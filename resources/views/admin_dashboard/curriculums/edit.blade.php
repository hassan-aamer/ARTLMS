@extends('admin_dashboard.layout.master')
@section('Page_Title')  المناهج | تعديل   @endsection
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
                        <h5 class="mb-0"> <i class="lni lni-book"></i> المناهج | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('curriculums.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-lg-6">
                                            <label class="form-label">  اختر الصف الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="level_id">
                                                <option value="">اختر الصف الدراسي</option>
                                                @foreach($levels as $key=>$val)
                                                    <option @if($val == $content->level_id) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">  اختر الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}" @if($content->term == $term->id) selected @endif>
                                                        {{ $term->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_short_description')

                                        <div class="col-12">
                                            <label class="form-label">  اختر المهارات <span class="text-danger">*</span> </label>
                                            <select name="skills[]" class="multiple-select" data-placeholder="اختر المهارات" multiple="multiple">
                                                @foreach($skills as $key=>$val)
                                                    <option @if(in_array($val,$arrayCourseSkills)) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_image')
                                        @include('admin_dashboard.inputs.edit_SEO_inputs')
                                        <div class="col-12">
                                            <label class="form-label"> رابط فيديو </label>
                                            <input type="url" name="video_link" class="form-control"  placeholder=" رابط فيديو" value="{{  old('video_link') ? old('video_link') : $content->video_link }}">
                                        </div>
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
                    }
                    ,
                    "skills[]": {
                        required: "يجب تحديد مهارات المنهج",
                    },
                }
            });
        });
    </script>
@endpush
