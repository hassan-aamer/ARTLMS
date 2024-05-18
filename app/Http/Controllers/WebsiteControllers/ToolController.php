<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'الأدوات الدراسية';
        $content = Tool::whereStatus('yes')->orderBy('sort', 'asc')->paginate(config('app.paginate'));
        return view('website.tools', compact('content','page_title'));
    }


}
