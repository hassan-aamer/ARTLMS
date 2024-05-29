@extends('admin_dashboard.layout.master')
@section('Page_Title')  الفنانون @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="lni lni-consulting"></i> الفنانون </h5>




            </div>
            <div class="table-responsive mt-4" id="print">
                <table class="table align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>

                        <th>البريد الإلكتروني</th>

                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($usersData as $artist)
                        <tr>
                            <td>{{$artist->id}}</td>

                            <td>{{$artist->user->name}}</td>

                            <td>{{$artist->user->email}}</td>

                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            العمليات
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('artists.destroy',$artist->id) }}"  data-bs-toggle="modal" data-bs-target="#deleteItem{{$artist->id}}" data-bs-toggle="tooltip"><i class="bi bi-trash-fill"></i> حذف</a>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="deleteItem{{$artist->id}}" tabindex="-1" aria-labelledby="link{{$artist->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="link{{$artist->id}}">هل أنت متأكد من حذف هذا العنصر ؟</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">لا</button>
                                                    <form action="{{ route('artists.destroy',$artist->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" type="button">نعم</button>
                                                    </form>
                                                </div>
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
                    {{-- {{$content->links()}} --}}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection

