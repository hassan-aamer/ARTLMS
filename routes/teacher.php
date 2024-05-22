<?php

use App\Http\Controllers\TeacherControllers\AuthController;
use App\Http\Controllers\TeacherControllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::get('/register', [AuthController::class, 'register_page'])->name('website.teacher.register_page');
Route::post('/register', [AuthController::class, 'register'])->name('website.teacher.register');
Route::get('/login', [AuthController::class, 'login_page'])->name('website.teacher.login_page');
Route::post('/login', [AuthController::class, 'login'])->name('website.teacher.login');

Route::post('contacts/{id}/add-attach', ['App\Http\Controllers\AdminControllers\ContactController'::class, 'addAttach'])->name('contact.attach');


/*All Teacher Routes List*/
Route::middleware(['auth', 'teacher-admin-access'])->namespace('App\Http\Controllers\TeacherControllers')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('website.teacher.dashboard');
    Route::resource('students_files', 'StudentFileController');
    Route::resource('courses_questions', 'CourseQuestionController');
    Route::resource('meets', 'GoogleMeetController');
});








