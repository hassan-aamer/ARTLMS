<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Scheduled;
use App\Models\Skill;
use App\Models\Term;
use App\Models\Unit;
use App\Models\ModuleFile;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LessonController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Lesson::with('unit')->orderBy('sort', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.lessons.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        $scheduleds = Scheduled::with('curriculum:id,title')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
        $units = Unit::with('scheduled.curriculum:id,title')->whereStatus('yes')->orderBy('sort', 'asc')->get();
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        $categories = Category::orderBy('sort', 'asc')->whereStatus('yes')->get();
        $galleries = Gallery::whereStatus('yes')->orderBy('sort', 'asc')->get();
        return view('admin_dashboard.lessons.create', compact('categories','skills', 'terms', 'units', 'scheduleds', 'galleries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            //upload Image
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
            $created = Lesson::create($data);
            //Save multiple skills
            $skills=(array)$data['skills'];
            $pivotData = array_fill(0, count($skills), ['lesson_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($skills, $pivotData);
            $created->skills()->sync($syncData);
            //Save Multiple Files
            $this->saveMultipleFiles('Lesson', $created->id, $data,'uploads/');

            DB::commit();
            toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        $terms = Term::all();
        $content =  $lesson;
        $units = Unit::with('scheduled.curriculum:id,title')->whereStatus('yes')->orderBy('sort', 'asc')->get();
        $scheduleds = Scheduled::with('curriculum:id,title')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->whereStatus('yes')->get();
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        $arrayCourseSkills = $content->skills->pluck('id')->toArray();
        $categories = Category::orderBy('sort', 'asc')->whereStatus('yes')->get();
        $galleries = Gallery::whereStatus('yes')->orderBy('sort', 'asc')->get();
        return view('admin_dashboard.lessons.edit', compact('content','categories','arrayCourseSkills','skills', 'terms', 'units', 'scheduleds', 'galleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonRequest $request, Lesson $lesson)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $lesson->update($data);
        $lesson->skills()->detach();
        $skills=(array)$data['skills'];
        $pivotData = array_fill(0, count($skills), ['lesson_id' => $lesson->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
        $syncData  = array_combine($skills, $pivotData);
        $lesson->skills()->sync($syncData);

        if($request->hasFile('file_uploaded'))
        {
            $this->saveMultipleFiles('Lesson', $lesson->id, $data,'uploads/');
        }
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->files()->delete();
        $lesson->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }



}
