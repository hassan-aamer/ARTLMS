<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ExtensionRequest;
use App\Models\Extension;
use Illuminate\Support\Facades\File;

class ExtensionController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Extension::where('teacher_id', $this->userId())->paginate($this->paginate);
        }
        else
        {
            $content = Extension::paginate($this->paginate);
        }
        return view('admin_dashboard.extensions.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.extensions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExtensionRequest $request)
    {
        $data = $request->validated();
        $data['teacher_id'] = $this->userId();
        Extension::create($data);
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extension $extension)
    {
       $content =  $extension;
        $this->editPermission($content);
       return view('admin_dashboard.extensions.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExtensionRequest $request, Extension $extension)
    {
        $data = $request->validated();
        $extension->update($data);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extension $extension)
    {
        $extension->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
