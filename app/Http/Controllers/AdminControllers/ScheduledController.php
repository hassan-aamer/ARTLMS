<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\Curriculum;
use App\Models\ModuleFile;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduledRequest;
use App\Models\Scheduled;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ScheduledController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Scheduled::with(['curriculum','category'])->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Scheduled::with(['curriculum','category'])->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.scheduleds.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        $categories = Category::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $curriculums = Curriculum::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('admin_dashboard.scheduleds.create', compact('categories','curriculums', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduledRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            //upload Image
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
            $data['teacher_id'] = $this->userId();
            $created = Scheduled::create($data);
            //Save Multiple Files
            $this->saveMultipleFiles('Scheduled', $created->id, $data,'uploads/');
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
    public function edit(Scheduled $scheduled)
    {
        $terms = Term::all();
        $content =  $scheduled;
        $categories = Category::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $curriculums = Curriculum::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $this->editPermission($content);
        return view('admin_dashboard.scheduleds.edit', compact('curriculums','content','categories', 'terms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduledRequest $request, Scheduled $scheduled)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $scheduled->update($data);
        if($request->hasFile('file_uploaded'))
        {
            $this->saveMultipleFiles('Scheduled', $scheduled->id, $data,'uploads/');
        }
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scheduled $scheduled)
    {
        $scheduled->files()->delete();
        $scheduled->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }



}
