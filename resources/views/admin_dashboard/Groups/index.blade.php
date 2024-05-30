@extends('admin_dashboard.layout.master')
@section('Page_Title', 'المجموعات')

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="lni lni-book"></i> المجموعات </h5>
                <div class="ms-auto position-relative">
                    <a href="{{ route('groups.show') }}"
                        class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> أضف عنصر جديد </a>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                            <tr>
                                <td>{{ $con->id }}</td>
                                <td>{{ $con->name }}</td>
                                <td>

                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            العمليات
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('groups.editt', $con->id) }}"

                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-pencil-fill"></i> تعديل
                                            </a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteItem{{ $con->id }}" data-bs-toggle="tooltip">
                                                <i class="bi bi-trash-fill"></i> حذف
                                            </a>
                                        </div>
                                    </div>


                                  



                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <div class="modal fade" id="deleteItem{{ $con->id }}" tabindex="-1"
                                            aria-labelledby="link{{ $con->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="link{{ $con->id }}">هل أنت متأكد من
                                                            حذف هذا العنصر ؟</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-default btn-sm me-2" type="button"
                                                            data-bs-dismiss="modal">لا</button>
                                                        <form action="{{ route('groups.destroy', $con->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                type="button">نعم</button>
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
                                <td colspan="7" class="text-center">
                                    <p> لا يوجد بيانات </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
