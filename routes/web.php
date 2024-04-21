<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('/test',function(){
    return redirect()->route('article');
});

Route::get('/article/elon-musk',function(){
    return '<h1>Saravanan buys twitter</h1>';
})->name('article');

Route::group(["prefix"=>"admin"],function(){
    Route::get('/settings',function(){
        return 'settings';
    });
});

Route::get('/employees',[EmployeeController::class,'index'])->name('employees.index');
Route::get('/employees/create',[EmployeeController::class,'create']);
Route::get('/employees/{id}',[EmployeeController::class,'show'])->name('employees.show');
Route::get('/employees/{id}/edit',[EmployeeController::class,'edit'])->name('employees.edit');
Route::post('/employees/store',[EmployeeController::class,'store'])->name('employees.store');
Route::put('/employee/{id}',[EmployeeController::class,'update'])->name('employees.update');
Route::delete('/employees/{id}',[EmployeeController::class,'destroy'])->name('employees.destroy');
