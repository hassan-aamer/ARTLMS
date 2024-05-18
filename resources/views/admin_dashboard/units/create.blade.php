@extends('admin_dashboard.layout.master')
@section('Page_Title')  الوحدات | أضف وحدة جديدة   @endsection
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
                        <h5 class="mb-0"> <i class="lni lni-book"></i> الوحدات | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('units.store')}}">
                                        @csrf

                                        <div class="col-12">
                                            <label class="form-label">  اختر المقرر <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="scheduled_id">
                                                <option value="">اختر المقرر</option>
                                                @foreach($scheduleds as $key)
                                                    <option value="{{$key->id}}">{{$key->title}} -  {{$key->curriculum?->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">  اختر المجال <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="category_id">
                                                <option value="">اختر المجال</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">  اختر الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.title')
                                        @include('admin_dashboard.inputs.short_description')

                                        <div class="col-12">
                                            <label class="form-label">  اختر المحاضرين <span class="text-danger">*</span> </label>
                                            <select name="teachers[]" class="multiple-select" data-placeholder="اختر المحاضرين" multiple="multiple">
                                                @foreach($teachers as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        @include('admin_dashboard.inputs.image')

                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو  (Iframe tag) </label>
                                            <input type="text" name="video_link" class="form-control"  placeholder=" رابط الفيديو ">
                                        </div>


                                        @include('admin_dashboard.inputs.SEO_inputs')
                                        @include('admin_dashboard.inputs.status_sort')

                                        @include('admin_dashboard.inputs.multiple_files')

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
                category_id: {
                    required: true,
                },
                term : {
                    required : true
                },
                scheduled_id: {
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
                "teachers[]": {
                    required: true,
                },

            },
            messages: {
                category_id: {
                    required: "يجب تحديد المجال أو المحور الفني",
                },
                term : {
                    required : 'يجب اختيار الفصل الدراسي'
                },
                scheduled_id: {
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
                "teachers[]": {
                    required: "الحقل مطلوب",
                },

            }
        });
    });
</script>
@endpush
