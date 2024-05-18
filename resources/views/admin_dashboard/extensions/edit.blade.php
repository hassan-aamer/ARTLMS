@extends('admin_dashboard.layout.master')
@section('Page_Title')   أنواع الملفات | تعديل   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-files"></i> أنواع الملفات | تعديل </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('extensions.update', $content->id)}}">
                                        @method('put')
                                        @csrf
                                        <div class="col-12">
                                            <label class="form-label">  نوع الملف <span class="text-danger">*</span> </label>
                                            <input type="text" name="file_type" value="{{$content->file_type}}" class="form-control" required placeholder="نوع الملف">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">  صيغة الملف <span class="text-danger">*</span> </label>
                                            <input type="text" name="file_ext" value="{{$content->file_ext}}" class="form-control" required placeholder="صيغة الملف">
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
