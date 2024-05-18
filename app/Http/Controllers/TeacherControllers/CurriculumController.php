<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Level;
use App\Models\ModuleFile;
use App\Models\Skill;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CurriculumController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Curriculum::with('level')->orderBy('sort', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.curriculums.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('admin_dashboard.curriculums.create', compact('levels', 'terms', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurriculumRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            //upload Image
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
            $created = Curriculum::create($data);
            //Save multiple skills
            if(array_key_exists('skills', $data)){
                $skills=(array)$data['skills'];
                $pivotData = array_fill(0, count($skills), ['curriculum_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
                $syncData  = array_combine($skills, $pivotData);
                $created->skills()->sync($syncData);
            }
            //Save Multiple Files
            $this->saveMultipleFiles('Curriculum', $created->id, $data,'uploads/');
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
    public function edit(Curriculum $curriculum)
    {
        $terms = Term::all();
        $content =  $curriculum;
        $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        return view('admin_dashboard.curriculums.edit', compact('content','levels', 'terms', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurriculumRequest $request, Curriculum $curriculum)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $curriculum->update($data);
        // handle skills
        if(array_key_exists('skills', $data)){
            $curriculum->skills()->detach();
            $skills=(array)$data['skills'];
            $pivotData = array_fill(0, count($skills), ['curriculum_id' => $curriculum->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($skills, $pivotData);
            $curriculum->skills()->sync($syncData);
        }
        if($request->hasFile('file_uploaded'))
        {
            $this->saveMultipleFiles('Curriculum', $curriculum->id, $data,'uploads/');
        }
        DB::commit();
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curriculum $curriculum)
    {
        $curriculum->files()->delete();
        $curriculum->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    //moduleFileDestroy
    public function moduleFileDestroy($id)
    {
        $item = ModuleFile::find($id);
        $item->delete();
        toastr()->success(' تم حذف العنصر بنجاح', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


}
