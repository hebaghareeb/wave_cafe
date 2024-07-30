<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;
use App\Http\Controllers\userController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\beveragesController;
use App\Http\Controllers\messageController;
use App\Http\Controllers\Controller;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);
/////////////////////////////////////  user   ////////////////////////////////////////////////
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
route::get('homepage',[Controller::class,'drinks'])->name('homePage');
route::get('users',[userController::class,'index'])->name('users');
route::get("editUser/{id}",[userController::class,"edit"])->name('editUser');
route::post('updateUser/{id}',[userController::class,'update'])->name('updateUser');
route::view('addUser','admin.addUser')->name('addUser');
route::post('createUser',[userController::class,'createUser'])->name('createUser');

////////////////////////////////////  category  //////////////////////////////////////////////
route::get('categories',[categoryController::class,'index'])->name('categories');
route::post('createCategory',[categoryController::class,'createCategory'])->name('createCategory');
route::get('deleteCategory/{id}',[categoryController::class,'deleteCategory'])->name('deleteCategory');
route::get('editCategory/{id}',[categoryController::class,'editCategory'])->name('editCategory');
route::post('updateCategory/{id}',[categoryController::class,'updateCategory'])->name('updateCategory');
route::view('addCategory','admin.addCategory')->name('addCategory');

///////////////////////////////////   Beverages  /////////////////////////////////////////////
route::get('beverages',[beveragesController::class,'index'])->name('beverages');
route::get('addBeverage',[beveragesController::class,'addBeverage'])->name('addBeverage');
route::post('createBeverage',[beveragesController::class,'createBeverage'])->name('createBeverage');
route::get('editBeverage/{id}',[beveragesController::class,'editBeverage'])->name('editBeverage');
route::get('deleteBeverage/{id}',[beveragesController::class,'deleteBeverage'])->name('deleteBeverage');
route::post('updateBeverage/{id}',[beveragesController::class,'updateBeverag'])->name('updateBeverage');

////////////////////////////////////   message  ////////////////////////////////////////////////////////

route::get('messages',[messageController::class,'message_user'])->name('messages');
route::get('showMessage/{id}',[messageController::class,'showMessage'])->name('showMessage');
route::post('addMessage',[Controller::class,'addMessage'])->name('addMessage');
route::get('deleteMessage/{id}',[messageController::class,'deleteMessage'])->name('deleteMessage');
route::get('adminPanel',[Controller::class,'unreadMessage'])->name('adminPanel')->middleware(isAdmin::class);
