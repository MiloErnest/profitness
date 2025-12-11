<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OnlineTrainingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SupplementController;
use App\Http\Controllers\SportClothingController;
use App\Http\Controllers\CafeteriaSaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CartController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Gimnasio (servicios principales)
Route::get('/gimnasio', [ServiceController::class, 'index'])->name('gym');

// Tienda
Route::get('/tienda/suplementos', [SupplementController::class, 'index'])->name('supplements');
Route::get('/tienda/ropa', [SportClothingController::class, 'index'])->name('clothes');

// Cafetería - Vista Pública (para clientes)
Route::get('/cafeteria', [CafeteriaSaleController::class, 'index'])->name('cafeteria.index');

// Cafetería - Panel Administrativo (CRUD) - PROTEGIDO
Route::prefix('admin/cafeteria')->name('cafeteria.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [CafeteriaSaleController::class, 'adminIndex'])->name('admin');
    Route::get('/reporte', [CafeteriaSaleController::class, 'report'])->name('report');
    Route::get('/mes-actual', [CafeteriaSaleController::class, 'goToCurrentMonth'])->name('currentMonth');
    Route::post('/cerrar-mes', [CafeteriaSaleController::class, 'closeMonth'])->name('closeMonth');
    Route::post('/actualizar-mes', [CafeteriaSaleController::class, 'updateMonth'])->name('updateMonth');
    Route::delete('/eliminar-mes', [CafeteriaSaleController::class, 'deleteMonth'])->name('deleteMonth');
    Route::get('/crear', [CafeteriaSaleController::class, 'create'])->name('create');
    Route::post('/', [CafeteriaSaleController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [CafeteriaSaleController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CafeteriaSaleController::class, 'update'])->name('update');
    Route::delete('/{id}', [CafeteriaSaleController::class, 'destroy'])->name('destroy');
});

// Suplementos - Panel Administrativo (CRUD) - PROTEGIDO
Route::prefix('admin/supplements')->name('supplements.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [SupplementController::class, 'adminIndex'])->name('admin');
    Route::get('/reporte', [SupplementController::class, 'report'])->name('report');
    Route::get('/mes-actual', [SupplementController::class, 'goToCurrentMonth'])->name('currentMonth');
    Route::post('/cerrar-mes', [SupplementController::class, 'closeMonth'])->name('closeMonth');
    Route::post('/actualizar-mes', [SupplementController::class, 'updateMonth'])->name('updateMonth');
    Route::delete('/eliminar-mes', [SupplementController::class, 'deleteMonth'])->name('deleteMonth');
    Route::get('/crear', [SupplementController::class, 'create'])->name('create');
    Route::post('/', [SupplementController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [SupplementController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SupplementController::class, 'update'])->name('update');
    Route::delete('/{id}', [SupplementController::class, 'destroy'])->name('destroy');
});

// Ropa Deportiva - Panel Administrativo (CRUD) - PROTEGIDO
Route::prefix('admin/sport-clothes')->name('sport_clothes.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [SportClothingController::class, 'adminIndex'])->name('admin');
    Route::get('/reporte', [SportClothingController::class, 'report'])->name('report');
    Route::get('/mes-actual', [SportClothingController::class, 'goToCurrentMonth'])->name('currentMonth');
    Route::post('/cerrar-mes', [SportClothingController::class, 'closeMonth'])->name('closeMonth');
    Route::post('/actualizar-mes', [SportClothingController::class, 'updateMonth'])->name('updateMonth');
    Route::delete('/eliminar-mes', [SportClothingController::class, 'deleteMonth'])->name('deleteMonth');
    Route::get('/crear', [SportClothingController::class, 'create'])->name('create');
    Route::post('/', [SportClothingController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [SportClothingController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SportClothingController::class, 'update'])->name('update');
    Route::delete('/{id}', [SportClothingController::class, 'destroy'])->name('destroy');
});

// Entrenadores - Panel Administrativo (CRUD) - PROTEGIDO
Route::prefix('admin/trainers')->name('trainers.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [TrainerController::class, 'adminIndex'])->name('admin');
    Route::get('/crear', [TrainerController::class, 'create'])->name('create');
    Route::post('/', [TrainerController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [TrainerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TrainerController::class, 'update'])->name('update');
    Route::delete('/{id}', [TrainerController::class, 'destroy'])->name('destroy');
});

// Máquinas - Panel Administrativo (CRUD) - PROTEGIDO
Route::prefix('admin/machines')->name('machines.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [MachineController::class, 'adminIndex'])->name('admin');
    Route::get('/crear', [MachineController::class, 'create'])->name('create');
    Route::post('/', [MachineController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [MachineController::class, 'edit'])->name('edit');
    Route::put('/{id}', [MachineController::class, 'update'])->name('update');
    Route::delete('/{id}', [MachineController::class, 'destroy'])->name('destroy');
});

// Planes de membresía - Vista pública
Route::get('/planes', [MemberController::class, 'plans'])->name('members.plans');

// Miembros - Panel Administrativo (CRUD) - PROTEGIDO
Route::prefix('admin/members')->name('members.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [MemberController::class, 'adminIndex'])->name('admin');
    Route::get('/crear', [MemberController::class, 'create'])->name('create');
    Route::post('/', [MemberController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [MemberController::class, 'edit'])->name('edit');
    Route::put('/{id}', [MemberController::class, 'update'])->name('update');
    Route::delete('/{id}', [MemberController::class, 'destroy'])->name('destroy');
});

// Dashboard Principal - PROTEGIDO CON AUTH Y ADMIN
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'admin']);

// Gestión de Mensajes de Contacto - ADMIN
Route::prefix('admin/contacts')->name('contacts.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [ContactController::class, 'adminIndex'])->name('admin');
    Route::patch('/{id}/mark-read', [ContactController::class, 'markAsRead'])->name('mark-read');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
});

// Dashboard de Usuario - PROTEGIDO CON AUTH Y USER
Route::prefix('user')->name('user.')->middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/attendance', [App\Http\Controllers\UserDashboardController::class, 'markAttendance'])->name('attendance');
});

// Carrito y Checkout (público)
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/actualizar', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrito/eliminar', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');

// Páginas generales
Route::get('/quienes-somos', [AboutController::class, 'index'])->name('about');
Route::get('/entrenamiento-online', [OnlineTrainingController::class, 'index'])->name('online-training');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');