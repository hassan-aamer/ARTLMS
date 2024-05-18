<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'المدونة';
        $content = Article::whereStatus('yes')->orderBy('sort', 'asc');
        if(request('category_id'))
        {
            $content = $content->where('category_id', request('category_id'));
        }
        if(request('tag_id'))
        {
            $content = $content->where('tags_id', 'LIKE', "%".request('tag_id')."%");
        }
        if(auth()->user()->type == 3)
        {
            $content = $content->where(['level_id' => auth()->user()->userInfo?->level_id, 'group' =>auth()->user()->userInfo?->group_type])->paginate(config('app.paginate'));
        }
        else
        {
            $content = $content->paginate(config('app.paginate'));

        }

        return view('website.articles', compact('content','page_title'));
    }

    //show
    public function show($id)
    {
        if(auth()->user()->type == 3)
        {
            $content = Article::whereStatus('yes')->where(['level_id' => auth()->user()->userInfo?->level_id, 'group' =>auth()->user()->userInfo?->group_type])->orderBy('sort', 'asc')->whereId($id)->first();
        }
        else
        {
            $content = Article::whereStatus('yes')->orderBy('sort', 'asc')->whereId($id)->first();
        }
        if(!$content)
        {
            return view('errors.404');
        }
        $page_title = $content->title;
        $related = Article::whereStatus('yes')->orderBy('sort', 'asc')->where('id', '!=', $content->id)->take(4)->get();

        $categories = ArticleCategory::withCount('articles')->get();
        $tags = ArticleTag::get();

        return view('website.single-article', compact('content','page_title', 'related', 'categories', 'tags'));
    }


}
