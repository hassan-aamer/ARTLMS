<div class="col-xl-4 col-lg-4 col-md-6 search_results">
    <div class="course-grid tooltip-style bg-white hover-shadow">
        <div class="course-header">
            <div class="course-thumb">
                @if(!is_null($con->images?->first()))
                <img
                    src="{{assetURLFile($con->images?->first()->image)}}"
                    alt="{{$con->title}}"
                    class="img-fluid"
                />
                @else
                    <img
                        src="https://placehold.co/600x400"
                        alt="{{$con->title}}"
                        class="img-fluid"
                    />
                @endif
            </div>
        </div>
        <div class="course-content">
            <div class="rating mb-10">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>

                <span>(5.0)</span>
            </div>
            <h3 class="course-title">
                <a href="{{ route('website.galleries.show', $con->id) }}">{{$con->title}}</a>
            </h3>
            <p class="mb-0">
                <i class="far fa-user-chart me-2"></i>
                منصة فن
            </p>
            <div
                class="course-footer mt-20 mb-10 d-flex align-items-center justify-content-between"
            >
                <a
                    href="{{ route('website.galleries.show', $con->id) }}"
                    class="action btn-grey py-2 px-4 d-block w-100 text-center rounded-2"
                >عرض التفاصيل</a
                >
            </div>
        </div>
    </div>
</div>
