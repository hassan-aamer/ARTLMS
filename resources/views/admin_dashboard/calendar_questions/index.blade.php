@extends('admin_dashboard.layout.master')
@section('Page_Title')  أسئلة التقويمات @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="lni lni-book"></i> أسئلة التقويمات </h5>
                <div class="ms-auto position-relative">
                    <a href="{{route('calendar_questions.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> أضف عنصر جديد </a>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <div class="w-50 mt-2 mb-3">
                    <form method="get" action="{{route('calendar_questions.index')}}" id="filter"
                     class="d-flex justify-content-center align-items-center">
                        <i class="bx bx-filter-alt mx-2 font-24" style="background: #e2e3e5;padding: 1px 5px;border-radius: 5px;"></i>
                        <select class="form-select form-control" name="calendar_id" onchange="$('#filter').submit();">
                            <option value="">
                                تصفية بالتقويم</option>
                            @foreach($calendars as $key=>$val)
                                <option @if(\request('calendar_id') == $val) selected @endif value="{{$val}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>التقويم</th>
                        <th>السؤال</th>
                        <th>النوع</th>
                        <th>الحالة</th>
                        <th>الدرجة</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                        <tr>
                            <td>{{$con->id}}</td>
                            <td>{{$con->calendar?->title}}</td>
                            <td>{{ strLimit($con->title,50) }}</td>
                            <td><span class="badge @if($con->question_kind == 'theoretical') bg-light-success text-success @else bg-light-primary text-primary @endif w-50">
                                    {{ $con->question_kind == 'theoretical' ? 'نظري' : 'عملي' }}</span></td>
                            <td><span class="badge @if($con->status == 'yes') bg-light-success text-success @else bg-light-danger text-danger @endif w-50">
                                    {{ $con->status == 'yes' ? 'مفعل' : 'غير مفعل' }}</span></td>
                            <td>
                                <form method="post" class="d-flex align-items-center" action="{{route('question.updateQuestionMark', $con->id)}}">
                                    @csrf
                                    <input class="form-control w-50" value="{{$con->question_mark}}" required min="1" name="question_mark" type="number">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        تعديل
                                    </button>
                                </form>

                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('calendar_questions.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="Show"><i class="lni lni-eye"></i></a>
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
                                                    <form action="{{route('calendar_questions.destroy',$con->id)}}" method="POST">
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
                                <td colspan="7" class="text-center">
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

