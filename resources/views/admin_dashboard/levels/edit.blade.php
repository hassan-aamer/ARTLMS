@extends('admin_dashboard.layout.master')
@section('Page_Title')  الصفوف الدراسية | تعديل   @endsection
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
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>الصفوف الدراسية | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('levels.update', $content->id)}}">
                                        @method('put')
                                        @csrf
                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_image')

                                        <div class="col-12">
                                            <label class="form-label">  اختر الشعبة <span class="text-danger">*</span> </label>
                                            <select name="sections[]" class="multiple-select" data-placeholder="اختر الشعبة" multiple="multiple">
                                                @foreach($sections as $key=>$val)
                                                    <option @if(in_array($val,$arraySections)) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">  رابط استمارة الرغبات  </label>
                                            <input type="text" value="{{$content->hyper_link}}" name="hyper_link" class="form-control"  placeholder="  رابط استمارة الرغبات">
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
    <script src="{{asset('admin_dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/assets/js/form-select2.js')}}"></script>
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
