@extends('admin_dashboard.layout.master')
@section('Page_Title')   المعارض الفنية | أضف   @endsection
@push('styles')
    <link href="{{asset('admin_dashboard/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_dashboard/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    <style>
        .imageThumb {
            width: 130px;
            height: 115px;
            cursor: pointer;
        }
        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }
        .remove {
            display: block;
            background: #fb3a3a;
            color: white;
            text-align: center;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> المعارض الفنية | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('galleries.store')}}">
                                        @csrf
                                        <div class="col-12">
                                            <label class="form-label"> المجالات والمحاور الفنية   </label>
                                            <select class="form-control form-select" name="category_id">
                                                <option value="">اختر المجال</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @include('admin_dashboard.inputs.title')
                                        <div class="col-12">
                                            <label class="form-label"> رابط المعرض </label>
                                            <input type="url" name="gallery_link" class="form-control"  placeholder=" رابط المعرض">
                                        </div>

                                        @include('admin_dashboard.inputs.description')

                                        <div class="col-12">
                                            <label class="form-label">  اختر المهارات المتوقعة <span class="text-danger">*</span> </label>
                                            <select name="skills[]" class="multiple-select" data-placeholder="اختر المهارات" multiple="multiple">
                                                @foreach($skills as $key=>$val)
                                                  <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.video_link')

                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي (Iframe tag)  </label>
                                            <input type="text" name="video_link_active" class="form-control"  placeholder=" رابط الفيديو التفاعلي">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو التفاعلي آخر (Iframe tag)  </label>
                                            <input type="text" name="video_link_active2" class="form-control"  placeholder=" رابط الفيديو التفاعلي آخر">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label"> الصور <span class="text-danger">*</span> <small class="text-danger">(PNG - JPEG - JPG - WEBP - SVG - GIF)</small>
                                            <small class="text-warning"> يمكنك رفع أكثر من صورة </small></label>
                                            <input type="file" id="files" name="images[]" class="form-control" multiple required />
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
                title: {
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
                image: {
                    required: "الحقل مطلوب",
                },
                "skills[]": {
                    required: "يجب اختيار مهارات المعرض",
                },
            }
        });
    });
</script>

    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class='bx bx-trash-alt'></i></span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function(){
                                $(this).parent(".pip").remove();
                            });

                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {

            }
        });
    </script>
@endpush
