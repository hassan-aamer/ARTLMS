@extends('admin_dashboard.layout.master')
@section('Page_Title')  التقويمات | تعديل   @endsection
@push('styles')
    <link href="{{asset('admin_dashboard/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_dashboard/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endpush
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i> التقويمات | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('calendars.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        @include('admin_dashboard.inputs.edit_title')

                                        <div class="col-12">
                                            <label class="form-label">  اختر نوع التقويم <span class="text-danger">*</span> </label>
                                            <select disabled class="form-control" name="type" id="type_final_or_staging">
                                                <option value="final" @if($content->type=='final') selected @endif>نهائي</option>
                                                <option value="staging" @if($content->type=='staging') selected @endif>مرحلي</option>
                                            </select>
                                        </div>



                                         <div class="col-12 @if($content->type=='staging') d-none @endif"  id="final_type_before_or_after">
                                            <label class="form-label">  اختر نوع التقويم النهائي <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="final_type">
                                                <option @if($content->final_type=='after') selected @endif value="after">بعدي</option>
                                                <option @if($content->final_type=='before') selected @endif  value="before">قبلي</option>
                                            </select>
                                        </div>

                                        <div class="col-12 @if($content->type=='staging') d-none @endif" id="type_final">
                                            <label class="form-label">  اختر المنهج <span class="text-danger">*</span> </label>
                                            <select class="form-control curriculum_id" name="curriculum_id" required>
                                                <option value="">اختر المنهج</option>
                                                @foreach($curriculums as $key=>$val)
                                                    <option @if($content->curriculum_id==$val) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12  @if($content->type=='final') d-none @endif" id="type_staging">
                                            <label class="form-label"> اختر درس - محاضرة أو نشاط  <span class="text-danger">*</span> </label>
                                            <select disabled class="form-control"  id="staging_type">
                                                <option value="">اختر....</option>
                                                <option value="lesson" @if($content->lesson_id) selected @endif>درس / محاضرة</option>
                                                <option value="course" @if($content->course_id) selected @endif>نشاط</option>
                                            </select>
                                        </div>


                                        <div class="col-12 @if($content->course_id || $content->type=='final') d-none @endif" id="staging_type_lesson">
                                            <label class="form-label">  اختر الدرس/المحاضرة <span class="text-danger">*</span> </label>
                                            <select disabled class="form-control lesson_id" name="lesson_id">
                                                <option value="">اختر الدرس/المحاضرة</option>
                                                @foreach($lessons as $key)
                                                    <option @if($content->lesson_id == $key->id) selected @endif value="{{$key->id}}">{{$key->title}} - {{$key->unit?->title}} - {{$key->unit?->scheduled?->title}} - {{$key->unit?->scheduled?->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 @if($content->lesson_id || $content->type=='final') d-none @endif" id="staging_type_course">
                                            <label class="form-label">  اختر النشاط<span class="text-danger">*</span> </label>
                                            <select disabled class="form-control course_id" name="course_id">
                                                <option value="">اختر النشاط</option>
                                                @foreach($courses as $key)
                                                    <option  @if($content->course_id == $key->id) selected @endif value="{{$key->id}}">{{$key->title}} - {{$key->scheduled?->title}}  - {{$key->scheduled?->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label"> اختر بين عملي أو نظري  <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="kind" id="kind">
                                                <option value="">اختر بين عملي أو نظري....</option>
                                                <option value="theoretical" @if($content->kind == 'theoretical') selected @endif>نظري</option>
                                                <option value="practical" @if($content->kind == 'practical') selected @endif>عملي</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  الدرجة النهائية </label>
                                            <input type="number" min="1" disabled  value="{{$content->degree}}" class="form-control degree" required placeholder="ادخل الدرجة النهائية">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">   وقت التقويم (ادخل عدد الدقائق)  </label>
                                            <input type="number" min="1" disabled  value="{{$content->duration }}" class="form-control"  placeholder="مثال : 60">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  اختر المهارات <span class="text-danger">*</span> </label>
                                            <select name="skills[]" class="multiple-select" data-placeholder="اختر المهارات" multiple="multiple">
                                                @foreach($skills as $key=>$val)
                                                    <option @if(in_array($val,$arrayCourseSkills)) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_status_sort')
                                        @include('admin_dashboard.inputs.edit_btn')
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
    <script src="{{asset('admin_dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/assets/js/form-select2.js')}}"></script>
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
                    },
                    "skills[]": {
                        required: true,
                    },
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
                    },
                    "skills[]": {
                        required: "يجب تحديد المهارات",
                    },
                }
            });
        });

        $(document).on('change','#type_final_or_staging',function (){
            var val = $(this).val();
            if(val == 'staging')
            {
                $('.degree').val(25);
                $('#type_final').addClass('d-none');
                $('#type_staging').removeClass('d-none');
                $('.curriculum_id').val('');
                $('#final_type_before_or_after').addClass('d-none')
            }
            else
            {
                $('.degree').val(50);
                $('#type_final').removeClass('d-none');
                $('#type_staging').addClass('d-none');
                $('#staging_type_lesson').addClass('d-none');
                $('#staging_type_course').addClass('d-none');
                $('.lesson_id').val('');
                $('.course_id').val('');
                $('#staging_type').val('');
                 $('#final_type_before_or_after').removeClass('d-none')
            }
        });

        $(document).on('change','#staging_type',function (){
            var val = $(this).val();
            if(val == 'lesson')
            {
                $('#staging_type_lesson').removeClass('d-none');
                $('#staging_type_course').addClass('d-none');
            }
            else if(val == 'course')
            {
                $('#staging_type_lesson').addClass('d-none');
                $('#staging_type_course').removeClass('d-none');
            }
            else
            {
                $('#staging_type_lesson').addClass('d-none');
                $('#staging_type_course').addClass('d-none');
            }

        });


    </script>
@endpush
