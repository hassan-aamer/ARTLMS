@extends('admin_dashboard.layout.master')
@section('Page_Title')   اختيارات سؤال | {{$content->calendar?->title}}   @endsection
<style>
    #insert_answers,#insert_connect_answers,#insert_rearrange_answers
    {
        background: #bfbfbf;
        margin: 0;
        border-radius: 5px;
        padding: 45px 25px;
        color: #000;
    }
    .oneAnswerBox
    {
        background: white;
        padding: 25px 13px;
        border-radius: 5px;
        border: 2px solid var(--bs-blue);
        margin: 12px;
        width: 47% !important;
    }
    @media screen and (max-width:992px) {
        .oneAnswerBox
        {
            width: 100% !important;
        }
    }
</style>
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i>    اختيارات سؤال |   <small class="text-warning">({{$content->calendar?->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('calendar_questions.update', $content->id)}}">
                                        @method('put')
                                        @csrf


                                        <div class="col-12">
                                            <label class="form-label">   التقويم  </label>
                                            <select class="form-control calendar_id"  disabled name="calendar_id" required>
                                                <option value=""> التقويم</option>
                                                @foreach($calendars as $key=>$val)
                                                    <option  @if($val == $content->calendar_id) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="col-12">
                                            <label class="form-label"> اختر  عملي أو نظري   </label>
                                            <select class="form-control" name="question_kind" disabled id="question_kind" required>
                                                <option @if($content->question_kind == 'theoretical') selected @endif value="theoretical">نظري</option>
                                                <option @if($content->question_kind == 'practical') selected @endif value="practical">عملي</option>
                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label">  السؤال  </label>
                                            <input type="text" disabled value="{{$content->title}}"  class="form-control" required placeholder="ادخل رأس السؤال">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">  وصف السؤال  </label>
                                            <input type="text" disabled  value="{{$content->description}}" class="form-control" placeholder="ادخل وصف السؤال">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  درجة السؤال <span class="text-danger">*</span> </label>
                                            <input type="number" min="0" value="{{$content->question_mark}}" class="form-control" disabled placeholder="ادخل درجة السؤال">
                                        </div>

                                        @if($content->question_kind == 'theoretical')
                                        <!--Theoretical-->
                                            <div class="col-12 " id="question_theoretical">

                                                <div class="col-12 my-3">
                                                    <label class="form-label">   نوع السؤال   </label>
                                                    <select disabled class="form-control" name="question_type" id="question_type" required>
                                                        <option @if($content->question_type == 'true_false') selected @endif value="true_false">صح أو خطأ</option>
                                                        <option @if($content->question_type == 'complete') selected @endif value="complete"> أكمل السؤال </option>

                                                        <option @if($content->question_type == 'single_choice') selected @endif value="single_choice">اختيار فردي (المتعلم يختار اجابة واحدة فقط) </option>
                                                        <option @if($content->question_type == 'multiple_choice') selected @endif value="multiple_choice">اختيار  متعدد (المتعلم يختار أكثر من إجابة)</option>
                                                        <option @if($content->question_type == 'article') selected @endif value="article">سؤال مقالي</option>
                                                        <option @if($content->question_type == 'connect') selected @endif value="connect">سؤال توصيل </option>
                                                        <option @if($content->question_type == 'rearrange') selected @endif value="rearrange">سؤال إعادة ترتيب </option>
                                                    </select>
                                                </div>



                                                <div class="col-12 my-3">
{{--                                                    <label class="form-label"> ملف أو صورة للسؤال  <small class="text-danger">Image :(PNG - JPEG - JPG - WEBP - SVG - GIF) File : (PDF - DOC - DOCX - XLSX - XLS)</small> </label>--}}
{{--                                                    <input class="form-control" type="file" name="question_file" />--}}
                                                    @if($content->question_file)
                                                        <img src="{{assetURLFile($content->question_file)}}" width="200px" />
                                                    @endif
                                                </div>


                                            @if(count($content->choices) > 0 && !in_array($content->question_type, ['rearrange', 'connect']))
                                                <!--Add Answers-->
                                                    <div class="col-12">
                                                        <div class="row" method="post" action="" id="insert_answers">
                                                            <div class="col-12 text-center mb-3">
                                                                <h5> اختيارات السؤال ({{$content->title}})</h5>
                                                            </div>

                                                            @foreach($content->choices as $choice)
                                                                <div class="col-md-6 mb-4 oneAnswerBox">
                                                                    <h6 class="text-center mb-3 fw-bold"> الاختيار  </h6>
                                                                    <div class="my-1 box_of_inputs">
                                                                        <label for="answer1"> الاختيار   </label>
                                                                        <input type="text" disabled class="form-control answer_value" value="{{$choice->choice_text}}" name="choice_text[]" placeholder="اكتب الاختيار " />
                                                                    </div>
                                                                    @if($choice->choice_file)
                                                                    <div class="my-4 box_of_inputs">
                                                                        <label for="answer1">ملف أو صورة الاختيار :    </label>
                                                                        <a download="" class="btn btn-sm btn-success" href="{{assetURLFile($choice->choice_file)}}">ملف {{$choice->choice_file_ext}}</a>
                                                                    </div>
                                                                    @endif
                                                                    @if($choice->choice_video_url)
                                                                    <div class="my-1 box_of_inputs">
                                                                        <label for="answer1">رابط فيديو الاختيار    </label>
                                                                        <input type="url" disabled value="{{$choice->choice_video_url}}"  class="form-control answer_value" name="choice_video[]" />
                                                                    </div>
                                                                    @endif
                                                                    <div class="d-flex mt-2 align-items-center">
                                                                        <div class="">
                                                                            الإجابة صحيحة ؟
                                                                        </div>
                                                                        <div>
                                                                            <input type="hidden"  value="{{$choice->id}}" name="choice_id[]" />
                                                                            <input type="checkbox" value="1" class="mx-2" @if($choice->correct_answer == 1) checked @endif name="correct_answer[{{$choice->id}}]" style="width: 50px;height: 40px"  />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div class="col-12 mx-auto text-center">
                                                                <button type="submit" class="btn btn-success">
                                                                    تعديل
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @if(count($content->choices) > 0 && in_array($content->question_type, ['rearrange', 'connect']) )
                                                <!--Add Answers-->
                                                    <div class="col-12">
                                                        <div class="row" id="insert_answers">
                                                            <div class="col-12 text-center mb-3">
                                                                <h5> إجابات السؤال ({{$content->title}})</h5>
                                                            </div>

                                                            @foreach($content->choices as $choice)
                                                                <div class="col-md-6 mb-4 oneAnswerBox">
                                                                    <h6 class="text-center mb-3 fw-bold"> الإجابة  </h6>
                                                                    <div class="my-1 box_of_inputs">
                                                                        <label for="answer1"> الإجابة   </label>
                                                                        <input type="text" disabled class="form-control answer_value" value="{{$choice->choice_text}}"  placeholder="اكتب الاختيار " />
                                                                    </div>
                                                                    <div class="d-flex mt-2 align-items-center">
                                                                        <div class="">
                                                                            ترتيب  الإجابة ؟
                                                                        </div>
                                                                        <div class="mx-2">
                                                                            <input type="number" disabled class="form-control answer_value" value="{{$choice->correct_answer}}"  placeholder="اكتب الترتيب " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif



                                            </div>
                                        @elseif($content->question_kind == 'practical')
                                        <!--Practical-->
                                            <div class="col-12" id="question_photopia">

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
                    title: {
                        required: true,
                    },
                    short_description: {
                        required: true,
                    },
                    description: {
                        required: true,
                    }

                },
                messages: {
                    title: {
                        required: "الحقل مطلوب",
                    },
                    short_description: {
                        required: "الحقل مطلوب",
                    },
                    description: {
                        required: "الحقل مطلوب",
                    }

                }
            });
        });



    </script>
@endpush
