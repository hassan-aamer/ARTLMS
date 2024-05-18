<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\GalleryImage;
use App\Models\Gallery;
use App\Models\ModuleFile;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Gallery::where('teacher_id', $this->userId())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Gallery::orderBy('sort', 'asc')->paginate($this->paginate);
        }
        $intro = Setting::where('key','galleries_intro')->first();
        return view('admin_dashboard.galleries.index' , compact('content', 'intro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('sort', 'asc')->get();
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        return view('admin_dashboard.galleries.create', compact('categories', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $data['teacher_id'] = $this->userId();
        $created = Gallery::create($data);
        if($created)
        {
            $skills=(array)$data['skills'];
            $pivotData = array_fill(0, count($skills), ['skill_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($skills, $pivotData);
            $created->skills()->sync($syncData);
            $this->saveMultipleFiles('Gallery', $created->id, $data,'uploads/');
            foreach ($request->file('images') as $image)
            {
                $moveTo = 'uploads/';
                $fileUploaded=rand(1,99999999999).'__'.$image->getClientOriginalName();
                $image->move($moveTo, $fileUploaded);

                GalleryImage::create([
                    'gallery_id' =>$created->id,
                    'image' =>$fileUploaded
                ]);
            }
        }
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $content =  $gallery;
        $this->editPermission($content);
        $categories = Category::orderBy('sort', 'asc')->get();
        $skills = Skill::orderBy('sort', 'asc')->whereStatus('yes')->pluck('id', 'title');
        $arrayCourseSkills = $content->skills->pluck('id')->toArray();
        return view('admin_dashboard.galleries.edit', compact('content','categories', 'skills','arrayCourseSkills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $gallery->update($data);
        $gallery->skills()->detach();
        $skills=(array)$data['skills'];
        $pivotData = array_fill(0, count($skills), ['gallery_id' => $gallery->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
        $syncData  = array_combine($skills, $pivotData);
        $gallery->skills()->sync($syncData);
        if($request->hasFile('file_uploaded'))
        {
            $this->saveMultipleFiles('Gallery', $gallery->id, $data,'uploads/');
        }
        if($request->file('images'))
        {
            GalleryImage::where('gallery_id',$gallery->id)->delete();
            foreach ($request->file('images') as $image)
            {
                $moveTo = 'uploads/';
                $fileUploaded=rand(1,99999999999).'__'.$image->getClientOriginalName();
                $image->move($moveTo, $fileUploaded);
                GalleryImage::create([
                    'gallery_id'=>$gallery->id,
                    'image'=>$fileUploaded,
                ]);
            }
        }
        toastr()->success($this->updateMsg, 'تم تعديل البيانات بنجاح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->images()->delete();
        $gallery->files()->delete();
        $gallery->delete();
        toastr()->success($this->deleteMsg, 'عملية ناجحة', ['timeOut' => 5000]);
        return redirect()->back();
    }

    public function moduleFileDestroy($id)
    {
        $item = ModuleFile::find($id);
        $item->delete();
        toastr()->success(' تم حذف العنصر بنجاح', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
