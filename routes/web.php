<?php

use App\Http\Controllers\AddUserController;
use App\Http\Controllers\AddUserPrivilegeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ModuleGeneratorController;
use App\Http\Controllers\UserProfileController;
use App\Livewire\ModuleGenerator;
use App\Models\ModuleGenerator as ModelsModuleGenerator;
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
    return redirect('login');
});

// Login
Route::get('login', [LoginController::class, 'index'])->name('login-index');
Route::post('login-account', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('dashboard', [MainController::class, 'index'])->name('dashboard');
    // Add User
    Route::get('add-user', [AddUserController::class, 'index']);
    // Add User Privilege
    Route::get('add-user-privilege', [AddUserPrivilegeController::class, 'index']);
    // User Profile
    Route::get('user-profile/{id}', [UserProfileController::class, 'index'])->name('user-profile');
    // Module Generator
    Route::get('module-generator', [ModuleGeneratorController::class, 'index'])->name('module-generator');
    // User App Settings
    Route::post('update-app-settings/{id}', [UserProfileController::class, 'update'])->name('update-app-setting');
    // Modules
    // $modules = ModelsModuleGenerator::get();

    // foreach ($modules as $module){
    //     $controllerPath = $module->controller_path;
    //     $controllerNamespace = 'App\\' . str_replace('/', '\\', $controllerPath);

    //     Route::get($module->route_name, [$controllerNamespace, 'index'])->name($module->route_name);
    // }

    // Add other authenticated routes here
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
