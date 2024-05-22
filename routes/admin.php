<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminControllers\AuthController;
use App\Http\Controllers\AdminControllers\ContactController;
use App\Http\Controllers\AdminControllers\DashboardController;


Route::get('/login', [AuthController::class, 'login_page'])->name('admin.login_page');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');




/*All Admin Routes List*/
Route::middleware(['auth', 'teacher-admin-access'])->namespace('App\Http\Controllers\AdminControllers')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    //students
    Route::resource('students', 'StudentController');
    Route::get('send-email/{id}', 'SendEmailController@index')->name('send-email');
    Route::resource('sendEmail', 'SendEmailController');

    //teachers
    Route::resource('teachers', 'TeacherController');
    Route::post('teachers/assignments/{id}', 'TeacherController@assignments')
        ->name('teachers.assignments');
    //extensions
    Route::resource('extensions', 'ExtensionController');
    //levels
    Route::resource('sections', 'SectionController');
    //Terms
    Route::resource('terms', 'TermController');
    Route::resource('levels', 'LevelController');
    //categories
    Route::resource('categories', 'CategoryController');
    //skills
    Route::resource('skills', 'SkillController');
    //courses
    Route::resource('courses', 'CourseController');

    //curriculums
    Route::resource('curriculums', 'CurriculumController');

    //scheduled
    Route::resource('scheduleds', 'ScheduledController');

    //units
    Route::resource('units', 'UnitController');

    //lessons
    Route::resource('lessons', 'LessonController');

    Route::get('moduleFile/destroy/{id}', [\App\Http\Controllers\AdminControllers\CurriculumController::class, 'moduleFileDestroy'])->name('moduleFile.destroy');


    //Sprint 3
    //calendars
    Route::resource('calendars', 'CalendarController');
    //calendar Questions
    Route::resource('calendar_questions', 'CalendarQuestionController');
    //calendar answers
    Route::resource('calendar_answers', 'CalendarAnswerController');
    Route::post('calendar/question/updateQuestionMark/{id}', [\App\Http\Controllers\AdminControllers\CalendarQuestionController::class, 'updateQuestionMark'])->name('question.updateQuestionMark');
    //    Route::resource('meets', 'GoogleMeetController');
    //Sprint 4
    //tools
    Route::resource('tools', 'ToolController');
    //galleries
    Route::resource('galleries', 'GalleryController');
    //zoom
    Route::resource('zooms', 'ZoomController');
    Route::get('zooms/authorize', 'ZoomController@callback')
        ->name('admin.zooms.authorize');
    Route::post('zooms/filterSections', 'ZoomController@filterSections')
        ->name('admin.filterSections');
    Route::get('zooms/students/{id}', 'ZoomController@students')
        ->name('zooms.students');
    Route::post('zooms/students/attendance/{id}', 'ZoomController@attendance')
        ->name('zooms.students.attendance');

    Route::resource('articles', 'ArticleController');
    Route::resource('article_categories', 'ArticleCategoryController');
    Route::resource('article_tags', 'ArticleTagController');
    Route::post('send/{id}', [ContactController::class, 'send'])->name('contact.send');
    Route::get('update/{id}', [ContactController::class, 'showUpdate'])->name('contact.update');
    Route::put('update/{id}', [ContactController::class, 'update'])->name('contact.update');
    Route::resource('contacts', 'ContactController');
    Route::resource('guides', 'GuideController');
    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::post('/settings', 'SettingController@update')->name('settings.update');

    Route::post('att/{id}', [ContactController::class, 'att'])->name('att');

});
