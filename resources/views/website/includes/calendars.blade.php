@if($calendars->count() > 0)
    <!--Calendars of curriculum-->
    <div class="col-12 mt-5">
        <div class="single-course-details mb-4">
            <h4 class="course-title">تقويمات علي  ({{$content->title}})</h4>
            <div class="head-decorator head-decorator-sm mb-4"></div>
        </div>
        <div class="row">
            @forelse($calendars as $calendar)
                <div class="col-lg-4 col-md-6">
                    <div class="course-grid tooltip-style bg-white shadow">
                        <div class="course-header">
                            <div class="course-thumb text-center mt-3">
                                <i style="font-size: 35px;" class="text-danger fa fa-question-circle"></i>
                            </div>
                        </div>
                        <div class="course-content">
                            <h5 class="mb-20">
                                <a href="{{route('website.calendars.show', $calendar->id)}}">{{$calendar->title}}</a>
                            </h5>
                            <span class="d-block">الدرجة النهائية : {{$calendar->degree ?? 'غير محدد'}}</span>
                            <span class="d-block"> وقت الأمتحان : {{$calendar->duration ?? 'غير محدد' }} دقيقة</span>
                            <span class="d-block"> عدد الأسئلة : {{$calendar->questions_count }} سؤال </span>
                            <div
                                class="course-footer mt-20 mb-10 d-flex align-items-center justify-content-between"
                            >
                                <a
                                    href="{{route('website.calendars.show', $calendar->id)}}"
                                    class="action btn-success py-2 px-4 d-block w-100 text-center rounded-2"
                                >عرض الأسئلة</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                @include('website.layout.no_data')
            @endforelse
        </div>

    </div>
@endif
