<section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-8">
                <div class="title-block">
                    <h1>{{$page_title}}</h1>
                    <ul class="header-bradcrumb justify-content-center">
                        <li><a href="{{route('website.index')}}">الرئيسية</a></li>
                        <li class="active" aria-current="page">{!! isset($subTitle) ? $subTitle : $page_title !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
