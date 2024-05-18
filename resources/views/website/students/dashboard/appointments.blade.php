@extends('website.layout.master')

@section('page_title')  {{$page_title}} @endsection

@section('styles')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
@endsection

@section('content')
    <style>
        .form-control {
            border: 2px solid #e3e3e3;
        }
    </style>

    @include('website.layout.inner-header')

    <section class="page-wrapper">
        <div class="tutori-course-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="course-single-tabs learn-press-nav-tabs">
                            <div
                                class="nav nav-tabs course-nav"
                                id="nav-tab"
                                role="tablist"
                            >
                                <a
                                    class="nav-item nav-link active"
                                    id="nav-next-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-next"
                                    role="tab"
                                    aria-controls="nav-next-tab"
                                    aria-selected="true"
                                >الاجتماعات القادمة</a
                                >
                                <a
                                    class="nav-item nav-link"
                                    id="nav-pending-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-pending"
                                    role="tab"
                                    aria-controls="nav-pending-tab"
                                    aria-selected="false"
                                >
                                    بانتظار الموافقة

                                    @if(count($pending_meetings) > 0)<span class="badge bg-danger rounded-circle fs-14 ms-1"
                                    >{{count($pending_meetings)}}</span
                                    >@endif
                                </a>
                                <a
                                    class="nav-item nav-link"
                                    id="nav-prev-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-prev"
                                    role="tab"
                                    aria-controls="nav-prev-tab"
                                    aria-selected="false"
                                >الاجتماعات السابقة</a
                                >
                                <a
                                    class="nav-item nav-link"
                                    id="nav-cancelled-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-cancelled"
                                    role="tab"
                                    aria-controls="nav-cancelled-tab"
                                    aria-selected="false"
                                >الاجتماعات الملغية</a
                                >
                            </div>
                            <a
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#meetingModal"
                                class="btn-main px-4 py-2 rounded-2 remove float-end"
                                style="max-height: 45px; max-width: 200px"
                            >
                                <i class="fa fa-plus-circle me-2"></i>
                                أضف اجتماع جديد</a
                            >
                        </nav>

                        <div
                            class="tab-content tutori-course-content"
                            id="nav-tabContent"
                        >
                            <div
                                class="tab-pane fade show active"
                                id="nav-next"
                                role="tabpanel"
                                aria-labelledby="nav-next-tab"
                            >
                                <div class="tutori-course-curriculum">
                                    <div class="curriculum-scrollable">
                                        <ul class="curriculum-sections">
                                            <li class="section">
                                                <div
                                                    class="section-header d-flex flex-lg-row flex-column g-3 justify-content-lg-between align-items-lg-center align-items-end mb-4"
                                                >
                                                    <div class="section-left">
                                                        <h5 class="section-title mb-0">
                                                            قائمة الاجتماعات القادمة
                                                        </h5>
                                                        <p class="section-desc">
                                                            يمكنك متابعة و إدارة المواعيد القادمة مع زملائك
                                                            من خلال قائمة المواعيد الموضحة بالأسفل
                                                        </p>
                                                    </div>
                                                </div>
                                                <ul class="section-content">
                                                    @forelse($upcoming_approved_meetings as $con)
                                                    <li
                                                        class="course-item course-item-lp_assignment course-item-lp_lesson"
                                                    >
                                                        <a class="section-item-link video" target="_blank" href="{{$con->google_meet_url}}">
                                                            <span class="item-name">{{$con->title}} </span>
                                                            <div class="course-item-meta">
                                                                 <span class="item-meta count-questions">
                                                                     رابط الاجتماع
                                                                 </span>
                                                                <span class="item-meta count-questions">
                                                                        @if($con->sender_id == auth()->user()->id)
                                                                        {{$con->receiver?->name}}
                                                                    @else
                                                                        {{$con->sender?->name}}
                                                                    @endif
                                                                    </span>
                                                                <span class="item-meta duration">{{date('Y-m-d h:i A', strtotime($con->start_date_time))}}</span><i
                                                                    class="fa item-meta course-item-status trans"></i>

                                                            </div>
                                                        </a>
                                                    </li>
                                                    @empty
                                                        <!-- Show this if no meetings -->
                                                        <section class="section-padding page bg-light text-center">
                                                                <i class="far fa-video-plus fa-4x mb-4"></i>
                                                                <h5 class="text-muted mb-0">
                                                                    لا يوجد لديك اجتماعات قادمة فى الوقت الحالي
                                                                </h5>
                                                                <div class="action mt-4 pt-3">
                                                                    <a
                                                                        href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#meetingModal"
                                                                        class="btn-main px-4 py-2 rounded-2 remove"
                                                                    >
                                                                        <i class="fa fa-plus-circle me-2"></i>
                                                                        أضف اجتماع جديد</a
                                                                    >
                                                                </div>
                                                            </section>
                                                    @endforelse
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="nav-pending"
                                role="tabpanel"
                                aria-labelledby="nav-pending-tab"
                            >
                                <div class="tutori-course-curriculum">
                                    <div class="curriculum-scrollable">
                                        <ul class="curriculum-sections">
                                            <li class="section">
                                                <div
                                                    class="section-header d-flex flex-lg-row flex-column g-3 justify-content-lg-between align-items-lg-center align-items-end mb-4"
                                                >
                                                    <div class="section-left">
                                                        <h5 class="section-title mb-0">قائمة الانتظار</h5>
                                                        <p class="section-desc">
                                                            يمكنك متابعة حالة الدعوات للاجتماعات التى
                                                            أرسلتها للزملاء من خلال القائمة الموضحة بالأسفل
                                                        </p>
                                                    </div>
                                                </div>
                                                <ul class="section-content">

                                                    @forelse($pending_meetings as $con)
                                                    <li
                                                        class="course-item course-item-lp_assignment course-item-lp_lesson"
                                                    >
                                                        <a class="section-item-link video" onclick="return false;">
                                                            <span class="item-name"> {{$con->title}} </span>
                                                            <div class="course-item-meta">
                                                                @if($con->sender_id == auth()->user()->id)
                                                                  <span class="item-meta bg-warning text-dark"
                                                                  >بانتظار الموافقة</span>
                                                                @else
                                                                    <span style="cursor: pointer" class="item-meta bg bg-success text-white" onclick="approve_or_reject_meet({{$con->id}}, 'approved')" >قبول</span>
                                                                    <span style="cursor: pointer" class="item-meta bg bg-danger text-white"  onclick="approve_or_reject_meet({{$con->id}}, 'rejected')" >رفض</span>
                                                                @endif
                                                                <span class="item-meta count-questions">
                                                                    @if($con->sender_id == auth()->user()->id)
                                                                        {{$con->receiver?->name}}
                                                                    @else
                                                                        {{$con->sender?->name}}
                                                                    @endif
                                                                </span>
                                                                <span class="item-meta duration"
                                                                >{{date('Y-m-d h:i A', strtotime($con->start_date_time))}}</span
                                                                ><i
                                                                    class="fa item-meta course-item-status trans"
                                                                ></i>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @empty
                                                        <!-- Show this if no meetings -->
                                                        <section class="section-padding page bg-light text-center">
                                                            <i class="far fa-video-plus fa-4x mb-4"></i>
                                                            <h5 class="text-muted mb-0">
                                                                لا يوجد لديك اجتماعات بانتظار الموافقة فى الوقت الحالي
                                                            </h5>
                                                            <div class="action mt-4 pt-3">
                                                                <a
                                                                    href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#meetingModal"
                                                                    class="btn-main px-4 py-2 rounded-2 remove"
                                                                >
                                                                    <i class="fa fa-plus-circle me-2"></i>
                                                                    أضف اجتماع جديد</a
                                                                >
                                                            </div>
                                                        </section>
                                                    @endforelse
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="nav-prev"
                                role="tabpanel"
                                aria-labelledby="nav-prev-tab"
                            >
                                <div class="tutori-course-curriculum">
                                    <div class="curriculum-scrollable">
                                        <ul class="curriculum-sections">
                                            <li class="section">
                                                <div
                                                    class="section-header d-flex flex-lg-row flex-column g-3 justify-content-lg-between align-items-lg-center align-items-end mb-4"
                                                >
                                                    <div class="section-left">
                                                        <h5 class="section-title mb-0">
                                                            قائمة الاجتماعات السابقة
                                                        </h5>
                                                        <p class="section-desc">
                                                            يمكنك متابعة الاجتماعات التى قمت باجرائها مع
                                                            زملائك خلال الفترة الماضية
                                                        </p>
                                                    </div>
                                                </div>
                                                <ul class="section-content">

                                                    @forelse($previous_meetings as $con)
                                                        <li
                                                            class="course-item course-item-lp_assignment course-item-lp_lesson"
                                                        >
                                                            <a class="section-item-link video" target="_blank" onclick="return false;">
                                                                <span class="item-name">{{$con->title}} </span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta count-questions">
                                                                        @if($con->sender_id == auth()->user()->id)
                                                                            {{$con->receiver?->name}}
                                                                        @else
                                                                            {{$con->sender?->name}}
                                                                        @endif
                                                                    </span>
                                                                    <span class="item-meta duration">{{date('Y-m-d h:i A', strtotime($con->start_date_time))}}</span><i
                                                                        class="fa item-meta course-item-status trans"></i>

                                                                </div>
                                                            </a>
                                                        </li>
                                                    @empty
                                                        <!-- Show this if no meetings -->
                                                        <section class="section-padding page bg-light text-center">
                                                            <i class="far fa-video-plus fa-4x mb-4"></i>
                                                            <h5 class="text-muted mb-0">
                                                                لا يوجد لديك اجتماعات سابقة فى الوقت الحالي
                                                            </h5>
                                                            <div class="action mt-4 pt-3">
                                                                <a
                                                                    href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#meetingModal"
                                                                    class="btn-main px-4 py-2 rounded-2 remove"
                                                                >
                                                                    <i class="fa fa-plus-circle me-2"></i>
                                                                    أضف اجتماع جديد</a
                                                                >
                                                            </div>
                                                        </section>
                                                    @endforelse
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="nav-cancelled"
                                role="tabpanel"
                                aria-labelledby="nav-cancelled-tab"
                            >
                                <div class="tutori-course-curriculum">
                                    <div class="curriculum-scrollable">
                                        <ul class="curriculum-sections">
                                            <li class="section">
                                                <div
                                                    class="section-header d-flex flex-lg-row flex-column g-3 justify-content-lg-between align-items-lg-center align-items-end mb-4"
                                                >
                                                    <div class="section-left">
                                                        <h5 class="section-title mb-0">
                                                            قائمة الاجتماعات الملغية
                                                        </h5>
                                                        <p class="section-desc">
                                                            قائمة بالاجتماعات التى قمت بإلغائها قبل موعدها
                                                            أو التى قام الزملاء برفض قبولها
                                                        </p>
                                                    </div>

                                                </div>
                                                <ul class="section-content">
                                                    @forelse($rejected_meetings as $con)
                                                        <li
                                                            class="course-item course-item-lp_assignment course-item-lp_lesson"
                                                        >
                                                            <a class="section-item-link video" target="_blank" onclick="return false;">
                                                                <span class="item-name">{{$con->title}} </span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta count-questions">
                                                                        @if($con->sender_id == auth()->user()->id)
                                                                            {{$con->receiver?->name}}
                                                                        @else
                                                                            {{$con->sender?->name}}
                                                                        @endif
                                                                    </span>
                                                                    <span class="item-meta duration">{{date('Y-m-d h:i A', strtotime($con->start_date_time))}}</span><i
                                                                        class="fa item-meta course-item-status trans"></i>

                                                                </div>
                                                            </a>
                                                        </li>
                                                    @empty
                                                    <!-- Show this if no meetings -->
                                                        <section class="section-padding page bg-light text-center">
                                                            <i class="far fa-video-plus fa-4x mb-4"></i>
                                                            <h5 class="text-muted mb-0">
                                                                لا يوجد لديك اجتماعات ملغية فى الوقت الحالي
                                                            </h5>
                                                            <div class="action mt-4 pt-3">
                                                                <a
                                                                    href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#meetingModal"
                                                                    class="btn-main px-4 py-2 rounded-2 remove"
                                                                >
                                                                    <i class="fa fa-plus-circle me-2"></i>
                                                                    أضف اجتماع جديد</a
                                                                >
                                                            </div>
                                                        </section>
                                                    @endforelse

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add meeting Modal -->


    <!-- Modal -->
    <div
        class="modal fade meeting-modal"
        id="meetingModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="meetingModalLabel"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-centered"
            role="document"
            style="max-width: 700px"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meetingModalLabel">أضف اجتماع جديد</h5>
                    <button
                        type="button"
                        class="btn-close remove"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">

                    <div id="successMsg"></div>
                    <ul class="list-unstyled" id="failedMsg"></ul>

                    <form action="" class="add-meeting-form p-4" id="addMeetingForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="meetingTitle" class="d-block mb-2"
                                >عنوان الاجتماع</label
                                >
                                <div class="input-group mb-0">
                                    <input
                                        type="text"
                                        placeholder="ادخل عنوان الاجتماع"
                                        name="title"
                                        id="meetingTitle"
                                        class="form-control py-3"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="colleague" class="d-block mb-2"
                                >طرف الاجتماع</label
                                >
                                <div class="input-group mb-0">
                                    <select
                                        required
                                        name="receiver_id"
                                        id="colleague"
                                        class="form-control form-select py-3 fs-14"
                                    >
                                        <option value="">-- اختر زميل فى الصف --</option>
                                        @foreach($myFriends as $user)
                                            <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="meetingDate" class="d-block mb-2"
                                >تاريخ الاجتماع</label
                                >
                                <div class="input-group mb-0">
                                    <input
                                        required
                                        type="datetime-local"
                                        placeholder="تاريخ الاجتماع"
                                        name="start_date_time"
                                        id="meetingDate"
                                        class="form-control py-3"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="meetingTime" class="d-block mb-2"
                                >رابط الاجتماع</label
                                >
                                <div class="input-group mb-0">
                                    <input
                                        required
                                        type="url"
                                        placeholder="https://meet.google.com/nqo-xhgr-wtr"
                                        name="google_meet_url"
                                        id="meetingTime"
                                        class="form-control py-3"
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer p-4">
                    <button
                        type="button"
                        class="btn btn-secondary py-2 rounded-2 remove"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    >
                        إلغاء
                    </button>
                    <button type="button" id="createGoogleMeet" class="btn-main px-4 py-2 rounded-2">
                        إضافة الاجتماع
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('scripts')


    <script>

        $(document).on('click', '#createGoogleMeet', function (e){
            e.preventDefault();
            var data = $('#addMeetingForm').serialize();
            $.ajax({
                url: "{{route('website.student.createGoogleMeet')}}",
                type: 'post',
                data: data,
                success: function(response) {
                    if(response.success)
                    {
                        $('#successMsg').html('<div class="alert alert-success">'+response.message+'</div>');
                        $(".alert-danger").hide();
                        $('#addMeetingForm')[0].reset()
                        setTimeout(function(){
                            location.reload();
                        },2000);
                    }
                },
                error: function (reject) {
                    $(".alert-danger").hide();
                    if( reject.status === 422 ) {
                        $.each(reject.responseJSON.errors, function (key, val) {
                            var errors = '<li class="alert alert-danger">'+val[0]+'</li>';
                            $("#failedMsg").append(errors);
                            $(".alert-success").hide();
                        });
                    }
                },
            });
        });


        $('.remove').on('click', function(){
            $('.alert-danger').hide();
            $('.alert-success').hide();
        });


        function approve_or_reject_meet(id, type) {
            if(type === 'approved')
            {
                var title = 'تأكيد الطلب';
                var text = "هل أنت متأكد من تأكيد الطلب ؟";
            }
            else if(type === 'rejected')
            {
                var title = 'رفض الطلب';
                var text = "هل أنت متأكد من رفض الطلب ؟";
            }
            swal.fire({
                title: title,
                icon: 'question',
                text: text,
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "نعم , متأكد !",
                cancelButtonText: "لا , ليس متأكد!",
                reverseButtons: !0
            }).then(function (e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/student/approve_or_reject_meet')}}/" + id,
                        data: {_token: CSRF_TOKEN, type: type},
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire("تم التأكيد!", results.message, "success");
                            } else {
                                swal.fire("هناك خطأ!", results.message, "error");
                            }
                            setTimeout(function(){
                                location.reload();
                            },2000);
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }


    </script>
@endpush
