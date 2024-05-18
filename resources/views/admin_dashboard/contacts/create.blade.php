@extends('admin_dashboard.layout.master')
@section('Page_Title')   المقالات | أضف   @endsection

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
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  المقالات | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('articles.store')}}">
                                        @csrf



                                        <div class="col-12">
                                            <label class="form-label">  اختر الصف الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="level_id">
                                                <option value="">اختر الصف الدراسي</option>
                                                @foreach($levels as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">  اختر المجموعة <span class="text-danger">*</span> </label>
                                            <select class="form-control" name="group">
                                                <option value="">اختر المجموعة</option>
                                                <option value="t">مجموعة تجريبية</option>
                                                <option value="d">مجموعة ضابطة</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"> أقسام المقالات (ليس إلزامي)  </label>
                                            <select class="form-control" name="category_id">
                                                <option value="">اختر القسم</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.title')
                                        @include('admin_dashboard.inputs.image')
                                        @include('admin_dashboard.inputs.description')

                                        @include('admin_dashboard.inputs.video_link')

                                        <div class="col-12">
                                            <label class="form-label">   ال تلميحات  (ليس إلزامي)  </label>
                                            <select name="tags_id[]" class="multiple-select" data-placeholder="اختر التلميحات  " multiple="multiple">
                                                @foreach($tags as $tag)
                                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.SEO_inputs')

                                        @include('admin_dashboard.inputs.status_sort')


                                        <div class="col-12 mb-5">

                                            <h5 class="mt-4 mb-3">  ارفع الملفات الخاصه بالعنصر : <span class="text-primary">ليس إلزامي</span>  </h5>


                                            <div class="float-end mb-2">
                                                <button type="button" class="btn btn-sm btn-success" id="addNewRow">أضف ملف أخر</button>
                                            </div>
                                            <table class="no-datatable table table-striped table-hover table-responsive table-bordered mb-0">
                                                <thead>
                                                <th>اسم الملف</th>
                                                <th>نوع الملف</th>
                                                <th> الملف</th>
                                                <th> حذف</th>
                                                </thead>
                                                <tbody id="lines">
                                                <tr id="tr">
                                                    <td>
                                                        <input class="form-control" name="name[]" placeholder="ادخل اسم الملف"  />
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="file_type[]" >
                                                            <option value=""> اختر نوع الملف </option>
                                                            @foreach(extensions() as $ext)
                                                                <option value="{{$ext->file_type .' - '.$ext->file_ext}}"> {{$ext->file_type .' - '.$ext->file_ext}} </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="file_uploaded[]"   />
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
                description: {
                    required: true,
                },
                image: {
                    required: true,
                }

            },
            messages: {
                title: {
                    required: "الحقل مطلوب",
                },
                description: {
                    required: "الحقل مطلوب",
                },
                image: {
                    required: "الحقل مطلوب",
                }

            }
        });
    });
</script>
@endpush
