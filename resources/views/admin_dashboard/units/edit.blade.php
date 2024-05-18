@extends('admin_dashboard.layout.master')
@section('Page_Title')  الوحدات | تعديل بيانات الوحدة   @endsection
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
                        <h5 class="mb-0"> <i class="lni lni-book"></i> الوحدات | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('units.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-12">
                                            <label class="form-label">  اختر المقرر <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="scheduled_id">
                                                <option value="">اختر المقرر</option>
                                                @foreach($scheduleds as $key)
                                                    <option @if($key->id == $content->scheduled_id) selected @endif value="{{$key->id}}">{{$key->title}} -  {{$key->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">  اختر المجال <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="category_id">
                                                <option value="">اختر المجال</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}" @if($cat->id == $content->category_id) selected @endif>{{$cat->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">  اختر الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}" @if($content->term == $term->id) selected @endif>{{ $term->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_short_description')

                                        <div class="col-12">
                                            <label class="form-label">  اختر المحاضرين <span class="text-danger">*</span> </label>
                                            <select name="teachers[]" class="multiple-select" data-placeholder="اختر المحاضرين" multiple="multiple">
                                                @foreach($teachers as $key=>$val)
                                                    <option @if(in_array($val,$arrayUnitTeachers)) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_image')
                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو  (Iframe tag) </label>
                                            <input type="text" name="video_link" value="{{$content->video_link}}" class="form-control"  placeholder=" رابط الفيديو ">
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
                    term : {
                        required : true
                    },
                    category_id: {
                        required: true,
                    },
                    scheduled_id: {
                        required: true,
                    },
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
                    term : {
                        required : "يجب اختيار الفصل الدراسي"
                    },
                    category_id: {
                        required: "يجب تحديد المجال أو المحور الفني",
                    },
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
