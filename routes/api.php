<?php

use App\Http\Controllers\api\AboutController;
use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\EducationController;
use App\Http\Controllers\api\ExperienceController;
use App\Http\Controllers\api\MediaController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\ServiceController;
use App\Http\Controllers\api\SkillController;
use App\Http\Controllers\api\TestMonialController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('abouts',[AboutController::class,'edit']);
Route::post('abouts',[AboutController::class,'update']);

//media
Route::get('media',[MediaController::class,'index']);
Route::post('media',[MediaController::class,'store']);
Route::delete('media/{id}',[MediaController::class,'deleteMedia']);

//services
Route::get('services',[ServiceController::class,'index']);
Route::post('services',[ServiceController::class,'store']);
Route::post('services/{id}',[ServiceController::class,'updateService']);
Route::delete('service/{id}',[ServiceController::class,'deleteService']);

//skills
Route::get('skills',[SkillController::class,'index']);
Route::post('skills',[SkillController::class,'store']);
Route::post('skills/{id}',[SkillController::class,'updateSkill']);
Route::delete('skill/{id}',[SkillController::class,'deleteSkill']);

//educations
Route::get('educations',[EducationController::class,'index']);
Route::post('educations',[EducationController::class,'store']);
Route::post('educations/{id}',[EducationController::class,'updateEducation']);
Route::delete('educations/{id}',[EducationController::class,'deleteEducation']);

//experiences
Route::get('experiences',[ExperienceController::class,'index']);
Route::post('experiences',[ExperienceController::class,'store']);
Route::post('experiences/{id}',[ExperienceController::class,'updateExperience']);
Route::delete('experiences/{id}',[ExperienceController::class,'deleteExperience']);

//projects 
Route::get('projects',[ProjectController::class,'index']);
Route::get('projects-list',[ProjectController::class,'projectList']);
Route::post('projects',[ProjectController::class,'store']);
Route::get('projects/{id}',[ProjectController::class,'edit']);
Route::post('projects/{id}',[ProjectController::class,'update']);
Route::delete('projects/{id}',[ProjectController::class,'deleteProject']);

//Testmonials
Route::get('testmonials',[TestMonialController::class,'index']);
Route::post('testmonials',[TestMonialController::class,'store']);
Route::get('testmonials/{id}',[TestMonialController::class,'edit']);
Route::post('testmonials/{id}',[TestMonialController::class,'update']);
Route::delete('testmonials/{id}',[TestMonialController::class,'delete']);

//Messages
Route::get('messages',[MessageController::class,'index']);
Route::post('messages/change-status/{id}',[MessageController::class,'changeStatus']);
Route::delete('messages/{id}',[MessageController::class,'deleteMessage']);

//Dashboard
Route::get('dashboard',[DashboardController::class,'index']);

//Contact Me
Route::post('contact',[DashboardController::class,'contactMe']);




