<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\IssuesController;
use App\Http\Controllers\WebsiteController;

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

Route::get('/', [IssuesController::class, 'index'])->name('issues');
Route::get('/export', [IssuesController::class, 'export'])->name('export');
Route::get('/import', [IssuesController::class, 'import'])->name('import');
Route::post('/import-excel', [IssuesController::class, 'import_excel'])->name('import.excel');
Route::resource('websites', WebsiteController::class);
Route::get('/websites/destroy/{id}', [WebsiteController::class, 'destroy'])->name('websites.destroy');






