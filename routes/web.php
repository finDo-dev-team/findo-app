<?php

use App\Models\ODPEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ODPEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecommController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/recommandation', [RecommController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('odpEvents', ODPEventController::class)
    ->only(['index', 'show'])
    ->middleware(['auth']);

Route::post('/likeEvent/{odpEvent}', [ODPEventController::class, 'likeOrUnlike'])
    ->name('likeEvent')
    ->middleware(['auth']);


require __DIR__ . '/auth.php';
