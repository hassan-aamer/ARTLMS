@extends('admin_dashboard.layout.master')
@section('Page_Title')   جميع الأنشطة @endsection
@push('styles')
    <style>
        .count
        {
            background: #1a2232;
            padding: 0 9px;
            border-radius: 50%;
            width: 10px;
            color: #fff;
            margin: 5px;
        }
    </style>
@endpush

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-file-code-fill"></i>  جميع الأنشطة </h5>
                <div class="ms-auto position-relative">
                    <a href="{{route('courses.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> أضف عنصر جديد </a>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>النوع</th>
                        <th>العنوان</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الأسئلة والأجوبة</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                        <tr>
                            <td>{{$con->id}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="{{ assetURLFile($con->image) }}" class="rounded-circle" width="44" height="44" alt="">
                                </div>
                            </td>
                            <td><span class="badge @if($con->kind == 'connected') bg-light-primary text-primary @else bg-light-warning text-warning @endif w-50">
                                    {{ $con->kind == 'connected' ? 'متصل' : 'منفصل' }}</span></td>
                            <td>{{$con->title}}</td>
                            <td><span class="badge @if($con->status == 'yes') bg-light-success text-success @else bg-light-danger text-danger @endif w-50">
                                    {{ $con->status == 'yes' ? 'مفعل' : 'غير مفعل' }}</span></td>
                            <td>{{$con->sort}}</td>
                            <td>
                                <a href="{{route('courses.show', $con->id)}}">
                                    الأسئلة والأجوبة
                                    <span class="count"> {{$con->questions?->count()}} </span>
                                </a>
                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('courses.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
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
                                                    <form action="{{route('courses.destroy',$con->id)}}" method="POST">
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
                                <td colspan="8" class="text-center">
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

