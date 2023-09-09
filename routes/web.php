<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\RegionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/companies', [CompanyController::class, 'index'])->middleware(['auth', 'verified'])->name('companies.index');
Route::post('/companies', [CompanyController::class, 'store'])->middleware(['auth', 'verified'])->name('companies.store');

Route::get('/companies/create', [CompanyController::class, 'create'])->middleware(['auth', 'verified'])->name('companies.create');
Route::get('/companies/edit/{company}', [CompanyController::class, 'edit'])->middleware(['auth', 'verified'])->name('companies.edit');
Route::patch('/companies/edit/{company}', [CompanyController::class, 'update'])->middleware(['auth', 'verified'])->name('companies.update');
Route::delete('/companies/delete/{company}', [CompanyController::class, 'destroy'])->middleware(['auth', 'verified'])->name('companies.destroy');



Route::get('/localities/{locality}', [LocalityController::class, 'index'])->middleware(['auth', 'verified'])->name('locality.index');
Route::get('/regions/{region}', [RegionController::class, 'index'])->middleware(['auth', 'verified'])->name('region.index');
Route::get('/regions/localities/{region}', [RegionController::class, 'localities'])->middleware(['auth', 'verified'])->name('region.localities');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
