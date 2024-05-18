<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryTimeRequest;
use App\Http\Requests\StudentTimeRequest;
use App\Models\GalleryTime;
use App\Models\StudentTime;
use Illuminate\Http\Request;

class TimesController extends Controller
{
    public function  save_student_time(StudentTimeRequest $request){
        try{
            if($request->validated()){
                $data = $request->validated();
                $data['user_id'] = auth()->user()->id;
                $data['start_time'] = date_format(date_create($data['start_time']),"Y-m-d H:i:s");
                $data['end_time'] = date_format(date_create($data['end_time']), "Y-m-d H:i:s");
                StudentTime::create($data);
                return response()->json(['success'=> true,
                    'user_id' => auth()->user()->id,
                    'message' => 'تم إضافة البيانات بنجاح',
                    'start_time' => date_format(date_create($data['start_time']),"Y-m-d H:i:s"),
                    'end_time' => date_format(date_create($data['end_time']), "Y-m-d H:i:s")
                ]);
            }
            else{
                return response()->json(['success'=> false, 'message'=> 'Please validate all input data.']);
            }
        }
        catch (\Exception $e){
            return response()->json(['success'=> false, 'message'=> $e->getMessage()]);
        }
    }
    public function  save_user_gallery_time(GalleryTimeRequest $request){
        try{
            if($request->validated()){
                $data = $request->validated();
                $data['user_id'] = auth()->user()->id;
                $data['start_time'] = date_format(date_create($data['start_time']),"Y-m-d H:i:s");
                $data['end_time'] = date_format(date_create($data['end_time']), "Y-m-d H:i:s");
                GalleryTime::create($data);
                return response()->json(['success'=> true,
                    'user_id' => auth()->user()->id,
                    'gallery_id' => $data['gallery_id'],
                    'message' => 'تم إضافة البيانات بنجاح',
                    'start_time' => date_format(date_create($data['start_time']),"Y-m-d H:i:s"),
                    'end_time' => date_format(date_create($data['end_time']), "Y-m-d H:i:s")
                ]);
            }
            else{
                return response()->json(['success'=> false, 'message'=> 'Please validate all input data.']);
            }
        }
        catch (\Exception $e){
            return response()->json(['success'=> false, 'message'=> $e->getMessage()]);
        }
    }
}
