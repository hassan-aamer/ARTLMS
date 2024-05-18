@extends('admin_dashboard.layout.master')
@section('Page_Title')   دليل المستخدم | أضف   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  دليل المستخدم | أضف عنصر جديد </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('guides.store')}}">
                                        @csrf
                                        @include('admin_dashboard.inputs.title')
                                        @include('admin_dashboard.inputs.description')
                                        @include('admin_dashboard.inputs.video_link')
                                        @include('admin_dashboard.inputs.SEO_inputs')
                                        @include('admin_dashboard.inputs.status_sort')
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
                title: {
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
                description: {
                    required: "الحقل مطلوب",
                }


            }
        });
    });
</script>

@endpush
