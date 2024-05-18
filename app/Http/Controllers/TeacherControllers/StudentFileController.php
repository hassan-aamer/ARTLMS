<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUploadAnswerRequest;
use App\Http\Traits\HelperTrait;
use App\Models\User;
use App\Models\UserCourseFileAnswer;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentFileController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $content = UserCourseFileAnswer::with(['student', 'course'])
            ->whereIn('course_id', getCoursesOfTeacherAuth())->latest()->paginate($this->paginate);
        return view('website.teachers.dashboard.students_files.index', compact('content'));
    }

    public function edit($id)
    {
        $content =  UserCourseFileAnswer::findOrFail($id);
        return view('website.teachers.dashboard.students_files.edit', compact('content'));
    }

    public function update(StudentUploadAnswerRequest $request, $id)
    {
        $content = UserCourseFileAnswer::find($id);
        $data = $request->validated();
        $content->teacher_correct_date = date('Y-m-d H:i:s');
        $content->teacher_id = auth()->user()->id;
        if(is_null($content->degree))
        {
            $content->update($data);
            toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        }
        else
        {
            toastr()->warning('تم تصحيح الاجابة بالفعل', 'تنبيه', ['timeOut' => 5000]);
        }
        return redirect()->back();
    }


    public function destroy($id)
    {
        $content = UserCourseFileAnswer::find($id);
        $content->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


}


