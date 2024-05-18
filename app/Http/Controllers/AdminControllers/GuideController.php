<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use Illuminate\Http\Request;
use App\Http\Requests\GuideRequest;
use App\Models\Guide;
use Illuminate\Support\Facades\File;

class GuideController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Guide::where('teacher_id', $this->userId())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Guide::orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.guides.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuideRequest $request)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $data['teacher_id'] = $this->userId();
        Guide::create($data);
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guide $guide)
    {
        $content =  $guide;
        $this->editPermission($content);
        return view('admin_dashboard.guides.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuideRequest $request, Guide $guide)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $guide->update($data);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guide $guide)
    {
        $guide->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
