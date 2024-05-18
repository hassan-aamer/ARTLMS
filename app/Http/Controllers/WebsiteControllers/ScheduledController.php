<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Scheduled;
use Illuminate\Http\Request;

class ScheduledController extends Controller
{

    //show
    public function show($id)
    {
        $content = Scheduled::with(['courses','units', 'files'])->whereStatus('yes')->whereId($id)->first();
        if(!$content)
        {
            return abort(404);
        }
        $page_title = $content->title;
        $subTitle = '<a href="'.route('website.curriculums.index').'">مناهجي</a>' .' / '.'<a href="'.route('website.curriculums.show',$content->curriculum?->id).'">'.$content->curriculum?->title.'</a>' .' / '. $content->title;
        $lessons_lectures_based_on_user_group_type
            = (auth()->user()->userInfo?->group_type == 'd') ? $content->lessons->where('type','lesson') : $content->lessons;
        return view('website.single_scheduled', compact('content','page_title','subTitle','lessons_lectures_based_on_user_group_type'));
    }


}
