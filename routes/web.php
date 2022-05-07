<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dbController;

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

Route::get('/', function () {
    return view('index');
});



Route::get('/',[dbController::class,'index'])->name('index');

// Route::get('{id}',[dbController::class,'routeControl'])->name('routeControl');


Route::get('/login',[dbController::class,'login'])->name('login');

Route::get('/sign-up',[dbController::class,'signUp'])->name('signUp');

Route::post('/login',[dbController::class,'loginRequest'])->name('loginRequest');

Route::post('/signOut',[dbController::class,'signOut'])->name('signOut');

Route::post('/sign-up',[dbController::class,'signUpRequest'])->name('signUpRequest');


Route::get('/docs/{docId}',[dbController::class,'docs'])->name('docs');

Route::post('addDocs',[dbController::class,'addDocs'])->name('addDocs');

Route::post('addDocsData',[dbController::class,'addDocsData'])->name('addDocsData');

Route::get('guestDocs',[dbController::class,'guestDocs'])->name('guestDocs');


Route::post('getHistoryData',[dbController::class,'getHistoryData'])->name('getHistoryData');


Route::post('searchUser',[dbController::class,'searchUser'])->name('searchUser');

Route::post('changePerm',[dbController::class,'changePerm'])->name('changePerm');

Route::post('changePerm2',[dbController::class,'changePerm2'])->name('changePerm2');

Route::post('restoreData',[dbController::class,'restoreData'])->name('restoreData');

Route::post('deleteVersion',[dbController::class,'deleteVersion'])->name('deleteVersion');

Route::post('makeCopy',[dbController::class,'makeCopy'])->name('makeCopy');


Route::post('dateCalculate',[dbController::class,'dateCalculate'])->name('dateCalculate');


Route::post('deleteDocs',[dbController::class,'deleteDocs'])->name('deleteDocs');

Route::post('changeTitle',[dbController::class,'changeTitle'])->name('changeTitle');





