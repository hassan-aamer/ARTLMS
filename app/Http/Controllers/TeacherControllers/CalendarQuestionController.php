<?php

namespace App\Http\Controllers\TeacherControllers;

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
        $content = CalendarQuestion::with('calendar:id,title');
        if(\request('calendar_id') && \request('calendar_id') != '')
        {
            $content = $content->where('calendar_id', \request('calendar_id'));
        }
        $content = $content->orderBy('sort', 'asc')->paginate($this->paginate);
        $calendars = Calendar::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');

        return view('admin_dashboard.calendar_questions.index' , compact('content','calendars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $calendars = Calendar::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
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

            if(CalendarQuestion::where('calendar_id', $data['calendar_id'])->where('question_kind', 'practical')->exists())
            {
                toastr()->warning('هذا التقويم يوجد به سؤال عملي بالفعل', 'تحذير', ['timeOut' => 5000]);
                return redirect()->back();
            }

            $created = CalendarQuestion::create(collect($data)->except(['choice_text', 'choice_file','choice_file_ext', 'choice_video'])->toArray());
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
        $calendars = Calendar::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        return view('admin_dashboard.calendar_questions.edit', compact('content','calendars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CalendarQuestionRequest $request, CalendarQuestion $calendarQuestion)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $calendarQuestion->update($data);
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
