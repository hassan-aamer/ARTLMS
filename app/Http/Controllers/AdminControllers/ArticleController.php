<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Article::whereIn('level_id', $this->teacher_levels())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Article::orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.articles.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ArticleCategory::get(['id', 'name']);
        $tags = ArticleTag::get(['id', 'name']);
        if($this->isTeacher())
        {
            $levels =  Level::whereStatus('yes')->whereIn('level_id', $this->teacher_levels())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $levels =  Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        return view('admin_dashboard.articles.create', compact('categories','tags','levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();
        //upload Image
        $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
        $data['image'] = $image;
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $data['teacher_id'] = $this->userId();
        isset($data['tags_id']) ? $data['tags_id']= implode(',' , $data['tags_id']) : '';
        $created = Article::create($data);
        if($request->hasFile('file_uploaded')) {
            //Save Multiple Files
            $this->saveMultipleFiles('Article', $created->id, $data, 'uploads/');
        }
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $content =  $article;
        $this->editPermission($content);
        $categories = ArticleCategory::get(['id', 'name']);
        $tags = ArticleTag::get(['id', 'name']);
        $tagsIDS = ($content->tags_id) ? explode(',' , $content->tags_id): '';

        if($this->isTeacher())
        {
            $levels =  Level::whereStatus('yes')->whereIn('level_id', $this->teacher_levels())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $levels =  Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        return view('admin_dashboard.articles.edit', compact('levels','content','tagsIDS','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        isset($data['tags_id']) ? $data['tags_id']= implode(',' , $data['tags_id']) : '';
        $article->update($data);
        if($request->hasFile('file_uploaded'))
        {
            $this->saveMultipleFiles('Article', $article->id, $data,'uploads/');
        }
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->files()->delete();
        $article->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
