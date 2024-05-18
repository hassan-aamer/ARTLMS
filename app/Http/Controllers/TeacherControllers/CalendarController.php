<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Lesson;
use App\Models\ModuleFile;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CalendarController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Calendar::orderBy('sort', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.calendars.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        $curriculums = Curriculum::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();
        $courses = Course::with('lesson.unit.scheduled.curriculum:id,title')->whereKind('separated')->orderBy('sort', 'asc')->whereStatus('yes')->get();

        return view('admin_dashboard.calendars.create', compact('lessons','curriculums','courses', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalendarRequest $request)
    {
        $data = $request->validated();
        if($data['staging_type'] == 'lesson')
        {
            $data['course_id'] = null;
        }
        elseif($data['staging_type'] == 'course')
        {
            $data['lesson_id'] = null;
        }
        Calendar::create($data);
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {
        $content =  $calendar;
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        $curriculums = Curriculum::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();
        $courses = Course::with('lesson.unit.scheduled.curriculum:id,title')->whereKind('separated')->orderBy('sort', 'asc')->whereStatus('yes')->get();
        return view('admin_dashboard.calendars.edit', compact('content','lessons','curriculums','courses', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CalendarRequest $request, Calendar $calendar)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $calendar->update($data);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->questions()->delete();
        $calendar->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }



}
