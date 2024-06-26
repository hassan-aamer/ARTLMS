@extends('admin_dashboard.layout.master')
@section('Page_Title')  اجتماعات Google @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> اجتماعات Google </h5>
                <div class="ms-auto position-relative">
                    <a href="{{route('meets.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> أضف عنصر جديد </a>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                            @if(auth()->user()->type == 'admin' || $con->sender_id == auth()->user()->id || in_array(auth()->user()->id, $con->receiver_ids))
                                <tr>
                                    <td>{{$con->id}}</td>
                                    <td>{{$con->title}}</td>
                                    <td>{{date('Y-m-d h:i A', strtotime($con->start_date_time))}}</td>
                                    <td><span class="badge @if($con->start_date_time > date('Y-m-d H:i:s')) bg-light-success text-success @else bg-light-danger text-danger @endif w-50">
                                    {{ $con->start_date_time > date('Y-m-d H:i:s') ? 'قادم' : 'منتهي' }}</span></td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                            <a href="{{route('meets.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                               title="تعديل"><i class="bi bi-pencil-fill"></i></a>
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
                                                            <form action="{{route('meets.destroy',$con->id)}}" method="POST">
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
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
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

