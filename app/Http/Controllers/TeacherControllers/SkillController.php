<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\SkillImage;
use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Support\Facades\File;

class SkillController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Skill::orderBy('sort', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.skills.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $created = Skill::create($data);

        if($created)
        {
            foreach ($request->file('images') as $image)
            {
                $moveTo = 'uploads/';
                $fileUploaded=rand(1,99999999999).'__'.$image->getClientOriginalName();
                $image->move($moveTo, $fileUploaded);

                SkillImage::create([
                    'skill_id' =>$created->id,
                    'image' =>$fileUploaded
                ]);
            }
        }

        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        $content =  $skill;
        return view('admin_dashboard.skills.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $skill->update($data);

        if($request->file('images'))
        {
            SkillImage::where('skill_id',$skill->id)->delete();
            foreach ($request->file('images') as $image)
            {
                $moveTo = 'uploads/';
                $fileUploaded=rand(1,99999999999).'__'.$image->getClientOriginalName();
                $image->move($moveTo, $fileUploaded);
                SkillImage::create([
                    'skill_id'=>$skill->id,
                    'image'=>$fileUploaded,
                ]);
            }
        }

        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->images()->delete();
        $skill->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
