<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('students','App\Http\Controllers\StudentController');
Route::get('/students', 'StudentsController@index');
Route::get('/students/create', 'StudentsController@store');
Route::get('/students/create', 'StudentsController@create');
Route::get('/students/create', [StudentController::class,'create']);
Route::post('/students/create', [StudentController::class,'store'])->name('students.store');
Route::post('/students/edit', [StudentController::class,'edit'])->name('students.update');
Route::delete('/students', [StudentController::class,'DELETE'])->name('students.destroy');
Route::delete('students.destroy{id}', array('as' => 'students.destroy', 'uses' => 'StudentController@destroy'));
