<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Course;
use App\Models\PlatformRating;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{

    //Index
    public function index()
    {
        $skills = Skill::with('images')->whereStatus('yes')->orderBy('sort', 'asc')->limit(4)->get();
        $teachers = User::with('userInfo')->whereType(2)->whereNotNull('email_verified_at')->limit(4)->get();
        return view('website.index', compact('skills', 'teachers'));
    }


    //search_results
    public function searchPage(Request $request)
    {
        return response()->json(['success' =>true]);
    }
    public function search_results(Request $request)
    {
        $search = $request->search;
        $page_title = 'نتائج البحث';
        $content = Course::where('title', 'LIKE',"%{$search}%")->whereStatus('yes')
            ->orderBy('sort', 'asc')->get();
        return view('website.search', compact('content','page_title'));
    }


    //contacts
    public function contacts()
    {
        $page_title = 'تواصل معنا';
        return view('website.contacts', compact('page_title'));
    }


    public function contacts_submit(ContactRequest $request)
    {
        $data = $request->validated();
        if (isset($data['spam'])) {
            return redirect()->back();
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'images');
            $data['file'] = $filePath;
        }

        Contact::create($data);

        toastr()->success('تم إرسال الرسالة بنجاح سوف يتم الرد عليكم في أقرب وقت', 'نجح', ['timeOut' => 8000]);
        return redirect()->back();
    }




    public function alreadyRating(Request $request)
    {
        $data = Auth::check() ? ['user_id' => auth()->user()->id, 'ip' =>null]
         : ['user_id' => null, 'ip' =>getIpAddress()];
        PlatformRating::create($data);
        toastr()->success('شكراً علي تقييمك للمنصة', 'نجح', ['timeOut' => 8000]);
        return redirect()->back();
    }


}
