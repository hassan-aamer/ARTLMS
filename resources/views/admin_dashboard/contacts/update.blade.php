@extends('admin_dashboard.layout.master')
@section('Page_Title', 'تعديل الرسالة')


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> تعديل الرسالة</h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" method="post" action="{{ route('contact.update', $contact->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-6">
                                            <label class="form-label">الأسم <span class="text-danger">*</span></label>
                                            <input type="text" id="name" value="{{ $contact->name }}" name="name" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                                            <input type="email" id="email" value="{{ $contact->email }}" name="email" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                                            <input type="number" min="0" id="phone" value="{{ $contact->phone }}" name="phone" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">الموضوع</label>
                                            <input type="text" id="subject" value="{{ $contact->subject }}" name="subject" class="form-control" />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">الرسالة</label>
                                            <input type="text" id="message" value="{{ $contact->message }}" name="message" class="form-control" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">المرفق <small class="text-danger">(PNG - JPEG - JPG - WEBP - SVG - GIF - PDF)</small></label>
                                            <input class="form-control" type="file" name="file" accept="image/*,application/pdf">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-sm btn-primary col-2">تعديل</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection
