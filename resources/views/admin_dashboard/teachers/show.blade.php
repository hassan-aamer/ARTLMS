@extends('admin_dashboard.layout.master')
@section('Page_Title')    المعلمين | تكليفات المعلم   @endsection

<style>
    .level_with_sections
    {
        background: white;
        padding: 25px;
        margin: 30px 0;
        border-radius: 5px;
    }
</style>

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   تكليفات المعلم   | تعديل ({{$content->email}}) </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('teachers.assignments', $content->id)}}">
                                        @csrf

                                        <h5>الصفوف الدراسية </h5>
                                        <ul class="list-unstyled">
                                            @foreach($levels_with_sections as $level)
                                                <li class="level_with_sections">
                                                    <div class="d-flex align-items-center">
                                                        <input id="level_{{$level->id}}" @if(in_array($level->id, $assignmentsLevels)) checked @endif type="checkbox" style="width: 20px;height: 20px;" name="levels[]" value="{{$level->id}}" >
                                                        <label for="level_{{$level->id}}" class="fw-bold mx-2 text-primary">{{$level->title}}</label>
                                                    </div>
                                                    <ul class="list-unstyled">
                                                        @foreach($level->sections as $section)
                                                            <li class="mx-4 my-3">
                                                                <div class="d-flex align-items-center">
                                                                    @php
                                                                        $sectionsIDs =\App\Models\TeacherAssignment::where('teacher_id', $content->id)->where('level_ids', $level->id)->first();
                                                                    @endphp
                                                                    <input id="section_{{$section->id}}" @if(in_array($section->id,  explode(',',$sectionsIDs?->section_ids))) checked @endif   type="checkbox" style="width: 20px;height: 20px;" name="sections[{{$section->id}}]" value="{{$level->id}}" >
                                                                    <label for="section_{{$section->id}}" class="fw-bold mx-2">{{$section->name}}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>


                                        @include('admin_dashboard.inputs.edit_btn')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')



@endpush
