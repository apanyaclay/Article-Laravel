<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Konfigurasi\AksesRoleController;
use App\Http\Controllers\Konfigurasi\AksesUserController;
use App\Http\Controllers\Konfigurasi\MenuController;
use App\Http\Controllers\Konfigurasi\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Konfigurasi\RoleController;
use App\Http\Controllers\Konfigurasi\SubMenuController;
use App\Http\Controllers\Konfigurasi\UserController;
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
})->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('post', PostController::class);
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_store'])->name('login_store');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

});
Route::group(['prefix' => 'konfigurasi', 'middleware' => ['auth']], function(){
    Route::controller(MenuController::class)->group(function(){
        Route::get('menu', 'index')->name('menu.index')->middleware('permission:view menu');
        Route::get('menu/create', 'create')->name('menu.create')->middleware('permission:create menu');
        Route::post('menu/create', 'store')->name('menu.store');
        Route::get('menu/{id}/edit', 'edit')->name('menu.edit')->middleware('permission:update menu');
        Route::post('menu/{id}/edit', 'update')->name('menu.update');
        Route::get('menu/{id}/delete', 'destroy')->name('menu.destroy')->middleware('permission:delete menu');
    });
    Route::controller(SubMenuController::class)->group(function(){
        Route::get('submenu', 'index')->name('submenu.index')->middleware('permission:view submenu');
        Route::get('submenu/create', 'create')->name('submenu.create')->middleware('permission:view submenu');
        Route::post('submenu/create', 'store')->name('submenu.store');
        Route::get('submenu/{id}/edit', 'edit')->name('submenu.edit')->middleware('permission:update submenu');
        Route::post('submenu/{id}/edit', 'update')->name('submenu.update');
        Route::get('submenu/{id}/delete', 'destroy')->name('submenu.destroy')->middleware('permission:delete submenu');
    });
    Route::controller(RoleController::class)->group(function(){
        Route::get('role', 'index')->name('role.index')->middleware('permission:view role');
        Route::get('role/create', 'create')->name('role.create')->middleware('permission:create role');
        Route::post('role/create', 'store')->name('role.store');
        Route::get('role/{id}/edit', 'edit')->name('role.edit')->middleware('permission:update role');
        Route::post('role/{id}/edit', 'update')->name('role.update');
        Route::get('role/{id}/delete', 'destroy')->name('role.destroy')->middleware('permission:delete role');
    });
    Route::controller(PermissionController::class)->group(function(){
        Route::get('permission', 'index')->name('permission.index')->middleware('permission:view permission');
        Route::get('permission/create', 'create')->name('permission.create')->middleware('permission:create permission');
        Route::post('permission/create', 'store')->name('permission.store');
        Route::get('permission/{id}/edit', 'edit')->name('permission.edit')->middleware('permission:update permission');
        Route::post('permission/{id}/edit', 'update')->name('permission.update');
        Route::get('permission/{id}/delete', 'destroy')->name('permission.destroy')->middleware('permission:delete permission');
    });
    Route::controller(AksesRoleController::class)->group(function(){
        Route::get('akses-role', 'index')->name('akses-role.index')->middleware('permission:view akses-role');
        Route::get('akses-role/create', 'create')->name('akses-role.create')->middleware('permission:create akses-role');
        Route::post('akses-role/create', 'store')->name('akses-role.store');
        Route::get('akses-role/{id}/edit', 'edit')->name('akses-role.edit')->middleware('permission:update akses-role');
        Route::put('akses-role/{id}/edit', 'update')->name('akses-role.update');
        Route::get('akses-role/{id}/delete', 'destroy')->name('akses-role.destroy')->middleware('permission:delete akses-role');
    });
    Route::controller(AksesUserController::class)->group(function(){
        Route::get('akses-user', 'index')->name('akses-user.index')->middleware('permission:view akses-user');
        Route::get('akses-user/create', 'create')->name('akses-user.create')->middleware('permission:create akses-user');
        Route::post('akses-user/create', 'store')->name('akses-user.store');
        Route::get('akses-user/{id}/edit', 'edit')->name('akses-user.edit')->middleware('permission:update akses-user');
        Route::post('akses-user/{id}/edit', 'update')->name('akses-user.update');
        Route::get('akses-user/{id}/delete', 'destroy')->name('akses-user.destroy')->middleware('permission:delete akses-user');
    });
    Route::controller(UserController::class)->group(function(){
        Route::get('user', 'index')->name('user.index')->middleware('permission:view user');
        Route::get('user/create', 'create')->name('user.create')->middleware('permission:create user');
        Route::post('user/create', 'store')->name('user.store');
        Route::get('user/{id}/edit', 'edit')->name('user.edit')->middleware('permission:update user');
        Route::put('user/{id}/edit', 'update')->name('user.update');
        Route::get('user/{id}/delete', 'destroy')->name('user.destroy')->middleware('permission:delete user');
    });
});
