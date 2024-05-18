@extends('admin_dashboard.layout.master')
@section('Page_Title')   إعدادات الموقع  @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bx bx-trophy"></i> إعدادات الموقع </h5>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-12">
                    <div class="card shadow-none bg-light border">
                        <div class="card-body">
                            <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                  action="{{route('settings.update')}}">
                                @csrf
                                @foreach($content as $con)
                                    <div class="col-12">
                                        <label class="form-label">  {{$con->key}} <span class="text-danger">*</span> </label>
                                        <input type="text" name="value[{{$con->id}}]" value="{{$con->value}}" class="form-control" required placeholder="ادخل ">
                                    </div>
                                @endforeach
                                @include('admin_dashboard.inputs.edit_btn')
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>


@endsection

