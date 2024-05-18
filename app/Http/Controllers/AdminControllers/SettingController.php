<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Scheduled;
use App\Models\ModuleFile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Setting::get();
        return view('admin_dashboard.settings.index' , compact('content'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request)
    {
        $data = $request->validated();
        foreach($data['value'] as $key =>$val)
        {
            Setting::whereId($key)->update(['value'=>$val]);
        }
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }




}
