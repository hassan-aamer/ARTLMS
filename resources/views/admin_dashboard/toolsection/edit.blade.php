@extends('admin_dashboard.layout.master')
@section('Page_Title') تعديل قسم الأدوات الدراسية @endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> تعديل قسم الأدوات الدراسية </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data" action="{{ route('toolssections.update', $section->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-12">
                                            <label for="section_name" class="form-label">اسم القسم</label>
                                            <input type="text" name="section_name" class="form-control" id="section_name" value="{{ $section->section_name }}" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">تحديث</button>
                                        </div>
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
                section_name: {
                    required: true,
                }
            },
            messages: {
                section_name: {
                    required: "الحقل مطلوب",
                }
            }
        });
    });
</script>
@endpush
