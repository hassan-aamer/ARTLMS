<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Lesson;
use App\Models\StudentAnswer;
use App\Models\StudentAnswerDegree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{

    use HelperTrait;
    //show
    public function show($id)
    {
        $content = Calendar::withCount('questions')->whereStatus('yes')
            ->whereId($id)->first();

        if(!$content)
        {
            return abort(404);
        }
        if(StudentAnswerDegree::where('calendar_id', $content->id)->where('student_id', auth()->user()->id)->exists())
        {
            return view('website.thanks_before');
        }

        return view('website.single_calendar_show', compact('content'));
    }
    public function go_exam($id)
    {
        $content = Calendar::with('questions.choices')->whereStatus('yes')
            ->whereId($id)->first();

        if(!$content)
        {
            return abort(404);
        }

        if(StudentAnswerDegree::where('calendar_id', $content->id)->where('student_id', auth()->user()->id)->exists())
        {
            return view('website.thanks_before');
        }

        return view('website.single_calendar_go_exam', compact('content'));
    }


    //save_exam
    public function save_exam(Request $request ,$id)
    {
        DB::beginTransaction();
        try {

            $calendarObject = Calendar::find($id);
            if(!$calendarObject)
            {
                return abort(404);
            }

            if(StudentAnswerDegree::where('calendar_id', $calendarObject->id)->where('student_id', auth()->user()->id)->exists())
            {
                return response()->json(['success' => false, 'message' =>'عفواً - تم الإجابة علي هذا التقويم من قبل']);
            }


            if($calendarObject->type == 'final')
            {
                $curriculum_id = $calendarObject->curriculum_id;
            }
            else
            {
                if($calendarObject->staging_type == 'lesson')
                {
                    $lesson = Lesson::findOrFail($calendarObject->lesson_id);
                    $curriculum_id = $lesson->unit?->scheduled?->curriculum?->id;
                }
                elseif($calendarObject->staging_type == 'course')
                {
                    $course = Course::findOrFail($calendarObject->course_id);
                    $curriculum_id = $course->scheduled?->curriculum?->id;
                }
                else
                {
                    $curriculum_id=null;
                }
            }

            $data = [
                'calendar_id' => $calendarObject->id,
                'student_id' => auth()->user()->id,
                'curriculum_id' => $curriculum_id,
                'calendar_type' => $calendarObject->type,
                'duration' => ((int)($request->calendar_duration) - (int)($request->duration)),
            ];

            $created = StudentAnswerDegree::create($data);
            foreach($request->question_id as $key => $value)
            {

                if($request->question_type[$key] == 'multiple_choice' || $request->question_type[$key] == 'rearrange' || $request->question_type[$key] == 'connect')
                {
                    $answer = (isset( $request->answer[$value])) ? json_encode($request->answer[$value]) : '';
                }
                else
                {
                    $answer = (isset( $request->answer[$value])) ? $request->answer[$value] : '';
                }


                if($request->question_kind[$key] == 'practical')
                {
                    $video_links = json_encode($request->video_links);
                    if($request->hasFile('practical_file'))
                    {
                        $practical_file = $this->upload_file_helper_trait($request,'practical_file', 'uploads/');
                    }
                    else
                    {
                        $practical_file = null;
                    }
                }
                else
                {
                    $video_links = null;
                    $practical_file = null;
                }



                $data = [
                    'student_answer_degree_id' => $created->id,
                    'student_id' => auth()->user()->id,
                    'question_id' => $value,
                    'calendar_id' =>$id,
                    'calendar_title' =>$request->calendar_title,
                    'question_title' =>$request->question_title[$key],
                    'question_type' =>$request->question_type[$key],
                    'question_kind' =>$request->question_kind[$key],
                    'answer' =>$answer,
                    'video_links' =>$video_links,
                    'practical_file' =>$practical_file,
                ];
                StudentAnswer::create($data);
            }
            DB::commit();
            return response()->json(['success' => true]);

        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' =>$e]);
        }



    }


    public function thanks_after_finished()
    {
        return view('website.thanks');
    }


}
