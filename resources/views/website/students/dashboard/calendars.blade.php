@extends('website.layout.master')

@section('page_title')  {{$page_title}} @endsection
<style>
    .side
    {
        background: #5e84af;
    padding: 0 7px;
    border-radius: 5px;
    color: #fff;
    font-size: 11px;
    font-weight: bold;
    }
</style>
@section('content')

    @include('website.layout.inner-header')

    <section class="my-5 edit_profile">
        <div class="container">
            <div class="row">

                @forelse($myCalendars as $calendarDegree)

                    <div class="col-md-6">
                    <div class="tutori-course-curriculum mt-4">
                        <div class="curriculum-scrollable">
                            <ul class="curriculum-sections">
                                <li class="section">
                                    <div class="section-header">
                                        <div class="section-left">
                                            <h5 class="section-title">تقويماتك علي المنهج ({{$calendarDegree['curriculum_title']}})</h5>
                                        </div>
                                    </div>
                                    <ul class="section-content">
                                        <li class="course-item course-item-lp_assignment course-item-lp_lesson">
                                            <div class="section-item-link">
                                                <span class="item-name text-secondary">
                                                  {{$calendarDegree['calendar_title']}}
                                                </span>
                                                 <div class="course-item-meta">
                                                     @if(is_null($calendarDegree['student_final_degree']))
                                                         <span class="item-meta count-questions">لم يتم التصحيح</span>
                                                     @else
                                                         <span class="item-meta count-questions bg-success text-white">  تم التصحيح</span>
                                                     @endif

                                                    <span class="item-meta duration">وقت إجاباتك  : {{$calendarDegree['duration']}} دقيقة</span>
                                                     @if(!is_null($calendarDegree['student_final_degree']))
                                                     <span class="item-meta count-questions bg-info text-white fw-bold"
                                                           dir="rtl">
                                        @if($calendarDegree['final_type'] == 'after')                 {{$calendarDegree['student_final_degree']}} / 100 درجة
                                        @else
                                        {{$calendarDegree['student_final_degree']}} / 100 درجة
                                        @endif
                                        </span>
                                                     @endif
                                                 </div>


                                            </div>
                                              @if(!is_null($calendarDegree['student_final_degree']))
                                            <div class="d-flex justify-content-around  align-items-center">

                                                <div class="side">
                                                    درجة الجانب المعرفي : {{$calendarDegree['knowledge_side_degree']}}
                                                </div>
                                                   <div class="side">
                                                    درجة الجانب الأدائي : {{$calendarDegree['performance_side_degree']}}
                                                </div>
                                                   <div class="side">
                                                    درجة الجانب الوجداني : {{$calendarDegree['sentimental_side_degree']}}
                                                </div>
                                            </div>
                                            @endif
                                        </li>

                                        @foreach($calendarDegree['staging'] as $stagingDegree)
                                            <li class="course-item course-item-lp_assignment course-item-lp_lesson">
                                                <div class="section-item-link">
                                                <span class="item-name text-secondary">
                                                  {{$stagingDegree->calendar?->title}}
                                                </span>
                                                    <div class="course-item-meta">
                                                        @if(is_null($stagingDegree->student_final_degree))
                                                            <span class="item-meta count-questions">لم يتم التصحيح</span>
                                                        @else
                                                            <span class="item-meta count-questions bg-success text-white">  تم التصحيح</span>
                                                        @endif

                                                        <span class="item-meta duration">وقت إجاباتك  : {{$stagingDegree->duration}} دقيقة</span>
                                                        @if(!is_null($stagingDegree->student_final_degree))
                                                            <span class="item-meta count-questions bg-info text-white fw-bold"
                                                                  dir="rtl">{{$stagingDegree->student_final_degree}} / 25 درجة</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach


                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                @empty
                    @include('website.layout.no_data')
                @endforelse

            </div>
        </div>
    </section>
@endsection
