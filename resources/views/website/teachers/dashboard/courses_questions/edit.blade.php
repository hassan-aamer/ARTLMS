@extends('website.teachers.dashboard.layout.master')
@section('Page_Title')   أسألة المتعلمين @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>    أسألة المتعلمين | الرد علي السؤال  </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('courses_questions.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-md-6 mb-4">
                                            <h5>بيانات المتعلم : </h5>
                                            <ul class="list-unstyled mx-2">

                                                <li class="mb-2">  اسم المتعلم : <strong>{{$content->student?->name}}</strong></li>
                                                <li class="mb-2">   البريد الإلكتروني للمتعلم : <strong>{{$content->student?->email}}</strong></li>
                                                <li class="mb-2">   هاتف المتعلم : <strong>{{$content->student?->userInfo?->phone}}</strong></li>
                                                <li class="mb-2">   مستوي المتعلم : <strong>{{$content->student?->userInfo?->level?->title}}</strong></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <h5>بيانات النشاط : </h5>
                                            <ul class="list-unstyled mx-2">

                                                <li class="mb-2">  اسم النشاط : <strong>{{$content->course?->title}}</strong></li>
                                                <li class="mb-2">   الترم : <strong>{{$content->course?->term == '1' ? 'ترم أول' : 'ترم ثاني'}}</strong></li>
                                                <li class="mb-2">   النوع : <strong>@if($content->course?->kind == 'separated') <span class="btn btn-success btn-sm">منفصل</span> @else <span class="btn btn-primary btn-sm">متصل</span> @endif</strong></li>
                                                @if($content->course?->kind == 'separated')
                                                    <li class="mb-2">   المجال : <strong>{{$content->course?->category?->title}}</strong></li>
                                                    <li class="mb-2">   المقرر : <strong>{{$content->course?->scheduled?->title .' - '.$content->course?->scheduled?->curriculum?->title}}</strong></li>
                                                @else
                                                    <li class="mb-2">   الدرس : <strong>
                                                            {{$content->course?->lesson?->title}} - {{$content->course?->lesson?->unit?->title}} - {{$content->course?->lesson?->unit?->scheduled?->title}} - {{$content->course?->lesson?->unit?->scheduled?->curriculum?->title}}

                                                        </strong></li>

                                                @endif

                                            </ul>
                                        </div>

                                        <div class="col-12">
                                            <h5>سؤال المتعلم : </h5>
                                            <input disabled class="form-control" value="{{$content->question}}">
                                        </div>

                                        @if(is_null($content->answer))
                                            <div class="col-md-12">
                                                <h5> الإجابة</h5>
                                                <div class="form-group">
                                                    <textarea class="form-control ckeditor" required name="answer">{!! $content->answer !!}</textarea>
                                                </div>
                                            </div>
                                            @include('admin_dashboard.inputs.edit_btn')

                                        @else
                                            <h5> الإجابة</h5>
                                            <div class="form-group  mt-0">
                                                <div class="card-body">
                                                    {!! $content->answer !!}
                                                </div>
                                            </div>
                                        @endif


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




