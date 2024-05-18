<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //Index
    public function index()
    {
        $page_title = ' قائمة المحاضرين والمعلمين';
        $content = User::with(['userInfo','courses'])->whereType(2)->whereNotNull('email_verified_at')->paginate(config('app.paginate'));
        return view('website.teachers',compact('content','page_title'));
    }

    //show
    public function show($id)
    {
        $content = User::with(['userInfo','courses'])->whereType(2)->whereNotNull('email_verified_at')->whereId($id)->first();
        if(!$content || $content->userInfo?->status == 'no')
        {
            return view('errors.404');
        }

        $page_title = $content->name;
        return view('website.single-teacher',compact('content','page_title'));
    }

}
