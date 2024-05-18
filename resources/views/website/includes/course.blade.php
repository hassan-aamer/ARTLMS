<div class="col-xl-4 col-lg-6 col-12 search_results">
    <div class="course-grid bg-shadow tooltip-style">
        <div class="course-header">
            <div class="course-thumb">
                <img
                    src="{{assetURLFile($con->image)}}"
                    alt="{{$con->title}}"
                    class="img-fluid"
                />
                <div class="course-price">@if($con->term == '1') الفصل الدراسي الأول
                @else  الفصل الدراسي الثاني @endif</div>
            </div>
        </div>

        <div class="course-content">
            <div class="rating mb-10">
                @for($i=1; $i<=getCourseRating($con->id); $i++)
                <i class="{{$i}} fa fa-star"></i>
                @endfor
                @for($i=1; $i<=5 - getCourseRating($con->id); $i++)
                    <i class="{{$i}} far fa-star"></i>
                @endfor

                <span>{{getCourseRating($con->id)}} ({{getCourseRatingCount($con->id)}} مراجعة)</span>
            </div>

            <h3 class="course-title mb-20">
                <a href="{{route('website.courses.show', $con->id)}}">{{$con->title}}</a>
            </h3>

            <div
                class="course-footer mt-20 d-flex align-items-center justify-content-between"
            >
                <span class="students"
                ><i class="far fa-list"></i>   عدد المهارات : {{$con->skills->count()}}</span
                >
                <span class="lessons"
                ><i class="far fa-play-circle me-2"></i>@if($con->term == '1') الفصل الدراسي الأول
                    @else  الفصل الدراسي الثاني @endif</span
                >
            </div>
        </div>

        <div class="course-hover-content">
            <div class="price fs-6">@if($con->term == '1') الفصل الدراسي الأول
                @else  الفصل الدراسي الثاني @endif</div>
            <h3 class="course-title mb-20 mt-30">
                <a href="{{route('website.courses.show', $con->id)}}">{{$con->title}}</a>
            </h3>
            <div class="course-meta d-flex align-items-center mb-20">
                <span class="lesson"><i class="far fa-play-circle"></i> @if($con->term == '1') الفصل الدراسي الأول
                    @else  الفصل الدراسي الثاني @endif</span>
                <span class="lesson"><i class="far fa-list"></i>   عدد المهارات : {{$con->skills->count()}}</span>
            </div>
            <p class="mb-20">
                {!!  strip_tags( \Illuminate\Support\Str::limit($con->short_description, 100, $end='...'))!!}
            </p>
            <a href="{{route('website.courses.show', $con->id)}}" class="btn btn-grey btn-sm rounded"
            >اذهب للنشاط <i class="fal fa-angle-left"></i
                ></a>
        </div>
    </div>
</div>
