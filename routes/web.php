<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ChallengeController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php

// User uchun
Route::middleware('auth')->group(function () {
    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::post('/challenges/{challenge}/submit', [SubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

// Admin uchun
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/challenges', [ChallengeController::class, 'allChallenges'])->name('admin.challenges.index');
    Route::get('/admin/challenges/create', [ChallengeController::class, 'create'])->name('admin.challenges.create');
    Route::post('/admin/challenges', [ChallengeController::class, 'store'])->name('admin.challenges.store');
    Route::get('/admin/challenges/{challenge}/edit', [ChallengeController::class, 'edit'])->name('admin.challenges.edit');
    Route::put('/admin/challenges/{challenge}', [ChallengeController::class, 'update'])->name('admin.challenges.update');
    Route::delete('/admin/challenges/{challenge}', [ChallengeController::class, 'destroy'])->name('admin.challenges.destroy');
    Route::get('/admin/submissions', [SubmissionController::class, 'index'])->name('admin.submissions.index');
    Route::post('/admin/submissions/{submission}/status', [SubmissionController::class, 'updateStatus'])->name('admin.submissions.updateStatus');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');

require __DIR__.'/auth.php';
