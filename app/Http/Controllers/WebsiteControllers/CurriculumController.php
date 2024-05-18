<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'المناهج';
        $content = Curriculum::withCount('scheduleds')->whereStatus('yes');
        if(auth()->user()->type == 'student')
        {
            $content = $content->where('level_id', auth()->user()->userInfo?->level_id);
        }
        $content = $content->orderBy('sort', 'asc')->paginate(config('app.paginate'));
        return view('website.curriculums', compact('content','page_title'));
    }

    //show
    public function show($id)
    {
        $content = Curriculum::with(['scheduleds.category', 'files'])->whereStatus('yes')->whereId($id);

        if(auth()->user()->type == 'student')
        {
            $content = $content->where('level_id', auth()->user()->userInfo?->level_id);
        }
        $content = $content->first();
        if(!$content)
        {
            return abort(404);
        }
        $page_title = $content->title;
        $subTitle = '<a href="'.route('website.curriculums.index').'">مناهجي</a>' .' / '. $content->title;


        //Calendars
        $calendars = Calendar::withCount('questions')->whereStatus('yes')->whereType('final')
            ->where('curriculum_id', $content->id)->orderBy('sort', 'asc')->get();

        return view('website.single_curriculum', compact('content','page_title','subTitle','calendars'));
    }


}
