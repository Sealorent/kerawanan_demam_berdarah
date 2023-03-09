<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FuzzyGaController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KlimatologiController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\VektorController;
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

// Route::get('/', function () {
//     Route::get('fr')
// });
Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('/test', [FrontendController::class, 'test'])->name('test');
Route::get('/ujiPopulasi', [FuzzyGaController::class, 'getUjiPopulasi']);
Route::get('/ujiGenerasi', [FuzzyGaController::class, 'getUjiGenerasi']);
Route::get('/filter', [FrontendController::class, 'filter']);
Route::get('/penyebaran', [FrontendController::class, 'penyebaran']);
Route::get('/get-kasus', [DashboardController::class, 'getKasus']);
Route::get('/getAllPotensi', [DashboardController::class, 'getAllPotensi']);
Route::get('/updateFuzzy', [FrontendController::class, 'updateFuzzy']);




Route::get('/admin-panel', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin-panel')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/metode', [DashboardController::class, 'metode'])->name('metode');
        Route::prefix('data-potensi')->group(function () {
            Route::resource('/potensi', PotensiController::class);
            Route::resource('/vektor', VektorController::class);
            Route::resource('/klimatologi', KlimatologiController::class);
        });
        // Route::prefix('metode')->group(function () {
        //     Route::get('/fuzzy-ga', [FuzzyGaController::class, 'index'])->name('fuzzyGa.index');
        //     Route::post('/fuzzy-ga', [FuzzyGaController::class, 'store'])->name('fuzzyGa.store');
        // });
        Route::prefix('data-master')->group(function () {
            Route::resource('/kecamatan', KecamatanController::class);
            Route::resource('/rule', RuleController::class);
            Route::resource('/kasus', KasusController::class);
            Route::resource('/tindakan', TindakanController::class);
        });
    });
});
require __DIR__ . '/auth.php';
