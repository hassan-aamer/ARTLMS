<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\Scheduled;
use App\Models\ModuleFile;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UnitController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Unit::with('scheduled')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Unit::with('scheduled')->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.units.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        $categories = Category::orderBy('sort', 'asc')->whereStatus('yes')->get();
        if($this->isTeacher()) {
            $scheduleds = Scheduled::with('curriculum:id,title')->where('teacher_id', $this->userId())->whereStatus('yes')->orderBy('sort', 'asc')->get();
            $teachers = User::whereType(2)->where('id', $this->userId())->pluck('id', 'name');
        }
        else
        {
            $scheduleds = Scheduled::with('curriculum:id,title')->whereStatus('yes')->orderBy('sort', 'asc')->get();
            $teachers = User::whereType(2)->pluck('id', 'name');
        }

        return view('admin_dashboard.units.create', compact('categories','teachers', 'terms', 'scheduleds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            //upload Image
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
            $data['teacher_id'] = $this->userId();
            $created = Unit::create($data);

            //Save multiple teachers
            $teachers=(array)$data['teachers'];
            $pivotData = array_fill(0, count($teachers), ['unit_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($teachers, $pivotData);
            $created->teachers()->sync($syncData);

            //Save Multiple Files
            $this->saveMultipleFiles('Unit', $created->id, $data,'uploads/');
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
    public function edit(Unit $unit)
    {
        $terms = Term::all();
        $content =  $unit;
        $categories = Category::orderBy('sort', 'asc')->whereStatus('yes')->get();
        if($this->isTeacher()) {
            $scheduleds = Scheduled::with('curriculum:id,title')->where('teacher_id', $this->userId())->whereStatus('yes')->orderBy('sort', 'asc')->get();
            $teachers = User::whereType(2)->where('id', $this->userId())->pluck('id', 'name');
        }
        else
        {
            $scheduleds = Scheduled::with('curriculum:id,title')->whereStatus('yes')->orderBy('sort', 'asc')->get();
            $teachers = User::whereType(2)->pluck('id', 'name');
        }
        $arrayUnitTeachers = $content->teachers->pluck('id')->toArray();
        $this->editPermission($content);
        return view('admin_dashboard.units.edit', compact('content','categories','teachers','arrayUnitTeachers', 'terms', 'scheduleds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $unit->update($data);
        $unit->teachers()->detach();
        $teachers=(array)$data['teachers'];
        $pivotData = array_fill(0, count($teachers), ['unit_id'=>$unit->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
        $syncData  = array_combine($teachers, $pivotData);
        $unit->teachers()->sync($syncData);
        if($request->hasFile('file_uploaded'))
        {
            $this->saveMultipleFiles('Unit', $unit->id, $data,'uploads/');
        }
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->files()->delete();
        $unit->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }



}
