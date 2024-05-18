<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Level;
use App\Models\Section;
use App\Models\TeacherAssignment;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = User::with('userInfo')->whereType(2)->orderBy('id', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.teachers.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $created = User::create([
                'type' =>2,
                'name' =>$data['name'],
                'email' =>$data['email'],
                'email_verified_at' =>date('Y-m-d H:i:s'),
                'second_email' =>$data['second_email'],
                'password' =>Hash::make($data['password']),
            ]);
            $this->createUserInfo($data,$created->id,$request, $type='created');
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
    public function edit($id)
    {
        $content =  User::with('userInfo')->whereType(2)->findOrFail($id);
        return view('admin_dashboard.teachers.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, $id)
    {
        $user =  User::with('userInfo')->whereType(2)->findOrFail($id);

        $data = $request->validated();

        DB::beginTransaction();
        try {
            $user->update([
                'name' =>$data['name'],
                'email' =>$data['email'],
                'second_email' =>$data['second_email'],
                'email_verified_at' =>isset($data['email_verified_at']) ? date('Y-m-d H:i:s') : NULL,
            ]);
            $this->createUserInfo($data,$user->id,$request, $type='updated');

            DB::commit();
            toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $content =  User::whereType(2)->findOrFail($id);
        $content->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    public function show($id)
    {
        $content =  User::with('userInfo')->whereType(2)->findOrFail($id);
        $levels_with_sections = Level::with('sections')->whereStatus('yes')->get();
        $assignmentsLevels = TeacherAssignment::where('teacher_id', $content->id)->pluck('level_ids')->toArray();
        return view('admin_dashboard.teachers.show', compact('content','levels_with_sections','assignmentsLevels'));
    }
    //assignments
    public function assignments(Request $request, $id)
    {
       $teacher =User::whereType(2)->findOrFail($id);
       if(!$teacher) { return abort(404); }

        TeacherAssignment::where('teacher_id', $teacher->id)->delete();
        if($request->levels && count($request->levels) > 0)
        {

            foreach ($request->levels as $key => $val)
            {
                $sectionsArr = [];
                if($request->sections)
                {
                    foreach ($request->sections as $key2 => $val2)
                    {
                        if($val2 == $val)
                        {
                            array_push($sectionsArr, $key2);
                        }
                    }
                }
                $implodeSections = implode(',', $sectionsArr);

                TeacherAssignment::create([
                    'teacher_id' =>$teacher->id,
                    'level_ids' =>$val,
                    'section_ids' =>isset($implodeSections) ? $implodeSections : 0,
                ]);
            }


        }

        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


}
