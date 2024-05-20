@extends('admin_dashboard.layout.master')
@section('Page_Title')
    الرسائل | رسالة من {{ $contactMessage->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> رسالة من <small
                                class="text-success">({{ $contactMessage->name }})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div id="print">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <ul>
                                            <li class="mb-3">
                                                <strong>البريد الإلكتروني :</strong>
                                                <span>{{ $contactMessage->email }}</span>
                                            </li>
                                            <li class="mb-3">
                                                <strong>الهاتف :</strong>
                                                <span>{{ $contactMessage->phone }}</span>
                                            </li>
                                            <li class="mb-3">
                                                <strong>الموضوع :</strong>
                                                <span>{{ $contactMessage->subject }}</span>
                                            </li>
                                            <li class="mb-3">
                                                <strong>الرسالة :</strong>
                                                <span>{{ $contactMessage->message }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

    {{-- -------------------------------------- المحاضرون و المعلمون ------------------------------- --}}
<form action="{{ route('sendEmail.store') }}" method="POST">
    @csrf
    <input type="hidden" name="contactMessage" value="{{ $contactMessage->id }}">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  المحاضرون و المعلمون </h5>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($teacher as $con)
                        <tr>
                            <td>{{$con->id}}</td>
                            <td>{{$con->name}}</td>
                            <td>{{$con->email}}</td>
                            <td>
                                <input type="checkbox" name="teachers[]" value="{{ $con->id }}">
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <p> لا يوجد بيانات </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- ------------------------------------المتعلمين--------------------------------- --}}

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  المتعلمين </h5>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($student as $con)
                        <tr>
                            <td>{{$con->id}}</td>
                            <td>{{$con->name}}</td>
                            <td>{{$con->email}}</td>
                            <td>
                                <input type="checkbox" name="students[]" value="{{ $con->id }}">
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <p> لا يوجد بيانات </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- -------------------------------------------------------------------- --}}
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                    <button class="btn btn-primary" type="submit"> ارسال</button>
            </div>
        </div>
    </div>
</form>
@endsection

