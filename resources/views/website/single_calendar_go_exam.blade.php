@extends('website.layout.master')

@section('page_title') {{$content->title}} @endsection
<style>
    header:first-child
    {
        display: none;
    }
    .practical_question_box
    {
        background: #e7e7e7;
        padding: 20px;
        border-radius: 5px;
    }
    .answers
    {
            margin-right: 35px;
    }
</style>
<link
    rel="stylesheet"
    href="{{asset('frontend/assets/vendors/drawingboard.js-master/dist/drawingboard.min.css')}}"
/>
@section('content')
    <header class="header-style-1">
        <div class="header-topbar topbar-style-2">
            <div class="container">
                <div class="row g-2 justify-content-center">
                    <div
                        class="col-xl-7 col-lg-6 col-md-7 col-sm-6 justify-content-sm-start justify-content-center d-flex align-items-center"
                    >
                        <h1
                            class="text-white text-sm-start text-center mb-0 py-sm-0 py-1"
                            style="font-size: 14px !important"
                        >
                            <i class="far fa-question-circle me-2"></i>
                            {{$content->title}}
                        </h1>
                    </div>

                    <div class="col-xl-5 col-lg-6 col-md-5 col-sm-6">
                        <div
                            class="d-sm-flex justify-content-center justify-content-lg-end"
                        >
                            <div class="header-socials text-center text-lg-end">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a
                                            class="btn btn-main px-4 py-1 fs-12 text-white rounded-2"
                                            href="{{ route('website.index') }}"
                                        >
                                            خروج من التقويم
                                            <i class="fa fa-angle-left ms-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="page-wrapper">
        <div class="container">
            <div class="exam-wrapper">
                <form action="{{route('website.calendar.save_exam', $content->id)}}" method="post" id="submitExam" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="calendar_title" value="{{$content->title}}">
                    <input type="hidden" id="calendar_duration" name="calendar_duration" value="{{$content->duration}}">
                    <input type="hidden" id="student_duration" name="duration" value="">

                    @foreach($content->questions as $key =>$question)
                        <input type="hidden" name="question_id[]" value="{{$question->id}}">
                        <input type="hidden" name="question_title[]" value="{{$question->title}}">
                        <input type="hidden" name="question_type[]" @if($question->question_kind == 'theoretical') value="{{$question->question_type}}" @else value="practical" @endif>
                        <input type="hidden" name="question_kind[]" value="{{$question->question_kind}}">

                        @if($question->question_kind == 'theoretical')
                            <div class="qa-group mb-5">
                                <h5 class="mb-3 pb-2">
                                    <span class="num">({{$key+1}})</span>
                                    <span class="text">
                                      {{$question->title}}

                                        @if($question->question_file)
                                            <a href="{{assetURLFile($question->question_file)}}" download
                                          class="text-decoration-underline fs-14 text-danger mx-1">شاهد الملف المرفق</a>
                                        @endif
                                    </span>
                                    <p class="text-muted fw-400 fs-14 mb-0">
                                        {{$content->description}}
                                        <span class="d-block fw-600">
                                            <i class="far fa-question-circle me-1"></i>
                                            نوع السؤال :
                                            @if($question->question_type == 'single_choice')
                                                اختيار واحد
                                            @elseif($question->question_type == 'complete')
                                                أكمل مكان النقاط بالإجابة الصحيحة
                                            @elseif($question->question_type == 'article')
                                                سؤال مقالي
                                            @elseif($question->question_type == 'multiple_choice')
                                                اختيار متعدد
                                            @elseif($question->question_type == 'true_false')
                                                صح و خطأ
                                            @elseif($question->question_type == 'rearrange')
                                               رتب الجمل التالية (من 1 ل 4)
                                            @elseif($question->question_type == 'connect')
                                                وصل الجمل التالية بعضها البعض
                                            @endif
                                        </span>
                                    </p>
                                </h5>
                                <hr class="mb-4" />
                                <ul class="answers">
                                    @if($question->question_type == 'single_choice' || $question->question_type == 'complete')

                                        @foreach($question->choices as $choice)
                                        <div class="form-check-group d-flex gap-2">
                                              <li style="list-style: lower-roman;" class="num text-dark fw-bold" style="width: 25px"
                                              ></li
                                              >
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    id="radio{{$question->id}}_{{$choice->id}}"
                                                    type="radio"
                                                    value="{{$choice->id}}"
                                                    name="answer[{{$question->id}}]"
                                                />
                                                <label class="form-check-label fw-600" for="radio{{$question->id}}_{{$choice->id}}">
                                                    {{$choice->choice_text}}
                                                    @if($choice->choice_file)
                                                        <a
                                                            href="{{assetURLFile($choice->choice_file)}}" download
                                                            class=" text-decoration-underline fs-14 text-danger mx-2"
                                                        >(ملف)</a>
                                                    @endif
                                                    @if($choice->choice_video_url)
                                                        ,
                                                        <a
                                                            href="{{$choice->choice_video_url}}" target="_blank"
                                                            class="popup-video  text-decoration-underline fs-14 text-danger mx-2"
                                                        >(فيديو توضيحي)</a>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach


                                    @elseif($question->question_type == 'multiple_choice')

                                        @foreach($question->choices as $choice)
                                        <div class="form-check-group d-flex gap-2">
                                              <li style="list-style: lower-roman;"  class="num text-dark fw-bold" style="width: 25px"
                                              ></li
                                              >
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    id="check{{$question->id}}_{{$choice->id}}"
                                                    type="checkbox"
                                                    value="{{$choice->id}}"
                                                    name="answer[{{$question->id}}][{{$choice->id}}]"
                                                />
                                                <label class="form-check-label fw-600" for="check{{$question->id}}_{{$choice->id}}">
                                                    {{$choice->choice_text}}
                                                    @if($choice->choice_file)
                                                    <a
                                                        href="{{assetURLFile($choice->choice_file)}}" download
                                                        class=" text-decoration-underline fs-14 text-danger mx-2"
                                                    >(ملف)</a>
                                                    @endif

                                                    @if($choice->choice_video_url)
                                                        ,
                                                        <a
                                                            href="{{$choice->choice_video_url}}" target="_blank"
                                                            class="popup-video  text-decoration-underline fs-14 text-danger mx-2"
                                                        >(فيديو توضيحي)</a>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach

                                    @elseif($question->question_type == 'rearrange')

                                        @foreach($question->choices as $choice)
                                            <div class="form-check-group d-flex gap-2">
                                                <li style="list-style: lower-roman;"  class="num text-dark fw-bold" style="width: 25px"></li>
                                                <div class="form-check d-flex align-items-center">
                                                    <input
                                                        class="form-control"
                                                        id="check{{$question->id}}_{{$choice->id}}"
                                                        type="number"
                                                        min="0"
                                                        max="4"
                                                        required
                                                        name="answer[{{$question->id}}][{{$choice->id}}]"
                                                    />
                                                    <label class="form-check-label fw-600 mx-2" for="check{{$question->id}}_{{$choice->id}}">
                                                        {{$choice->choice_text}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach


                                    @elseif($question->question_type == 'connect')


                                            <div class="form-check-group  gap-2">
                                                <li style="list-style: lower-roman;"  class="num text-dark fw-bold" style="width: 25px"></li>
                                                <div class="d-flex  justify-content-around">
                                                    <ul>
                                                        @foreach($question->choices as $key=>$choice)
                                                            @if(($choice->correct_answer) == 0)
                                                                <li class="form-check-label mb-4 fw-600 mx-2">{{$key+1}} - {{$choice->choice_text}}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <ul>
                                                        @foreach($question->choices as $choice)
                                                            @if(($choice->correct_answer) != 0)
                                                                <li class="form-check-label mb-3 fw-600 d-flex align-items-center mx-2" for="check{{$question->id}}_{{$choice->id}}">
                                                                    {{$choice->choice_text}}
                                                                    <input
                                                                        class="form-control mx-2 w-50"
                                                                        id="check{{$question->id}}_{{$choice->id}}"
                                                                        type="number"
                                                                        min="0"
                                                                        max="4"
                                                                        required
                                                                        style="height: 35px;width: 100px !important;"
                                                                        name="answer[{{$question->id}}][{{$choice->id}}]"
                                                                    />
                                                                </li>

                                                            @endif
                                                        @endforeach
                                                    </ul>


                                                </div>

                                            </div>



                                    @elseif($question->question_type == 'article')
                                        <textarea cols="3" rows="3" placeholder="أكتب الإجابة هنا" class="form-control" name="answer[{{$question->id}}]"></textarea>
                                    @elseif($question->question_type == 'true_false')


                                        <div class="form-check-group d-flex gap-2">
                                              <li style="list-style: lower-roman;" class="num text-dark fw-bold" style="width: 25px"
                                              ></li
                                              >
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    id="radio1"
                                                    type="radio"
                                                    value="1"
                                                    name="answer[{{$question->id}}]"
                                                />
                                                <label class="form-check-label fw-600" for="radio1">
                                                    إجابة صحيحة
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check-group d-flex gap-2">
                                              <span class="num text-dark fw-bold" style="width: 25px"
                                              >(ب)</span
                                              >
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    id="radio2"
                                                    type="radio"
                                                    value="0"
                                                    name="answer[{{$question->id}}]"
                                                />
                                                <label class="form-check-label fw-600" for="radio2">
                                                    إجابة خاطئة
                                                </label>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            </ul>
                        @endif
                        @if($question->question_kind == 'practical')
                            <div class="qa-group mb-5 practical_question_box">
                                <h5 class="mb-3 pb-2">
                                    <span class="num">(*)</span>
                                    <span class="text"> السؤال العملي : {{$question->title}} </span>
                                    <p class="text-muted fw-400 fs-14 mb-0 mt-1">
                                      @if($question->description)
                                          <span class="d-block fw-600">
                                            <i class="far fa-question-circle me-1"></i>
                                            {{$question->description}}
                                          </span>
                                      @endif
                                    </p>
                                </h5>
                                <hr class="mb-4" />
                                <div class="wrap">
                                    <div class="drawing-iframe-container mb-4">
                                        <iframe src="https://www.photopea.com" style="width: 100%;height: 850px;"></iframe>
                                    </div>
                                    <div dir="ltr" class="drawing-board" id="drawingBoard"></div>
                                    <input type="hidden" name="answer[{{$question->id}}]" value="" id="boardImage" />
                                </div>
                                <div class="my-2">
                                    <label>ارفع ملف</label>
                                    <input type="file" class="form-control" id="practical_file" name="practical_file"/>
                                </div>
                                <div class="my-3">
                                    <h5 class="mb-3">إضافة روابط مساعدة لحل السؤال العملي</h5>
                                    <div class="col-12 mb-5">
                                        <div class="mb-2">
                                            <button type="button" class="btn btn-sm btn-success" id="addNewRow">أضف رابط أخر</button>
                                        </div>
                                        <table class="no-datatable table table-striped table-hover table-responsive table-bordered mb-0">
                                            <thead>
                                            <th>الرابط</th>
                                            <th> حذف</th>
                                            </thead>
                                            <tbody id="lines">
                                            <tr id="tr">
                                                <td>
                                                    <input type="url" class="form-control" name="video_links[][{{$question->id}}]"
                                                           placeholder="ex: http://youtube.com/dtlyhgmdfmgvf" />
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger removeRow">
                                                        <i class="fa fa-trash m-0"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="action text-center">
                        <button type="button" class="btn btn-main px-5 py-3 fs-16 text-white rounded-2"
                                 data-bs-toggle="modal" href="#finish_exam" role="button">
                            <i class="fa fa-check-circle me-2"></i>
                            إنهاء التقويم
                        </button>

                        <div class="modal fade" id="finish_exam" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel">
                                            هل أنت متأكد من إنهاء التقويم ؟
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-main px-5 py-3 fs-16 text-white rounded-2">
                                            <i class="fa fa-check-circle me-2"></i>
                                            إنهاء التقويم
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="exam-counter-wrapper">
            <p id="counter"></p>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{asset('frontend/assets/vendors/drawingboard.js-master/dist/drawingboard.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/exam.js')}}"></script>

    <script>


        $(document).on('submit', '#submitExam', function(e){
            e.preventDefault();
            if (localStorage.getItem('drawing-board-drawingBoard') !== null)
            {
                var localStorageValue = localStorage.getItem("drawing-board-drawingBoard");
                $('#boardImage').val(localStorageValue);
            }
            else
            {
                $('#boardImage').val('');
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
             //   data: $(this).serialize(),
                success:function(data){
                    if(data.success)
                    {
                        if (localStorage.getItem('drawing-board-drawingBoard') !== null)
                        {
                            localStorage.removeItem("drawing-board-drawingBoard");
                        }
                        window.location.href = '{{route("website.calendars.thanks")}}';
                    }
                    else
                    {
                        alert(data.message)
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                }
            });
        });
    </script>



    <script>
        //Add New Row
        $(document).on('click','#addNewRow', function(){
            var row = $(this).parent().parent().find('#tr').clone();
            $(row).find("input").val("");
            $(row).appendTo( $(this).parent().parent().find('tbody'));
        });

        //Remove Row
        $(document).on('click','.removeRow', function(){
            if($("#lines").children().length >1){
                $(this).parent().parent().remove();
            }
        });
    </script>

@endpush
