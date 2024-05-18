<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Traits\HelperTrait;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HelperTrait;

    //login page
    public function login_page()
    {
        if(Auth::check())
        {
            return redirect()->to('/');
        }
        return view('admin_dashboard.login');
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

        if($user->type != 'admin')
        {
            toastr()->error('هذا الحساب ليس حساب أدمن', 'فشل', ['timeOut' => 8000]);
            return redirect()->back();
        }
        if (Auth::attempt($data)) {
            toastr()->success('تم تسجيل الدخول بنجاح', 'نجح', ['timeOut' => 8000]);
            return redirect()->route('admin.dashboard');
        }
        toastr()->error('البريد الإلكتروني أو كلمة المرور خاطئة', 'فشل', ['timeOut' => 8000]);
        return redirect()->back();

    }



}


