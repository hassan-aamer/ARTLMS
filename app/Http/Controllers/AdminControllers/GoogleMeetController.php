<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\MeetRequest;
use App\Models\Meet;
use Illuminate\Support\Facades\File;

class GoogleMeetController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Meet::latest()->paginate($this->paginate);
        return view('admin_dashboard.meets.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::whereType(2)->where('id', '!=', $this->userId())->pluck('id','name');
        return view('admin_dashboard.meets.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MeetRequest $request)
    {
        $data = $request->validated();
        $data['sender_id'] = $this->userId();
        Meet::create($data);
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meet $meet)
    {
        $currentUser =false;
        $content =  $meet;
        $teachers = User::whereType(2)->where('id', '!=', $this->userId())->pluck('id','name');
        if($content->sender_id == $this->userId() )
        {
            $currentUser =true;
        }

        $receivers = [];
        foreach($content->receiver_ids as $receiver_id)
        {
            $receiver = User::select('name')->find($receiver_id);
            array_push($receivers,$receiver);
        }
        return view('admin_dashboard.meets.edit', compact('content','teachers','currentUser','receivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MeetRequest $request, Meet $meet)
    {
        $data = $request->validated();
        $meet->update($data);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meet $meet)
    {
        $meet->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
