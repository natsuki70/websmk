<?php

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

Route::get('/debug-data', function () {
    $user = \App\Models\User::where('name', 'Arif Rahman')->first();
    $mapels = \App\Models\Mapel::all();
    return response()->json([
        'user' => $user,
        'mapels' => $mapels
    ]);
});

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Modules Routes
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KuisController;

use App\Http\Controllers\Admin\PertemuanController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('kelas', KelasController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('siswa', SiswaController::class);
    // Kuis Routes (Resource)
    Route::resource('kuis', KuisController::class)->parameters(['kuis' => 'kuis']);

    // Pertemuan Routes
    Route::get('/mapel/{mapel}/pertemuan/create', [PertemuanController::class, 'create'])->name('pertemuan.create');
    Route::post('/pertemuan', [PertemuanController::class, 'store'])->name('pertemuan.store');
    Route::get('/pertemuan/{pertemuan}/edit', [PertemuanController::class, 'edit'])->name('pertemuan.edit');
    Route::put('/pertemuan/{pertemuan}', [PertemuanController::class, 'update'])->name('pertemuan.update');
    Route::delete('/pertemuan/{pertemuan}', [PertemuanController::class, 'destroy'])->name('pertemuan.destroy');

    // Soal Routes
    Route::post('/soal', [App\Http\Controllers\Admin\SoalController::class, 'store'])->name('soal.store');
    Route::delete('/soal/{soal}', [App\Http\Controllers\Admin\SoalController::class, 'destroy'])->name('soal.destroy');
});

// Siswa Routes
Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/onboarding', [App\Http\Controllers\Student\OnboardingController::class, 'index'])->name('onboarding');
    Route::post('/onboarding', [App\Http\Controllers\Student\OnboardingController::class, 'store'])->name('onboarding.store');
    
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
    
    // Mapel Routes
    Route::resource('mapel', App\Http\Controllers\Student\MapelController::class)->only(['index', 'show']);
    Route::get('/mapel/{mapel}/pertemuan-ke/{ke}', [App\Http\Controllers\Student\MapelController::class, 'listTopics'])->name('mapel.topics');
    Route::get('/mapel/{mapel}/pertemuan/{pertemuan}', [App\Http\Controllers\Student\MapelController::class, 'read'])->name('mapel.read');

    // Quiz Routes
    Route::get('/kuis/{kuis}', [App\Http\Controllers\Student\KuisController::class, 'show'])->name('kuis.show');
    Route::post('/kuis/{kuis}/start', [App\Http\Controllers\Student\KuisController::class, 'start'])->name('kuis.start');
    Route::get('/kuis/{kuis}/soal/{no}', [App\Http\Controllers\Student\KuisController::class, 'main'])->name('kuis.main');
    Route::post('/kuis/{kuis}/answer', [App\Http\Controllers\Student\KuisController::class, 'answer'])->name('kuis.answer');
    Route::get('/kuis/{kuis}/finish', [App\Http\Controllers\Student\KuisController::class, 'finish'])->name('kuis.finish');
    Route::get('/kuis/{kuis}/result', [App\Http\Controllers\Student\KuisController::class, 'result'])->name('kuis.result');

    // Nilai Routes
    Route::resource('nilai', App\Http\Controllers\Student\NilaiController::class)->only(['index']);
});

