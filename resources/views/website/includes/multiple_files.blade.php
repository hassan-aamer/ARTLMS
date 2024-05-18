@if(count($content->files) > 0)
    <div class="single-course-details mb-4">
        <h4 class="course-title">الملفات المرفقة</h4>
        <div class="head-decorator head-decorator-sm mb-4"></div>
        <div
            class="file-attachments d-inline-flex flex-column flex-wrap gap-2"
        >
            @foreach($content->files as $file)
                <a class="text-success" href="{{assetURLFile($file->file_uploaded)}}"
                   download>
                    <i class="far fa-download me-2"></i>
                    <span>{{$file->name}}</span>
                    <span class="text-muted">( {{$file->file_type}} )</span>
                </a>
            @endforeach
        </div>
    </div>
@endif
