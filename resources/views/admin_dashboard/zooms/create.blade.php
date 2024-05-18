@extends('admin_dashboard.layout.master')
@section('Page_Title')   الفصول الافتراضية | أضف   @endsection

@section('content')


    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i>  الفصول الافتراضية | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('zooms.store')}}">
                                        @csrf

                                        <div class="col-12">
                                            <label class="form-label">  اختر الصف الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="level_id" required id="filterSections">
                                                <option value="">اختر الصف الدراسي</option>
                                                @foreach($levels as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 my-3">
                                            <label class="form-label"> اختر الشعبة <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="section_id" required id="sections">

                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.title')

                                        <div class="col-12">
                                            <label class="form-label">  وقت بدء الحصة <span class="text-danger">*</span> </label>
                                            <input type="datetime-local" name="start_time" class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  رابط الاجتماع <span class="text-danger">*</span> </label>
                                            <input type="url" name="join_url" class="form-control"  placeholder="https://google.meet/1sdfsd4r" required>
                                        </div>



                                        <div class="col-12">
                                            <label class="form-label">  المدة الزمنية للحصة (ادخل المدة بالدقائق) بحد أقصي 40 دقيقة <span class="text-danger">*</span> </label>
                                            <input type="number" min="1" name="duration" class="form-control"  placeholder="مثال : 40" required>
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
                level_id: {
                    required: true,
                },
                title: {
                    required: true,
                },
                short_description: {
                    required: true,
                },
                image: {
                    required: true,
                },
                "name[]": {
                    required: true,
                },
                "file_type[]": {
                    required: true,
                },
                "file_uploaded[]": {
                    required: true,
                },

            },
            messages: {
                level_id: {
                    required: "الحقل مطلوب",
                },
                title: {
                    required: "الحقل مطلوب",
                },
                short_description: {
                    required: "الحقل مطلوب",
                },
                image: {
                    required: "الحقل مطلوب",
                },
                "name[]": {
                    required: "الحقل مطلوب",
                },
                "file_type[]": {
                    required: "الحقل مطلوب",
                },
                "file_uploaded[]": {
                    required: "الحقل مطلوب",
                },

            }
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('change', '#filterSections', function (){
        var level_id = $(this).val();
        $.ajax({
            url:"{{route('admin.filterSections')}}",
            method:"POST",
            data: {level_id:level_id},
            success:function(response){
                $('#sections').html(response.html);
            },
            error:function(){
            }
        });
    });
</script>
@endpush
