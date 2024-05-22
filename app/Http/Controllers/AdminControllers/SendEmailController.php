<?php

namespace App\Http\Controllers\AdminControllers;


use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Traits\HelperTrait;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailUser;

class SendEmailController extends Controller
{
    use HelperTrait;
    public function index($id)
    {
        $contactMessage = Contact::find($id);
        $student = User::with('userInfo')->whereType(3)->orderBy('id', 'asc')->paginate($this->paginate);
        $teacher = User::with('userInfo')->whereType(2)->orderBy('id', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.send-email.index', compact('contactMessage', 'student', 'teacher'));
    }

    public function store(Request $request)
    {
        try {

            $contactMessageId = $request->input('contactMessage');
            $email = $request->input('email');
            $teacherIds = $request->input('teachers', []);
            $studentIds = $request->input('students', []);

            SendEmailUser::dispatch($contactMessageId, $teacherIds, $studentIds,$email);

            return redirect()->back()->with(['success' => 'تم ارسال الرسالة الى المستخدمين بنجاح']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
