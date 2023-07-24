<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BillTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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
require __DIR__.'/auth.php';

Route::get('', function () {
    return view('welcome');
});

// Route::get('dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('users', [UserController::class,'index'])->name('users.index');
    Route::match(['GET','POST'], 'users/create', [UserController::class,'create'])->name('users.create');
    Route::match(['GET','POST'],'users/{user}/edit', [UserController::class,'edit'])->name('users.edit');
    Route::delete('users/{user}', [UserController::class,'destroy'])->name('users.destroy');

    Route::get('bill-type', [BillTypeController::class,'index'])->name('type.index');
    Route::match(['GET','POST'], 'bill-type/create', [BillTypeController::class,'create'])->name('type.create');
    Route::match(['GET','POST'],'bill-type/{bill}/edit', [BillTypeController::class,'edit'])->name('type.edit');
    Route::delete('bill-type/{bill}', [BillTypeController::class,'destroy'])->name('type.destroy');

    Route::get('bill', [BillController::class,'index'])->name('bill.index');
    Route::match(['GET','POST'],'bill-approve', [BillController::class,'approve'])->name('bill.approve');
    Route::post('bill/submit', [BillController::class,'submit'])->name('bill.submit');
    Route::get('bill-paid', [BillController::class,'paid'])->name('bill.paid');
    Route::match(['GET','POST'], 'bill/create', [BillController::class,'create'])->name('bill.create');
    Route::match(['GET','POST'],'bill/{bill}/edit', [BillController::class,'edit'])->name('bill.edit');
    Route::delete('bill/{bill}', [BillController::class,'destroy'])->name('bill.destroy');
});
