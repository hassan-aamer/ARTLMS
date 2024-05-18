@extends('admin_dashboard.layout.master')
@section('Page_Title')  الدروس والمحاضرات | تعديل   @endsection
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
                        <h5 class="mb-0"> <i class="lni lni-book"></i> الدروس والمحاضرات | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('lessons.update', $content->id)}}">
                                        @method('put')
                                        @csrf
                                        <div class="col-lg-6">
                                            <label class="form-label">  نوع الدرس <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="kind" id="kind">
                                                <option value="connected" @if($content->kind == 'connected') selected @endif>متصل</option>
                                                <option value="separated" @if($content->kind == 'separated') selected @endif>منفصل</option>
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
                                        <div class="col-12 kindParent mt-3 @if($content->kind == 'connected' || empty($content->kind)) d-none @endif" id="separated">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label">  اختر المقرر <span class="text-danger">*</span> </label>
                                                    <select class="form-control form-select" name="schedule_id" id="schedule_id">
                                                        <option value="">اختر المقرر</option>
                                                        @foreach($scheduleds as $key)
                                                            <option value="{{$key->id}}" @if($content->schedule_id == $key->id) selected @endif>
                                                                {{$key->title}} - {{$key->curriculum?->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 kindParent mt-3 @if($content->kind == 'separated') d-none @elseif(empty($content->kind)) d-block @endif" id="connected">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label">  اختر الوحدة <span class="text-danger">*</span> </label>
                                                    <select class="form-control form-select" name="unit_id" id="unit_id">
                                                        <option value="">اختر الوحدة</option>
                                                        @foreach($units as $key)
                                                            <option value="{{$key->id}}" @if($key->id == $content->unit_id) selected @endif>
                                                                {{$key->title}} - {{$key->scheduled?->title}} - {{$key->scheduled?->curriculum?->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">  نوع العرض <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="type">
                                                <option value="">اختر نوع العرض</option>
                                                <option value="lesson" @if($content->type == 'lesson') selected @endif>درس</option>
                                                <option value="lecture" @if($content->type == 'lecture') selected @endif>محاضرة</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label"> الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}" @if($content->term == $term->id) selected @endif>
                                                        {{ $term->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> اختر المعرض (اختياري) </label>
                                            <select class="form-control form-select" name="gallery_id">
                                                <option value="">--اختر المعرض الفني--</option>
                                                @foreach($galleries as $gallery)
                                                    <option value="{{ $gallery->id }}" @if($gallery->id == $content->gallery_id) selected @endif>
                                                        {{ $gallery->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_short_description')

                                        <div class="col-12">
                                            <label class="form-label"> النتائج العلمية </label>
                                            <textarea  name="results" class="form-control ckeditor" placeholder="النتائج العلمية " rows="4" cols="4">{!! $content->results !!}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  اختر المهارات <span class="text-danger">*</span> </label>
                                            <select name="skills[]" class="multiple-select" data-placeholder="اختر المهارات" multiple="multiple">
                                                @foreach($skills as $key=>$val)
                                                    <option @if(in_array($val,$arrayCourseSkills)) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي (Iframe tag)  </label>
                                            <input type="text" value="{{$content->video_link}}" name="video_link" class="form-control"  placeholder=" رابط الفيديو التفاعلي">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي آخر (Iframe tag) </label>
                                            <input type="text"  value="{{$content->video_link2}}" name="video_link2" class="form-control"  placeholder=" رابط الفيديو التفاعلي آخر">
                                        </div>

                                        @include('admin_dashboard.inputs.edit_image')
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
                    title: {
                        required: true,
                    },
                    category_id :{
                        required : true
                    },
                    kind : {
                        required : true
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
                        required: "يجب اختيار المهارات"
                    },
                }
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
        });
    </script>
@endpush
