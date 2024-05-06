<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//============================[ユーザー画面]=====================================
//ホーム画面表示
Route::get('/', [\App\Http\Controllers\kikukawaController::class,"giveInfo"])->name('giveInfo');

//イベント詳細ページ表示
Route::get('/detail/{id}', [\App\Http\Controllers\kikukawaController::class,"openDetail"])->name('openDetail');
//===================================[管理画面]==================================================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Event
    Route::get("/dashboard/show-event",[\App\Http\Controllers\dashEvent::class,"showEvent"])->name("show-event");
    Route::post("/dashboard/add-event",[\App\Http\Controllers\dashEvent::class,"addEvent"])->name("add-event");
    Route::post("/dashboard/add-category",[\App\Http\Controllers\dashEvent::class,"addCategory"])->name("add-category");
    Route::patch('/dashboard/show-event/update/{event}', [\App\Http\Controllers\dashEvent::class,"updateEvent"])->name('updateEvent');
    Route::post("/dashboard/show-event/delete",[\App\Http\Controllers\dashEvent::class,"deleteEvent"])->name("deleteEvent");

//Product
    Route::get("/dashboard/show-product",[\App\Http\Controllers\dashProduct::class,"showProductPage"])->name("show-product");
    Route::post("/dashboard/add-product",[\App\Http\Controllers\dashProduct::class,"addProduct"])->name("add-product");
    Route::patch('/dashboard/show-product/update/{product}', [\App\Http\Controllers\dashProduct::class,"updateProduct"])->name('update-product');
    Route::post("/dashboard/show-product/delete",[\App\Http\Controllers\dashProduct::class,"deleteProduct"])->name("deleteProduct");

//Message
    Route::get("/dashboard/show-message",[\App\Http\Controllers\dashMessage::class,"showMessagePage"])->name("show-message");
    Route::post("/dashboard/add-message",[\App\Http\Controllers\dashMessage::class,"addMessage"])->name("add-message");
    Route::patch('/dashboard/show-message/update/{message}', [\App\Http\Controllers\dashMessage::class,"updateMessage"])->name('update-message');
    Route::post("/dashboard/show-message/delete",[\App\Http\Controllers\dashMessage::class,"deleteMessage"])->name("deleteMessage");

//Interview
    Route::get("/dashboard/show-interview",[\App\Http\Controllers\dashInterview::class,"showInterviewPage"])->name("show-interview");
    Route::post("/dashboard/add-interview",[\App\Http\Controllers\dashInterview::class,"addInterview"])->name("add-interview");
    Route::patch('/dashboard/show-interview/update/{interview}', [\App\Http\Controllers\dashInterview::class,"updateInterview"])->name('update-interview');
    Route::post("/dashboard/show-interview/delete",[\App\Http\Controllers\dashInterview::class,"deleteInterview"])->name("deleteInterview");

//Job Opening
    Route::get("/dashboard/show-job_opening",[\App\Http\Controllers\dashJobOpening::class,"showJobOpeningPage"])->name("show-job_opening");
    Route::post("/dashboard/add-add-job_opening",[\App\Http\Controllers\dashJobOpening::class,"addJobOpening"])->name("add-job_opening");
    Route::patch('/dashboard/show-job_opening/update/{job_opening}', [\App\Http\Controllers\dashJobOpening::class,"updateJobOpening"])->name('update-job_opening');
    Route::post("/dashboard/show-job_opening/delete",[\App\Http\Controllers\dashJobOpening::class,"deleteJobOpening"])->name("deleteJobOpening");

//Benefit
    Route::get("/dashboard/show-benefit",[\App\Http\Controllers\dashBenefit::class,"showBenefitPage"])->name("show-benefit");
    Route::post("/dashboard/add-add-benefit",[\App\Http\Controllers\dashBenefit::class,"addBenefit"])->name("add-benefit");
    Route::patch('/dashboard/show-benefit/update/{benefit}', [\App\Http\Controllers\dashBenefit::class,"updateBenefit"])->name('update-benefit');
    Route::post("/dashboard/show-benefit/delete",[\App\Http\Controllers\dashBenefit::class,"deleteBenefit"])->name("deleteBenefit");

//Question
    Route::get("/dashboard/show-question",[\App\Http\Controllers\dashQuestion::class,"showQuestionPage"])->name("show-question");
    Route::post("/dashboard/add-question",[\App\Http\Controllers\dashQuestion::class,"addQuestion"])->name("add-question");
    Route::patch('/dashboard/show-question/update/{question}', [\App\Http\Controllers\dashQuestion::class,"updateQuestion"])->name('update-question');
    Route::post("/dashboard/show-question/delete",[\App\Http\Controllers\dashQuestion::class,"deleteQuestion"])->name("deleteQuestion");

//イベント編集（Quill)
    Route::get('/dashboard/edit-detail/{id}', [\App\Http\Controllers\kikukawaController::class,"openEditDetail"])->name('openEditDetail');
    Route::post('/posts', [\App\Http\Controllers\kikukawaController::class,"storeData"])->name('posts');

//画像編集
    Route::get('/dashboard/edit-img', [\App\Http\Controllers\kikukawaController::class,"editImg"])->name('editImg');
});

require __DIR__.'/auth.php';

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});
