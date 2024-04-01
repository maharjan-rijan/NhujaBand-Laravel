<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TempImagesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Str;
use App\Http\Controllers\FrontController;


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

//Route::get('/', function () { return view('welcome'); });
Route::get('/',[FrontController::class,'index'])->name('front.home');

Route::get('/members',[FrontController::class,'members'])->name('front.our-members');
Route::get('/events',[FrontController::class,'events'])->name('front.events');
Route::get('/event/{slug}',[EventController::class,'event'])->name('front.event-details');
Route::get('/gallery',[FrontController::class,'gallery'])->name('front.gallery');
Route::get('/page/{slug}',[FrontController::class,'page'])->name('front.page');
Route::post('/send-contact-email',[FrontController::class,'sendContactEmail'])->name('front.sendContactEmail');


Route::group(['prefix' => 'admin'],function(){
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('/login',[LoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate',[LoginController::class,'authenticate'])->name('admin.authenticate');
        Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('admin.forgotPassword');
        Route::post('/process-forgot-password',[AuthController::class,'processForgotPassword'])->name('admin.processForgotPassword');
        Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('admin.resetPassword');
        Route::post('/process-reset-password',[AuthController::class,'processResetPassword'])->name('admin.processResetPassword');
    });

    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');
        Route::put('/update-profile-pic',[UserController::class,'updateProfilePic'])->name('account.updateProfilePic');


        //Team Member
        Route::get('/team-members',[TeamMemberController::class,'index'])->name('team-members.index');
        Route::get('/team-members/create',[TeamMemberController::class,'create'])->name('team-members.create');
        Route::post('/team-members',[TeamMemberController::class,'store'])->name('team-members.store');
        Route::get('/team-members/{members}/edit',[TeamMemberController::class,'edit'])->name('team-members.edit');
        Route::put('/team-members/{members}',[TeamMemberController::class,'update'])->name('team-members.update');
        Route::delete('/team-members/{members}',[TeamMemberController::class,'destory'])->name('team-members.delete');

        //Event
        Route::get('/events',[EventController::class,'index'])->name('events.index');
        Route::get('/events/create',[EventController::class,'create'])->name('events.create');
        Route::post('/events',[EventController::class,'store'])->name('events.store');
        Route::get('/events/{event}/edit',[EventController::class,'edit'])->name('events.edit');
        Route::put('/events/{event}',[EventController::class,'update'])->name('events.update');
        Route::delete('/events/{event}',[EventController::class,'destory'])->name('events.delete');

        //Gallery
        Route::get('/galleries',[GalleryController::class,'index'])->name('galleries.index');
        Route::get('/galleries/create',[GalleryController::class,'create'])->name('galleries.create');
        Route::post('/galleries',[GalleryController::class,'store'])->name('galleries.store');
        Route::get('/galleries/{gallery}/edit',[GalleryController::class,'edit'])->name('galleries.edit');
        Route::put('/galleries/{gallery}',[GalleryController::class,'update'])->name('galleries.update');
        Route::delete('/galleries/{gallery}',[GalleryController::class,'destory'])->name('galleries.delete');

         //User
         Route::get('/users',[UserController::class,'index'])->name('users.index');
         Route::get('/users/create',[UserController::class,'create'])->name('users.create');
         Route::post('/users',[UserController::class,'store'])->name('users.store');
         Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
         Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
         Route::delete('/users/{user}',[UserController::class,'destory'])->name('users.delete');

        //Page
        Route::get('/pages',[PageController::class,'index'])->name('pages.index');
        Route::get('/pages/create',[PageController::class,'create'])->name('pages.create');
        Route::post('/pages',[PageController::class,'store'])->name('pages.store');
        Route::get('/pages/{page}/edit',[PageController::class,'edit'])->name('pages.edit');
        Route::put('/pages/{page}',[PageController::class,'update'])->name('pages.update');
        Route::delete('/pages/{page}',[PageController::class,'destory'])->name('pages.delete');

         //Temp-image
         Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');

        //Setting
        Route::get('/change-password',[SettingController::class,'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password',[SettingController::class,'processChangePassword'])->name('admin.processChangePassword');

        Route::get('/getSlug',function(Request $request){
            $slug = '';
            if(!empty($request->title)){
               $slug = Str::slug($request->title);
            }

            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');


    });



});

