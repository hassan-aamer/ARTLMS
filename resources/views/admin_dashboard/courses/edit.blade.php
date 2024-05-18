@extends('admin_dashboard.layout.master')
@section('Page_Title')     جميع الأنشطة | تعديل   @endsection

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
                        <h5 class="mb-0"> <i class="bi bi-file-code-fill"></i>   جميع الأنشطة | تعديل </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('courses.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-12">
                                            <label class="form-label">  اختر النوع <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="kind" id="kind">
                                                <option value="connected" @if($content->kind == 'connected') selected @endif>متصل</option>
                                                <option value="separated" @if($content->kind == 'separated') selected @endif>منفصل</option>
                                            </select>
                                        </div>

                                        <span id="separated" class="row mt-3 kindParent @if($content->kind == 'connected') d-none @endif">

                                            <div class="col-4">
                                            <label class="form-label">  اختر المقرر <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="scheduled_id">
                                                <option value="">اختر المقرر</option>
                                                @foreach($scheduleds as $key)
                                                    <option @if($key->id == $content->scheduled_id) selected @endif value="{{$key->id}}">{{$key->title}} - {{$key->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">  اختر المجال <span class="text-danger">*</span> </label>
                                                <select class="form-control form-select" name="category_id">
                                                    <option value="">اختر المجال</option>
                                                    @foreach($categories as $key=>$val)
                                                        <option @if($val == $content->category_id) selected @endif value="{{$val}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">  اختر المعلم <span class="text-danger">*</span> </label>
                                                <select class="form-control form-select" name="teacher_id">
                                                    <option value="">اختر المعلم</option>
                                                    @foreach($teachers as $key=>$val)
                                                        <option  @if($val == $content->teacher_id) selected @endif value="{{$val}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </span>

                                        <span id="connected" class="row mt-3  @if($content->kind == 'separated') d-none @endif kindParent">
                                            <div class="col-12">
                                            <label class="form-label">  اختر الدرس/المحاضرة <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="lesson_id">
                                                <option value="">اختر الدرس/المحاضرة</option>
                                                @foreach($lessons as $key)
                                                    <option  @if($key->id == $content->lesson_id) selected @endif value="{{$key->id}}">{{$key->title}} - {{$key->unit?->title}} - {{$key->unit?->scheduled?->title}} - {{$key->unit?->scheduled?->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </span>

                                        <div class="col-12">
                                            <label class="form-label"> الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}" @if($content->term == $term->id) selected @endif>{{ $term->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_short_description')
                                        @include('admin_dashboard.inputs.edit_description')
                                        @include('admin_dashboard.inputs.edit_image')
                                        @include('admin_dashboard.inputs.edit_video_link')
                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي (Iframe tag)  </label>
                                            <input type="text" value="{{$content->video_link_active}}" name="video_link_active" class="form-control"  placeholder=" رابط الفيديو التفاعلي">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي آخر (Iframe tag)  </label>
                                            <input type="text" value="{{$content->video_link_active2}}" name="video_link_active2" class="form-control"  placeholder=" رابط الفيديو التفاعلي آخر">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  اختر المهارات <span class="text-danger">*</span> </label>
                                            <select name="skills[]" class="multiple-select" data-placeholder="اختر المهارات" multiple="multiple">
                                                @foreach($skills as $key=>$val)
                                                    <option @if(in_array($val,$arrayCourseSkills)) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_SEO_inputs')
                                        @include('admin_dashboard.inputs.edit_status_sort')

                                        @include('admin_dashboard.inputs.edit_multiple_files')
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
                    }
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
