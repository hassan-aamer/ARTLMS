<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentAnswerDegreeRequest;
use App\Http\Traits\HelperTrait;
use App\Models\CalendarQuestionChoice;
use App\Models\Curriculum;
use App\Models\StudentAnswer;
use App\Models\StudentAnswerDegree;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CalendarQuestionRequest;
use App\Models\Calendar;
use App\Models\CalendarQuestion;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CalendarAnswerController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = StudentAnswerDegree::with(['student:id,name', 'calendar:id,title']);
        if(\request('curriculum_id') && \request('curriculum_id') != '')
        {
            $content = $content->where('curriculum_id', \request('curriculum_id'));
        }
        if(\request('student_id') && \request('student_id') != '')
        {
            $content = $content->where('student_id', \request('student_id'));
        }
        if(\request('calendar_id') && \request('calendar_id') != '')
        {
            $content = $content->where('calendar_id', \request('calendar_id'));
        }
        if(\request('correction') != '')
        {
            if(\request('correction') == 1)
            {
                $content = $content->whereNotNull('final_calendar_degree');
            }
            else
            {
                $content = $content->whereNull('final_calendar_degree');
            }

        }
        $content = $content->paginate($this->paginate);
        $calendars = Calendar::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $curriculums = Curriculum::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        $students = User::whereType(3)->get();

        return view('admin_dashboard.calendar_answers.index' , compact('content','calendars','curriculums','students'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentAnswerDegree $calendarAnswer)
    {
        $content =  $calendarAnswer;
        $answers = $content->answers()->with('question.choices')->get();

        $othersStagingCalendarQuery =  StudentAnswerDegree::where('student_id', $content->student_id)
            ->where('curriculum_id', $content->curriculum_id)->where('calendar_type', 'staging')->whereNotNull('student_final_degree');

        $allStudentStagingDegreeCount = $othersStagingCalendarQuery->count();
        $allStudentStagingDegreeSum =$othersStagingCalendarQuery->sum('student_final_degree');

        if($allStudentStagingDegreeCount > 0 && $allStudentStagingDegreeSum > 0)
        {
            $stagingDegrees = ($allStudentStagingDegreeSum / $allStudentStagingDegreeCount);
        }
        else
        {
            $stagingDegrees = 0;
        }


        return view('admin_dashboard.calendar_answers.edit', compact('content','answers','stagingDegrees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentAnswerDegreeRequest $request, StudentAnswerDegree $calendarAnswer)
    {
        $data = $request->validated();

        $data['final_calendar_degree'] = array_sum($data['question_degree']);

        if($data['final_calendar_degree']  > $data['calendar_final_calendar_degree'])
        {
            toastr()->error('عفواً - مجموع درجات الأسئلة أعلي من درجة التقويم ', 'تحذير', ['timeOut' => 5000]);
            return redirect()->back();
        }

        foreach($data['question_degree'] as $key=>$question_degree)
        {
            StudentAnswer::whereId($key)->update(['question_degree' =>$question_degree]);
        }
        $student_final_degree = array_sum(Arr::except($data, ['question_degree','calendar_final_calendar_degree']));
        $data['student_final_degree'] = $student_final_degree;
        $calendarAnswer->update(Arr::except($data, ['question_degree','calendar_final_calendar_degree']));
        toastr()->success('تم تصحيح الإجابات بنجاح', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentAnswerDegree $calendarAnswer)
    {
        $calendarAnswer->answers()->delete();
        $calendarAnswer->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }



}
