@extends('admin_dashboard.layout.master')
@section('Page_Title')      ( المتعلمين ) | تعديل   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>    ( المتعلمين ) | تعديل ({{$content->email}}) </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('students.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-md-6">
                                            <label class="form-label"> الأسم <span class="text-danger">*</span> </label>
                                            <input type="text" id="name" name="name" value="{{$content->name}}" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> البريد الإلكتروني <span class="text-danger">*</span> </label>
                                            <input type="email" id="email" name="email" value="{{$content->email}}" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">  رقم الهاتف <span class="text-danger">*</span> </label>
                                            <input type="number" min="0" id="phone" value="{{$content->userInfo?->phone}}" name="phone" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> البريد الإلكتروني البديل </label>
                                            <input type="email" id="second_email" value="{{$content->second_email}}" name="second_email" class="form-control"  />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">المجموعة<span class="text-danger">*</span> </label>
                                            <select class="form-control" name="group_id" required>
                                                <option value=""> اختر نوع المجموعة </option>
                                                @foreach ($groups as $group)
                                                <option value="{{ $group->id }}"> {{ $group->name }} </option>
                                                @endforeach

                                            </select>
                                        </div>

                                         <div class="col-12 mb-3">
                                    <label class="form-label">   الصف الدراسي  </label>
                                    <select disabled class="form-control" name="level_id">
                                        <option value="">اختر الصف الدراسي</option>
                                        @foreach($levels as $key=>$val)
                                            <option  @if($content->userInfo?->level_id == $val) selected @endif value="{{$val}}">{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                        <div class="col-md-6">
                                            <label class="form-label">النوع </label>
                                            <select class="form-control" name="gender">
                                                <option value="male" @if($content->userInfo?->gender == 'male') selected @endif> ذكر </option>
                                                <option value="female" @if($content->userInfo?->gender == 'female') selected @endif> أنثي </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label"> المسمى الوظيفي   </label>
                                            <input type="text" id="job_title" value="{{$content->userInfo?->job_title}}" name="job_title" class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> الرقم القومي  </label>
                                            <input type="text" id="national_id" name="national_id" value="{{$content->userInfo?->national_id}}" class="form-control"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> المدينة  </label>
                                            <input type="text" id="city" name="city" class="form-control"  value="{{$content->userInfo?->city}}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> التخصص  </label>
                                            <input type="text" id="specialist" name="specialist" class="form-control"  value="{{$content->userInfo?->specialist}}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> المؤهل الدراسي  </label>
                                            <input type="text" id="qualification" name="qualification" class="form-control"  value="{{$content->userInfo?->qualification}}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> المدرسة أو الكلية أو المعهد  </label>
                                            <input type="text" id="school_or_college" name="school_or_college" class="form-control"  value="{{$content->userInfo?->school_or_college}}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"> الادارة / القسم  </label>
                                            <input type="text" id="department" name="department" class="form-control"  value="{{$content->userInfo?->department}}" />
                                        </div>

                                        <div class="col-md-12">
                                            <img src="{{assetURLFile($content->userInfo?->image)}}" width="300" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label"> الصوره  <small class="text-danger">(PNG - JPEG - JPG - WEBP - SVG - GIF)</small> </label>
                                            <input class="form-control" type="file" name="image" accept="image.*" >
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">   سبب التقدم</label>
                                            <textarea name="reason" class="form-control"
                                                      rows="4" cols="4">{{$content->userInfo?->reason}}</textarea>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">تنشيط الحساب</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                       name="status" id="flexSwitchCheckChecked" @if($content->userInfo?->status == 'yes') checked="" value="yes" @else value="no" @endif  >
                                            </div>
                                        </div>



                                        <div class="col-12 mt-3">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">التحقق من الحساب</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                       name="email_verified_at" id="flexSwitchCheckChecked" @if($content->email_verified_at) checked="" @endif  >
                                            </div>
                                        </div>

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
