<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryTime;
use App\Models\Lesson;
use Carbon\CarbonInterval;

class GalleryController extends Controller
{
    //Index
    public function index()
    {
        $page_title = 'المعارض الفنية';
        $content = Gallery::with('images')->whereStatus('yes')->orderBy('sort', 'asc')->paginate(config('app.paginate'));
        return view('website.galleries', compact('content','page_title'));
    }

    public function show($id)
    {
        $content = Gallery::with('images')->whereStatus('yes')->whereId($id)->first();
//        $prevTimes = GalleryTime::where('user_id', auth()->user()->id)->where('gallery_id', $id)->get();
//        $intervalArray = [];
//        $initialInterval = CarbonInterval::seconds(0);
//        foreach ($prevTimes as $time){
//            $start = \Carbon\Carbon::createFromDate($time->start_time);
//            $end = \Carbon\Carbon::createFromDate($time->end_time);
//            array_push($intervalArray, $start->diffAsCarbonInterval($end)->s);
//            $initialInterval->add($start->diffAsCarbonInterval($end))->cascade();
//        }
//        $intervalArraySum = array_sum($intervalArray);
//        $finalTimeValue = $initialInterval->forHumans();
        if(!$content)
        {
            return view('errors.404');
        }
        $page_title = $content->title;
        $galleries = Gallery::with('images')->where('id', '!=',$content->id)->whereStatus('yes')->latest()->limit(3)->get();
        $lessons_lectures_based_on_user_group_type
            = (auth()->user()->userInfo?->group_type == 'd') ? Lesson::where('gallery_id', $id)->where('type','lesson')->whereStatus('yes')->get() : Lesson::where('gallery_id', $id)->whereStatus('yes')->get();
        return view('website.gallery', compact('content','page_title','galleries', 'lessons_lectures_based_on_user_group_type'));
    }
}
