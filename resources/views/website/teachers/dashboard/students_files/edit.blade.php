@extends('website.teachers.dashboard.layout.master')
@section('Page_Title')  ملفات الإجابات للمتعلمين @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   ملفات الإجابات للمتعلمين | تصحيح الإجابة  </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('students_files.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-md-6 mb-4">
                                            <h5>بيانات المتعلم : </h5>
                                            <ul class="list-unstyled mx-2">

                                                <li class="mb-2">  اسم المتعلم : <strong>{{$content->student?->name}}</strong></li>
                                                <li class="mb-2">   البريد الإلكتروني للمتعلم : <strong>{{$content->student?->email}}</strong></li>
                                                <li class="mb-2">   هاتف المتعلم : <strong>{{$content->student?->userInfo?->phone}}</strong></li>
                                                <li class="mb-2">   مستوي المتعلم : <strong>{{$content->student?->userInfo?->level?->title}}</strong></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <h5>بيانات النشاط : </h5>
                                            <ul class="list-unstyled mx-2">

                                                <li class="mb-2">  اسم النشاط : <strong>{{$content->course?->title}}</strong></li>
                                                <li class="mb-2">   الترم : <strong>{{$content->course?->term == '1' ? 'ترم أول' : 'ترم ثاني'}}</strong></li>
                                                <li class="mb-2">   نوع الملف : <strong class="text-danger">{{$content->file_ext}}</strong></li>
                                                @if(!is_null($content->degree))
                                                    <li class="mb-2">   تصحيح الاجابة : <strong>
                                                            @if($content->degree == '1')
                                                                <span class="label label-danger">ضعيف</span>
                                                            @elseif($content->degree == '2')
                                                                <span class="label label-success">مقبول</span>
                                                            @elseif($content->degree == '3')
                                                                <span class="label label-success">جيد</span>
                                                            @elseif($content->degree == '4')
                                                                <span class="label label-success">جيد جدا</span>
                                                            @elseif($content->degree == '5')
                                                                <span class="label label-success">ممتاز</span>
                                                            @endif


                                                        </strong></li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="col-12">
                                            <h5>اجابة المتعلم : </h5>
                                            <a class="w-100 btn btn-primary" href="{{assetURLFile($content->file_uploaded)}}">تحميل إجابة المتعلم</a>
                                        </div>

                                        <div class="col-md-12">
                                            <h5>تصحيح الإجابة</h5>
                                            <div class="form-group ">
                                                @if(is_null($content->degree))
                                                    <label class="form-label">  اختر الدرجة <span class="text-danger">*</span> </label>
                                                @endif


                                                <select @if(!is_null($content->degree)) disabled @endif class="form-control" name="degree" id="degree" required>
                                                    <option value="">اختر الدرجة</option>
                                                    <option value="1" @if($content->degree == '1') selected @endif>ضعيف</option>
                                                    <option value="2" @if($content->degree == '2') selected @endif>مقبول</option>
                                                    <option value="3" @if($content->degree == '3') selected @endif>جيد</option>
                                                    <option value="4" @if($content->degree == '4') selected @endif>جيد جدا</option>
                                                    <option value="5" @if($content->degree == '5') selected @endif>ممتاز</option>
                                                </select>
                                            </div>
                                        </div>
                                        @if(is_null($content->degree))
                                            @include('admin_dashboard.inputs.edit_btn')
                                        @endif



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




