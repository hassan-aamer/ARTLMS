@extends('admin_dashboard.layout.master')
@section('Page_Title','قائمة المتعلمين ')

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="lni lni-users"></i> قائمة المتعلمين  </h5>
                <div class="ms-auto position-relative">
                    <a href="{{route('indexWith')}}" class="btnIcon btn btn-outline-primary " ><i class="lni lni-users"></i>  </a>
                </div>
                <div class="ms-auto position-relative">
                    <a href="#" id="print_Button" onclick="printDiv()" class="btnIcon btn btn-outline-primary ">طباعة  </a>
                </div>

                <div class="ms-auto position-relative">
                    <a href="{{route('students.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> أضف عنصر جديد </a>
                </div>
            </div>
            <div class="table-responsive mt-4" id="print">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>المجموعة</th>
                        <th>البريد الإلكتروني</th>
                        <th> التحقق من الحساب </th>
                        <th> تنشيط الحساب </th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                        <tr>
                            <td>{{$con->id}}</td>

                            <td>{{$con->name}}</td>
                            <td><span class="badge  bg-light-success text-success  w-50">
                                    {{ $con->userInfo->group->name }}</span></td>
                            <td>{{$con->email}}</td>
                            <td><span class="badge @if($con->email_verified_at) bg-light-success text-success @else bg-light-danger text-danger @endif w-50">
                                    {{$con->email_verified_at ? ' مفعل ' : ' غير مفعل' }}</span></td>
                            <td><span class="badge @if($con->userInfo?->status == 'yes') bg-light-success text-success @else bg-light-danger text-danger @endif w-50">
                                    {{$con->userInfo?->status == 'yes' ? ' نشط ' : ' غير نشط' }}</span></td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            العمليات
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- <a class="dropdown-item" href="{{route('indexWith')}}"> قبول الإضافة </a> --}}
                                            <a class="dropdown-item" href="{{ route('groups.index') }}"> إضافة مجموعات</a>
                                            <a class="dropdown-item" href="{{route('students.edit', $con->id)}}"> توزيع المتعلمون فى المجموعات</a>
                                            {{-- <a class="dropdown-item" href="#"><i class="bi bi-printer-fill"></i>طباعة</a> --}}
                                            <a class="dropdown-item" href="{{route('students.edit', $con->id)}}" ><i class="bi bi-pencil-fill"></i> تعديل</a>
                                            <a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#deleteItem{{$con->id}}" data-bs-toggle="tooltip"><i class="bi bi-trash-fill"></i> حذف</a>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="deleteItem{{$con->id}}" tabindex="-1" aria-labelledby="link{{$con->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="link{{$con->id}}">هل أنت متأكد من حذف هذا العنصر ؟</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">لا</button>
                                                    <form action="{{route('students.destroy',$con->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" type="button">نعم</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                <div>
                    {{$content->links()}}
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
