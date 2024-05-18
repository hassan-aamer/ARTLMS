<div class="col-12 mb-5">

    <h5 class="mt-4 mb-3">  ارفع الملفات الخاصه بالعنصر : <span class="text-danger">*</span>  </h5>


    <div class="float-end mb-2">
        <button type="button" class="btn btn-sm btn-success" id="addNewRow">أضف ملف أخر</button>
    </div>
    <table class="no-datatable table table-striped table-hover table-responsive table-bordered mb-0">
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
                    <input class="form-control" name="name[]" placeholder="ادخل اسم الملف" required />
                </td>
                <td>
                    <select class="form-control" name="file_type[]" required>
                        <option value=""> اختر نوع الملف </option>
                        @foreach(extensions() as $ext)
                            <option value="{{$ext->file_type .' - '.$ext->file_ext}}"> {{$ext->file_type .' - '.$ext->file_ext}} </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="file" class="form-control" name="file_uploaded[]"  required />
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
