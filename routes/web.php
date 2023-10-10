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

//Route::get('/', 'App\Http\Controllers\Admin\OutcomesController@index');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/********** PROYECTO REPORTE CANVAS OUTCOMES ***********/
Route::get('/outcomes', 'App\Http\Controllers\Admin\OutcomesController@index');
Route::get('/outcomes/assigmentxcourse/{courseId}', 'App\Http\Controllers\Admin\OutcomesController@assigmentxcourse');
Route::get('/outcomes/detalle/{courseId}/{assigmentId}', 'App\Http\Controllers\Admin\OutcomesController@assigmentdetalle')
    ->name('outcomes.detalle');

Route::get('/outcomes/student', 'App\Http\Controllers\Admin\OutcomesController@listaractividades');


Route::get('/outcomes/filtro', 'App\Http\Controllers\Admin\OutcomesController@listarcursos');
Route::get('/outcomes/prueba', 'App\Http\Controllers\Admin\OutcomesController@prueba');
/**Route::get('/reportterm', 'App\Http\Controllers\Admin\TermController@index');
Route::get('/graphsterm', 'App\Http\Controllers\Admin\GraphstermController@index');**/

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  
});

