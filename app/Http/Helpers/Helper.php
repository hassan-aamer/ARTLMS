<?php


use App\Models\Course;
use App\Models\CourseQuestionAnswer;
use App\Models\Rating;
use App\Models\UserCourseFileAnswer;
use Illuminate\Support\Facades\Auth;


if (!function_exists('getIpAddress'))
{
    function getIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

if (!function_exists('assetURLFile')) {
    function assetURLFile($filename)
    {
        return asset('/uploads/'. $filename);
    }
}

if (!function_exists('getSkillsInHeader')) {
    function getSkillsInHeader()
    {
        return \App\Models\Skill::select('id','title')->whereStatus('yes')->orderBy('sort', 'asc')->limit(10)->get();
    }
}

if (!function_exists('extensions')) {
    function extensions()
    {
        return \App\Models\Extension::get();
    }
}

if (!function_exists('checkUserUploadCourseAnswer'))
{
    function checkUserUploadCourseAnswer($course_id)
    {
        if(UserCourseFileAnswer::where('student_id', auth()->user()->id)->where('course_id', $course_id)->exists())
        {
            return 'true';
        }
        return 'false';
    }
}

if (!function_exists('getStudentFilesAnswers'))
{
    function getStudentFilesAnswers()
    {
        return UserCourseFileAnswer::whereIn('course_id', getCoursesOfTeacherAuth())->whereNull('degree')->count();
    }
}
if (!function_exists('getQuestionsNotAnswered'))
{
    function getQuestionsNotAnswered()
    {
        return CourseQuestionAnswer::whereIn('course_id', getCoursesOfTeacherAuth())->whereNull('answer')->count();
    }
}
if (!function_exists('getCoursesOfTeacherAuth'))
{
    function getCoursesOfTeacherAuth()
    {
        $courses_of_teachers = Course::whereNotNull('teacher_id')->where('teacher_id', auth()->user()->id)
            ->pluck('id')->toArray();
        $courses_of_units = Course::whereNull('teacher_id')
            ->with('lesson.unit.teachers')->get();
        $coursesArray = [];
        foreach ($courses_of_units as $c)
        {
            if($c->lesson?->unit?->teachers && in_array(auth()->user()->id, $c->lesson?->unit?->teachers->pluck('id')->toArray()))
            {
                array_push($coursesArray, $c->id);
            }

        }
        $courses_of_units_teachers = $coursesArray;
        $coursesFinalIDs = array_merge($courses_of_teachers, $courses_of_units_teachers);
        return $coursesFinalIDs;
    }
}

if (!function_exists('getCourseRating'))
{
    function getCourseRating($course_id)
    {
        $avg = Rating::where('course_id', $course_id)->avg('rating');
        return  number_format((float)$avg, 0, '.', '');

    }
}
if (!function_exists('getCourseRatingCount'))
{
    function getCourseRatingCount($course_id)
    {
        return Rating::where('course_id', $course_id)->count();
    }
}

if (!function_exists('messages')) {
    function messages()
    {
        return \App\Models\Contact::count();
    }
}


if (!function_exists('getSettings'))
{
    function getSettings($key)
    {
        return \App\Models\Setting::where('key', $key)->first()?->value;
    }
}

if (!function_exists('hideRateModal'))
{
    function hideRateModal()
    {
        if(session()->get('logout') == true)
        {
            if(Auth::check())
            {
                $data = \App\Models\PlatformRating::where('user_id', auth()->user()->id)->exists();
            }
            else
            {
                $data = \App\Models\PlatformRating::where('ip', getIpAddress())->exists();
            }
            return $data;
        }
        return true;
    }
}
if (!function_exists('strLimit'))
{
    function strLimit($string,$limit = 200)
    {
        return \Illuminate\Support\Str::limit($string, $limit, $end='...');
    }
}
if (!function_exists('getTotalDegreeForCalendar'))
{
    function getTotalDegreeForCalendar($calendarID)
    {
        $calendar = \App\Models\Calendar::find($calendarID);
        if(isset($calendar) && $calendar->type == 'staging')
        {
            return 25;
        }
        else
        {
            return 100;
        }
    }
}

if (!function_exists('getTotalQuestionDegreesForCalendar'))
{
    function getTotalQuestionDegreesForCalendar($calendarID,$request)
    {
        $return = false;
        $calendar = \App\Models\Calendar::find($calendarID);
        if(!$calendar)
        {
            return false;
        }
        $sumMarks = \App\Models\CalendarQuestion::where('calendar_id', $calendar->id)->sum('question_mark') + $request->question_mark;
        if($calendar->type == 'staging')
        {
           ($sumMarks > 25) ? $return = false : $return = true;
        }
        else
        {
            ($sumMarks > 50) ? $return = false : $return = true;
        }
        return $return;
    }
}


if (!function_exists('sendEmail')) {
    function sendEmail($email, $name, $body, $subject)
    {

        $headers = array(
            'Authorization: Bearer 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' ,
            'Content-Type: application/json'
        );

        $data = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $email,
                            "name" => $name
                        ),
                    )

                )
            ),
            "from" => array(
                "email" =>"mohamednaser@spcd.psu.edu.eg"
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }
}


