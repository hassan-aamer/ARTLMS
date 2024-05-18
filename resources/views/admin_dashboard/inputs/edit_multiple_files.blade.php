<div class="col-12 my-4">
    <h5 class="mt-4 mb-3">  الملفات المرفوعة مسبقاً :   </h5>
    <div class="row">
        @foreach($content->files as $fileName)
            <div class="col-md-4">
                <div class="box d-flex justify-content-around align-items-center">
                    <a class="file" title="Download" download href="{{assetURLFile($fileName->file_uploaded)}}">
                        {{$fileName->name}} - {{$fileName->file_type}}
                    </a>
                    <a data-bs-toggle="modal" data-bs-target="#deleteItem{{$fileName->id}}" href="javascript:;" class="btn btn-sm btn-danger">حذف</a>
                    <div class="modal fade" id="deleteItem{{$fileName->id}}" tabindex="-1" aria-labelledby="link{{$fileName->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="link{{$fileName->id}}">هل أنت متأكد من حذف هذا العنصر ؟</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">لا</button>
                                    <a href="{{route('moduleFile.destroy',$fileName->id)}}" class="btn btn-outline-danger btn-sm">نعم</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="col-12 mb-5">
    <h5 class="mt-4 mb-3">  ارفع الملفات الخاصه بالعنصر :   </h5>
    <div class="float-end mb-2">
        <button type="button" class="btn btn-sm btn-success" id="addNewRow">أضف ملف أخر</button>
    </div>
    <table class="table table-striped table-hover table-responsive table-bordered mb-0">
        <thead>
            <th>اسم الملف</th>
            <th>نوع الملف</th>
            <th> الملف</th>
            <th> توصيف الملف (Meta)</th>
            <th> حذف</th>
        </thead>
        <tbody id="lines">
            <tr id="tr">
                <td>
                    <input class="form-control" name="name[]" placeholder="ادخل اسم الملف"  />
                </td>
                <td>
                    <select class="form-control" name="file_type[]" >
                        <option value=""> اختر نوع الملف </option>
                        @foreach(extensions() as $ext)
                            <option value="{{$ext->file_type .' - '.$ext->file_ext}}"> {{$ext->file_type .' - '.$ext->file_ext}} </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="file" class="form-control" name="file_uploaded[]"   />
                </td>
                <td>
                    <input class="form-control" name="descriptions[]" placeholder="ادخل  توصيف الملف (Meta)"  />
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger removeRow">
                        <i class="lni lni-trash m-0"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>


</div>
