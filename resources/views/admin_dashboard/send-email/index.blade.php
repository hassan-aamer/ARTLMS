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
                        <h5 class="mb-0"> <i class="bi bi-envelope-open"></i> رسالة من
                            <smallclass="text-success">({{ $contactMessage->name }}) أختار من القائمه من الذى يمكنك ارسال
                            الرسالة الية</smallclass=>
                        </h5>
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

    {{-- -------------------------------------بريد من الخارج لارسال الرساله الية-------------------------------- --}}
    <form action="{{ route('sendEmail.store') }}" method="POST">
        @csrf
        <input type="hidden" name="contactMessage" value="{{ $contactMessage->id }}">

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0"> <i class="bi bi-reply"></i> ادخل بريد من خارج المنصة لارسال الرسالة اليه
                                <span class="text-danger">(أختياري)</span>
                            </h5>
                        </div>
                        <div class="row g-3 mt-4">
                            <div class="col-12">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label class="form-label">البريد الإلكتروني </label>
                                            <input type="email" placeholder="ادخل بريد الكتروني" id="email"
                                                name="email" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
                </div>
            </div>
        </div>

        {{-- ------------------------------------ المحاضرون و المعلمون ----------------------------------------- --}}
        <div>
            <center><input type="checkbox" id="select-all"> تحديد الكل<br></center>
        </div><br>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0"> <i class="bi bi-reply"></i> المحاضرون و المعلمون </h5>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>حدد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teacher as $con)
                                <tr>
                                    <td>{{ $con->id }}</td>
                                    <td>{{ $con->name }}</td>
                                    <td>{{ $con->email }}</td>
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
                    <h5 class="mb-0"> <i class="bi bi-reply"></i> المتعلمين </h5>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>حدد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student as $con)
                                <tr>
                                    <td>{{ $con->id }}</td>
                                    <td>{{ $con->name }}</td>
                                    <td>{{ $con->email }}</td>
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

        {{-- ------------------------------------الفنانين--------------------------------- --}}

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0"> <i class="bi bi-reply"></i> الفنانين </h5>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>حدد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student as $con)
                                <tr>
                                    <td>{{ $con->id }}</td>
                                    <td>{{ $con->name }}</td>
                                    <td>{{ $con->email }}</td>
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

@section('js')
    <script>
        document.getElementById('select-all').onclick = function() {
            var studentCheckboxes = document.getElementsByName('students[]');
            var teacherCheckboxes = document.getElementsByName('teachers[]');

            for (var checkbox of studentCheckboxes) {
                checkbox.checked = this.checked;
            }

            for (var checkbox of teacherCheckboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>
@endsection
