<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\OpdController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\RankingController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ── Home redirect ──
Route::get('/', function () {
    return redirect()->route('login');
});

// ── Public Routes (no auth) ──
Route::get('/p/{token}', [PublicController::class, 'showForm'])->name('public.form');
Route::post('/p/{token}', [PublicController::class, 'submitForm'])->name('public.submit');
Route::get('/p/{token}/success', [PublicController::class, 'success'])->name('public.success');

// ── Admin Routes (auth required) ──
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data CRUD
    Route::resource('periods', PeriodController::class)->except(['show']);
    Route::post('periods/{period}/regenerate-token', [PeriodController::class, 'regenerateToken'])->name('periods.regenerate-token');

    Route::resource('opds', OpdController::class)->except(['show']);
    Route::resource('questions', QuestionController::class)->except(['show']);
    Route::resource('options', OptionController::class)->except(['show']);

    // Submissions
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{submission}', [SubmissionController::class, 'show'])->name('submissions.show');

    // Ranking
    Route::get('ranking', [RankingController::class, 'index'])->name('ranking.index');

    // Exports
    Route::get('export/submissions/{period}', [ExportController::class, 'submissions'])->name('export.submissions');
    Route::get('export/ranking/{period}', [ExportController::class, 'ranking'])->name('export.ranking');
});

// ── Breeze Profile Routes ──
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
