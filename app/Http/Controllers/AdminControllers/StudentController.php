<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Traits\HelperTrait;
use App\Models\User;
use App\Models\Level;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = User::with('userInfo')->whereType(3)->orderBy('id', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.students.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('admin_dashboard.students.create',compact('levels'));
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
                'type' =>3,
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
        $content =  User::with('userInfo')->whereType(3)->findOrFail($id);
         $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('admin_dashboard.students.edit', compact('content','levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, $id)
    {
        $user =  User::with('userInfo')->whereType(3)->findOrFail($id);
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
        $content =  User::whereType(3)->findOrFail($id);

        $content->userInfo->delete();
        $content->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    //
    public function createUserInfo($data,$userID, $request, $type)
    {
     
        $someData = [
            'user_id'=>$userID,
            'phone' =>$data['phone'],
            'group_type' =>$data['group_type'],
            'date_of_birth' =>null,
            'job_title' =>$data['job_title'],
            'gender' =>$data['gender'],
            'national_id'=>$data['national_id'],
            'city'=>$data['city'],
            'specialist' =>$data['specialist'],
            'qualification'=>$data['qualification'],
            'school_or_college'=>$data['school_or_college'],
            'department'=>$data['department'],
            'reason'=>$data['reason'],
            'status'=>isset($data['status']) ? 'yes' : 'no',
        ];
          if($request->file('image'))
        {
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
             $someData['image'] = $image;
        }
        if($type == 'created')
        {
            $someData['level_id'] = $data['level_id'];
            UserInfo::create($someData);
        }
        elseif($type == 'updated')
        {
            UserInfo::where('user_id', $userID)->update($someData);
        }
    }


}
