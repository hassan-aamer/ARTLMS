<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ToolRequest;
use App\Models\Tool;
use Illuminate\Support\Facades\File;

class ToolController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Tool::where('teacher_id', $this->userId())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Tool::orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.tools.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.tools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ToolRequest $request)
    {
        $data = $request->validated();
        //upload Image
        $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
        $data['image'] = $image;
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $data['teacher_id'] = $this->userId();
        Tool::create($data);
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        $content =  $tool;
        $this->editPermission($content);
        return view('admin_dashboard.tools.edit', compact('content'));
    }

    public function showAttach($id)
    {
        $content = Tool::find($id);
        return view('admin_dashboard.tools.attach', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ToolRequest $request, Tool $tool)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $tool->update($data);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
