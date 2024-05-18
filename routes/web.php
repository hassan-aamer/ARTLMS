<?php
//Access Token : glpat-4jA7skgTiFK1KH9fy9Gu

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Spatie\Honeypot\ProtectAgainstSpam;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentControllers\AuthController;
use App\Http\Controllers\WebsiteControllers\ToolController;
use App\Http\Controllers\WebsiteControllers\UnitController;
use App\Http\Controllers\WebsiteControllers\ZoomController;
use App\Http\Controllers\WebsiteControllers\GuideController;
use App\Http\Controllers\WebsiteControllers\SkillController;
use \App\Http\Controllers\WebsiteControllers\TimesController;
use App\Http\Controllers\WebsiteControllers\CourseController;
use App\Http\Controllers\WebsiteControllers\LessonController;
use App\Http\Controllers\WebsiteControllers\ArticleController;
use App\Http\Controllers\WebsiteControllers\GalleryController;
use App\Http\Controllers\WebsiteControllers\TeacherController;
use App\Http\Controllers\WebsiteControllers\CalendarController;
use App\Http\Controllers\WebsiteControllers\CategoryController;
use App\Http\Controllers\WebsiteControllers\HomePageController;
use App\Http\Controllers\StudentControllers\DashboardController;
use App\Http\Controllers\WebsiteControllers\ScheduledController;
use App\Http\Controllers\WebsiteControllers\CurriculumController;

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear Config cache:
Route::get('/config-clear', function () {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});



//Auth::routes();
Route::post('/student/filterSections', [AuthController::class, 'filterSections'])->name('website.student.filterSections');

Route::get('/student/register', [AuthController::class, 'register_page'])->name('website.student.register_page');
Route::post('/student/register', [AuthController::class, 'register'])->name('website.student.register');
Route::get('/student/login', [AuthController::class, 'login_page'])->name('website.student.login_page');
Route::post('/student/login', [AuthController::class, 'login'])->name('website.student.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/student_logout', [AuthController::class, 'student_logout'])->name('student_logout');
Route::get('/forget_password', [AuthController::class, 'forget_password'])->name('website.forget_password');
Route::post('/reset_password', [AuthController::class, 'reset_password'])->name('website.reset_password');
Route::get('/reset_password/{token}', [AuthController::class, 'change_reset_password'])->name('website.change_reset_password');
Route::post('/change_reset_password', [AuthController::class, 'change_reset_password_post'])->name('website.change_reset_password_post');
Route::get('/verification_email/{encryptID}', [AuthController::class, 'verification_email'])->name('website.verification_email');

Route::get('/', [HomePageController::class, 'index'])->name('website.index');
Route::get('/contact-us', [HomePageController::class, 'contacts'])->name('website.contacts');
Route::post('/contact-us', [HomePageController::class, 'contacts_submit'])->name('website.contacts.submit')->middleware(ProtectAgainstSpam::class);
;
Route::get('/guides', [GuideController::class, 'index'])->name('website.guides.index');
Route::get('/guides/{id}', [GuideController::class, 'show'])->name('website.guides.show');
Route::post('/student/alreadyRating', [HomePageController::class, 'alreadyRating'])->name('website.student.alreadyRating');


Route::middleware('auth')->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('website.teachers.index');
    Route::get('/teacher/{id}', [TeacherController::class, 'show'])->name('website.teachers.show');
    Route::get('/skills', [SkillController::class, 'index'])->name('website.skills.index');
    Route::get('/skill/{id}', [SkillController::class, 'show'])->name('website.skills.show');
    Route::get('/categories', [CategoryController::class, 'index'])->name('website.categories.index');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('website.categories.show');
    Route::get('/courses', [CourseController::class, 'index'])->name('website.courses.index');
    Route::get('/course/{id}', [CourseController::class, 'show'])->name('website.courses.show');
    Route::get('/curriculums', [CurriculumController::class, 'index'])->name('website.curriculums.index');
    Route::get('/curriculum/{id}', [CurriculumController::class, 'show'])->name('website.curriculums.show');
    Route::get('/scheduled/{id}', [ScheduledController::class, 'show'])->name('website.scheduleds.show');
    Route::get('/unit/{id}', [UnitController::class, 'show'])->name('website.units.show');
    Route::get('/lesson/{id}', [LessonController::class, 'show'])->name('website.lessons.show');
    Route::post('/student_upload_course_file_answers/{id}', [CourseController::class, 'studentUploadCourseFileAnswers'])->name('website.courses.studentUploadCourseFileAnswers');
    Route::get('/student_delete_course_file_answers/{id}', [CourseController::class, 'studentDeleteCourseFileAnswers'])->name('website.courses.deleteUserFile');
    Route::post('/student_ask_question_course/{id}', [CourseController::class, 'studentAskQuestion'])->name('website.courses.studentAskQuestion');
    Route::get('/student_delete_question_course/{id}', [CourseController::class, 'studentDeleteCourseQuestion'])->name('website.courses.deleteUserQuestion');
    Route::get('/myFavorite/{id}', [CourseController::class, 'addToFavorite'])->name('website.courses.addToFavorite');
    Route::get('/myFavorite', [CourseController::class, 'myFavorite'])->name('website.courses.myFavorite');
    Route::get('/removeFromFavorite/{id}', [CourseController::class, 'removeFromFavorite'])->name('website.courses.removeFromFavorite');
    Route::post('/rating/{id}', [CourseController::class, 'rating'])->name('website.courses.rating');
    //Calendars Routes
    Route::get('/calendar/show/{id}', [CalendarController::class, 'show'])->name('website.calendars.show');
    Route::get('/calendar/go_exam/{id}', [CalendarController::class, 'go_exam'])->name('website.calendars.go');
    Route::post('/calendar/save_exam/{id}', [CalendarController::class, 'save_exam'])->name('website.calendar.save_exam');
    Route::get('/calendar/finished_exam/thanks', [CalendarController::class, 'thanks_after_finished'])->name('website.calendars.thanks');
    //Spint 4
    Route::get('/tools', [ToolController::class, 'index'])->name('website.tools.index');
    Route::get('/galleries', [GalleryController::class, 'index'])->name('website.galleries.index');
    Route::get('/galleries/{id}', [GalleryController::class, 'show'])->name('website.galleries.show');
    Route::get('/meetings', [ZoomController::class, 'index'])->name('website.meetings.index');
    Route::get('/articles', [ArticleController::class, 'index'])->name('website.articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('website.articles.show');
    //Search
    Route::get('/search_results', [HomePageController::class, 'search_results'])->name('website.search_results');
    Route::post('/searchPage', [HomePageController::class, 'searchPage'])->name('website.searchPage');
    Route::post('/save_user_time', [TimesController::class, 'save_student_time'])->name('website.save_student_time');
    Route::post('/save_user_gallery_time', [TimesController::class, 'save_user_gallery_time'])->name('website.save_user_gallery_time');
});



/*All Normal Students Routes List*/
Route::middleware(['auth', 'user-access:student'])->group(function () {
    Route::get('/student/dashboard', [DashboardController::class, 'dashboard'])->name('website.student.dashboard');
    Route::post('/student/update', [DashboardController::class, 'update'])->name('website.student.update');
    Route::get('/student/calendars', [DashboardController::class, 'myCalendars'])->name('website.student.calendars');
    //Sprint 5
    Route::get('/my-appointments', [DashboardController::class, 'appointments'])->name('website.student.appointments');
    Route::post('/student/createGoogleMeet', [DashboardController::class, 'createGoogleMeet'])->name('website.student.createGoogleMeet');
    Route::post('/student/approve_or_reject_meet/{id}', [DashboardController::class, 'approve_or_reject_meet'])->name('website.student.approve_or_reject_meet');
});
