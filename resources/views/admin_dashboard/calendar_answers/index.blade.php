@extends('admin_dashboard.layout.master')
@section('Page_Title')  إجابات المتعلمين للتقويمات @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="lni lni-book"></i> إجابات المتعلمين للتقويمات </h5>
            </div>
            <div class="table-responsive mt-4">
                <div class="w-100 mt-2 mb-3">
                    <form method="get" action="{{route('calendar_answers.index')}}" id="filter"
                     class="d-lg-flex justify-content-center align-items-center">
                        <i class="bx bx-filter-alt mx-2 font-24" style="background: #e2e3e5;padding: 1px 5px;border-radius: 5px;"></i>

                        <select class="form-select form-control" name="curriculum_id">
                            <option value="">
                                تصفية بالمنهج</option>
                            @foreach($curriculums as $key=>$val)
                                <option @if(\request('curriculum_id') == $val) selected @endif value="{{$val}}">{{$key}}</option>
                            @endforeach
                        </select>
                        <select class="form-select form-control mx-2" name="student_id">
                            <option value="">
                                تصفية بالمتعلم</option>
                            @foreach($students as $student)
                                <option @if(\request('student_id') == $student->id) selected @endif value="{{$student->id}}">{{$student->name}} - {{$student->email}}</option>
                            @endforeach
                        </select>

                        <select class="form-select form-control mx-2" name="calendar_id">
                            <option value="">
                                تصفية بالتقويم</option>
                            @foreach($calendars as $key=>$val)
                                <option @if(\request('calendar_id') == $val) selected @endif value="{{$val}}">{{$key}}</option>
                            @endforeach
                        </select>
                        <select class="form-select form-control mx-2" name="correction">
                            <option value="">
                                تصفية بالتصحيح</option>
                            <option @if(\request('correction') == '1') selected @endif value="1">تم التصحيح</option>
                            <option @if(\request('correction') == '0') selected @endif value="0">لم يتم التصحيح</option>
                        </select>
                        <button type="submit" onclick="$('#filter').submit();" class="btn btn-warning">
                            بحث
                        </button>
                    </form>
                </div>
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>التقويم</th>
                        <th>نوع التقويم</th>
                        <th>المتعلم</th>
                        <th>التصحيح</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                        <tr>
                            <td>{{$con->id}}</td>
                            <td>{{$con->calendar?->title}}</td>
                            <td>
                                <span class="badge @if($con->calendar_type == 'final')
                                    bg-light-success text-success @else
                                    bg-light-primary text-primary @endif w-50">
                                    {{ $con->calendar_type ==  'final' ? 'نهائي' : 'مرحلي' }}</span>
                            </td>
                            <td>
                                {{$con->student?->name}}
                            </td>
                            <td><span class="badge @if($con->final_calendar_degree == null)
                                    bg-light-danger text-danger @else
                                    bg-light-success text-success @endif w-50">
                                    {{ $con->final_calendar_degree == null ? 'لم يتم التصحيح' : 'تم التصحيح' }}</span>
                            </td>

                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('calendar_answers.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="تصحيح الإجابات"><i class="lni lni-eye"></i></a>
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
                                                    <form action="{{route('calendar_answers.destroy',$con->id)}}" method="POST">
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

