@extends('admin_dashboard.layout.master')
@section('Page_Title')  المقرر | تعديل   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i> المقرر | تعديل <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('scheduleds.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-lg-4">
                                            <label class="form-label">  اختر المنهج <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="curriculum_id">
                                                <option value="">اختر المنهج</option>
                                                @foreach($curriculums as $key=>$val)
                                                    <option @if($val == $content->curriculum_id) selected @endif  value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="form-label">  اختر المجال <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="category_id">
                                                <option value="">اختر المجال</option>
                                                @foreach($categories as $key=>$val)
                                                    <option @if($val == $content->category_id) selected @endif value="{{$val}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="form-label"> اختر الفصل الدراسي <span class="text-danger">*</span> </label>
                                            <select class="form-control form-select" name="term">
                                                <option value="">اختر الفصل الدراسي</option>
                                                @foreach($terms as $term)
                                                    <option value="{{ $term->id }}" @if($term->id == $content->term) selected @endif>{{ $term->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @include('admin_dashboard.inputs.edit_title')
                                        @include('admin_dashboard.inputs.edit_short_description')
                                        @include('admin_dashboard.inputs.edit_image')
                                        <div class="col-12">
                                            <label class="form-label"> رابط الفيديو  (Iframe tag) </label>
                                            <input type="text" name="video_link" value="{{$content->video_link}}" class="form-control"  placeholder=" رابط الفيديو ">
                                        </div>

                                        @include('admin_dashboard.inputs.edit_SEO_inputs')
                                        @include('admin_dashboard.inputs.edit_status_sort')
                                        @include('admin_dashboard.inputs.edit_multiple_files')
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
