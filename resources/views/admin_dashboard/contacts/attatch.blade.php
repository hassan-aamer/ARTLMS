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
                                        <div class="col-12">
                                            <label class="form-label">  العنوان <small class="text-danger">(اختيارى)</small> </label>
                                            <input type="text" name="" class="form-control"  placeholder="ادخل عنوان العنصر">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> وصف مختصر <small class="text-danger">(اختيارى)</small></label>
                                            <textarea  name="" class="form-control ckeditor" placeholder="وصف مختصر" rows="4" cols="4"></textarea>
                                        </div>


                                        @include('admin_dashboard.inputs.image')


                                        <div class="col-12 mb-5">
                                            <div class="float-end mb-2">
                                                <button type="button" class="btn btn-sm btn-success" id="addNewRow"> اضف رابط اخر</button>
                                            </div>
                                            <table class="no-datatable table table-striped table-hover table-responsive table-bordered mb-0">
                                                <thead>
                                                    <th> رابط فيديو  <small class="text-danger">(اختيارى)</small></th>
                                                    <th> حذف</th>
                                                </thead>
                                                <tbody id="lines">
                                                    <tr id="tr">
                                                        <td>
                                                            <input class="form-control" name="link[]" placeholder=" رابط الفيديو"  />
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-danger removeRow">
                                                                <i class="lni lni-trash m-0"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>




                                        <div class="col-12 mb-5">
                                            <div class="float-end mb-2">
                                                <button type="button" class="btn btn-sm btn-success" id="addNewRow"> اضف رابط اخر</button>
                                            </div>
                                            <table class="no-datatable table table-striped table-hover table-responsive table-bordered mb-0">
                                                <thead>
                                                    <th>(Iframe tag) 1  رابط فيديو <small class="text-danger">(اختيارى) SCORM, xAPI, cmi5 , AICC , html , html 5 , exe , epub ( ebook ) </small></th>
                                                    <th> حذف</th>
                                                </thead>
                                                <tbody id="lines">
                                                    <tr id="tr">
                                                        <td>
                                                            <input class="form-control" name="url[]" placeholder=" رابط الفيديو"  />
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-danger removeRow">
                                                                <i class="lni lni-trash m-0"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- <div class="col-12">
                                            <label for="form-label">إضافة ملفات</label>
                                            <input class="form-control" id="triggerInputt" type="file" name="file"
                                                placeholder="إضافة ملفات" accept="application/pdf">
                                        </div> --}}


                                        <div class="col-12">
                                            <label for="form-label"> وصف الميتا الخاص بال SEO</label>
                                            <textarea required name="title" class="form-control " placeholder=" وصف الميتا" rows="4" cols="4"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <label for="titleInput"> الكلمات الدلالية الخاصة بال SEO</label>
                                            <input class="form-control" id="titleInput" type="text" name="description"
                                                placeholder="إضافة وصف النطاق">
                                        </div>







                                        <div class="col-12 mb-5">

                                            <h5 class="mt-4 mb-3">  ارفع الملفات الخاصه بالعنصر : <span class="text-danger">*</span>  </h5>


                                            <div class="float-end mb-2">
                                                <button type="button" class="btn btn-sm btn-success" id="addNewRow">أضف ملف أخر</button>
                                            </div>
                                            <table class="no-datatable table table-striped table-hover table-responsive table-bordered mb-0">
                                                <thead>
                                                    <th>اسم الملف</th>
                                                    <th>نوع الملف</th>
                                                    <th> الملف</th>
                                                    <th> توصيف الملف (Meta)</th>
                                                    <th> حذف</th>
                                                </thead>
                                                <tbody id="lines">
                                                    <tr id="tr">
                                                        <td>
                                                            <input class="form-control" name="" placeholder="ادخل اسم الملف" required />
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="" required>
                                                                <option value=""> اختر نوع الملف </option>
                                                                @foreach(extensions() as $ext)
                                                                    <option value="{{$ext->file_type .' - '.$ext->file_ext}}"> {{$ext->file_type .' - '.$ext->file_ext}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="file" class="form-control" name="file"  required />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" name="" placeholder="ادخل  توصيف الملف (Meta)"  />
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-danger removeRow">
                                                                <i class="lni lni-trash m-0"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>


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
