@extends('admin_dashboard.layout.master')
@section('Page_Title')    الفصول الافتراضية | تفاصيل   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i>   الفصول الافتراضية | تفاصيل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('zooms.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-6">
                                            <label class="form-label"> المحاضر </label>
                                            <input type="text" disabled class="form-control" value="{{$content->teacher?->name}}" >
                                        </div>


                                        <div class="col-6">
                                            <label class="form-label">   الصف الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control" disabled>
                                                <option value="">اختر الصف الدراسي</option>
                                                @foreach($levels as $key=>$val)
                                                    <option @if($val == $content->level_id) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">   الشعبة <span class="text-danger">*</span> </label>
                                            <select class="form-control" disabled>
                                                <option selected>{{\App\Models\Section::find($content->section_id)?->name}}</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">  العنوان </label>
                                            <input type="text" disabled class="form-control" value="{{$content->title}}" required placeholder="ادخل عنوان العنصر">
                                        </div>



                                        <div class="col-6">
                                            <label class="form-label">  وقت بدء الحصة </label>
                                            <input type="text" disabled value="{{$content->start_time}}" class="form-control" >
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">  المدة الزمنية للحصة   </label>
                                            <input type="text" min="1" disabled class="form-control" value="{{$content->duration}} دقيقة" >
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">  حالة الحصة   </label>
                                            <input type="text" min="1" disabled class="form-control" value="{{$content->end_time['title']}}" >
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  رابط الاجتماع  </label>
                                            <input type="url" name="join_url" class="form-control" required value="{{$content->join_url}}" >
                                        </div>


{{--                                        <div class="col-6">--}}
{{--                                            <label class="form-label">   Meeting ID   </label>--}}
{{--                                            <input type="text" min="1" disabled class="form-control" value="{{$content->meeting_id}}" >--}}
{{--                                        </div>--}}

{{--                                        <div class="col-6">--}}
{{--                                            <label class="form-label">   Meeting Password   </label>--}}
{{--                                            <input type="text" min="1" disabled class="form-control" value="{{$content->password}}" >--}}
{{--                                        </div>--}}

{{--                                        <div class="col-12">--}}
{{--                                            <label class="form-label"> رابط الحصة للمتحكم    </label><br>--}}
{{--                                            <a href="{{$content->start_url}}" target="_blank">{{$content->start_url}}</a>--}}
{{--                                        </div>--}}



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
@endpush
