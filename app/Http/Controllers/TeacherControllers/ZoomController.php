<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Level;
use App\Models\ModuleFile;
use Illuminate\Http\Request;
use App\Http\Requests\ZoomRequest;
use App\Models\Zoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ZoomController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Zoom::with('level:id,title')->latest()->paginate($this->paginate);
        return view('admin_dashboard.zooms.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('admin_dashboard.zooms.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZoomRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $data['start_time'] = date('Y-m-d H:i:s', strtotime($data['start_time']));
            $data['end_time'] = date('Y-m-d H:i:s', strtotime($data['start_time'] . ' + '.$data['duration'].' minute'));
            Zoom::create($data);
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
    public function edit(Zoom $zoom)
    {
        $content =  $zoom;
        $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('admin_dashboard.zooms.edit', compact('content','levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ZoomRequest $request, Zoom $zoom)
    {
        $data = $request->validated();
        $zoom->update($data);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zoom $zoom)
    {
        $zoom->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


}
