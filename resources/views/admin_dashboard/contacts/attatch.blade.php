@extends('admin_dashboard.layout.master')
@section('Page_Title', 'اضافة مرفقات')
@push('styles')
    <link href="{{ asset('admin_dashboard/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i> اضافة المرفقات ( {{ $contact->email }} )</h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                        action="{{ route('att', $contact->id) }}">
                                        @csrf
                                        @include('admin_dashboard.inputs.image')

                                        <div class="container mt-5">
                                            <div id="iframeLinksContainer" class="col-12">
                                                <label class="form-label">رابط الفيديو (Iframe tag) 1</label>
                                                <input type="text" name="link[]" class="form-control mb-2"
                                                    placeholder="رابط الفيديو">
                                            </div>
                                            <button id="addIframeLinkButton" class="btn btn-primary">إضافة رابط آخر</button>
                                        </div>

                                        <div class="container mt-5">
                                            <div id="interactiveLinksContainer" class="col-12">
                                                <label class="form-label">رابط الفيديو تفاعلي 1</label>
                                                <input type="text" name="url[]" class="form-control mb-2"
                                                    placeholder="رابط الفيديو">
                                            </div>
                                            <button id="addInteractiveLinkButton" class="btn btn-primary">إضافة رابط
                                                آخر</button>
                                        </div>

                                        <div class="col-12">
                                            <label for="form-label">إضافة ملفات</label>
                                            <input class="form-control" id="triggerInputt" type="file" name="file"
                                                placeholder="إضافة ملفات" accept="application/pdf">
                                        </div>


                                        <div class="col-12">
                                            <label for="titleInput"> وصف الميتا الخاص بال SEO</label>
                                            <input class="form-control" id="titleInput" type="text" name="title"
                                                placeholder="إضافة وصف النطاق">
                                        </div>
                                        <div class="col-12">
                                            <label for="titleInput"> الكلمات الدلالية الخاصة بال SEO</label>
                                            <input class="form-control" id="titleInput" type="text" name="description"
                                                placeholder="إضافة وصف النطاق">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin_dashboard/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/assets/js/form-select2.js') }}"></script>


    <script>
        document.getElementById('addIframeLinkButton').addEventListener('click', function() {
            var container = document.getElementById('iframeLinksContainer');
            var inputCount = container.getElementsByTagName('input').length;
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'link[]';
            newInput.className = 'form-control mb-2';
            newInput.placeholder = 'رابط الفيديو (Iframe tag) ' + (inputCount + 1);
            container.appendChild(newInput);
        });

        document.getElementById('addInteractiveLinkButton').addEventListener('click', function() {
            var container = document.getElementById('interactiveLinksContainer');
            var inputCount = container.getElementsByTagName('input').length;
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'url[]';
            newInput.className = 'form-control mb-2';
            newInput.placeholder = 'رابط الفيديو تفاعلي ' + (inputCount + 1);
            container.appendChild(newInput);
        });
    </script>
@endpush
