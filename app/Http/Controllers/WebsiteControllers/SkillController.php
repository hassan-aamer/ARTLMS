<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'قائمة المهارات';
        $content = Skill::with('images')->whereStatus('yes')->orderBy('sort', 'asc')->paginate(config('app.paginate'));
        return view('website.skills', compact('content','page_title'));
    }

    //show
    public function show($id)
    {
        $content = Skill::with('images')->whereStatus('yes')->orderBy('sort', 'asc')->whereId($id)->first();
        if(!$content)
        {
            return view('errors.404');
        }
        $page_title = $content->title;

        $skills = Skill::with('images')->where('id', '!=',$content->id)->whereStatus('yes')->orderBy('sort', 'asc')->limit(4)->get();

        return view('website.single-skill', compact('content','page_title','skills'));
    }


}
