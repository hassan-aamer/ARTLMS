<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Lesson;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use HelperTrait;

    public function dashboard()
    {
        $students = User::whereType(3)->count();
        $teachers = User::whereType(2)->count();
        $courses = Course::where('teacher_id', $this->userId())->count();
        $categories = Category::where('teacher_id', $this->userId())->count();
        $lessons = Lesson::where('teacher_id', $this->userId())->count();
        $skills = Skill::where('teacher_id', $this->userId())->count();
        $contacts = Contact::count();
        $galleries = Gallery::where('teacher_id', $this->userId())->count();
        return view('website.teachers.dashboard.dashboard', compact('students', 'teachers','courses','categories', 'lessons', 'skills', 'contacts', 'galleries'));
    }



}


