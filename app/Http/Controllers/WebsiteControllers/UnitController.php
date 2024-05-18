<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Scheduled;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    //show
    public function show($id)
    {
        $content = Unit::with(['lessons','files'])->whereStatus('yes')->whereId($id)->first();
        if(!$content)
        {
            return abort(404);
        }
        $page_title = $content->title;
        $subTitle = '<a href="'.route('website.curriculums.index').'">مناهجي</a>' .' / '.
            '<a href="'.route('website.curriculums.show',$content->scheduled?->curriculum?->id).'">'
            .$content->scheduled?->curriculum?->title.'</a>' .' / '.
            '<a href="'.route('website.scheduleds.show',$content->scheduled?->id).'">'
            .$content->scheduled?->title.'</a>' .' / '. $content->title;


        $lessons_lectures_based_on_user_group_type
            = (auth()->user()->userInfo?->group_type == 'd') ? $content->lessons->where('type','lesson') : $content->lessons;

        return view('website.single_unit', compact('lessons_lectures_based_on_user_group_type','content','page_title','subTitle'));
    }


}
