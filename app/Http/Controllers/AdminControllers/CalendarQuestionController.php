<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\CalendarQuestionChoice;
use Illuminate\Http\Request;
use App\Http\Requests\CalendarQuestionRequest;
use App\Models\Calendar;
use App\Models\CalendarQuestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CalendarQuestionController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = CalendarQuestion::with('calendar:id,title')->where('teacher_id', $this->userId());
            $calendars = Calendar::whereStatus('yes')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $content = CalendarQuestion::with('calendar:id,title');
            $calendars = Calendar::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        }

        if(\request('calendar_id') && \request('calendar_id') != '')
        {
            $content = $content->where('calendar_id', \request('calendar_id'));
        }
        $content = $content->latest()->paginate($this->paginate);


        return view('admin_dashboard.calendar_questions.index' , compact('content','calendars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if($this->isTeacher())
        {
            $calendars = Calendar::whereStatus('yes')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $calendars = Calendar::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');

        }
        return view('admin_dashboard.calendar_questions.create', compact('calendars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalendarQuestionRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if($request->file('question_file'))
            {
                //upload Image
                $image = $this->upload_file_helper_trait($request,'question_file', 'uploads/');
                $data['question_file'] = $image;
                $data['question_file_ext'] = pathinfo($image, PATHINFO_EXTENSION);
            }
            isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';

            if($data['question_kind'] == 'practical' && CalendarQuestion::where('calendar_id', $data['calendar_id'])->where('question_kind', 'practical')->exists())
            {
                toastr()->warning('هذا التقويم يوجد به سؤال عملي بالفعل', 'تحذير', ['timeOut' => 5000]);
                return redirect()->back();
            }
            if (!getTotalQuestionDegreesForCalendar($data['calendar_id'],$request))
            {
                toastr()->warning('مجموع درجات الأسئلة يجب أن لا يتعدي 25 درجة للمرحلي و 50 درجة للنهائي', 'تحذير', ['timeOut' => 5000]);
                return redirect()->back();
            }
            $data['teacher_id'] = $this->userId();
            $created = CalendarQuestion::create(collect($data)->except(['choice_text','correct_answer', 'choice_file','choice_file_ext', 'choice_video'])->toArray());
            //Save Multiple Choices
            $this->SaveQuestionChoices($created->id, $data,'uploads/');
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
    public function edit(CalendarQuestion $calendarQuestion)
    {
        $content =  $calendarQuestion;
        if($this->isTeacher())
        {
            $calendars = Calendar::whereStatus('yes')->where('teacher_id', $this->userId())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $calendars = Calendar::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');

        }
        $this->editPermission($content);
        return view('admin_dashboard.calendar_questions.edit', compact('content','calendars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CalendarQuestion $calendarQuestion)
    {
        foreach ($request->choice_id as $key => $id)
        {
            $updateData = [
                'correct_answer' => isset($request->correct_answer[$id]) ? 1 : 0
            ];
            CalendarQuestionChoice::whereId($id)->update($updateData);
        }
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    public function updateQuestionMark(Request $request, $id)
    {
        $question = CalendarQuestion::find($id);
        if(!$question)
        {
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->back();
        }
        if (!getTotalQuestionDegreesForCalendar($question->calendar_id,$request))
        {
            toastr()->warning('مجموع درجات الأسئلة يجب أن لا يتعدي 25 درجة للمرحلي و 50 درجة للنهائي', 'تحذير', ['timeOut' => 5000]);
            return redirect()->back();
        }
        CalendarQuestion::whereId($id)->update(['question_mark' => $request->question_mark]);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalendarQuestion $calendarQuestion)
    {
        $calendarQuestion->choices()->delete();
        $calendarQuestion->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }



}
