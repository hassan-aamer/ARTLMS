<div class="col-4 mt-3">
    <label class="form-label"> ترتيب العنصر</label>
    <input type="number" min="0" value="{{$content->sort}}" name="sort" class="form-control" placeholder="ادخل ترتيب العنصر">
</div>

<div class="col-12 mt-3">
    <label class="form-check-label" for="flexSwitchCheckChecked">الحالة</label>
    <div class="form-check form-switch mt-2">
        <input class="form-check-input customSliderCheckbox" type="checkbox"
               name="status" id="flexSwitchCheckChecked" @if($content->status == 'yes') checked="" value="yes" @else value="no" @endif  >
    </div>
</div>
