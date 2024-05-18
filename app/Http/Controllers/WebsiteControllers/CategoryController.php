<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'المجالات والمحاور الفنية';
        $content = Category::with('courses')->whereStatus('yes')->orderBy('sort', 'asc')->paginate(config('app.paginate'));
        return view('website.categories', compact('content','page_title'));
    }

    //show
    public function show($id)
    {
        $content = Category::with('courses')->whereStatus('yes')->orderBy('sort', 'asc')->whereId($id)->first();
        if(!$content)
        {
            return view('errors.404');
        }
        $page_title = $content->title;
        return view('website.single-category', compact('content','page_title'));
    }


}
