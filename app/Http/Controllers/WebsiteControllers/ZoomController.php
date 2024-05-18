<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Zoom;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'الفصول الافتراضية';
        $content = Zoom::where('level_id', auth()->user()->userInfo?->level_id)
            ->where('section_id', auth()->user()->userInfo?->section_id)->latest()->paginate(config('app.paginate'));
        return view('website.meetings', compact('content','page_title'));
    }



}
