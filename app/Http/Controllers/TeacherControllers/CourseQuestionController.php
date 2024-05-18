<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentAskQuestionRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUploadAnswerRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Course;
use App\Models\CourseQuestionAnswer;
use App\Models\User;
use App\Models\UserCourseFileAnswer;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CourseQuestionController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $content = CourseQuestionAnswer::with(['student', 'course'])
        ->whereIn('course_id', getCoursesOfTeacherAuth())->latest()->paginate($this->paginate);
        return view('website.teachers.dashboard.courses_questions.index', compact('content'));
    }

    public function edit($id)
    {
        $content =  CourseQuestionAnswer::findOrFail($id);
        return view('website.teachers.dashboard.courses_questions.edit', compact('content'));
    }

    public function update(StudentAskQuestionRequest $request, $id)
    {
        $content = CourseQuestionAnswer::find($id);
        $data = $request->validated();
        $content->teacher_id = auth()->user()->id;
        if(is_null($content->answer))
        {
            $content->update($data);
            toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        }
        else
        {
            toastr()->warning('تم الاجابة علي هذا السؤال بالفعل', 'تنبيه', ['timeOut' => 5000]);
        }
        return redirect()->back();
    }


    public function destroy($id)
    {
        $content = CourseQuestionAnswer::find($id);
        $content->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


}


