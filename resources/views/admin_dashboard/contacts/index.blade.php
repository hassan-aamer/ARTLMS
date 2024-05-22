@extends('admin_dashboard.layout.master')


@section('Page_Title', 'الرسائل')

@section('css')

@endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> الرسائل </h5>
            </div>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الموضوع</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $con)
                            <tr>
                                <td>{{ $con->id }}</td>

                                <td>{{ $con->name }}</td>
                                <td>{{ $con->email }}</td>
                                <td>{{ $con->subject }}</td>

                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                العمليات
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('contacts.show', $con->id) }}">
                                                    <i class="bi bi-envelope-open"></i> فتح الرسالة
                                                </a>
                                                <a class="dropdown-item" href="{{ route('contact.update', $con->id) }}">
                                                    <i class="bi bi-pencil-square"></i> تعديل الرسالة
                                                </a>
                                                <a class="dropdown-item" href="{{ route('contact.update', $con->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#attach{{ $con->id }}">
                                                    اضافة مرفقات
                                                </a>
                                                <a class="dropdown-item" href="{{ route('send-email', $con->id) }}">
                                                    <i class="bi bi-arrow-repeat"></i> إعادة توجيه
                                                </a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#sendmessage{{ $con->id }}">
                                                    <i class="bi bi-reply"></i> الرد
                                                </a>
                                                <a class="dropdown-item" href="{{ route('contacts.show', $con->id) }}">
                                                    <i class="bi bi-printer-fill"></i> تصدير طباعة
                                                </a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#deleteItem{{ $con->id }}"
                                                    data-bs-toggle="tooltip">
                                                    <i class="bi bi-trash-fill"></i> حذف
                                                </a>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="attach{{ $con->id }}" tabindex="-1"
                                            aria-labelledby="link{{ $con->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('add.att', $con->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <input class="form-control" id="triggerInput"
                                                                placeholder="إضافة صورة (jpg-png-eps-pdf-svg-webp-gif)"
                                                                readonly>
                                                            <input class="form-control" id="fileInput" type="file"
                                                                name="image" hidden
                                                                accept=".jpg,.jpeg,.png,.eps,.pdf,.svg,.webp,.gif">
                                                        </div>
                                                        <div class="modal-header">
                                                            <input class="form-control" type="text" name="url"
                                                                placeholder="إضافة رابط فيديو أو أكثر" required>
                                                        </div>
                                                        <div class="modal-header">
                                                            <input class="form-control" type="text" name="link"
                                                                placeholder="إضافة رابط فيديو تفاعلي أو أكثر"
                                                                required>
                                                        </div>
                                                        <div class="modal-header">
                                                            <input class="form-control" id="triggerInputt" type="text"
                                                                placeholder="إضافة ملفات"
                                                                readonly style="margin-bottom: 8px;">
                                                            <input class="form-control" id="fileInputt" type="file"
                                                                name="file" required  accept="application/pdf"
                                                                hidden>
                                                        </div>
                                                        <div class="modal-header">
                                                            <input class="form-control" type="text" name="description"
                                                                placeholder="إضافة التوصيف المقالي "
                                                                required>
                                                        </div>
                                                        <div class="modal-header">
                                                            <input class="form-control" type="text" name="title"
                                                                placeholder="إضافة وصف النطاق "
                                                                required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-outline-default btn-sm me-2"
                                                                type="button" data-bs-dismiss="modal">الغاء</button>
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm">ارسال</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="deleteItem{{ $con->id }}" tabindex="-1"
                                            aria-labelledby="link{{ $con->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="link{{ $con->id }}">هل أنت متأكد
                                                            من حذف هذا العنصر ؟</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-default btn-sm me-2" type="button"
                                                            data-bs-dismiss="modal">لا</button>
                                                        <form action="{{ route('contacts.destroy', $con->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                type="button">نعم</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="sendmessage{{ $con->id }}" tabindex="-1"
                                            aria-labelledby="link{{ $con->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('contact.send', $con->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <input class="form-control" name="message"
                                                                placeholder="اكتب الرساله" required />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-outline-default btn-sm me-2"
                                                                type="button" data-bs-dismiss="modal">الغاء</button>
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm">ارسال</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <p> لا يوجد بيانات </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $content->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        document.getElementById('triggerInput').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function() {
            var fileName = this.files.length > 0 ? this.files.length + ' ملفات تم تحديدها' : '';
            document.getElementById('triggerInput').value = fileName;
        });
    </script>
    <script>
        document.getElementById('triggerInputt').addEventListener('click', function() {
            document.getElementById('fileInputt').click();
        });

        document.getElementById('fileInputt').addEventListener('change', function() {
            var fileName = this.files.length > 0 ? this.files.length + ' ملفات تم تحديدها' : '';
            document.getElementById('triggerInputt').value = fileName;
        });
    </script>


@endsection
