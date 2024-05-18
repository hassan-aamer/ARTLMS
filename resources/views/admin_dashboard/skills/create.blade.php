@extends('admin_dashboard.layout.master')
@section('Page_Title')   المهارات | أضف   @endsection

@push('styles')
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
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> المهارات | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('skills.store')}}">
                                        @csrf
                                        @include('admin_dashboard.inputs.title')
                                        @include('admin_dashboard.inputs.description')
                                        @include('admin_dashboard.inputs.video_link')

                                        <div class="col-md-12">
                                            <label class="form-label"> الصور <span class="text-danger">*</span> <small class="text-danger">(PNG - JPEG - JPG - WEBP - SVG - GIF)</small>
                                            <small class="text-warning"> يمكنك رفع أكثر من صورة </small></label>
                                            <input type="file" id="files" name="images[]" class="form-control" multiple required />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  الجوانب أو القدرات المعرفية</label>
                                            <textarea required name="knowledge_desc" class="form-control ckeditor"
                                                      placeholder="الجوانب أو القدرات المعرفية" rows="4" cols="4"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  الجوانب أو القدرات الأدائية / المهارية</label>
                                            <textarea required name="performance_desc" class="form-control ckeditor"
                                                      placeholder="الجوانب أو القدرات الأدائية / المهارية" rows="4" cols="4"></textarea>
                                        </div>

                                         <div class="col-12">
                                            <label class="form-label">  الجوانب أو القدرات الوجدانية</label>
                                            <textarea required name="sentimental_desc" class="form-control ckeditor"
                                                      placeholder="الجوانب أو القدرات الوجدانية" rows="4" cols="4"></textarea>
                                        </div>







                                        @include('admin_dashboard.inputs.SEO_inputs')
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
                }

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
                }

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
