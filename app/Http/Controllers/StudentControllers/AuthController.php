<?php

namespace App\Http\Controllers\StudentControllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Level;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('website.students.register',compact('levels'));
    }

    //register
    public function register(StudentRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $created = User::create([
                'type' => 3,
                'name' => $data['name'],
                'email' => $data['email'],
                'second_email' => $data['second_email'],
                'password' => Hash::make($data['password']),
            ]);

            $data['status'] ='no';
            $this->createUserInfo($data,$created->id,$request, $type='created');

            // Auth::login($created);


            DB::commit();

            return redirect()->route('website.index')->with(['success' => 'تم التسجيل بنجاح فى انتظار موافقة الادمن']);

        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($e->getMessage(), 'فشل', ['timeOut' => 5000]);
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
        return view('website.students.login');
    }

    //login
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::with('userInfo')->whereEmail($data['email'])->first();

        if(!$user)
        {
            return redirect()->back()->with(['error' => 'البريد الإلكتروني أو كلمة المرور خاطئة']);
        }

        if($user->type != 'student')
        {
            return redirect()->back()->with(['error' => 'هذا الحساب ليس حساب متعلم']);
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
            UserInfo::where('user_id', $user->id)->update(['login_count' => $user->userInfo?->login_count+1]);
            toastr()->success('تم تسجيل الدخول بنجاح', 'نجح', ['timeOut' => 8000]);
            return redirect()->route('website.curriculums.index');
        }
        toastr()->error('البريد الإلكتروني أو كلمة المرور خاطئة', 'فشل', ['timeOut' => 8000]);
        return redirect()->back();

    }



    //Forget password
    public function forget_password()
    {
        if(Auth::check())
        {
            return redirect()->to('/');
        }
        return view('website.students.forget_password');
    }

    public function reset_password(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', '=', $email)->first();
        if ($user) {
            $encrypt = Crypt::encryptString($user->id);
            $link = url("/reset_password/{$encrypt}");
            $html = view('emails.forget_password', compact('email', 'link'))->render();

            sendEmail($email,'منصة فن',$html, 'استعادة كلمة المرور');
            Session::flash('success', " قم بالذهاب إلي البريد الإلكتروني الخاص بك ");
            return Redirect::back();
        } else {
            Session::flash('message', " البريد الإلكتروني غير موجود ");
            return Redirect::back();
        }
    }


    public function change_reset_password($token)
    {
        return view('website.students.change_password', compact('token'));
    }


    public function change_reset_password_post(Request $request)
    {
        $token = $request->input('token');
        $password = $request->input('confirmPassword');
        $user = User::whereId(Crypt::decryptString($token))->first();
        if ($user) {
            $user->password = Hash::make($password);
            if ($user->save()) {
                if($request->page == 'edit_profile')
                {
                    Session::flash('success', " تم تغيير كلمة المرور بنجاح ");
                    return redirect()->back();
                }
                else
                {
                    Session::flash('success', " تم استعادة كلمة المرور بنجاح ");
                    if($user->type == 'teacher')
                    {
                        return redirect()->route('website.teacher.login_page');
                    }
                    else
                    {
                        return redirect()->route('website.student.login_page');
                    }
                }


            }
        } else {
            return abort(404);
        }
    }




    //verification_email
    public function verification_email($encryptID)
    {
        $user = User::whereId(Crypt::decryptString($encryptID))->first();
        if(is_null($user->email_verified_at))
        {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
        }
        return view('website.includes.verification_email', compact('user'));
    }



    //filterSections
    public function filterSections(Request $request)
    {
        if(!$request->level_id)
        {
            return response()->json(['success' => false, 'html' =>'']);
        }
        $level = Level::findOrFail($request->level_id);
        if(!$level) { return response()->json(['success' => false]); }
        $html = '';
        foreach ($level->sections as $section)
        {
            $html .= '<option value="'.$section->id.'">'.$section->name.'</option>';
        }
        return response()->json(['success' =>true, 'html' =>$html]);
    }


    public function student_logout(Request $request) {
        Auth::logout();
        session()->put('logout',true);
        return redirect('/');
    }

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
            'status'=>isset($data['status']) ? 'no' : 'yes',
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


