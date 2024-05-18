<div class="col-12">
    <label class="form-label"> {{ isset($title) ? $title : 'وصف كامل' }} <span class="text-danger">*</span></label>
    <textarea required name="description" class="form-control ckeditor"
              placeholder="وصف كامل" rows="4" cols="4"></textarea>
</div>
