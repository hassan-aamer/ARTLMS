<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Http\Traits\HelperTrait;
use App\Models\GalleryImage;
use App\Models\ModuleFile;
use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Gallery::orderBy('sort', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.galleries.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $created = Gallery::create($data);
        $this->saveMultipleFiles('Gallery', $created->id, $data,'uploads/');
        if($created)
        {
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
        return view('admin_dashboard.galleries.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';
        $gallery->update($data);
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
        toastr()->success($this->updateMsg, 'عملية ناجحة', ['timeOut' => 5000]);
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
