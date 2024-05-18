@extends('admin_dashboard.layout.master')
@section('Page_Title')  أسئلة التقويمات | أضف   @endsection
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
                        <h5 class="mb-0"> <i class="lni lni-book"></i> أسئلة التقويمات | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('calendar_questions.store')}}">
                                        @csrf

                                        <div class="col-12">
                                            <label class="form-label">   التقويم  </label>
                                            <select class="form-control calendar_id" name="calendar_id" required>
                                                <option value=""> التقويم</option>
                                                @foreach($calendars as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="col-12">
                                            <label class="form-label"> اختر  عملي أو نظري   </label>
                                            <select class="form-control" name="question_kind" id="question_kind" required>
                                                <option  value="">اختر  عملي أو نظري</option>
                                                <option  value="theoretical">نظري</option>
                                                <option  value="practical">عملي</option>
                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label">  السؤال <span class="text-danger">*</span> </label>
                                            <input type="text" name="title" class="form-control" required placeholder="ادخل رأس السؤال">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">  وصف السؤال  </label>
                                            <input type="text" name="description" class="form-control" placeholder="ادخل وصف السؤال">
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label">  درجة السؤال <span class="text-danger">*</span> </label>
                                            <input type="number" min="0" name="question_mark" class="form-control" required placeholder="ادخل درجة السؤال">
                                        </div>

                                        <!--Theoretical-->
                                        <div class="col-12 d-none" id="question_theoretical">

                                            <div class="col-12 my-3">
                                                <label class="form-label"> اختر  نوع السؤال <span class="text-danger">*</span>  </label>
                                                <select class="form-control" name="question_type" id="question_type" required>
                                                    <option value="true_false">صح أو خطأ</option>
                                                    <option value="complete"> أكمل السؤال </option>
                                                    <option value="single_choice">اختيار فردي  (المتعلم يختار اجابة واحدة فقط) </option>
                                                    <option value="multiple_choice">اختيار  متعدد (المتعلم يختار أكثر من إجابة)</option>
                                                    <option value="article">سؤال مقالي</option>
                                                    <option value="connect">سؤال توصيل </option>
                                                    <option value="rearrange">سؤال إعادة ترتيب </option>
                                                </select>
                                            </div>


                                            <div class="col-12 my-3">
                                                <label class="form-label"> ملف أو صورة للسؤال (ليس إالزامي) <small class="text-danger">Image :(PNG - JPEG - JPG - WEBP - SVG - GIF) File : (PDF - DOC - DOCX - XLSX - XLS)</small> </label>
                                                <input class="form-control" type="file" name="question_file" />
                                            </div>



                                            <!--Add Answers-->
                                            <div class="col-12">
                                                <div class="row d-none" id="insert_answers">
                                                    <div class="col-12 text-center mb-3">
                                                        <h5>أدخل اختيارات السؤال</h5>
                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الاختيار الأول </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الاختيار  الأول </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الاختيار " />
                                                        </div>
                                                        <div class="my-4 box_of_inputs">
                                                            <label for="answer1">ملف أو صورة الاختيار  الأول <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="file" class="form-control answer_value" name="choice_file[]" />
                                                        </div>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">رابط فيديو الاختيار  الأول <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="url" placeholder="رابط فيديو الإجابة" class="form-control answer_value" name="choice_video[]" />
                                                        </div>
                                                        <div class="d-flex mt-2 align-items-center">
                                                            <div class="">
                                                                الإجابة صحيحة ؟
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" value="1" class="mx-2" name="correct_answer[0]" style="width: 50px;height: 40px"  />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الاختيار الثاني </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الاختيار  الثاني </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الاختيار " />
                                                        </div>
                                                        <div class="my-4 box_of_inputs">
                                                            <label for="answer1">ملف أو صورة الاختيار  الثاني <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="file" class="form-control answer_value" name="choice_file[]" />
                                                        </div>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">رابط فيديو الاختيار  الثاني <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="url" placeholder="رابط فيديو الإجابة" class="form-control answer_value" name="choice_video[]" />
                                                        </div>
                                                        <div class="d-flex mt-2 align-items-center">
                                                            <div class="">
                                                                الإجابة صحيحة ؟
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" value="1" class="mx-2" name="correct_answer[1]" style="width: 50px;height: 40px"  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الاختيار الثالث </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الاختيار  الثالث </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الاختيار " />
                                                        </div>
                                                        <div class="my-4 box_of_inputs">
                                                            <label for="answer1">ملف أو صورة الاختيار  الثالث <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="file" class="form-control answer_value" name="choice_file[]" />
                                                        </div>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">رابط فيديو الاختيار  الثالث <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="url" placeholder="رابط فيديو الإجابة" class="form-control answer_value" name="choice_video[]" />
                                                        </div>
                                                        <div class="d-flex mt-2 align-items-center">
                                                            <div class="">
                                                                الإجابة صحيحة ؟
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" value="1" class="mx-2" name="correct_answer[2]" style="width: 50px;height: 40px"  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الاختيار الرابع </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الاختيار  الرابع </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الاختيار " />
                                                        </div>
                                                        <div class="my-4 box_of_inputs">
                                                            <label for="answer1">ملف أو صورة الاختيار  الرابع <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="file" class="form-control answer_value" name="choice_file[]" />
                                                        </div>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">رابط فيديو الاختيار  الرابع <span class="text-danger">(ان وجد)</span> </label>
                                                            <input type="url" placeholder="رابط فيديو الإجابة" class="form-control answer_value" name="choice_video[]" />
                                                        </div>
                                                        <div class="d-flex mt-2 align-items-center">
                                                            <div class="">
                                                                الإجابة صحيحة ؟
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" value="1" class="mx-2" name="correct_answer[3]" style="width: 50px;height: 40px"  />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <!--Connect Answers-->
                                            <div class="col-12 d-none" id="insert_connect_answers">
                                                <div class="col-12 text-center mb-3">
                                                    <h5>أدخل إجابات السؤال</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <div class="my-2">
                                                            <div class="my-1 box_of_inputs">
                                                                <strong class="mx-2">1 -</strong>
                                                                <label for="answer1">اكتب الإجابة  الأولي </label>
                                                             <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                                <input type="hidden"  class="form-control answer_value" name="correct_answer_correct[0]" value="0" />
                                                            </div>
                                                        </div>
                                                        <div class="my-2">
                                                            <div class="my-1 box_of_inputs">
                                                                <strong class="mx-2">2 -</strong>
                                                                <label for="answer1">اكتب الإجابة  الثانية </label>
                                                                <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                                <input type="hidden"  class="form-control answer_value" name="correct_answer_correct[1]" value="0" />

                                                            </div>
                                                        </div>
                                                        <div class="my-2">
                                                            <div class="my-1 box_of_inputs">
                                                                <strong class="mx-2">3 -</strong>
                                                                <label for="answer1">اكتب الإجابة  الثالثة </label>
                                                                <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                                <input type="hidden"  class="form-control answer_value" name="correct_answer_correct[2]" value="0" />
                                                            </div>
                                                        </div>
                                                        <div class="my-2">
                                                            <div class="my-1 box_of_inputs">
                                                                <strong class="mx-2">4 -</strong>
                                                                <label for="answer1">اكتب الإجابة  الرابعة </label>
                                                                <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                                <input type="hidden"  class="form-control answer_value" name="correct_answer_correct[3]" value="0" />

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <div class="my-2 d-flex align-items-center">
                                                            <div class="my-1 box_of_inputs w-100">
                                                                <label for="answer1">اكتب الإجابة  الأولي </label>
                                                                <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                            </div>
                                                            <div class="mb-2 w-100 mx-1">
                                                                <div class="my-1">
                                                                    موصل بي  ؟
                                                                </div>
                                                                <div>
                                                                    <input type="number" min="1" max="4"  class="form-control answer_value" name="correct_answer_correct[4]" placeholder="اكتب توصيل بالإجابة " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="my-2 d-flex align-items-center">
                                                            <div class="my-1 box_of_inputs w-100">
                                                                <label for="answer1">اكتب الإجابة  الثانية </label>
                                                                <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                            </div>
                                                            <div class="mb-2 w-100 mx-1">
                                                                <div class="my-1">
                                                                    موصل بي  ؟
                                                                </div>
                                                                <div>
                                                                    <input type="number" min="1" max="4"  class="form-control answer_value" name="correct_answer_correct[5]" placeholder="اكتب توصيل بالإجابة " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="my-2 d-flex align-items-center">
                                                            <div class="my-1 box_of_inputs w-100">
                                                                <label for="answer1">اكتب الإجابة  الثالثة </label>
                                                                <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                            </div>
                                                            <div class="mb-2 w-100 mx-1">
                                                                <div class="my-1">
                                                                    موصل بي  ؟
                                                                </div>
                                                                <div>
                                                                    <input type="number" min="1" max="4"  class="form-control answer_value" name="correct_answer_correct[6]" placeholder="اكتب توصيل بالإجابة " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="my-2 d-flex align-items-center">
                                                            <div class="my-1 box_of_inputs w-100">
                                                                <label for="answer1">اكتب الإجابة  الرابعة </label>
                                                                <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                            </div>
                                                            <div class="mb-2 w-100 mx-1">
                                                                <div class="my-1">
                                                                    موصل بي  ؟
                                                                </div>
                                                                <div>
                                                                    <input type="number" min="1" max="4"  class="form-control answer_value" name="correct_answer_correct[7]" placeholder="اكتب توصيل بالإجابة " />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!--Rearrange Answers-->
                                            <div class="col-12 d-none" id="insert_rearrange_answers">
                                                <div class="row">
                                                    <div class="col-12 text-center mb-3">
                                                        <h5>أدخل اختيارات السؤال</h5>
                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الإجابة الأولي </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الإجابة  الأولي </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                        </div>
                                                        <div class="">
                                                            <div class="my-1">
                                                                الترتيب ؟
                                                            </div>
                                                            <div>
                                                                <input type="number" min="1" max="4"  class="form-control answer_value" name="correct_answer[0]" placeholder="اكتب ترتيب الإجابة " />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الإجابة الثانية </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الإجابة  الثانية </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                        </div>
                                                        <div class="">
                                                            <div class="my-1">
                                                                الترتيب ؟
                                                            </div>
                                                            <div>
                                                                <input type="number" min="1" max="4"  class="form-control answer_value" name="correct_answer[1]" placeholder="اكتب ترتيب الإجابة " />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الإجابة الثالثة </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الإجابة  الثالثة </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                        </div>
                                                        <div class="">
                                                            <div class="my-1">
                                                                الترتيب ؟
                                                            </div>
                                                            <div>
                                                                <input type="number" min="1" max="4" class="form-control answer_value" name="correct_answer[2]" placeholder="اكتب ترتيب الإجابة " />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4 oneAnswerBox">
                                                        <h6 class="text-center mb-3 fw-bold"> الإجابة الرابعة </h6>
                                                        <div class="my-1 box_of_inputs">
                                                            <label for="answer1">اكتب الإجابة  الرابعة </label>
                                                            <input type="text" class="form-control answer_value" name="choice_text[]" placeholder="اكتب الإجابة " />
                                                        </div>
                                                        <div class="">
                                                            <div class="my-1">
                                                                الترتيب ؟
                                                            </div>
                                                            <div>
                                                                <input type="number" min="1" max="4"  class="form-control answer_value" name="correct_answer[3]" placeholder="اكتب ترتيب الإجابة " />
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <!--Practical-->
                                        <div class="col-12 d-none" id="question_photopia">

                                        </div>



                                        @include('admin_dashboard.inputs.status_sort')
                                        @include('admin_dashboard.inputs.add_btn')
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
                category_id: {
                    required: true,
                },
                title: {
                    required: true,
                },
                short_description: {
                    required: true,
                },
                image: {
                    required: true,
                },
                "name[]": {
                    required: true,
                },
                "file_type[]": {
                    required: true,
                },
                "file_uploaded[]": {
                    required: true,
                },

            },
            messages: {
                category_id: {
                    required: "الحقل مطلوب",
                },
                title: {
                    required: "الحقل مطلوب",
                },
                short_description: {
                    required: "الحقل مطلوب",
                },
                image: {
                    required: "الحقل مطلوب",
                },
                "name[]": {
                    required: "الحقل مطلوب",
                },
                "file_type[]": {
                    required: "الحقل مطلوب",
                },
                "file_uploaded[]": {
                    required: "الحقل مطلوب",
                },

            }
        });
    });

    $(document).on('change', '#question_kind', function(){
       var val = $(this).val();
       if(val == 'theoretical')
       {
           $('#question_theoretical').removeClass('d-none');
           $('#question_photopia').addClass('d-none');
       }
       else if(val == 'practical')
        {
            $('#question_theoretical').addClass('d-none');
            $('#question_photopia').removeClass('d-none');
        }
       else
       {
           $('#question_theoretical').removeClass('d-none');
           $('#question_photopia').removeClass('d-none');
       }
    });

    $(document).on('change', '#question_type', function(){
        var val = $(this).val();
        if(val === 'true_false' || val === 'article')
        {
            $('#insert_answers').addClass('d-none')
            $('#insert_connect_answers').addClass('d-none')
            $('#insert_rearrange_answers').addClass('d-none')
        }
        else if(val === 'connect')
        {
            $('#insert_answers').addClass('d-none')
            $('#insert_connect_answers').removeClass('d-none')
            $('#insert_rearrange_answers').addClass('d-none')
        }
        else if(val === 'rearrange')
        {
            $('#insert_answers').addClass('d-none')
            $('#insert_connect_answers').addClass('d-none')
            $('#insert_rearrange_answers').removeClass('d-none')
        }
        else
        {
            $('#insert_answers').removeClass('d-none')
            $('#insert_connect_answers').addClass('d-none')
            $('#insert_rearrange_answers').addClass('d-none')
        }
    });

</script>
@endpush
