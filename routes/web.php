<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\lecturer\LessonController;
use App\Http\Controllers\lecturer\MassageController;
use App\Http\Controllers\lecturer\LecturerController;
use App\Http\Controllers\lecturer\TestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PaypalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => [ 'lecturer']], function () {
    
    Route::resource('lessons', LessonController::class);

    Route::post('/storecourse', [CourseController::class, 'storecourse'])->name('storecourse');
    Route::post('/addtag', [TagController::class, 'addtag'])->name('addtag');
    Route::post('/addlesson/{id}', [LessonController::class, 'addlesson'])->name('addlesson');
    Route::get('/deltag/{tag}', [TagController::class, 'deltag'])->name('deltag');
    Route::post('/mail/{id}', [MassageController::class, 'send'])->name('mail');
    Route::get('/alart/{id}', [CourseController::class, 'alart'])->name('alart');
    Route::get('/cert/{course_id}/{score}', [CertificateController::class, 'cert'])->name('cert');
    Route::get('/course_lessons/{id}', [CourseController::class, 'coursepage2'])->name('course_lesson');
    Route::get('/addtest/{id}', [TestController::class, 'addtest'])->name('addtest');
    Route::post('/storetest', [TestController::class, 'storetest'])->name('storetest');
    Route::get('/addqu/{id}', [TestController::class, 'addqu'])->name('addquestion');

});

Route::group(['middleware' => ['auth']], function () {

    Route::post('/paypal',[PaypalController::class,'index'])->middleware(['auth'])->name('paypal_call');
    Route::get('/paypal/return',[PaypalController::class,'paypalReturn'])->name('paypal_return');
    Route::get('/paypal/cancel',[PaypalController::class,'paypalCancel'])->name('paypal_cancel');
    Route::get('/certif/{id}', [CertificateController::class, 'certif'])->name('certif');
    Route::get('/certorder', [CertificateController::class, 'certorder'])->name('certorder');
    Route::get('/course_intro/{id}', [CourseController::class, 'courseintro'])->name('course_intro');
    Route::get('/video/{id}', [CourseController::class, 'video'])->name('video');
    Route::get('/completed/{lesson_id}', [CourseController::class, 'completed'])->name('completed');
    Route::get('/test/{id}', [TestController::class, 'test'])->name('test');
    Route::get('/course_checout/{price}', [CourseController::class, 'coursechecout'])->name('coursecheckout');
    Route::get('/course_page/{id}', [CourseController::class, 'coursepage'])->name('course_page');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/client', [AdminController::class, 'client'])->name('client');
    Route::get('/course', [AdminController::class, 'course'])->name('course');
    Route::get('/lecturers', [AdminController::class, 'lecturers'])->name('lecturers');
});

Route::group(['prefix' => LaravelLocalization::setLocale(),
 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::resource('courses', CourseController::class);

    });

Route::get('/lecregister', [LecturerController::class, 'create'])->name('lectuer.register');
Route::get('/leclog', [LecturerController::class, 'login'])->name('lecturer.login');
Route::post('/saveleclog', [LecturerController::class, 'savelogin'])->name('save.lecturer.login');
Route::get('/lecturer/logout', [LecturerController::class, 'logout'])->name('lecturerLogout');
Route::get('/search', [CourseController::class, 'search'])->name('search');
Route::post('/lecstoregister', [LecturerController::class, 'store'])->name('storeregister');

Route::get('/regist', function () {
    return view('register');
})->name('regist');

Route::get('/lecturerhome', function () {
    return view('lecturerhome');
})->name('lecturerhome');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/contact-us', function () {
    return view('contact-us');

})->name('contact-us');
Route::get('/addcourse', function () {
    return view('addcourse');
})->name('addcourse');

Route::get('/addlec/{id}', function ($id) {
    return view('add-lecture')->with('id',$id);
})->name('addlec');



      
    
             
     
     



require __DIR__.'/auth.php';
