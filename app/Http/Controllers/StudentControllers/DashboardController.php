<?php

namespace App\Http\Controllers\StudentControllers;

use App\Http\Requests\GoogleMeetRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Googlemeet;
use App\Models\Level;
use App\Models\StudentAnswer;
use App\Models\StudentAnswerDegree;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use HelperTrait;

    public function dashboard()
    {
        $page_title = 'تعديل البيانات الشخصية';
        $levels = Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('website.students.dashboard.dashboard', compact('levels','page_title'));
    }

    public function update(StudentUpdateRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $user = User::find(auth()->user()->id);
            $user->update([
                'name' =>$data['name'],
            ]);
            $this->createUserInfo($data,$user->id,$request, $type='updated');
            DB::commit();
            toastr()->success('تم تعديل بياناتك بنجاح', 'نجح', ['timeOut' => 5000]);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->back();
        }
    }




    public function myCalendars()
    {
        $page_title = 'تقويماتي';
        $myFinalCalendarAndHisStaging = StudentAnswerDegree::with(['calendar:id,title', 'curriculum:id,title'])
            ->where('student_id' , auth()->user()->id)
            ->where('calendar_type', 'final')->get();

        $myCalendars = $myFinalCalendarAndHisStaging->map(function($calendarDegree, $key) {
           $stagingCalendarsOfAuthStudent = StudentAnswerDegree::with(['calendar:id,title'])
               ->where('student_id' , auth()->user()->id)
               ->where('calendar_type', 'staging')->where('curriculum_id', $calendarDegree->curriculum?->id)->get();
            return [
                'id' => $calendarDegree->id,
                'curriculum_title' => $calendarDegree->curriculum?->title,
                'calendar_title' => $calendarDegree->calendar?->title,
                'final_type' => $calendarDegree->calendar?->final_type,
                'student_final_degree' => $calendarDegree->student_final_degree,
                'duration' => $calendarDegree->duration,
                'knowledge_side_degree' =>$calendarDegree->knowledge_side_degree,
                'performance_side_degree' =>$calendarDegree->performance_side_degree,
                'sentimental_side_degree' =>$calendarDegree->sentimental_side_degree,
                'staging' => $stagingCalendarsOfAuthStudent
            ];
        });

        return view('website.students.dashboard.calendars', compact('myCalendars','page_title'));
    }



    //appointments
    public function appointments()
    {
         $page_title = ' اجتماعاتي ومواعيدي';
         $userID = auth()->user()->id;
         $myFriends = User::whereHas('userInfo', function($q){
             return $q->where('level_id', auth()->user()->userInfo?->level_id)->whereStatus('yes');
        })->whereNotNull('email_verified_at')->where('id', '!=', $userID)->get(['id', 'name', 'email']);

        $upcoming_approved_meetings = Googlemeet::owner($userID)
            ->where('invitation_status', 'approved')
            ->where('start_date_time', '>' ,  \Carbon\Carbon::now())
            ->orderBy('start_date_time')->get();

        $pending_meetings = Googlemeet::owner($userID)
            ->where('invitation_status', 'pending')
            ->where('start_date_time', '>' ,  \Carbon\Carbon::now())->orderBy('start_date_time')->get();

        $previous_meetings = Googlemeet::owner($userID)
            ->whereIn('invitation_status', ['pending', 'approved'])
            ->where('start_date_time', '<' ,  \Carbon\Carbon::now())->orderBy('start_date_time')->get();

        $rejected_meetings = Googlemeet::owner($userID)
            ->where('invitation_status', 'rejected')->get();

         return view('website.students.dashboard.appointments',
             compact(
                 'page_title',
                 'myFriends',
                 'upcoming_approved_meetings',
                 'pending_meetings',
                 'previous_meetings',
                 'rejected_meetings'
             ));
    }

    //Create Google Meet
    public function createGoogleMeet(GoogleMeetRequest $request)
    {
        $data = $request->validated();
        $data['sender_id'] = auth()->user()->id;
        $data['invitation_status'] = 'pending';
        Googlemeet::create($data);
        return response()->json(['success'=>true, 'message' =>'تم إنشاء الاجتماع بنجاح بانتظار قبول الدعوة من قبل الزميل']);
    }


    //approve_or_reject_meet
    public function approve_or_reject_meet(Request $request, $id)
    {
        $meet = Googlemeet::find($id);
        if(!$meet)
        {
            return response()->json(['success'=>false, 'message' =>'هذا الاجتماع غير موجود']);
        }
        if($meet->invitation_status != 'pending')
        {
            return response()->json(['success'=>false, 'message' =>'تم تغيير حالة الاجتماع بالفعل']);
        }
        $status = 'pending';
        if($request->type == 'approved')
        {
            $status = 'approved';
        }
        elseif($request->type == 'rejected')
        {
            $status = 'rejected';
        }

        $meet->update(['invitation_status' => $status]);
        return response()->json(['success'=>true, 'message' =>'تم تغيير حالة الاجتماع بنجاح']);

    }


}


