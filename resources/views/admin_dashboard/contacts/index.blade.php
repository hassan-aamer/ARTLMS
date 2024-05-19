@extends('admin_dashboard.layout.master')
@section('Page_Title')  الرسائل @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  الرسائل </h5>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الموضوع</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                        <tr>
                            <td>{{$con->id}}</td>

                            <td>{{$con->name}}</td>
                            <td>{{$con->email}}</td>
                            <td>{{$con->subject}}</td>

                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            العمليات
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('contacts.show', $con->id)}}">فتح الرسالة </a>
                                            <a class="dropdown-item" href="#">اعادة التوجية للمتعلم</a>
                                            <a class="dropdown-item" href="#">المعلم / المحاضر</a>
                                            <a class="dropdown-item" href="#">الفنان او اكثر</a>
                                            <a class="dropdown-item" href="#">الرد</a>
                                            <a class="dropdown-item" href="#"><i class="bi bi-file-earmark-plus-fill"></i>اضافة مرفقات</a>
                                            <a class="dropdown-item" href="#"><i class="bi bi-printer-fill"></i>طباعة اة تصدير </a>
                                            <a class="dropdown-item" href="#">تعطيل</a>
                                            <a class="dropdown-item" href="#"><i class="bi bi-ban"></i> تعديل</a>
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
                                                    <form action="{{route('contacts.destroy',$con->id)}}" method="POST">
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

