@extends('admin_dashboard.layout.master')
@section('Page_Title')  التقويمات | أضف   @endsection
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
                        <h5 class="mb-0"> <i class="lni lni-book"></i> التقويمات | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('calendars.store')}}">
                                        @csrf

                                        @include('admin_dashboard.inputs.title')

                                        <div class="col-12">
                                            <label class="form-label">  اختر نوع التقويم <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="type" id="type_final_or_staging">
                                                <option value="final">نهائي</option>
                                                <option value="staging">مرحلي</option>
                                            </select>
                                        </div>


                                         <div class="col-12"  id="final_type_before_or_after">
                                            <label class="form-label">  اختر نوع التقويم النهائي <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="final_type">
                                                <option value="after">بعدي</option>
                                                <option value="before">قبلي</option>
                                            </select>
                                        </div>



                                        <div class="col-12" id="type_final">
                                            <label class="form-label">  اختر المنهج <span class="text-danger">*</span> </label>
                                            <select class="form-control curriculum_id" name="curriculum_id">
                                                <option value="">اختر المنهج</option>
                                                @foreach($curriculums as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 d-none" id="type_staging">
                                            <label class="form-label"> اختر درس - محاضرة أو نشاط  <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="staging_type" id="staging_type">
                                                <option value="">اختر....</option>
                                                <option value="lesson">درس / محاضرة</option>
                                                <option value="course">نشاط</option>
                                            </select>
                                        </div>


                                        <div class="col-12 d-none" id="staging_type_lesson">
                                            <label class="form-label">  اختر الدرس/المحاضرة <span class="text-danger">*</span> </label>
                                            <select class="form-control lesson_id" name="lesson_id">
                                                <option value="">اختر الدرس/المحاضرة</option>
                                                @foreach($lessons as $key)
                                                    <option value="{{$key->id}}">{{$key->title}} - {{$key->unit?->title}} - {{$key->unit?->scheduled?->title}} - {{$key->unit?->scheduled?->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 d-none" id="staging_type_course">
                                            <label class="form-label">  اختر النشاط<span class="text-danger">*</span> </label>
                                            <select class="form-control course_id" name="course_id">
                                                <option value="">اختر النشاط</option>
                                                @foreach($courses as $key)
                                                    <option value="{{$key->id}}">{{$key->title}} - {{$key->scheduled?->title}}  - {{$key->scheduled?->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label"> اختر بين عملي أو نظري  <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="kind" id="kind">
                                                <option value="">اختر بين عملي أو نظري....</option>
                                                <option value="theoretical">نظري</option>
                                                <option value="practical">عملي</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  الدرجة النهائية <span class="text-danger">*</span> </label>
                                            <input type="number" readonly min="1" name="degree" value="50" class="form-control degree" required placeholder="ادخل الدرجة النهائية">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">   وقت التقويم (ادخل عدد الدقائق) <span class="text-danger">*</span> </label>
                                            <input type="number" min="1" name="duration"  class="form-control" required placeholder="مثال : 60">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  اختر المهارات <span class="text-danger">*</span> </label>
                                            <select name="skills[]" class="multiple-select" data-placeholder="اختر المهارات" multiple="multiple">
                                                @foreach($skills as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
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
<script src="{{asset('admin_dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin_dashboard/assets/js/form-select2.js')}}"></script>
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
                "skills[]": {
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
