<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Models\User;
use App\Models\Group;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Traits\HelperTrait;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    use HelperTrait;

    //register_page
    public function register_page()
    {
        if(Auth::check())
        {
            return redirect()->to('/');
        }
        $groups = Group::all();
        return view('website.teachers.register',compact('groups'));
    }

    //register
    public function register(StudentRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $created = User::create([
                'type' =>2,
                'name' =>$data['name'],
                'email' =>$data['email'],
                'second_email' =>$data['second_email'],
                'password' =>Hash::make($data['password']),
            ]);

            $data['status'] ='no';
            $this->createUserInfo($data,$created->id,$request, $type='created');



            DB::commit();
            return redirect()->route('website.index')->with(['success' => 'تم التسجيل بنجاح فى انتظار موافقة الادمن']);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }


    //login page
    public function login_page()
    {
        if(Auth::check())
        {
            return redirect()->to('/');
        }
        return view('website.teachers.login');
    }

    //login
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::with('userInfo')->whereEmail($data['email'])->first();

        if(!$user)
        {
            toastr()->error('البريد الإلكتروني أو كلمة المرور خاطئة', 'فشل', ['timeOut' => 8000]);
            return redirect()->back();
        }

        if($user->type != 'teacher')
        {
            toastr()->error('هذا الحساب ليس حساب محاضر', 'فشل', ['timeOut' => 8000]);
            return redirect()->back();
        }
        elseif($user->email_verified_at == null)
        {
            return redirect()->back()->with(['error' => 'هذا الحساب غير مفعل يرجى التواتصل مع الادمن']);
        }
        elseif($user->userInfo?->status != 'yes')
        {
            return redirect()->back()->with(['error' => 'هذا الحساب غير نشط يرجى التواتصل مع الادمن']);
        }


        if (Auth::attempt($data)) {
            toastr()->success('تم تسجيل الدخول بنجاح', 'نجح', ['timeOut' => 8000]);
            return redirect()->route('website.teacher.dashboard');
        }
        toastr()->error('البريد الإلكتروني أو كلمة المرور خاطئة', 'فشل', ['timeOut' => 8000]);
        return redirect()->back();

    }




}


