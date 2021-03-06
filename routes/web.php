<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FileController;


use App\Models\Classroom;


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

// Default home route:
//Route::any('/', function () {
//    return view('home');
//});



// Default home route:
Route::get('/home', function () {
    return view('home');
});



// if verified get dashboard url:
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Only authenticated users may access this route...
Route::group(['middleware' => 'auth'], function () {

    // if signed in:
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // @todo: Notes:
    Route::post('/image_upload', [FileController::class, 'store'])->name('image_upload');


    // custom urls go before resource routes:

    // @info: https://gyazo.com/b1dcca493538db567a9ec28d3a5fadf3
    route::get('/classrooms/search', [ClassroomController::class, 'searchClassrooms']);
    route::get('/explore', [CommunityController::class, 'index']);

    // define special route for visitors:
    Route::get('/visit/{id}', [ClassroomController::class, 'visitRoom'])->name('classrooms.visit');
    Route::get('/classrooms/invite/{token}', [ClassroomController::class, 'linkToClassroom']);

    Route::resource('classrooms', ClassroomController::class)->except('edit', 'create');
    // use prefix for subjects:
    Route::group(['middelware' => 'classrooms', 'prefix' => 'classrooms/{classroom_id}'], function() {
        // setup custom destroy route:
        Route::get('/delete', [ClassroomController::class, 'destroy']);



        // subjects needs Classroom parameter:
        Route::resource('subjects', SubjectsController::class)->except('edit', 'create');

        Route::group(['middelware' => 'subjects', 'prefix' => 'subjects/{subject_id}'], function() {
            // delete subjects:
            Route::get('/delete', [SubjectsController::class, 'destroy']);

            Route::resource('notes', NotesController::class)->except('show');

            Route::group(['middelware' => 'notes', 'prefix' => 'notes/{note_id}'], function($note_id) {
                Route::get('/delete', [NotesController::class, 'destroy'], ['id' => $note_id]);
            });
        });
    });

    // @todo: remove history-overview:
    Route::resource('history-overview', UserHistoryController::class)->only('index', 'show', 'destroy');
});


//Require custom jetstream fortify routing:
require_once('fortify_routes.php');
require_once('jetstream_routes.php');

