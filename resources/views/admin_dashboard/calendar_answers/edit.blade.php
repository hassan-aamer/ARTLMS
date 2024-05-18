@extends('admin_dashboard.layout.master')
@section('Page_Title')   إجابات المتعلمين للتقويم | {{$content->calendar?->title}}   @endsection
<style>
    .question_answer
    {
        background: #e9e9e9;
        padding: 25px;
        border-right: 2px solid var(--bs-blue);
    }
    .question_answer .label
    {
        background: white;
        padding: 2px 10px;
        /* color: #fff; */
        font-size: 9px;
        font-weight: bold;
        border-radius: 50px;
    }
    .text-successs i
    {
        top: 3px;
        font-size: 17px;
    }
    strong.text-danger
    {
        font-size: 11px;
    }
    .myInput
    {
        border: 2px solid var(--bs-teal);
        padding: 12px;
        outline: none;
    }
    .myDegreeLabel
    {
        border-radius: 7px;
        font-weight: bold;
    }
    .final_degree_circle
    {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        position: relative;
        overflow: hidden;
        font-size: 47px;
        border: 2px solid #7f7f7f;
        font-family: cursive;
    }
    .final_degree_circle .strong
    {
        display: block;
        border-bottom: 2px solid #7f7f7f;
    }
    label.error
    {
        font-weight: bold;
        position: absolute;
        bottom: -15px;
        left: 0;
    }
</style>
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i>     إجابات المتعلم <small class="text-primary">({{$content->student?->name}})</small> للتقويم |   <small class="text-primary">({{$content->calendar?->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('calendar_answers.update', $content->id)}}">
                                        @method('put')
                                        @csrf


                                        <div class="col-md-6">
                                            <div class="card bg-light">
                                                <h4>بيانات المتعلم</h4>
                                                <ul>
                                                    <li>
                                                       اسم المتعلم : <strong>{{$content->student?->name}}</strong>
                                                    </li>
                                                    <li>
                                                         البريد الإلكتروني : <strong>{{$content->student?->email}}</strong>
                                                    </li>
                                                    <li>
                                                         الصف الدراسي : <strong>{{$content->student?->userInfo?->level?->title}} </strong>
                                                    </li>
                                                    <li>
                                                         المجموعة : <strong>{{$content->student?->userInfo?->group_type == 't' ? 'تجريبية':'ضابطة'}} </strong>
                                                    </li>
                                                    <li>
                                                         عدد مرات تسجيل الدخول : <strong class="text-primary">{{$content->student?->userInfo?->login_count}} </strong>
                                                    </li>
                                                    <li>
                                                        الوقت المستغرق للأمتحان : <strong class="text-primary">{{$content->duration}}  دقيقية</strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card bg-light">
                                                <h4>بيانات التقويم</h4>
                                                <ul>
                                                    <li>
                                                        اسم التقويم : <strong>{{$content->calendar?->title}}</strong>
                                                    </li>
                                                    <li>
                                                        نوع التقويم : <strong>{{$content->calendar?->type == 'final' ? 'نهائي': 'مرحلي'}}</strong>
                                                    </li>
                                                    @if($content->calendar?->type == 'final')
                                                     <li>
                                                        نوع التقويم النهائي : <strong>{{$content->calendar?->final_type == 'after' ? 'بعدي': 'قبلي'}}</strong>
                                                    </li>
                                                    @endif
                                                    @if($content->calendar?->type == 'final')
                                                        <li>
                                                            المنهج : <strong>{{$content->calendar?->curriculum?->title}}</strong>
                                                        </li>
                                                    @elseif($content->calendar?->type == 'staging' && $content->calendar?->staging_type == 'lesson')
                                                        <li>
                                                            تابع للدرس : <strong>{{$content->calendar?->lesson?->title}}</strong>
                                                        </li>
                                                    @elseif($content->calendar?->type == 'staging' && $content->calendar?->staging_type == 'course')
                                                        <li>
                                                            تابع للنشاط : <strong>{{$content->calendar?->course?->title}}</strong>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        درجة التقويم الكلية : <strong>{{getTotalDegreeForCalendar($content->calendar_id)}} درجة</strong>
                                                    </li>
                                                    <li>
                                                        مدة التقويم : <strong>{{$content->calendar?->duration}} دقيقة</strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                        @if(!is_null($content->student_final_degree))


                                             @if($content->calendar?->final_type == 'after')
                                            <div class="text-center">
                                                <h5 class="mb-3"> الدرجة النهائية</h5>
                                                @if($content->calendar_type == 'final')

                                                    @if($content->student?->userInfo?->group_type == 't')
                                                        <h6>
                                                            @if($content->student_final_degree < 85)
                                                                <p class="fw-bold text-danger">راسب</p>
                                                            @else
                                                                <p class="fw-bold text-success">ناجح</p>
                                                            @endif
                                                        </h6>
                                                        <div class="final_degree_circle @if($content->student_final_degree < 85) text-danger @else text-success @endif">
                                                            <strong class="strong" id="student_degree">
                                                                {{$content->student_final_degree}}
                                                            </strong>
                                                            <strong id="final_degree">{{$content->calendar?->degree+50}}</strong>
                                                        </div>
                                                    @else
                                                    <h6>
                                                        @if($content->student_final_degree < ( ($content->calendar?->degree+50) /2))
                                                            <p class="fw-bold text-danger">راسب</p>
                                                        @else
                                                            <p class="fw-bold text-success">ناجح</p>
                                                        @endif
                                                    </h6>
                                                    <div class="final_degree_circle @if($content->student_final_degree < (($content->calendar?->degree+50) /2)) text-danger @else text-success @endif">
                                                        <strong class="strong" id="student_degree">
                                                            {{$content->student_final_degree}}
                                                        </strong>
                                                        <strong id="final_degree">{{$content->calendar?->degree+50}}</strong>
                                                    </div>
                                                    @endif
                                                @else
                                                    <h6>
                                                        @if($content->student_final_degree < ($content->calendar?->degree /2))
                                                            <p class="fw-bold text-danger">راسب</p>
                                                        @else
                                                            <p class="fw-bold text-success">ناجح</p>
                                                        @endif
                                                    </h6>
                                                    <div class="final_degree_circle @if($content->student_final_degree < ($content->calendar?->degree /2)) text-danger @else text-success @endif">
                                                        <strong class="strong" id="student_degree">
                                                            {{$content->student_final_degree}}
                                                        </strong>
                                                        <strong id="final_degree">{{$content->calendar?->degree}}</strong>
                                                    </div>
                                                @endif


                                                    </div>
                                            @else
                                            <div class="text-center">
                                            <h5 class="mb-3"> الدرجة النهائية</h5>
                                            @if($content->calendar_type == 'final')

                                                <div class="final_degree_circle text-dark">
                                                    <strong class="strong" id="student_degree">
                                                        {{$content->student_final_degree}}
                                                    </strong>
                                                    <strong id="final_degree">{{$content->calendar?->degree}}</strong>
                                                </div>
                                            @else
                                                <h6>
                                                    @if($content->student_final_degree < ($content->calendar?->degree /2))
                                                        <p class="fw-bold text-danger">راسب</p>
                                                    @else
                                                        <p class="fw-bold text-success">ناجح</p>
                                                    @endif
                                                </h6>
                                                <div class="final_degree_circle @if($content->student_final_degree < ($content->calendar?->degree /2)) text-danger @else text-success @endif">
                                                    <strong class="strong" id="student_degree">
                                                        {{$content->student_final_degree}}
                                                    </strong>
                                                    <strong id="final_degree">{{$content->calendar?->degree}}</strong>
                                                </div>
                                            @endif


                                        </div>
                                            @endif
                                        @else


                                         @if($content->calendar?->final_type == 'after')
                                        <div class="col-12 mt-4">
                                            <div class="row px-3">
                                                @if($content->calendar?->type == 'final')
                                                    <div class="col-12 ">
                                                        <h4 class="mb-5 fw-bold">تصحيح الإجابات :</h4>
                                                    </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">  درجة عدد مرات تسجيل الدخول للمتعلم <span class="text-danger">*</span> </label>
                                                    <div class="position-relative d-flex justify-content-around align-items-center">
                                                        <input type="number" min="0" max="5" name="login_degree" class="form-control sumDegrees sentimental_side" required placeholder="ادخل الدرجة">
                                                        <label class="myDegreeLabel bg-black w-100 text-white p-2">\ 5</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">  درجة الحضور والتكليفات <span class="text-danger">*</span> </label>
                                                    <div class="position-relative d-flex justify-content-around align-items-center">
                                                        <input type="number"  min="0" max="20" name="attendance_and_mission_degree" class="form-control sumDegrees sentimental_side" required placeholder="ادخل الدرجة">
                                                        <label class="myDegreeLabel bg-black w-100 text-white p-2">\ 20</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">  درجة التقويمات المرحلية <span class="text-danger">*</span> </label>
                                                    <div class="position-relative  d-flex justify-content-around align-items-center">
                                                        <input type="number" readonly value="{{$stagingDegrees}}"  min="0" max="25" name="staging_calendars_degree" class="form-control sumDegrees " required placeholder="ادخل الدرجة">
                                                        <label class="myDegreeLabel bg-black w-100 text-white p-2">\ 25</label>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        <input type="hidden" value="{{$content->calendar?->degree}}" name="calendar_final_calendar_degree">

                                        <div class="col-12 mt-4">

                                            <h5 class="text-primary"><i class="bi bi-question-lg mx-2"></i>
                                                الأسئلة والإجابات:</h5>


                                            @foreach($answers as $key=>$answer)
                                                @php
                                                    if($answer->question_type == 'multiple_choice')
                                                    {
                                                        foreach(json_decode($answer['answer']) as $val)
                                                        {
                                                            $correct = \App\Models\CalendarQuestionChoice::find($val)?->correct_answer ?? null;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $correct = \App\Models\CalendarQuestionChoice::find($answer->answer)?->correct_answer ?? null;
                                                    }
                                                @endphp
                                            <div class="question_answer m-4">
                                                <div class="position-relative  d-lg-flex justify-content-between align-items-center">
                                                    <h6>{{$key+1}} - {{$answer->question_title}}</h6>
                                                    <div>
                                                        <strong>  {{$answer->question?->question_mark}} / </strong>
                                                        <input type="number" min="0" @if(!is_null($answer->question?->question_mark) || $answer->question?->question_mark != 0)
                                                             max="{{$answer->question?->question_mark}}" @endif
                                                               name="question_degree[{{$answer->id}}]" @if($correct == 1) value="{{$answer->question?->question_mark}}" @endif placeholder=" درجة الإجابة " style="width: 130px" class="mx-2 myInput sumDegrees @if($answer->question_kind == 'practical') performance_side @else knowledge_side @endif" required />
                                                    </div>
                                                </div>

                                                @if($answer->question_kind == 'theoretical')
                                                <span class="label">
                                                      @if($answer->question_type == 'single_choice')
                                                        اختيار واحد
                                                    @elseif($answer->question_type == 'complete')
                                                        أكمل السؤال التالي
                                                    @elseif($answer->question_type == 'article')
                                                        سؤال مقالي
                                                    @elseif($answer->question_type == 'multiple_choice')
                                                        اختيار متعدد
                                                    @elseif($answer->question_type == 'true_false')
                                                        صح و خطأ
                                                    @elseif($answer->question_type == 'rearrange')
                                                        رتب الجمل التالية (من 1 ل 4)
                                                    @elseif($answer->question_type == 'connect')
                                                        وصل الجمل التالية
                                                    @endif
                                                </span>
                                                @endif
                                                <span class="mx-1"></span>
                                                <span class="label">{{$answer->question_kind == 'practical' ? 'عملي' : 'نظري'}}</span>
                                                <span class="mx-1"></span>
                                                @if($answer->question_type != 'rearrange')
                                                <span class="label @if($correct == 1) text-success @endif">@if($correct == 1) إجابة صحيحة  @endif </span>
                                                @endif

                                                <h6 class="mt-3 text-danger">إجابة المتعلم :</h6>
                                                <h6 class="">
                                                    @if($answer->question_kind == 'practical')

                                                        @if($answer->practical_file)
                                                            <a download="" class="btn btn-primary my-4" href="{{assetURLFile($answer->practical_file)}}">الملف المرفوع من المتعلم</a>
                                                        @endif

                                                        @if($answer->video_links)
                                                            <h6 class="my-3">الروابط التي تم وضعها من المتعلم :</h6>
                                                            <ul>
                                                               @foreach(json_decode($answer->video_links) as $key=>$value)
                                                                   @foreach($value as $val)
                                                                    <li>
                                                                        <a href="{{$val}}" target="_blank">{{$val}}</a>
                                                                    </li>
                                                                    @endforeach
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                        @if($answer->answer)
                                                        <img src="{{$answer->answer}}" width="100%" />
                                                        @endif
                                                        @if(!$answer->video_links && !$answer->answer)
                                                            <strong class="text-danger"> السؤال غير مجاوب عليه</strong>
                                                        @endif
                                                    @else
                                                        @if($answer->question_type == 'single_choice' || $answer->question_type == 'complete')

                                                            @if($answer->answer != '' || !is_null($answer->answer))

                                                                @foreach($answer->question?->choices as $choice)
                                                                    @if($choice->id == $answer->answer)
                                                                        <strong class="text-successs"> * {{$choice->choice_text}}</strong>
                                                                        @if($choice->choice_file)
                                                                            - <a href="{{assetURLFile($choice->choice_file)}}" download>الملف </a>
                                                                        @endif
                                                                        @if($choice->choice_video_url)
                                                                            - <a href="{{$choice->choice_video_url}}" target="_blank">الفيديو </a>
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                            @else
                                                                <strong class="text-danger"> السؤال غير مجاوب عليه</strong>
                                                            @endif

                                                            @elseif($answer->question_type == 'rearrange')

                                                            @if($answer['answer'] != ''  || !is_null($answer['answer']))
                                                                <strong class="text-successs">
                                                                    @foreach(json_decode($answer['answer']) as $key =>$val)
                                                                        <ul>
                                                                            <li>
                                                                                @foreach($answer->question?->choices as $choice)
                                                                                    @if($choice->id == $key)
                                                                                        <strong class="text-successs">  {{$choice->choice_text}} - ترتيب الطالب <span class="text-danger">{{$val}}</span> </strong>
                                                                                    @endif
                                                                                @endforeach
                                                                            </li>

                                                                        </ul>
                                                                    @endforeach
                                                                </strong>
                                                            @else
                                                                <strong class="text-danger"> السؤال غير مجاوب عليه</strong>
                                                            @endif

                                                            @elseif($answer->question_type == 'connect')

                                                            @if($answer['answer'] != ''  || !is_null($answer['answer']))
                                                                <strong class="text-successs">
                                                                    <div class="d-flex">
                                                                        <ul>
                                                                            @foreach($answer->question?->choices as $k =>$choice)
                                                                                @if($choice->correct_answer == 0)
                                                                                    <li class="mb-4">{{$k+1}} - {{$choice->choice_text}}</li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                        <ul class="mx-5">
                                                                            @foreach($answer->question?->choices as $k =>$choice)
                                                                                @if($choice->correct_answer != 0)
                                                                                    <li class="mb-4">
                                                                                        <span>{{$choice->choice_text}} -> </span>
                                                                                        @foreach(json_decode($answer['answer']) as $key =>$val)
                                                                                            @if($choice->id == $key)
                                                                                                <strong class="text-successs mx-3"> توصيل لرقم : <span class="text-danger">{{$val}}</span> </strong>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </strong>
                                                            @else
                                                                <strong class="text-danger"> السؤال غير مجاوب عليه</strong>
                                                            @endif


                                                            @elseif($answer->question_type == 'multiple_choice')
                                                            @if($answer['answer'] != ''  || !is_null($answer['answer']))
                                                            <strong class="text-successs">
                                                                @foreach(json_decode($answer['answer']) as $val)
                                                                    <ul>
                                                                        <li>
                                                                            @foreach($answer->question?->choices as $choice)
                                                                                @if($choice->id == $val)
                                                                                    <strong class="text-successs">  {{$choice->choice_text}}</strong>
                                                                                    @if($choice->choice_file)
                                                                                        - <a href="{{assetURLFile($choice->choice_file)}}" download>الملف </a>
                                                                                    @endif
                                                                                    @if($choice->choice_video_url)
                                                                                        - <a href="{{$choice->choice_video_url}}" target="_blank">الفيديو </a>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        </li>

                                                                    </ul>
                                                                @endforeach
                                                            </strong>
                                                            @else
                                                                <strong class="text-danger"> السؤال غير مجاوب عليه</strong>
                                                            @endif

                                                        @elseif($answer->question_type == 'article')
                                                            <strong>{{$answer->answer}}</strong>
                                                        @else
                                                            @if($answer->answer != '' || !is_null($answer->answer))
                                                            <strong class="text-successs">
                                                                @if($answer->answer == '1')
                                                                    <i class="bx bxs-check-circle position-relative  mx-2"></i> صح
                                                                @else
                                                                    <i class="bx bx-window-close position-relative  mx-2"></i> خطأ
                                                                @endif
                                                            </strong>
                                                            @else
                                                                <strong class="text-danger"> السؤال غير مجاوب عليه</strong>
                                                            @endif
                                                        @endif
                                                    @endif

                                                </h6>
                                            </div>
                                            @endforeach


                                            @if($content->calendar_type == 'final')

                                            <div class="row" style="    background: #7a87a1;margin: 45px 22px;padding: 30px;color: #fff;text-align: center;">

                                              <div class="col-md-4">
                                                <label class="mb-2">درجة الجانب المعرفي   </label>
                                                  <div class="d-flex align-items-center position-relative">
                                                      <input type="number"  min="0" max="25" class="form-control knowledge_side_degree" name="knowledge_side_degree" value="{{$stagingDegrees}}" placeholder="0" />
                                                      <label class="myDegreeLabel bg-black w-100 text-white p-2">\25</label>
                                                  </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="mb-2">درجة الجانب الوجداني</label>
                                                <div class="d-flex align-items-center position-relative">
                                                    <input type="number" min="0" max="25" class="form-control sentimental_side_degree" name="sentimental_side_degree" value="" placeholder="0" />
                                                    <label class="myDegreeLabel bg-black w-100 text-white p-2">\25</label>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <label class="mb-2">درجة الجانب الأدائي</label>
                                                 <div class="d-flex align-items-center position-relative">
                                                     <input type="number" min="0" max="50" class="form-control performance_side_degree" name="performance_side_degree" value="" placeholder="0" />
                                                     <label class="myDegreeLabel bg-black w-100 text-white p-2">\50</label>
                                                 </div>
                                            </div>






                                            </div>
                                            @endif



                                            <div class="col-md-4  mx-auto mt-4">
                                                <button type="submit" class="btnIcon btn btn-success px-5 w-100">
                                                    <i class="bx bx-edit-alt"></i>
                                                    تأكيد التصحيح
                                                </button>
                                            </div>


                                        </div>

                                        @endif




                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $("#validateForm").validate({
                rules: {
                    login_degree: {
                        required: true,
                    },
                    attendance_and_mission_degree: {
                        required: true,
                    },
                    staging_calendars_degree: {
                        required: true,
                    },
                    'question_degree[]': {
                        required: true,
                    }

                },
                messages: {
                    login_degree: {
                        required: "الحقل مطلوب",
                    },
                    attendance_and_mission_degree: {
                        required: "الحقل مطلوب",
                    },
                    staging_calendars_degree: {
                        required: "الحقل مطلوب",
                    },
                    'question_degree[]': {
                        required: "الحقل مطلوب",
                    },

                }
            });
        });


        //sentimental_side_degree 25
        function sumSentimentalSide()
        {
            var sum = 0;
            $('.sentimental_side').each(function(){
                sum += !isNaN( parseFloat(this.value)  ) ? parseFloat(this.value)  : 0;
            });
            $('.sentimental_side_degree').val(sum);
        }
        $(document).on('keyup', '.sentimental_side', function (){
            sumSentimentalSide();
        });

        //performance_side_degree 50
        function sumPerformanceSide()
        {
            var sum = 0;
            $('.myInput').each(function(){
                sum += !isNaN( parseFloat(this.value)  ) ? parseFloat(this.value)  : 0;
            });
            $('.performance_side_degree').val(sum);
        }
        $(document).on('keyup', '.myInput', function (){
            sumPerformanceSide();
        });


    </script>
@endpush
