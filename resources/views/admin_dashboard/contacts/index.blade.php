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
                                    <a href="{{route('contacts.show', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="فتح الرسالة"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="javascript:;"  data-bs-toggle="modal" data-bs-target="#deleteItem{{$con->id}}" class="text-danger" data-bs-toggle="tooltip"
                                       data-bs-placement="bottom" title="حذف"><i class="bi bi-trash-fill"></i></a>
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


                                {{-- hassan --}}
                                <div class="dropdown show">
                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        العمليات
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp; عرض بيانات الطالب</a>
                                        <a class="dropdown-item" href="#"><i style="color:green" class="fa fa-edit"></i>&nbsp; تعديل بيانات الطالب</a>
                                        <a class="dropdown-item" href="#"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة فاتورة رسوم&nbsp;</a>
                                        <a class="dropdown-item" href="#"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp;&nbsp;سند قبض</a>
                                        <a class="dropdown-item" href="#"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp;&nbsp; استبعاد رسوم</a>
                                        <a class="dropdown-item" href="#"><i style="color:goldenrod" class="fas fa-donate"></i>&nbsp;&nbsp;سند صرف</a>
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

