@extends('admin_dashboard.layout.master')
@section('Page_Title')  المقرر | أضف   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i> المقرر | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('scheduleds.store')}}">
                                        @csrf

                                        <div class="col-lg-4">
                                            <label class="form-label">  اختر المنهج <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="curriculum_id">
                                                <option value="">اختر المنهج</option>
                                                @foreach($curriculums as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="form-label">  اختر المجال <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="category_id">
                                                <option value="">اختر المجال</option>
                                                @foreach($categories as $key=>$val)
                                                    <option value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="form-label"> اختر الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.title')
                                        @include('admin_dashboard.inputs.short_description')
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

<script>
    $(document).ready(function () {
        $("#validateForm").validate({
            rules: {
                category_id: {
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
                category_id: {
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
</script>
@endpush
