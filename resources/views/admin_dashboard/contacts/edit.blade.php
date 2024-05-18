@extends('admin_dashboard.layout.master')
@section('Page_Title')   المقالات | تعديل   @endsection
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
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  المقالات  | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('articles.update', $content->id)}}">
                                        @method('put')
                                        @csrf


                                        <div class="col-12">
                                            <label class="form-label">  اختر الصف الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="level_id">
                                                <option value="">اختر الصف الدراسي</option>
                                                @foreach($levels as $key=>$val)
                                                    <option @if($val == $content->level_id) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  اختر المجموعة <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="group">
                                                <option value="">اختر المجموعة</option>
                                                <option @if('t' == $content->group) selected @endif value="t">مجموعة تجريبية</option>
                                                <option @if('d' == $content->group) selected @endif  value="d">مجموعة ضابطة</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> أقسام المقالات (ليس إلزامي)  </label>
                                            <select class="form-control" name="category_id">
                                                <option value="">اختر القسم</option>
                                                @foreach($categories as $category)
                                                    <option @if($category->id == $content->category_id) selected @endif
                                                    value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_image')
                                        @include('admin_dashboard.inputs.edit_description')
                                        @include('admin_dashboard.inputs.edit_video_link')


                                        <div class="col-12">
                                            <label class="form-label">   ال تلميحات  (ليس إلزامي)  </label>
                                            <select name="tags_id[]" class="multiple-select" data-placeholder="اختر التلميحات  " multiple="multiple">
                                                @foreach($tags as $tag)
                                                    <option @if(in_array($tag->id, $tagsIDS)) selected @endif value="{{$tag->id}}">{{$tag->name}}</option>
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
                    title: {
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
                    description: {
                        required: "الحقل مطلوب",
                    }

                }
            });
        });
    </script>
@endpush
