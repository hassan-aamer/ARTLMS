<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\CourseSkill;
use App\Models\Lesson;
use App\Models\Scheduled;
use App\Models\Term;
use App\Models\User;
use App\Models\Skill;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Course::with(['category', 'teacher'])->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Course::with(['category', 'teacher'])->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.courses.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        if($this->isTeacher())
        {
            $teachers = User::whereType(2)->where('id', $this->userId())->pluck('id', 'name');
            $categories = Category::orderBy('sort', 'asc')->where('teacher_id', $this->userId())->whereStatus('yes')->pluck('id', 'title');
            $scheduleds = Scheduled::with('curriculum:id,title')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
            $skills = Skill::orderBy('sort', 'asc')->where('teacher_id', $this->userId())->whereStatus('yes')->pluck('id', 'title');
            $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
        }
        else
        {
            $teachers = User::whereType(2)->pluck('id', 'name');
            $categories = Category::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
            $scheduleds = Scheduled::with('curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();
            $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
            $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();
        }

        return view('admin_dashboard.courses.create' , compact('scheduleds','lessons','teachers','categories', 'skills', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            //upload Image
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
            if($data['kind'] == 'connected')
            {
                $data['teacher_id'] = $this->userId();
            }
            $created = Course::create($data);
            $skills=(array)$data['skills'];
            $pivotData = array_fill(0, count($skills), ['course_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($skills, $pivotData);
            $created->skills()->sync($syncData);
            //Save Multiple Files
            $this->saveMultipleFiles('Course', $created->id, $data,'uploads/');
            DB::commit();
            toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->back();
        }


    }


    /**
     * Show the form for editing the specified resource.
     */

    //show
    public function show(Course $course)
    {
        $content = $course;
        return view('admin_dashboard.courses.show' , compact('content'));
    }

    public function edit(Course $course)
    {
        $terms = Term::all();
        $content = $course;
        $teachers = User::whereType(2)->pluck('id', 'name');
        $categories = Category::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        $scheduleds = Scheduled::with('curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();

        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
         $arrayCourseSkills = $content->skills->pluck('id')->toArray();
        $lessons = Lesson::with('unit.scheduled.curriculum:id,title')->orderBy('sort', 'asc')->whereStatus('yes')->get();
        return view('admin_dashboard.courses.edit' , compact('scheduleds','lessons','arrayCourseSkills','content','teachers','categories', 'skills', 'terms'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            //upload Image
            if($request->hasFile('image')){
                $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
                $data['image'] = $image;
            }
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
            $course->update($data);
            $course->skills()->detach();
            $skills=(array)$data['skills'];
            $pivotData = array_fill(0, count($skills), ['course_id' => $course->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($skills, $pivotData);
            $course->skills()->sync($syncData);
            if($request->hasFile('file_uploaded'))
            {
                $this->saveMultipleFiles('Course', $course->id, $data,'uploads/');
            }
            DB::commit();
            toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->skills()->detach();
        $course->files()->delete();
        $course->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
