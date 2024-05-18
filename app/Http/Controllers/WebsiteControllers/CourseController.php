<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Requests\StudentAskQuestionRequest;
use App\Http\Requests\StudentUploadAnswerRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseQuestionAnswer;
use App\Models\Favorite;
use App\Models\Rating;
use App\Models\UserCourseFileAnswer;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use HelperTrait;
    //Index
    public function index()
    {
        $page_title = 'جميع الأنشطة';
        $content = Course::whereStatus('yes')->orderBy('sort', 'asc');

        if(\request('term') == 1)
        {
            $content = $content->whereTerm('1');
        }
        elseif(\request('term') == 2)
        {
            $content = $content->whereTerm('2');
        }
        $content = $content->paginate(config('app.paginate'));
        return view('website.courses', compact('content','page_title'));
    }

    //show
    public function show($id)
    {
       $content = Course::with(['lesson','files'])->whereStatus('yes')->whereId($id)->first();
        if(!$content)
        {
            return abort(404);
        }

        if(auth()->user()->userInfo?->group_type == 'd' && $content->lesson?->type == 'lecture')
        {
            return abort(404);
        }

        $page_title = $content->title;

        $relatedCourses = Course::whereStatus('yes')->orderBy('sort', 'asc');
        if($content->kind == 'separated')
        {
            $subTitle = '<a href="'.route('website.curriculums.index').'">مناهجي</a>' .' / '.
                '<a href="'.route('website.curriculums.show',$content->scheduled?->curriculum?->id).'">'
                .$content->scheduled?->curriculum?->title.'</a>' .' / '.
                '<a href="'.route('website.scheduleds.show',$content->scheduled?->id).'">'
                .$content->scheduled?->title.'</a>' .' / '.
                $content->title;
            $relatedCourses = $relatedCourses->where('id','!=', $content->id)->where('scheduled_id', $content->scheduled_id)->get();
        }
        else
        {
            $subTitle = '<a href="'.route('website.curriculums.index').'">مناهجي</a>' .' / '.
                '<a href="'.route('website.curriculums.show',$content->lesson?->unit?->scheduled?->curriculum?->id).'">'
                .$content->lesson?->unit?->scheduled?->curriculum?->title.'</a>' .' / '.
                '<a href="'.route('website.scheduleds.show',$content->lesson?->unit?->scheduled?->id).'">'
                .$content->lesson?->unit?->scheduled?->title.'</a>' .' / '.
                '<a href="'.route('website.units.show',$content->lesson?->unit?->id).'">'
                .$content->lesson?->unit?->title.'</a>' .' / '.
                '<a href="'.route('website.lessons.show',$content->lesson?->id).'">'
                .$content->lesson?->title.'</a>' .' / '.
                $content->title;
            $relatedCourses = $relatedCourses->where('id','!=', $content->id)->where('lesson_id', $content->lesson_id)->get();
        }

        if(auth()->user()->type == 'student')
        {
            $studentsFileAnswers = UserCourseFileAnswer::where('student_id', auth()->user()->id)->where('course_id', $content->id)->latest()->get();
            $studentsQuestions = CourseQuestionAnswer::where('student_id', auth()->user()->id)->where('course_id', $content->id)->latest()->get();

        }
        else
        {
            $studentsFileAnswers = UserCourseFileAnswer::where('course_id', $content->id)->latest()->get();
            $studentsQuestions = CourseQuestionAnswer::where('course_id', $content->id)->latest()->get();

        }

        $favorite = Favorite::where('student_id', auth()->user()->id)->where('course_id', $content->id)->first();
        $userRating = Rating::where('student_id', auth()->user()->id)->where('course_id', $content->id)->first();


        //Calendars
        $calendars = Calendar::withCount('questions')->whereStatus('yes')->whereType('staging')
            ->where('course_id', $content->id)->where('staging_type', 'course')->orderBy('sort', 'asc')->get();


        return view('website.single_course', compact('userRating','favorite','studentsQuestions','studentsFileAnswers','relatedCourses','content','page_title','subTitle','calendars'));
    }


    //UploadFiles
    public function studentUploadCourseFileAnswers(StudentUploadAnswerRequest $request, $id)
    {
        $data = $request->validated();
        //upload File
        $file_uploaded = $this->upload_file_helper_trait($request,'file_uploaded', 'uploads/');
        $data['file_uploaded'] = $file_uploaded;
        $data['student_id'] = auth()->user()->id;
        $data['course_id'] = $id;
        $data['file_ext'] = pathinfo($file_uploaded, PATHINFO_EXTENSION);
        $data['student_answer_date'] = date('Y-m-d H:i:s');
        UserCourseFileAnswer::create($data);
        toastr()->success('تم رفع الاجابه بنجاح', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    public function studentDeleteCourseFileAnswers($id)
    {
        $content = UserCourseFileAnswer::find($id);
        if(is_null($content->degree) && $content->student_id == auth()->user()->id)
        {
            $content->delete();
            toastr()->success('تم حذف الاجابه بنجاح', 'نجح', ['timeOut' => 5000]);
        }
        return redirect()->back();
    }


    //UploadFiles
    public function studentAskQuestion(StudentAskQuestionRequest $request, $id)
    {
        $data = $request->validated();
        $data['student_id'] = auth()->user()->id;
        $data['course_id'] = $id;
        CourseQuestionAnswer::create($data);
        toastr()->success('تم ارسال السؤال بنجاح', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    public function studentDeleteCourseQuestion($id)
    {
        $content = CourseQuestionAnswer::find($id);
        if(is_null($content->answer) && $content->student_id == auth()->user()->id)
        {
            $content->delete();
            toastr()->success('تم حذف السؤال بنجاح', 'نجح', ['timeOut' => 5000]);
        }
        return redirect()->back();
    }



    public function addToFavorite($id)
    {
        $data = [
            'student_id' => auth()->user()->id,
            'course_id' => $id,
        ];
        if(!Favorite::where('student_id', auth()->user()->id)->where('course_id', $id)->exists())
        {
            Favorite::create($data);
        }
        toastr()->success('تم إضافة النشاط الي المفضلة ', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    public function myFavorite()
    {
        $page_title = 'أنشطتي المفضلة';
        $content = Favorite::with('course')->where('student_id', auth()->user()->id)->latest()->get();
        return view('website.favorites', compact('page_title','content'));
    }

    public function removeFromFavorite($id)
    {
        $content = Favorite::find($id);
        if(!$content)
        {
            return abort(404);
        }
        $content->delete();
        toastr()->success('تم إزالة النشاط الي المفضلة ', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    public function rating(RatingRequest $request, $id)
    {
        $data = $request->validated();
        $data['course_id']= $id;
        $data['student_id']= auth()->user()->id;
        if(!Rating::where('student_id', auth()->user()->id)->where('course_id', $id)->exists())
        {
            Rating::create($data);
            toastr()->success('تم إضافة التقييم بنجاح ', 'نجح', ['timeOut' => 5000]);
        }
        else
        {
            Rating::where('student_id', auth()->user()->id)->where('course_id', $id)->update($data);
            toastr()->success('تم تعديل التقييم بنجاح ', 'نجح', ['timeOut' => 5000]);
        }
        return redirect()->back();
    }



}
