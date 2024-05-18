
<div class="col-12">
    <label class="form-label"> وصف الميتا الخاص بال SEO</label>
    <textarea  name="meta_description" class="form-control"
               placeholder="  وصف الميتا الخاص بال SEO" rows="4" cols="4">{!! $content->meta_description !!}</textarea>
</div>
<div class="col-12">
    <label class="form-label"> الكلمات الدلالية الخاصه بال SEO  </label>
    <input type="text" name="keywords" value="{{$content->keywords}}" class="form-control"
           placeholder="الكلمات الدلالية الخاصه بال SEO">
</div>
