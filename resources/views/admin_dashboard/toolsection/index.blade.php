@extends('admin_dashboard.layout.master')
@section('Page_Title') اقسام الأدوات الدراسية @endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> اقسام الأدوات الدراسية </h5>
                <div class="ms-auto position-relative">
                    <a href="{{ route('createtoolssection') }}" class="btnIcon btn btn-outline-primary px-5">
                        <i class="lni lni-circle-plus"></i> أضف عنصر جديد
                    </a>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>القسم</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->section_name }}</td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="{{ route('toolssections.edit', $section->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="تعديل">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#deleteItem{{ $section->id }}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                        <div class="modal fade" id="deleteItem{{ $section->id }}" tabindex="-1" aria-labelledby="link{{ $section->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="link{{ $section->id }}">هل أنت متأكد من حذف هذا العنصر؟</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">لا</button>
                                                        <form action="{{ route('deletetoolssection', $section->id) }}" method="POST">
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
                                <td colspan="3" class="text-center">
                                    <p>لا يوجد بيانات</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
