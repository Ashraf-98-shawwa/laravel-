<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriperController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\Website\WebsiteController;
use App\Models\About;
use App\Models\Category;
use App\Models\City;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::prefix('cms/')->middleware('guest:admin,author')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('view.login');
    Route::post('{guard}/login', [AuthController::class, 'login']);

});
Route::prefix('cms/admin/')->middleware('auth:admin,author')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

    Route::get('Profile/Edit', [AuthController::class, 'editProfile'])->name('ProfileEdit');
    Route::post('Profile/update', [AuthController::class, 'updateProfile']);

    Route::get('Password/Reset', [AuthController::class, 'ResetPassword'])->name('PasswordEdit');
    Route::post('Password/update', [AuthController::class, 'updatePassword']);
});





Route::prefix('cms/admin')->middleware('auth:admin,author')->group(function () {

    Route::view('', 'cms.parent')->name('main');

    Route::resource('countries', CountryController::class);
    Route::post('countries_update/{id}', [CountryController::class, 'update']);

    Route::resource('cities', CityController::class);
    Route::post('cities_update/{id}', [CityController::class, 'update']);


    Route::resource('admins', AdminController::class);
    Route::post('admins_update/{id}', [AdminController::class, 'update']);

    Route::resource('authors', AuthorController::class);
    Route::post('authors_update/{id}', [AuthorController::class, 'update']);


    Route::resource('categories', CategoryController::class);
    Route::post('categories_update/{id}', [CategoryController::class, 'update']);

    Route::resource('projects', ProjectController::class);
    Route::post('projects_update/{id}', [ProjectController::class, 'update']);


    Route::resource('articles', ArticleController::class);
    Route::post('articles_update/{id}', [ArticleController::class, 'update']);
    Route::get('/index/articles/{id}', [ArticleController::class, 'indexArticle'])->name('indexArticle');
    Route::get('/create/articles/{id}', [ArticleController::class, 'createArticle'])->name('createArticle');


    Route::resource('settings', SettingController::class);
    Route::post('settings_update/{id}', [SettingController::class, 'update']);

    Route::resource('sliders', SliderController::class);
    Route::post('sliders_update/{id}', [SliderController::class, 'update']);


    Route::resource('abouts', AboutController::class);
    Route::post('abouts_update/{id}', [AboutController::class, 'update']);

    Route::resource('features', FeatureController::class);
    Route::post('features_update/{id}', [FeatureController::class, 'update']);

    Route::resource('services', ServiceController::class);
    Route::post('services_update/{id}', [ServiceController::class, 'update']);

    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials_update/{id}', [TestimonialController::class, 'update']);

    Route::resource('workers', WorkerController::class);
    Route::post('workers_update/{id}', [WorkerController::class, 'update']);

    Route::resource('roles', RoleController::class);
    Route::post('roles_update/{id}', [RoleController::class, 'update'])->name('roles_update');

    Route::resource('permissions', PermissionController::class);
    Route::post('permissions_update/{id}', [PermissionController::class, 'update'])->name('permissions_update');
    Route::resource('roles.permissions', RolePermissionController::class);
    Route::get('checkAllPermissions/{roleid}', [RolePermissionController::class, 'checkAllPermissions'])->name('checkallpermissions');
    Route::get('removeAllPermissions/{roleid}', [RolePermissionController::class, 'removeAllPermissions'])->name('removeallpermissions');


    Route::resource('requests', ApplicationController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('subscripers', SubscriperController::class);
    Route::resource('comments', CommentController::class);
});



Route::prefix('WEBUILD')->group(function () {

Route::get('/home', [WebsiteController::class,'home'])->name('home');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/blogs', [WebsiteController::class, 'blogs'])->name('blogs');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::get('/detail/{id}', [WebsiteController::class, 'detail'])->name('detail');
Route::get('/blog/{id}', [WebsiteController::class, 'categoryarticles'])->name('blog');
Route::get('/projects', [WebsiteController::class, 'projects'])->name('projects');
Route::get('/services', [WebsiteController::class, 'services'])->name('services');
Route::get('/team', [WebsiteController::class, 'team'])->name('team');
Route::get('/testimonials', [WebsiteController::class, 'testimonials'])->name('testimonials');


});

Route::get('error', function () {
    return view('test.404');
});