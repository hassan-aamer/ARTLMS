<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="منصة فن التعليمية | الصفحة الرئيسية" />
    <meta
        name="keywords"
        content="education,فن,instructor,lms,online,instructor,learning"
    />
    <meta name="author" content="Mohamed Nasr" />
    <title>{{getSettings('عنوان المنصة')}} | @yield('page_title')</title>
    <!-- Mobile Specific Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/bootstrap/bootstrap.rtl.css')  }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Iconfont Css -->
    <link rel="icon shortcut" href="{{ asset('frontend/assets/images/logo-v3.png')  }}" />
    <link
        rel="stylesheet"
        href="{{ asset('frontend/assets/vendors/awesome/css/fontawesome-all.min.css')  }}"
    />
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/flaticon/flaticon.css')  }}" />
    <link
        rel="stylesheet"
        href="{{ asset('frontend/assets/vendors/magnific-popup/magnific-popup.css')  }}"
    />
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/animate-css/animate.css')  }}" />
    <link
        rel="stylesheet"
        href="{{ asset('frontend/assets/vendors/animated-headline/animated-headline.css')  }}"
    />
    <link
        rel="stylesheet"
        href="{{ asset('frontend/assets/vendors/owl/assets/owl.carousel.min.css')  }}"
    />
    <link
        rel="stylesheet"
        href="{{ asset('frontend/assets/vendors/owl/assets/owl.theme.default.min.css')  }}"
    />
    <meta content="{{csrf_token()}}" name="csrf-token" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/woocomerce-rtl.css')  }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style-rtl.css')  }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive-rtl.css')  }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/my-css.css')  }}" />
    @yield('styles')
</head>
<style>
    .fixed-element{
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        background: #062350;
        color: #ffffff;
        padding: 6px 25px;
        font-weight: 600;
        border: 1px solid #ffffff;
        border-bottom: 0;
        font-size: 14px;
        width: 100%;
        max-width: 250px;
        z-index: 10;
        text-align: center;
    }
</style>
<body id="top-header">


@include('website.layout.header')

@yield('content')

@include('website.layout.footer')

@php
   if(\Illuminate\Support\Facades\Auth::check()){
       $prevTimes = \App\Models\StudentTime::where('user_id', auth()->user()->id)->get();
        $intervalArray = [];
        $initialInterval = \Carbon\CarbonInterval::seconds(0);
        foreach ($prevTimes as $time){
            $start = \Carbon\Carbon::createFromDate($time->start_time);
            $end = \Carbon\Carbon::createFromDate($time->end_time);
            array_push($intervalArray, $start->diffAsCarbonInterval($end)->s);
            $initialInterval->add($start->diffAsCarbonInterval($end))->cascade();
        }
        $intervalArraySum = array_sum($intervalArray);
        $finalTimeValue = $initialInterval->forHumans();
   }
 @endphp

@if(\Illuminate\Support\Facades\Auth::check())
    @if(!is_null($finalTimeValue) && $intervalArraySum > 0)
        <span class="fixed-element">
            <i class="fa fa-clock me-1"></i>
        <span class="ms-1">{{ $finalTimeValue }}</span>
    </span>
    @endif
@endif

<script src="{{ asset('frontend/assets/vendors/jquery/jquery.js')  }}"></script>
<!-- Bootstrap 5:0 -->
<script src="{{ asset('frontend/assets/vendors/bootstrap/popper.min.js')  }}"></script>
<script src="{{ asset('frontend/assets/vendors/bootstrap/bootstrap.js')  }}"></script>
<!-- Counterup -->
<script src="{{ asset('frontend/assets/vendors/counterup/waypoint.js')  }}"></script>
<script src="{{ asset('frontend/assets/vendors/counterup/jquery.counterup.min.js')  }}"></script>
<!--  Owl Carousel -->
<script src="{{ asset('frontend/assets/vendors/owl/owl.carousel.min.js')  }}"></script>
<!-- Isotope -->
<script src="{{ asset('frontend/assets/vendors/isotope/jquery.isotope.js')  }}"></script>
<script src="{{ asset('frontend/assets/vendors/isotope/imagelaoded.min.js')  }}"></script>
<!-- Animated Headline -->
<script src="{{ asset('frontend/assets/vendors/animated-headline/animated-headline.js')  }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('frontend/assets/vendors/magnific-popup/jquery.magnific-popup.min.js')  }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/script.js')  }}"></script>

@stack('scripts')

<script>
    $(document).ready(function(){
        $("#filter").keyup(function(){

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val();

            // Loop through the comment list
            $(".live-search-list .search_results").each(function(){

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).hide();
                    $('.live_search_message').removeClass('d-none');
                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).show();
                    $('.live_search_message').addClass('d-none');
                }
            });

        });
    });

    $(document).on('submit', '#searchForm', function (e){
        @if(!Auth::check())
            window.location.href= "{{route('website.student.login_page')}}"
        @endif
        e.preventDefault();
       var data = $(this).serialize();
       var val = $('#search').val();
        $.ajax({
            url: "{{route('website.searchPage')}}",
            type: 'post',
            data: data,
            success: function(response) {
                if(response.success)
                {
                   window.location.href= "{{route('website.search_results')}}?search="+val
                }
            },
            error: function (reject) {

            },
        });
    });

</script>

@if(\Illuminate\Support\Facades\Auth::check())
    <script>
        let start_time = new Date().toLocaleString();
        setInterval(()=>{
            console.log("hi")
            $.ajax({
                url: '{{ route('website.save_student_time') }}',
                method: 'POST',
                data: {
                    start_time : start_time,
                    end_time : new Date().toLocaleString(),
                    _token : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                cache: false,
                success:function(response)
                {
                    start_time = new Date().toLocaleString();
                },
                error: function(err) {
                    start_time = new Date().toLocaleString();
                }
            });
        }, 10000);
    </script>
@endif

</body>
</html>
