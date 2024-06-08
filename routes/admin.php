<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminControllers\AuthController;
use App\Http\Controllers\AdminControllers\ToolController;
use App\Http\Controllers\AdminControllers\ArtistController;
use App\Http\Controllers\AdminControllers\GroupsController;
use App\Http\Controllers\AdminControllers\ContactController;
use App\Http\Controllers\AdminControllers\SubjectController;
use App\Http\Controllers\AdminControllers\DashboardController;


Route::get('/login', [AuthController::class, 'login_page'])->name('admin.login_page');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');




/*All Admin Routes List*/
Route::middleware(['auth', 'teacher-admin-access'])->namespace('App\Http\Controllers\AdminControllers')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    //students
    Route::resource('students', 'StudentController');
    Route::get('send-email/{id}', 'SendEmailController@index')->name('send-email');
    Route::get('studenth', 'StudentController@indexWith')->name('indexWith');
    Route::get('student/{id}', 'StudentController@addUser')->name('students.add');
    Route::get('teacher/new/{id}', [\App\Http\Controllers\AdminControllers\TeacherController::class ,'addUser'])->name('teacher.add.new');
    Route::resource('sendEmail', 'SendEmailController');

    //teachers
    Route::resource('teachers', 'TeacherController');
    Route::get('teacher/add', [\App\Http\Controllers\AdminControllers\TeacherController::class ,'indexWith'])->name('teacher.new');
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
    //groups
    Route::resource('groups', 'GroupsController');
    Route::post('groups', [GroupsController::class, 'create'])->name('groups.create');
    Route::post('groups/{id}', [GroupsController::class, 'destroy'])->name('groups.destroy');
    Route::get('group/{id}/edit', [GroupsController::class, 'edit'])->name('groups.editt');
    Route::post('groups/{id}/edit', [GroupsController::class, 'update'])->name('groups.update');
    Route::get('groups/show', [GroupsController::class, 'show'])->name('groups.show');
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
    //subjects

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
    Route::get('tool/attach/{id}', [ToolController::class, 'showAttach'])->name('show.attach');
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
    Route::post('student-email/{id}', 'StudentController@send')->name('student-email');
    Route::get('update/{id}', [ContactController::class, 'showUpdate'])->name('contact.update');
    Route::get('contacts/show/{id}', [ContactController::class, 'showAtt'])->name('show.att');
    Route::put('update/{id}', [ContactController::class, 'update'])->name('contact.update');
    Route::resource('contacts', 'ContactController');
    Route::resource('guides', 'GuideController');
    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::post('/settings', 'SettingController@update')->name('settings.update');

    Route::post('att/{id}', [ContactController::class, 'att'])->name('att');
    //Artists
    Route::get('artists', [ArtistController::class, 'index'])->name('artists');
    Route::delete('/destroy/artists/{id}', [ArtistController::class, 'destroy'])->name('artists.destroy');
    Route::get('teacher-artist/{id}', [ArtistController::class, 'teacherasartist'])->name('teacherasartist');
    Route::get('student-artist/{id}', [ArtistController::class, 'studentasartist'])->name('studentasartist');

    //End Artists
    //section of tools
    Route::get('/tools-sections/{id}/edit', [ToolController::class, 'editsection'])->name('toolssections.edit');
    Route::put('/tools-sections/{id}', [ToolController::class, 'updatesection'])->name('toolssections.update');
    Route::get('toolssection', [ToolController::class, 'section'])->name('toolssection');
    Route::delete('deletetoolssection/{id}', [ToolController::class, 'deletesection'])->name('deletetoolssection');
    Route::get('createtoolssection', [ToolController::class, 'createsection'])->name('createtoolssection');
    Route::post('storetoolssection', [ToolController::class, 'storesection'])->name('storetoolssection');
    //end
      //section of subjects
    //   Route::get('/tools-sections/{id}/edit', [ToolController::class, 'editsection'])->name('toolssections.edit');
    //   Route::put('/tools-sections/{id}', [ToolController::class, 'updatesection'])->name('toolssections.update');
      Route::get('subjects', [SubjectController::class, 'index'])->name('subjects');
    //   Route::delete('deletetoolssection/{id}', [ToolController::class, 'deletesection'])->name('deletetoolssection');
    //   Route::get('createtoolssection', [ToolController::class, 'createsection'])->name('createtoolssection');
    //   Route::post('storetoolssection', [ToolController::class, 'storesection'])->name('storetoolssection');
      //end

});
