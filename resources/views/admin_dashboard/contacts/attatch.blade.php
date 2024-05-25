@extends('admin_dashboard.layout.master')
@section('Page_Title','اضافة مرفقات')
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
                        <h5 class="mb-0"> <i class="lni lni-book"></i> اضافة المرفقات  (  {{ $contact->email }}  )</h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{ route('att', $contact->id) }}">
                                        @csrf
                                        @include('admin_dashboard.inputs.image')

                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو  (Iframe tag) </label>
                                            <input type="text" name="link" class="form-control"  placeholder=" رابط الفيديو ">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو  </label>
                                            <input type="text" name="url" class="form-control"  placeholder=" رابط الفيديو ">
                                        </div>

                                        <div class="col-12">
                                            <label for="form-label">إضافة ملفات</label>
                                            <input class="form-control" id="triggerInputt" type="file" name="file" placeholder="إضافة ملفات" accept="application/pdf"  >
                                        </div>


                                        <div class="col-12">
                                            <label for="titleInput">إضافة وصف النطاق</label>
                                            <input class="form-control" id="titleInput" type="text" name="title" placeholder="إضافة وصف النطاق" >
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label"> وصف مختصر <span class="text-danger">*</span></label>
                                            <textarea required name="description" class="form-control ckeditor" placeholder="وصف مختصر" rows="4" cols="4"></textarea>
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
@endpush
