<?php

use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\FeatureController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\SubscriperController;
use App\Http\Controllers\API\TestimonialController;
use App\Http\Controllers\API\WorkerController;
use App\Models\About;
use App\Models\Admin;
use App\Models\Feature;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('cities',CityController::class);
Route::apiResource('countries',CountryController::class);
Route::apiResource('abouts',AboutController::class);
Route::apiResource('admins',AdminController::class);
Route::apiResource('authors',AuthorController::class);
Route::apiResource('requests',ApplicationController::class);
Route::apiResource('articles',ArticleController::class);
Route::apiResource('categories',CategoryController::class);
Route::apiResource('contacts',ContactController::class);
Route::apiResource('features',FeatureController::class);
Route::apiResource('permissions',PermissionController::class);
Route::apiResource('roles',RoleController::class);
Route::apiResource('projects',ProjectController::class);
Route::apiResource('services',ServiceController::class);
Route::apiResource('settings',SettingController::class);
Route::apiResource('subscripers',SubscriperController::class);
Route::apiResource('sliders',SliderController::class);
Route::apiResource('testimonials',TestimonialController::class);
Route::apiResource('workers',WorkerController::class);

Route::prefix('auth/')->group(function(){
    Route::Post('login', [AuthController::class, 'login']);
    Route::post('forgetPassword', [AuthController::class, 'ResetPassword']);
    Route::post('updatePassword', [AuthController::class, 'UpdatePassword']);
});


Route::prefix('auth/')->middleware('auth:admin-api,author-api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::apiResource('comments', CommentController::class);
});