<div class="course-top-wrap">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
               @if(\Request::segment(1) == 'category')
                    <p>النتائج ( {{$content->courses?->count()}} )  عنصر</p>
                @else
                    <p>النتائج ( {{$content->total()}} )  عنصر</p>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="topbar-search">

                    <form id="live-search" action="" class="styled" method="post" onsubmit="return false;">
                       <input type="text" class="form-control bg-white text-input" id="filter" placeholder="بحث  ..." />
                        <label><i class="fa fa-search"></i></label>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="live_search_message d-none">
                <i class="fa fa-book-reader fa-4x mb-4"></i>
                <h5 class="text-muted">
                    لا يوجد بيانات
                </h5>
            </div>
        </div>
    </div>
</div>
