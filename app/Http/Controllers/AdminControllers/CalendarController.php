<?php

namespace App\Http\Controllers\AdminControllers;

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
        $content = Calendar::orderBy('sort', 'asc');
        if($this->isTeacher())
        {
            $content =$content->where('teacher_id', $this->userId());
        }
        $content = $content->paginate($this->paginate);
        return view('admin_dashboard.calendars.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        if($this->isTeacher())
        {
            $curriculums = Curriculum::whereStatus('yes')->whereIn('level_id', $this->teacher_levels())->orderBy('sort', 'asc')->pluck('id', 'title');
            $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
            $courses = Course::with('lesson.unit.scheduled.curriculum:id,title')->whereKind('separated')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
        }
        else
        {
            $curriculums = Curriculum::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
            $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();
            $courses = Course::with('lesson.unit.scheduled.curriculum:id,title')->whereKind('separated')->orderBy('sort', 'asc')->whereStatus('yes')->get();
        }
        return view('admin_dashboard.calendars.create', compact('lessons','curriculums','courses', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalendarRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try{
            if($data['staging_type'] == 'lesson')
            {
                $data['course_id'] = null;
            }
            elseif($data['staging_type'] == 'course')
            {
                $data['lesson_id'] = null;
            }
            $data['teacher_id'] = $this->userId();
            $created = Calendar::create($data);
            //Save multiple skills
            if(array_key_exists('skills', $data)){
                $skills=(array)$data['skills'];
                $pivotData = array_fill(0, count($skills), ['exam_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
                $syncData  = array_combine($skills, $pivotData);
                $created->skills()->sync($syncData);
            }
            DB::commit();
            toastr()->success($this->insertMsg, 'تم حفظ البيانات بنجاح', ['timeOut' => 5000]);
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'لم تتم العملية بنجاح', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {
        $content =  $calendar;
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        if($this->isTeacher())
        {
            $curriculums = Curriculum::whereStatus('yes')->whereIn('level_id', $this->teacher_levels())->orderBy('sort', 'asc')->pluck('id', 'title');
            $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
            $courses = Course::with('lesson.unit.scheduled.curriculum:id,title')->whereKind('separated')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
        }
        else
        {
            $curriculums = Curriculum::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
            $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();
            $courses = Course::with('lesson.unit.scheduled.curriculum:id,title')->whereKind('separated')->orderBy('sort', 'asc')->whereStatus('yes')->get();
        }
        $arrayCourseSkills = $content->skills->pluck('id')->toArray();
        $this->editPermission($content);
        return view('admin_dashboard.calendars.edit', compact('content','lessons','curriculums','courses', 'skills', 'arrayCourseSkills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CalendarRequest $request, Calendar $calendar)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try{
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
            $calendar->update($data);
            $calendar->skills()->detach();
            $skills=(array)$data['skills'];
            $pivotData = array_fill(0, count($skills), ['exam_id' => $calendar->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($skills, $pivotData);
            $calendar->skills()->sync($syncData);
            DB::commit();
            toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'لم تتم العملية بنجاح', ['timeOut' => 5000]);
            return redirect()->back();
        }
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
