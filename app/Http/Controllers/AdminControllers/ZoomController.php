<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\Attendance;
use App\Models\Level;
use App\Models\ModuleFile;
use App\Models\Section;
use App\Models\User;
use App\Models\ZoomToken;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ZoomRequest;
use App\Models\Zoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ZoomController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Zoom::with('level:id,title')->whereIn('level_id', $this->teacher_levels())->latest()->paginate($this->paginate);
        }
        else
        {
            $content = Zoom::with('level:id,title')->latest()->paginate($this->paginate);
        }
        return view('admin_dashboard.zooms.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        if($this->isTeacher())
        {
            $levels =  Level::whereStatus('yes')->whereIn('id', $this->teacher_levels())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $levels =  Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        }

//        //  Create Authorize Code
//        if(env('ZOOM_CLIENT_ID') && env('ZOOM_CLIENT_SECRET')) {
//            $params = [
//                'response_type' => 'code',
//                'client_id' =>env('ZOOM_CLIENT_ID'),
//                'redirect_uri' => 'https://www.art-lms.net/admin/zooms/authorize',
//            ];
//            $url = 'https://zoom.us/oauth/authorize?' . http_build_query($params);
//
//            return redirect()->away($url);
//        }

        return view('admin_dashboard.zooms.create', compact('levels'));
    }

    public function show(Request $request)
    {
        if($this->isTeacher())
        {
            $levels =  Level::whereStatus('yes')->whereIn('id', $this->teacher_levels())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $levels =  Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        }
       // $this->callback($request);
        return view('admin_dashboard.zooms.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZoomRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $data['start_time'] = date('Y-m-d H:i:s', strtotime($data['start_time']));
            $data['end_time'] = date('Y-m-d H:i:s', strtotime($data['start_time'] . ' + '.$data['duration'].' minute'));
            $data['teacher_id'] = $this->userId();
//            $response = $this->createZoomMeeting($data);
//            //  $response = $createdMeeting['response'];
//            $data['meeting_id'] = $response['id'];
//            $data['start_url'] = $response['start_url'];
//            $data['join_url'] = $response['join_url'];
//            $data['host_id'] = $response['host_id'];
//            $data['password'] = $response['password'];
            Zoom::create($data);
            DB::commit();
            toastr()->success('تم إضافة حصة افتراضية بنجاح', 'نجح', ['timeOut' => 5000]);
            return redirect()->route('zooms.index');

        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($this->error, 'فشل', ['timeOut' => 5000]);
            return redirect()->route('zooms.index');
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zoom $zoom)
    {
        $content =  $zoom;
        if($this->isTeacher())
        {
            $levels =  Level::whereStatus('yes')->whereIn('id', $this->teacher_levels())->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        else
        {
            $levels =  Level::whereStatus('yes')->orderBy('sort', 'asc')->pluck('id', 'title');
        }
        $this->editPermission($content);
        return view('admin_dashboard.zooms.edit', compact('content','levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zoom $zoom)
    {
        //$data = $request->validated();
        $zoom->update(['join_url'=>$request->join_url]);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zoom $zoom)
    {
        if(!$this->isTeacher())
        {
            $this->deleteMeeting($zoom->meeting_id);
            $zoom->delete();
            toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
            return redirect()->back();
        }
        else
        {
            toastr()->warning('حذف الحصه من خلال الادمن فقط', 'تحذير', ['timeOut' => 5000]);
            return redirect()->back();
        }

    }


    public function callback(Request $request)
    {
        $code = $request->code;
        $response = $this->getAccessToken($code);
        if(isset($response['access_token'])) {
            $user = $this->getUserData($response['access_token']);
            if(isset($user['id'])) {
                $account = ZoomToken::updateOrCreate([
                    'zoom_account_id' => $user['account_id'],
                    'zoom_email' => $user['email'],
                ], [
                    'access_token' => $response['access_token'],
                    'refresh_token' => $response['refresh_token'],
                    'token_exp' => Carbon::now()->addSeconds($response['expires_in']),
                ]);

                $this->refreshToken($account);
                return redirect()->back();
            }
        }
        return redirect()->back();
    }



    //filterSections
    public function filterSections(Request $request)
    {
        if(!$request->level_id)
        {
            return response()->json(['success' => false, 'html' =>'']);
        }
        $level = Level::findOrFail($request->level_id);
        if(!$level) { return response()->json(['success' => false]); }
        $html = '';
        if($this->isTeacher())
        {
            foreach ($this->teacher_sections_level($level->id) as $key => $val)
            {
                $section = Section::find($val);
                $html .= '<option value="'.$section->id.'">'.$section->name.'</option>';
            }
        }
        else
        {
            foreach ($level->sections as $section)
            {
                $html .= '<option value="'.$section->id.'">'.$section->name.'</option>';
            }
        }
        return response()->json(['success' =>true, 'html' =>$html]);
    }


    //attendance get
    public function students($id)
    {
        $content = Zoom::find($id);
        if(!$content) { return abort(404); }
        $users_in_same_section = User::whereType(3)->whereHas('userInfo',function($query) use ($content) {
            $query->where('section_id' , $content->section_id);
        })->get();
        $attendances = Attendance::join('zooms', 'zooms.id', '=', 'attendances.zoom_id')
            ->join('users','attendances.user_id','=','users.id')
            ->select('users.id')->pluck('users.id')->toArray();
        return view('admin_dashboard.zooms.students', compact('content','users_in_same_section','attendances'));
    }


    //attendance post
    public function attendance(Request $request, $id)
    {
        $content = Zoom::find($id);
        if(!$content) { return abort(404); }
        Attendance::where('zoom_id', $content->id)->delete();
        if($request->attendance && count($request->attendance) > 0)
        {
            foreach ($request->attendance as $key => $val)
            {
                Attendance::create([
                    'zoom_id' => $content->id,
                    'user_id' => $key,
                    'attendance' => $val,
                ]);
            }
        }
        toastr()->success('تم الحفظ بنجاح', 'نجح', ['timeOut' => 5000]);
        return redirect()->back();

    }



}
