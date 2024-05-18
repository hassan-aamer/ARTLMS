@extends('admin_dashboard.layout.master')
@section('Page_Title')   الأدوات الدراسية  | تعديل   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   الأدوات الدراسية  | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('tools.update', $content->id)}}">
                                        @method('put')
                                        @csrf
                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_image')
                                        <div class="col-12">
                                            <label class="form-label">   رابط تحميل البرنامج <span class="text-danger">*</span>  </label>
                                            <input type="url" value="{{$content->downloaded_link}}" name="downloaded_link" required class="form-control"
                                                   placeholder="ادخل رابط التحميل">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  نوع البرنامج </label>
                                            <input type="text" value="{{$content->type}}" name="type" class="form-control"
                                                   placeholder=" مثال : برنامج تحكم عن بعد  ">
                                        </div>
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
                    downloaded_link: {
                        required: true,
                    }


                },
                messages: {
                    title: {
                        required: "الحقل مطلوب",
                    },
                    downloaded_link: {
                        required: "الحقل مطلوب",
                    }

                }
            });
        });
    </script>
@endpush
