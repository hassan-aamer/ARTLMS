@extends('admin_dashboard.layout.master')
@section('Page_Title')  المهارات | تعديل   @endsection
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
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> المهارات | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('skills.update', $content->id)}}">
                                        @method('put')
                                        @csrf
                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_description')'
                                        @include('admin_dashboard.inputs.edit_video_link')

                                        <div class="col-md-12">
                                            <div class="d-inline-block">
                                                @foreach($content->images as $image)
                                                    <img class="m-2" src="{{assetURLFile($image->image)}}" width="200" />
                                                @endforeach
                                            </div>
                                            <br>
                                            <label class="form-label"> الصور <small class="text-danger">(PNG - JPEG - JPG - WEBP - SVG - GIF)</small>
                                                <small class="text-warning"> يمكنك رفع أكثر من صورة </small></label>
                                            <input type="file" id="files" name="images[]" class="form-control" multiple  />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  الجانب المعرفي</label>
                                            <textarea required name="knowledge_desc" class="form-control ckeditor"
                                                      placeholder="الجانب المعرفي" rows="4" cols="4">{!! $content->knowledge_desc !!}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  الجانب الأدائي</label>
                                            <textarea required name="performance_desc" class="form-control ckeditor"
                                                      placeholder="الجانب الأدائي" rows="4" cols="4">{!! $content->performance_desc !!}</textarea>
                                        </div>
                                        
                                        
                                          
                                         <div class="col-12">
                                            <label class="form-label">  الجانب الوجداني</label>
                                            <textarea required name="sentimental_desc" class="form-control ckeditor"
                                                      placeholder="الجانب الوجداني" rows="4" cols="4">{!! $content->sentimental_desc !!}</textarea>
                                        </div>
                                        
                                        
                                        



                                        @include('admin_dashboard.inputs.edit_SEO_inputs')
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
