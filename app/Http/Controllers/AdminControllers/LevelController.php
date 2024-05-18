<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Section;
use App\Models\TeacherAssignment;
use Illuminate\Http\Request;
use App\Http\Requests\LevelRequest;
use App\Models\Level;
use Illuminate\Support\Facades\File;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class LevelController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Level::whereIn('id', $this->teacher_levels())->orderBy('sort', 'asc')->paginate($this->paginate);

        }
        else
        {
            $content = Level::orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.levels.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if($this->isTeacher())
        {
          $sections = Section::whereIn('id', $this->teacher_sections())->pluck('id', 'name');
        }
        else
        {
            $sections = Section::pluck('id', 'name');
        }
        return view('admin_dashboard.levels.create',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelRequest $request)
    {
        $data = $request->validated();
        //upload Image
        $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
        $data['image'] = $image;
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $data['teacher_id'] = $this->userId();
        $created = Level::create($data);
        $sections=(array)$data['sections'];
        $pivotData = array_fill(0, count($sections), ['level_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
        $syncData  = array_combine($sections, $pivotData);
        $created->sections()->sync($syncData);
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {
        $content =  $level;
        $this->editPermission($content);
        $sections = Section::pluck('id', 'name');
        $arraySections = $content->sections->pluck('id')->toArray();
        return view('admin_dashboard.levels.edit', compact('content','sections','arraySections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LevelRequest $request, Level $level)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $level->update($data);
        $level->sections()->detach();
        $sections=(array)$data['sections'];
        $pivotData = array_fill(0, count($sections), ['level_id' => $level->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
        $syncData  = array_combine($sections, $pivotData);
        $level->sections()->sync($syncData);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        $level->sections()->detach();
        $level->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
