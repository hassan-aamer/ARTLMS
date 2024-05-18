<section class="footer footer-3 pt-110 text-lg-start text-center">
    <div class="footer-mid">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-8 me-auto">
                    <div class="widget footer-widget mb-5 mb-lg-0">
                        <p class="mt-4">
                            فعالية استراتيجية التعلم المعكوس باستخدام الوسائط المعلوماتية
                            فى تنمية بعض المهارات التصميمية الرقمية لدى تلاميذ المرحلة
                            الابتدائية
                        </p>

                        <div class="footer-socials mt-3">
                  <span class="me-2">
                    <i class="far fa-envelope me-2"></i>
                    للتواصل
                  </span>
                            <a href="mailto:mohamednaser@spcd.psu.edu.eg">
                                mohamednaser@spcd.psu.edu.eg</a
                            >
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-4">
                    <div class="footer-widget mb-5 mb-lg-0">
                        <h5 class="widget-title">البحث</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ url('/') }}">الرئيسية</a></li>
                            <li><a href="{{ url('skills') }}">المهارات</a></li>
                            <li><a href="{{ url('meetings') }}">الفصول الافتراضية</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-4">
                    <div class="footer-widget mb-5 mb-lg-0">
                        <h5 class="widget-title">استكشف</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ url('galleries') }}">المعارض الفنية</a></li>
                            <li><a href="{{ url('tools') }}">الأدوات الدراسية</a></li>
                            <li><a href="{{ url('guides') }}">دليل المستخدم</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-4">
                    <div class="footer-widget mb-5 mb-lg-0">
                        <h5 class="widget-title">روابط الموقع</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ url('teachers') }}">المحاضرون</a></li>
                            <li><a href="{{ url('contact-us') }}">تواصل معنا</a></li>
                            <li><a href="{{ url('articles') }}">المدونة</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-4">
                    <div class="footer-widget mb-5 mb-lg-0">
                        <h5 class="widget-title">الصفحات</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ url('curriculums') }}">المناهج الدراسية</a></li>
                            <li><a href="{{ url('categories') }}">المجالات و المحاور الفنية</a></li>
                        <li><a href="{{getSettings('رابط تقييم المنصة')}}" target="_blank">تقييم المنصة</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-btm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-sm-12 col-lg-6">
                    <p class="mb-0 copyright text-sm-center text-lg-start">
                        جميع الحقوق محفوظة ، منصة فن © 2023
                    </p>
                </div>

                <div class="col-xl-6 col-sm-12 col-lg-6">
                    <div
                        class="footer-btm-links text-start text-sm-center text-lg-end"
                    >
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ url('contact-us') }}">تواصل معنا</a>
                            </li>
                            <li class="list-inline-item"><a href="{{ url('student/register') }}">التحق بنا</a></li>
                            <li class="list-inline-item">
                                <a href="{{ url('') . '#' }}">عن البحث</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-btm-top">
        <a href="#top-header" class="js-scroll-trigger scroll-to-top"
        ><i class="fa fa-angle-up"></i
            ></a>
    </div>
</section>
