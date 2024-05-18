@extends('admin_dashboard.layout.master')
@section('Page_Title')   إنشاء اجتماع Google | أضف   @endsection
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
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> انشء اجتماع Google  | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('meets.store')}}">
                                        @csrf
                                        <div class="col-12">
                                            <label class="form-label">  اختر المحاضرين و المعلمين <span class="text-danger">*</span> </label>
                                            <select name="receiver_ids[]" class="multiple-select" data-placeholder="اختر المعلمين" multiple="multiple">
                                                @foreach($teachers as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @include('admin_dashboard.inputs.title')

                                        <div class="col-12">
                                            <label class="form-label">  تاريخ الاجتماع <span class="text-danger">*</span> </label>
                                            <input type="datetime-local" name="start_date_time" class="form-control" required placeholder="ادخل عنوان العنصر">
                                        </div>
                                        <div class="col-12">
                                            <label>رابط الاجتماع</label>
                                            <div class="input-group mb-0">
                                                <input required type="url" placeholder="https://meet.google.com/nqo-xhgr-wtr" name="google_meet_url" id="meetingTime" class="form-control w-100"/>
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
<script src="{{asset('admin_dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin_dashboard/assets/js/form-select2.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#validateForm").validate({
            rules: {
                title: {
                    required: true,
                },
                "receiver_ids[]": {
                    required: true,
                },
                start_date_time: {
                    required: true,
                },
                google_meet_url: {
                    required: true,
                }

            },
            messages: {
                title: {
                    required: "الحقل مطلوب",
                },
                "receiver_ids[]": {
                    required: "الحقل مطلوب",
                },
                start_date_time: {
                    required: "الحقل مطلوب",
                },
                google_meet_url: {
                    required: "الحقل مطلوب",
                }

            }
        });
    });
</script>
@endpush
