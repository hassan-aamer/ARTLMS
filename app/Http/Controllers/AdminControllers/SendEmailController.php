<?php

namespace App\Http\Controllers\AdminControllers;

use App\Mail\SendEmailUsers;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Traits\HelperTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     */
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
            $contactMessage = $request->input('contactMessage');
            $contactDetails = Contact::find($contactMessage);

            $teacherIds = $request->input('teachers', []);
            $studentIds = $request->input('students', []);
            $userIds = array_merge($teacherIds, $studentIds);
            $emails = User::whereIn('id', $userIds)->pluck('email')->toArray();

            Mail::to($emails)->send(new SendEmailUsers($contactDetails));

            return redirect()->back()->with(['success' => 'تم ارسال الرسالة الى المستخدمين بنجاح']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
