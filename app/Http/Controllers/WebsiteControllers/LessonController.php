<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Lesson;
use App\Models\Scheduled;
use App\Models\Unit;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    //show
    public function show($id)
    {
         $content = Lesson::with(['courses','unit','files','skills'])->whereStatus('yes')->whereId($id);
        if(auth()->user()->userInfo?->group_type == 'd')
        {
            $content = $content->whereType('lesson');
        }
        $content =  $content->first();
        if(!$content)
        {
            return abort(404);
        }
        $page_title = $content->title;
        if($content->kind == 'connected'){
            $subTitle = '<a href="'.route('website.curriculums.index').'">مناهجي</a>' .' / '.
                '<a href="'.route('website.curriculums.show',$content->unit?->scheduled?->curriculum?->id).'">'
                .$content->unit?->scheduled?->curriculum?->title.'</a>' .' / '.
                '<a href="'.route('website.scheduleds.show',$content->unit?->scheduled?->id).'">'
                .$content->unit?->scheduled?->title.'</a>' .' / '.
                '<a href="'.route('website.units.show',$content->unit?->id).'">'
                .$content->unit?->title.'</a>' .' / '.
                $content->title;
        }
        else{
            $subTitle = '<a href="'.route('website.curriculums.index').'">مناهجي</a>' .' / '.
                '<a href="'.route('website.curriculums.show',$content?->scheduled?->curriculum?->id).'">'
                .$content?->scheduled?->curriculum?->title.'</a>' .' / '.
                '<a href="'.route('website.scheduleds.show',$content?->scheduled?->id).'">'
                .$content?->scheduled?->title.'</a>' .' / '. $content->title;
        }

        //Calendars
        $calendars = Calendar::withCount('questions')->whereStatus('yes')->whereType('staging')
            ->where('lesson_id', $content->id)->where('staging_type', 'lesson')->orderBy('sort', 'asc')->get();

        return view('website.single_lesson', compact('content','page_title','subTitle','calendars'));
    }


}
