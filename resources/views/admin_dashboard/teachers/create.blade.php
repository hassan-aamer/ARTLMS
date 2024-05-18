@extends('admin_dashboard.layout.master')
@section('Page_Title')    المعلمين | أضف   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   المعلمين  | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('teachers.store')}}">
                                        @csrf

                                        <div class="col-md-6">
                                            <label class="form-label"> الأسم <span class="text-danger">*</span> </label>
                                            <input type="text" id="name" name="name" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> البريد الإلكتروني <span class="text-danger">*</span> </label>
                                            <input type="email" id="email" name="email" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">  رقم الهاتف <span class="text-danger">*</span> </label>
                                            <input type="number" min="0" id="phone" name="phone" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> البريد الإلكتروني البديل </label>
                                            <input type="email" id="second_email" name="second_email" class="form-control"  />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">المجموعة<span class="text-danger">*</span> </label>
                                            <select class="form-control" name="group_type" required>
                                                <option value=""> اختر نوع المجموعة </option>
                                                <option value="d"> مجموعة ضابطة </option>
                                                <option value="t"> مجموعة تجريبية </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">النوع </label>
                                            <select class="form-control" name="gender">
                                                <option value="male"> ذكر </option>
                                                <option value="female"> أنثي </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label"> المسمى الوظيفي </label>
                                            <input type="text" id="job_title" name="job_title" class="form-control"  />
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label"> الرقم القومي  </label>
                                            <input type="text" id="national_id" name="national_id" class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> المدينة  </label>
                                            <input type="text" id="city" name="city" class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> التخصص  </label>
                                            <input type="text" id="specialist" name="specialist" class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> المؤهل الدراسي  </label>
                                            <input type="text" id="qualification" name="qualification" class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> المدرسة أو الكلية أو المعهد  </label>
                                            <input type="text" id="school_or_college" name="school_or_college" class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> الادارة / القسم  </label>
                                            <input type="text" id="department" name="department" class="form-control"  />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> الصوره  <small class="text-danger">(PNG - JPEG - JPG - WEBP - SVG - GIF)</small> </label>
                                            <input class="form-control" type="file" name="image" accept="image.*" >
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">   سبب التقدم</label>
                                            <textarea name="reason" class="form-control"
                                                       rows="4" cols="4"></textarea>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label">  كلمة المرور <span class="text-danger">*</span>  </label>
                                            <input type="password" id="password" name="password" required class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">  تأكيد كلمة المرور  <span class="text-danger">*</span> </label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control"  />
                                        </div>


                                        <div class="col-12 mt-3">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">تنشيط الحساب</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                       name="status" value="yes" id="flexSwitchCheckChecked" checked="">
                                            </div>
                                        </div>



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
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                group_type: {
                    required: true,
                },
                password: {
                    required: true,
                },
                password_confirmation: {
                    required: true,
                    equalTo:'#password'
                },

            },
            messages: {
                name: {
                    required: "الحقل مطلوب",
                },
                email: {
                    required: "الحقل مطلوب",
                },
                phone: {
                    required: "الحقل مطلوب",
                },
                group_type: {
                    required: "الحقل مطلوب",
                },
                password: {
                    required: "الحقل مطلوب",
                },
                password_confirmation: {
                    required: "الحقل مطلوب",
                    equalTo: " كلمة المرور غير متطابقة",
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
