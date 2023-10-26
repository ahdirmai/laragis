<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\IndonesianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Models\Address;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
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

// Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');
// Route::get('/user', [UserDashboardController::class, 'index'])->middleware(['auth'])->name('user.dashboard');

Route::middleware('auth', 'role:admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');

    Route::resource('destinations', \App\Http\Controllers\Admin\DestinationController::class);
    Route::POST('/destinations/{slug}/gallery', [\App\Http\Controllers\Admin\DestinationController::class, 'storeGallery'])->name('destinations.gallery.store');
    Route::PUT('/destinations/{slug}/position', [\App\Http\Controllers\Admin\DestinationController::class, 'storeGallery'])->name('destinations.position.edit');

    Route::get('destinations/{slug}/edit/open-hours', [\App\Http\Controllers\Admin\DestinationController::class, 'editOpenHours'])->name('destinations.open-hours.edit');
    Route::POST('destinations/{slug}/store/open-hours', [\App\Http\Controllers\Admin\DestinationController::class, 'storeOpenHours'])->name('destinations.open-hours.store');
    Route::PUT('destinations/{slug}/update/open-hours', [\App\Http\Controllers\Admin\DestinationController::class, 'storeOpenHours'])->name('destinations.open-hours.update');
});

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::name('address.')->group(function () {
    Route::get('/city/{province_code?}', [IndonesianController::class, 'city'])->name('city');
    Route::get('/district/{city_code?}', [IndonesianController::class, 'district'])->name('district');
    Route::get('/village/{district_code?}', [IndonesianController::class, 'village'])->name('village');
    Route::get('/village/detail/{village_code?}', [IndonesianController::class, 'villageDetail'])->name('village-detail');
});
require __DIR__ . '/auth.php';
