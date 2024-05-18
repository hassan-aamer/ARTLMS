@extends('admin_dashboard.layout.master')
@section('Page_Title')    الفصول الافتراضية | الحضور والغياب   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="lni lni-book"></i>   الفصول الافتراضية | الحضور والغياب <small class="text-warning">({{$content->title}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('zooms.students.attendance', $content->id)}}">
                                        @csrf

                                            <ul>
                                                @foreach($users_in_same_section as $user)
                                                    <li class="mb-4 d-flex align-items-center">
                                                        <input id="attendance_{{$user->id}}" type="checkbox" style="width: 20px;height: 20px;" name="attendance[{{$user->id}}]"
                                                               @if(in_array($user->id, $attendances)) checked @else @endif value="1" >
                                                        <label for="attendance_{{$user->id}}" class="fw-bold mx-2">{{$user->name}}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="col-md-4  mx-auto mt-4">
                                                <button type="submit" class="btnIcon btn btn-primary px-5 w-100">
                                                    <i class="lni lni-circle-plus"></i>
                                                    حفظ
                                                </button>
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

