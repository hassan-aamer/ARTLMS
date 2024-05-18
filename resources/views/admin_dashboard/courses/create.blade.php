@extends('admin_dashboard.layout.master')
@section('Page_Title') الأنشطة | أضف @endsection

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
                        <h5 class="mb-0"> <i class="bi bi-file-code-fill"></i>  الأنشطة | أضف نشاط جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('courses.store')}}">
                                        @csrf
                                        <div class="col-12">
                                            <label class="form-label">  اختر النوع <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="kind" id="kind">
                                                <option value="separated">منفصل</option>
                                                <option value="connected">متصل</option>
                                            </select>
                                        </div>
                                        <span id="separated" class="row mt-3 kindParent">
                                            <div class="col-4">
                                                <label class="form-label">  اختر المقرر <span class="text-danger">*</span> </label>
                                                <select class="form-control" name="scheduled_id">
                                                    <option value="">اختر المقرر</option>
                                                    @foreach($scheduleds as $key)
                                                        <option value="{{$key->id}}">{{$key->title}} - {{$key->curriculum?->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">  اختر المجال <span class="text-danger">*</span> </label>
                                                <select class="form-control" name="category_id">
                                                    <option value="">اختر المجال</option>
                                                    @foreach($categories as $key=>$val)
                                                        <option value="{{$val}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">  اختر المعلم <span class="text-danger">*</span> </label>
                                                <select class="form-control" name="teacher_id">
                                                    <option value="">اختر المعلم</option>
                                                    @foreach($teachers as $key=>$val)
                                                        <option value="{{$val}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </span>
                                        <span id="connected" class="row mt-3 d-none kindParent">
                                            <div class="col-12">
                                            <label class="form-label">  اختر الدرس/المحاضرة <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="lesson_id">
                                                <option value="">اختر الدرس/المحاضرة</option>
                                                @foreach($lessons as $key)
                                                    <option value="{{$key->id}}">{{$key->title}} - {{$key->unit?->title}} - {{$key->unit?->scheduled?->title}} - {{$key->unit?->scheduled?->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </span>

                                        <div class="col-12">
                                            <label class="form-label">  اختر الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.title')
                                        @include('admin_dashboard.inputs.short_description')
                                        @include('admin_dashboard.inputs.description')
                                        @include('admin_dashboard.inputs.image')
                                        @include('admin_dashboard.inputs.video_link')

                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي (Iframe tag)  </label>
                                            <input type="text" name="video_link_active" class="form-control"  placeholder=" رابط الفيديو التفاعلي">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي آخر (Iframe tag)  </label>
                                            <input type="text" name="video_link_active2" class="form-control"  placeholder=" رابط الفيديو التفاعلي آخر">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  اختر المهارات <span class="text-danger">*</span> </label>
                                            <select name="skills[]" class="multiple-select" data-placeholder="اختر المهارات" multiple="multiple">
                                                @foreach($skills as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.SEO_inputs')
                                        @include('admin_dashboard.inputs.status_sort')

                                        @include('admin_dashboard.inputs.multiple_files')
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
                kind: {
                    required: true,
                },
                title: {
                    required: true,
                },
                term: {
                    required: true,
                },
                short_description: {
                    required: true,
                },
                description: {
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
                "skills[]" : {
                    required: true,
                }
            },
            messages: {
                kind: {
                    required: "الحقل مطلوب",
                },
                title: {
                    required: "الحقل مطلوب",
                },
                term: {
                    required: "الحقل مطلوب",
                },
                short_description: {
                    required: "الحقل مطلوب",
                },
                description: {
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
                    required: "يجب تحديد المهارات المكتسبة",
                },
            }
        });
    });


    $(document).on('change', '#kind', function(){
       var val = $(this).val();
       if(val == 'connected')
       {
           $('#connected').removeClass('d-none');
           $('#separated').addClass('d-none');
           $('.kindParent  select').val('');
       }
       else if(val == 'separated') {
           $('#connected').addClass('d-none');
           $('#separated').removeClass('d-none');
           $('.kindParent  select').val('');
       }
    });

</script>
@endpush
