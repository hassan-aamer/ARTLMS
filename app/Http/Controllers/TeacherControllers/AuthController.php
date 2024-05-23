<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Traits\HelperTrait;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        return view('website.teachers.register');
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

            Auth::login($created);

            $encryptID = Crypt::encryptString($created->id);


            DB::commit();
            toastr()->success('تم تسجيل الدخول بنجاح', 'نجح', ['timeOut' => 8000]);
            return redirect()->route('website.teacher.dashboard');
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


        if (Auth::attempt($data)) {
            toastr()->success('تم تسجيل الدخول بنجاح', 'نجح', ['timeOut' => 8000]);
            return redirect()->route('website.teacher.dashboard');
        }
        toastr()->error('البريد الإلكتروني أو كلمة المرور خاطئة', 'فشل', ['timeOut' => 8000]);
        return redirect()->back();

    }



}


