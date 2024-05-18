<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\Tool;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'دليل المستخدم لاستخدام المنصة';
        $content = Guide::whereStatus('yes')->orderBy('sort', 'asc')->paginate(config('app.paginate'));
        return view('website.guides', compact('content','page_title'));
    }

    public function show($id)
    {
        $content = Guide::whereStatus('yes')->whereId($id)->first();
        if(!$content)
        {
            return view('errors.404');
        }
        $page_title = $content->title;
        $related = Guide::where('id', '!=',$content->id)->whereStatus('yes')->limit(3)->latest()->get();
        return view('website.guide', compact('content','page_title','related'));
    }


}
