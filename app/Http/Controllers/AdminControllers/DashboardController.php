<?php

namespace App\Http\Controllers\AdminControllers;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Lesson;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $students = User::whereType(3)->count();
        $teachers = User::whereType(2)->count();
        $courses = Course::whereStatus('yes')->count();
        $categories = Category::whereStatus('yes')->count();
        $contacts = Contact::count();
        $lessons = Lesson::count();
        $galleries = Gallery::count();
        $skills = Skill::count();
        return view('admin_dashboard.dashboard', compact('contacts','students', 'teachers','courses','categories', 'lessons', 'galleries', 'skills'));
    }

}
