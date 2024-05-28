<?php

namespace App\Http\Traits;

use App\Models\CalendarQuestionChoice;
use App\Models\ModuleFile;
use App\Models\TeacherAssignment;
use App\Models\UserInfo;
use App\Models\Zoom;
use App\Models\ZoomToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Exception;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

Trait HelperTrait
{
    public $insertMsg = ' تم إنشاء العنصر بنجاح ';
    public $updateMsg = 'تم تحديث العنصر بنجاح';
    public $deleteMsg = 'تم حذف العنصر بنجاح';
    public $error = 'يوجد مشكلة ما';

    public $paginate = 50;



    //Main Upload File Method
    public function upload_file_helper_trait($request,$fileInputName, $moveTo)
    {
        $file = $request->file($fileInputName);
        $fileUploaded=rand(1,99999999999).'__'.$file->getClientOriginalName();
        $file->move($moveTo, $fileUploaded);
        return $fileUploaded;
    }

    public function createUserInfo($data,$userID, $request, $type)
    {

        $someData = [
            'user_id'=>$userID,
            'phone' =>$data['phone'],
            'group_id' =>$data['group_id'],
            'job_title' =>$data['job_title'],
            'gender' =>isset($data['gender']) ? $data['gender'] : 'male',
            'national_id'=>$data['national_id'],
            'city'=>$data['city'],
            'specialist' =>$data['specialist'],
            'qualification'=>$data['qualification'],
            'school_or_college'=>$data['school_or_college'],
            'date_of_birth'=>null,
            'department'=>$data['department'],
            'reason'=>isset($data['reason']) ? $data['reason']:'',
            'status'=>isset($data['status']) ? 'no' : 'yes',
            // 'level_id'=>isset($data['level_id']) ? $data['level_id'] : null,
            // 'section_id'=>isset($data['section_id']) ? $data['section_id'] : null,
            // 'facebook'=>$data['facebook'],
            // 'twitter'=>$data['twitter'],
            // 'linkedin'=>$data['linkedin'],
        ];
        if($request->file('image'))
        {
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $someData['image']=$image;
        }

        if($type == 'created')
        {
            UserInfo::create($someData);
        }
        elseif($type == 'updated')
        {
            UserInfo::where('user_id', $userID)->update($someData);
        }
    }



    public function saveMultipleFiles($module, $module_id , $data, $moveTo)
    {
        foreach ($data['name'] as $key => $value)
        {
            $fileUploaded=rand(1,99999999999).'__'.$data['file_uploaded'][$key]->getClientOriginalName();
            $data['file_uploaded'][$key]->move($moveTo, $fileUploaded);
            $moduleFiles =  [
                'module_name' =>$module,
                'module_id' =>$module_id,
                'name' =>$value,
                'file_type' =>$data['file_type'][$key],
                'file_uploaded'=>$fileUploaded,
                'descriptions' =>$data['descriptions'][$key],
            ];
            ModuleFile::create($moduleFiles);
        }
    }


    //SaveQuestionChoices
    public function SaveQuestionChoices($question_id , $data, $moveTo)
    {
        $arrayTypes = ['complete', 'single_choice', 'multiple_choice','rearrange','connect']; //have choices
        if(in_array($data['question_type'], $arrayTypes))
        {
            $choicesTextNotNull = [];
            foreach ($data['choice_text'] as $key =>$val)
            {
                if($val != null)
                {
                    array_push($choicesTextNotNull, $val);
                }
            }
            foreach ($choicesTextNotNull as $key => $value)
            {
                if(isset($key))
                {
                    $correct = 0;
                    foreach ($data['correct_answer'] as $correct_key => $correct_val)
                    {
                        if($correct_key == $key)
                        {
                            $correct = 1;
                        }
                    }
                    if($data['question_type'] == 'connect'){
                        $correct = $data['correct_answer_correct'][$key];
                        $video = null;
                    }
                    elseif($data['question_type'] == 'rearrange')
                    {
                        $correct = $data['correct_answer'][$key];
                        $video = null;
                    }
                    else
                    {
                        $video = $data['choice_video'][$key];
                    }
                    $insertChoices =  [
                        'question_id' =>$question_id,
                        'choice_text' =>$value,
                        'correct_answer' =>$correct,
                        'choice_video_url' => $video,
                    ];

                    if(isset($data['choice_file'][$key]))
                    {
                        $fileUploaded=rand(1,99999999999).'__'.$data['choice_file'][$key]->getClientOriginalName();
                        $data['choice_file'][$key]->move($moveTo, $fileUploaded);
                        $insertChoices['choice_file'] = $fileUploaded;
                        $insertChoices['choice_file_ext'] = pathinfo($fileUploaded, PATHINFO_EXTENSION);
                    }
                    CalendarQuestionChoice::create($insertChoices);
                }

            }
        }

    }


    //auth type
    public function userId()
    {
        return auth()->user()->id;
    }

    public function isTeacher()
    {
        if(auth()->user()->type == 'teacher')
        {
            return true;
        }
        return false;
    }


    public function editPermission($content)
    {
        if($this->isTeacher())
        {
            if($content->teacher_id != $this->userId())
            {
                return abort(404);
            }
        }
    }

    //teacher levels
    public function teacher_levels()
    {
        return TeacherAssignment::where('teacher_id', $this->userId())->pluck('level_ids')->toArray();
    }

    //teacher sections
    public function teacher_sections()
    {
        $sections = TeacherAssignment::where('teacher_id', $this->userId())->select('section_ids')->get();
        $arr = [];
        foreach ($sections as $section)
        {
            if(!empty($section->section_ids))
            {
                $explodeSection = explode(',', $section->section_ids);
                array_push($arr, $explodeSection);
            }

        }
        $arr2 = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr));
        return iterator_to_array($arr2, false);
    }

    //teacher sections for level
    public function teacher_sections_level($level_id)
    {
        $sections = TeacherAssignment::where('level_ids',$level_id)->where('teacher_id', $this->userId())->select('section_ids')->get();
        $arr = [];
        foreach ($sections as $section)
        {
            if(!empty($section->section_ids))
            {
                $explodeSection = explode(',', $section->section_ids);
                array_push($arr, $explodeSection);
            }

        }
        $arr2 = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr));
        return iterator_to_array($arr2, false);
    }




    //Zoom Service

    public static function createZoomMeeting($request)
    {
        $account = ZoomToken::first();

        $email = $account->zoom_email;
        $token = self::getValidAccessToken($account);
        if(!$token) {
            return false;
        }
        $date = date('Y-m-d H:i:s', strtotime($request['start_time']));
        $start_time = date('Y-m-d\TH:i:s', strtotime($date));
        $topic = $request['title'];
        $duration = $request['duration'];
        $type  = "2";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/users/me/meetings",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "
            {\"topic\":\"$topic\",
                \"type\":\"$type\",
                \"start_time\":\"$start_time\",
                \"duration\":\"$duration\",
                \"timezone\":\"Africa/Cairo\",
                \"password\":\"\"}}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $token",
                "content-type: application/json",
                "accept: application/json"
            ),
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        return  $response = json_decode($response, true);
        curl_close($curl);
        if(isset($response['code']) && $response['code'] != 200) {
            return false;
        }
        return ['response' => $response, 'error' => $err];
    }


    public static function deleteMeeting($id)
    {
        $account = ZoomToken::first();
        $curl = curl_init();
        $token = self::getValidAccessToken($account);
        if(!$token) {
            return false;
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/meetings/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $token"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if(isset($response['code']) && !in_array($response['code'], [200, 204, 201])) {
            return false;
        }

        return [
            'response' => $response,
            'error' => $err,
        ];
    }




    public static function getAccessToken($code)
    {
        $authorization = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
        $redirectUri = 'https://www.art-lms.net/admin/zooms/authorize';
        $data = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
        ];
        $client = new Client();
        $res = $client->request('POST', 'https://zoom.us/oauth/token/', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . $authorization,
            ],
            'form_params' => $data,
        ]);


        $response = json_decode($res->getBody(), true);
        return $response;
    }


    public static function refreshToken($account)
    {
        $client = new Client();
        $refreshToken = $account->refresh_token;
        $oldToken = $account->access_token;
        $authorization = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
        try {
            $response = $client->request('POST', 'https://zoom.us/oauth/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . $authorization,
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $response = json_decode($response->getBody(), true);
                $account->access_token = $response['access_token'];
                $account->refresh_token = $response['refresh_token'];
                $account->token_exp = Carbon::now()->addSeconds($response['expires_in']);
                $account->save();
            }
            $newToken = $account->access_token;
            return $account;
        } catch(RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $contents = $response->getBody()->getContents();
            } else {
                // Handle the case where no response was received
                $statusCode = 0;
                $contents = 'No response received.';
            }
            return false;
        }
    }

    public static function isTokenExpired($account)
    {
        if($account->token_exp->lte(Carbon::now()->subMinutes(10))) {
            return true;
        }
        return false;
    }

    public static function getValidAccessToken($account)
    {
        $account = self::refreshToken($account);
        return $account ? $account->access_token : false;
    }
    public static function checkToken($account)
    {
        $account = self::refreshToken($account);
        if(!$account) {
            return false;
        } else {
            return $account;
        }
    }

    public static function getUserData($token)
    {
        $client = new Client();
        $data = [
            'login_type' => 99,
        ];
        $res = $client->request('GET', 'https://api.zoom.us/v2/users/me', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . $token,
            ],
            'form_params' => $data,
        ]);
        $response = json_decode($res->getBody(), true);
        return $response;
    }






}

