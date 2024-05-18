(function ($) {
  "use strict";

  //  Main Menu Offcanvas
  $(".primary-menu")
    .find("li a")
    .each(function () {
      if ($(this).next().length > 0) {
        $(this)
          .parent("li")
          .append(
            '<span class="menu-trigger"><i class="fal fa-angle-down"></i></span>'
          );
      }
    });

  // expands the dropdown menu on each click
  $(".primary-menu")
    .find("li .menu-trigger")
    .on("click", function (e) {
      e.preventDefault();
      $(this)
        .toggleClass("open")
        .parent("li")
        .children("ul")
        .stop(true, true)
        .slideToggle(350);
      $(this).find("i").toggleClass("fa-angle-up fa-angle-down");
    });

  // check browser width in real-time
  function breakpointCheck() {
    var windoWidth = window.innerWidth;

    if (windoWidth <= 991) {
      $(".header-navbar").addClass("mobile-menu");
    } else {
      $(".header-navbar").removeClass("mobile-menu");
    }
  }

  breakpointCheck();
  $(window).on("resize", function () {
    breakpointCheck();
  });

  $(".nav-toggler").on("click", function (e) {
    $(".site-navbar").toggleClass("menu-on");
    e.preventDefault();
  });

  // Close menu on toggler click
  $(".nav-close").on("click", function (e) {
    $(".site-navbar").removeClass("menu-on");
    e.preventDefault();
  });

  // Offcanvas Info menu

  $(".offcanvas-icon").on("click", function (e) {
    $(".offcanvas-info").toggleClass("offcanvas-on");
    e.preventDefault();
  });

  // Close menu on toggler click
  $(".info-close").on("click", function (e) {
    $(".offcanvas-info").removeClass("offcanvas-on");
    e.preventDefault();
  });

  //Search Box addClass removeClass
  $(".header_search_btn > a").on("click", function () {
    $(".page_search_box").addClass("active");
  });
  $(".search_close > i").on("click", function () {
    $(".page_search_box").removeClass("active");
  });

  /* ---------------------------------------------
      Sticky Fixed Menu
  --------------------------------------------- */

  $(window).scroll(function () {
    var window_top = $(window).scrollTop() + 1;

    if (window_top > 50) {
      $(".fixed-btm-top").addClass("reveal");
    } else {
      $(".fixed-btm-top").removeClass("reveal");
    }
  });

  /* ---------------------------------------------
     Bottom To Top hide
  --------------------------------------------- */

  $(window).scroll(function () {
    var window_top = $(window).scrollTop() + 1;

    if (window_top > 50) {
      $(".fixed-btm-top").addClass("reveal");
    } else {
      $(".fixed-btm-top").removeClass("reveal");
    }
  });

  //  Sticky Menu

  $(window).scroll(function () {
    var window_top = $(window).scrollTop() + 1;
    if (window_top > 50) {
      $(".navbar-sticky").addClass("menu_fixed animated fadeInDown");
    } else {
      $(".navbar-sticky").removeClass("menu_fixed animated fadeInDown");
    }
  });

    // owl carousel for banner
    $(".banner-carousel").owlCarousel({
        loop: true,
        dots: false,
        nav: false,
        margin: 10,
        autoplayHoverPause: true,
        rtl: true,
        autoplay: true,
        autoplayTimeout: 5000,
        navContainer: "#carousel-arrow",
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        // center: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                dots: true,
                nav: false,
            }
        },
    });

  // Testimonial layout 1
  $(".testimonials-slides").owlCarousel({
    loop: true,
    dots: false,
    nav: false,
    margin: 10,
    autoplayHoverPause: true,
    rtl: true,
    autoplay: false,
    navContainer: "#carousel-arrow",
    navText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>",
    ],
    // center: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        dots: true,
        nav: false,
      },
      576: {
        items: 1,
        dots: true,
        nav: false,
      },
      768: {
        items: 2,
      },
      1000: {
        items: 2,
      },
      1200: {
        items: 3,
      },
    },
  });

  // Testimonial layout 2
  $(".testimonials-slides-2").owlCarousel({
    loop: true,
    dots: true,
    nav: false,
    autoplayHoverPause: true,
    autoplay: false,
    responsiveClass: true,
    rtl: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      768: {
        items: 1,
      },
      1000: {
        items: 2,
      },
      1200: {
        items: 2,
      },
    },
  });

  // Testimonial layout 2
  $(".testimonials-slides-3").owlCarousel({
    loop: true,
    dots: true,
    nav: false,
    margin: 10,
    autoplayHoverPause: true,
    autoplay: false,
    rtl: true,
    navText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>",
    ],
    // center: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        dots: true,
        nav: false,
      },
      576: {
        items: 1,
        dots: true,
        nav: false,
      },
      768: {
        items: 1,
      },
      1000: {
        items: 3,
      },
      1200: {
        items: 4,
      },
    },
  });

  //  Lightbox

    //  Lightbox
    $(".popup").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
        },
        removalDelay: 300,
    });

    //  Lightbox
    $(".popup-video").magnificPopup({
        type: "iframe",
        gallery: {
            enabled: true,
        },
        removalDelay: 300,
    });


    // Counter

  $(".counter").counterUp({
    delay: 10,
    time: 1000,
  });

  /* ---------------------------------------------
        Course filtering
  --------------------------------------------- */
  var $courses = $(".course-gallery");
  if ($.fn.imagesLoaded) {
    imagesLoaded($courses, function () {
      $courses.isotope({
        itemSelector: ".course-item",
        filter: "*",
      });
      $(window).trigger("resize");
    });
  }

  $(".course-filter").on("click", "a", function (e) {
    e.preventDefault();
    $(this).parent().addClass("active").siblings().removeClass("active");
    var filterValue = $(this).attr("data-filter");
    $courses.isotope({ filter: filterValue });
  });

  // Jquery Validation

  $(".numeric-input").keypress(function (e) {
    var charCode = e.which ? e.which : e.keyCode;
    if (String.fromCharCode(charCode).match(/[^0-9]/g)) return false;
  });

  jQuery.validator.addMethod(
    "email",
    function (value, element) {
      return (
        this.optional(element) ||
        /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(
          value
        )
      );
    },
    "أدخل بريد إلكترونى صالح!"
  );

  $(".woocommerce-form-login").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
    },
    messages: {
      email: {
        required: "البريد الإلكترونى مطلوب",
        email: "أدخل بريد إلكترونى صالح",
      },
      password: {
        required: "من فضلك أدخل كلمة السر",
        minlength: "ادخل كلمة سر من 6 أحرف على الأقل",
      },
    },
  });
  $(".reset-pass-form").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
    },
    messages: {
      email: {
        required: "البريد الإلكترونى مطلوب",
        email: "أدخل بريد إلكترونى صالح",
      },
    },
  });
  $(".change-pass-form").validate({
    rules: {
      password: {
        required: true,
        minlength: 8,
      },
      confirmPassword: {
          required: true,
        equalTo: "#password",
      },
    },
    messages: {
      password: {
        required: "ادخل كلمة السر الجديدة",
        minlength: "ادخل كلمة سر من 8 أحرف على الأقل",
      },
      confirmPassword: {
          required: "ادخل تطابق كلمة السر الجديدة",
        equalTo: "يجب تطابق كلمة السر مع تأكيد كلمة السر",
      },
    },
  });
  $(".register-1").validate({
    rules: {
      name: {
        required: true,
        minlength: 2,
      },
        group_type: {
            required: true,
        },
        level_id: {
            required: true,
        },

      email: {
        required: true,
        email: true,
      },
      altEmail: {
        email: true,
      },
      phone: {
        required: true,
        minlength: 6,
      },
      city: {
        required: true,
        minlength: 2,
      },
      school: {
        required: true,
        minlength: 2,
      },
      type: {
        required: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
      confirmPassword: {
        equalTo: "#password",
      },
    },
    messages: {
      name: {
        required: "الاسم  مطلوب",
        minlength: "أدخل حرفين على الأقل",
      },
      email: {
        required: "ادخل البريد الإلكتروني",
        email: "ادخل بريد إلكتروني صالح",
      },
      altEmail: {
        email: "ادخل بريد إلكتروني صالح",
      },
        group_type: {
            required: "اختر نوع المجموعة  ",
        },
        level_id: {
            required: " الحقل مطلوب",
        },
      phone: {
        required: "ادخل رقم الهاتف",
        minlength: "ادخل 6 أرقام على الأقل",
      },
      city: {
        required: "ادخل المدينة",
        minlength: "ادخل اسم مدينة صالح",
      },
      school: {
        required: "ادخل المدرسة /  الكلية / المعهد",
        minlength: "ادخل اسم صالح",
      },
      type: {
        required: "يجب اختيار النوع مسبقاً",
      },
      password: {
        required: "يجب إدخال كلمة السر",
        minlength: "كلمة السر لا تقل عن 6 أحرف",
      },
      confirmPassword: {
        equalTo: "يجب ان تتطابق مع كلمة السر",
      },
    },
  });
  $(".register-2").validate({
    rules: {
      name: {
        required: true,
        minlength: 2,
      },
      email: {
        required: true,
        email: true,
      },
      altEmail: {
        email: true,
      },
      phone: {
        required: true,
        minlength: 6,
      },
      city: {
        required: true,
        minlength: 2,
      },
      school: {
        required: true,
        minlength: 2,
      },

      qualification: {
        required: true,
        minlength: 4,
      },
      spec: {
        required: true,
        minlength: 4,
      },
      type: {
        required: true,
      },
        image: {
            required: true,
        },
      reason: {
        required: true,
        minlength: 10,
      },
      password: {
        required: true,
        minlength: 8,
      },
      confirmPassword: {
        equalTo: "#password",
      },
    },
    messages: {
      name: {
        required: "الاسم الأول مطلوب",
        minlength: "أدخل حرفين على الأقل",
      },
      email: {
        required: "ادخل البريد الإلكتروني",
        email: "ادخل بريد إلكتروني صالح",
      },
      altEmail: {
        email: "ادخل بريد إلكتروني صالح",
      },
      phone: {
        required: "ادخل رقم الهاتف",
        minlength: "ادخل 6 أرقام على الأقل",
      },
      city: {
        required: "ادخل المدينة",
        minlength: "ادخل اسم مدينة صالح",
      },
      school: {
        required: "ادخل المدرسة /  الكلية / المعهد",
        minlength: "ادخل اسم صالح",
      },
      spec: {
        required: "ادخل التخصص مطلوب",
        minlength: "ادخل بيانات صالحة",
      },
      qualification: {
        required: "ادخل المؤهل الدراسي",
        minlength: "ادخل بيانات صالحة",
      },
      type: {
        required: "يجب اختيار النوع مسبقاً",
      },
        image: {
            required: "الحقل مطلوب",
        },
      password: {
        required: "يجب ادخال كلمة السر",
        minlength: "كلمة السر لا تقل عن 8 أحرف",
      },
      confirmPassword: {
        equalTo: "يجب ان تتطابق مع كلمة السر",
      },
      reason: {
        required: "ادخل بيانات التقدم",
        minlength: "ادخل 10 أحرف على الأقل",
      },
    },
  });
    // Skill Images Carousel

    $(".skill-carousel").owlCarousel({
        loop: true,
        dots: false,
        nav: true,
        margin: 10,
        autoplayHoverPause: true,
        rtl: true,
        autoplay: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        center: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1.75,
            },
        },
    });
})(jQuery);
