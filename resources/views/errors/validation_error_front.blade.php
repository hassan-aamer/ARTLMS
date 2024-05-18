

<!-- Errors -->
@if ($errors->any())
    <div class="div_errors">
        @foreach ($errors->all() as $error)
            <div
                class="alert-danger alert text-center d-flex justify-content-center align-items-center py-2 fs-14"
            >
                <i class="fa fa-times-circle me-2"></i>
                {{$error}}
            </div>
        @endforeach
    </div>
@endif
<!-- end -->
