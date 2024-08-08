<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\IssuesController;
use App\Http\Controllers\ViolationsController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StatusController;

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

// Routes for IssuesController
Route::get('/issues', [IssuesController::class, 'index'])->name('issues.index');
Route::get('/issues/export', [IssuesController::class, 'export'])->name('issues.export');
Route::get('/issues/import', [IssuesController::class, 'import'])->name('issues.import');
Route::post('/issues/import-process', [IssuesController::class, 'import_excel'])->name('issues.import.process');
Route::post('/issues/update-status', [IssuesController::class, 'updateStatus'])->name('issues.updateStatus');
Route::post('/issues/bulk-update', [IssuesController::class, 'bulkUpdate'])->name('issues.bulkUpdate');

// Routes for ViolationController
Route::get('/violations', [ViolationsController::class, 'index'])->name('violations.index');
Route::get('/violations/export', [ViolationsController::class, 'export'])->name('violations.export');
Route::get('/violations/import', [ViolationsController::class, 'import'])->name('violations.import');
Route::post('/violations/import-process', [ViolationsController::class, 'import_excel'])->name('violations.import.process');
Route::post('/violations/update-status', [ViolationsController::class, 'updateStatus'])->name('violations.updateStatus');
Route::post('/violations/bulk-update', [ViolationsController::class, 'bulkUpdate'])->name('violations.bulkUpdate');

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::resource('websites', WebsiteController::class);
Route::get('/websites/destroy/{id}', [WebsiteController::class, 'destroy'])->name('website.remove');
Route::resource('statuses', StatusController::class);
Route::get('/statuses/destroy/{id}', [StatusController::class, 'destroy'])->name('statuses.remove');
Route::resource('pages', PageController::class);







