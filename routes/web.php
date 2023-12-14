<?php

use App\Http\Controllers\AddadminController;
use App\Http\Controllers\AdduserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProjectsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserAddController;
use App\Http\Controllers\VendorAddController;
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
//login & register
Route::middleware(['guest'])->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'aunthenticate']);
});
Route::get('/home', function(){
    return redirect('/dashboard');
});

Route::middleware(['auth', 'CheckRole:adminsuper'])->group(function () {
    Route::get('/dashboard/admin', [AddadminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard/admin/create', [AddadminController::class, 'create'])->name('admin.create');
    Route::post('/dashboard/admin/store', [AddadminController::class, 'store'])->name('admin.store');
    Route::get('/dashboard/admin/edit/{id}', [AddadminController::class, 'edit'])->name('admin.edit');
    Route::patch('/dashboard/admin/update/{id}', [AddadminController::class, 'update'])->name('admin.update');
    Route::get('/dashboard/admin/delete/{id}', [AddadminController::class, 'destroy'])->name('admin.delete');
});

// Rute yang hanya dapat diakses oleh 'admin'
Route::middleware(['auth', 'CheckRole:admin,adminsuper'])->group(function () {
    Route::get('/dashboard/vendor', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/dashboard/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/dashboard/vendor/store', [VendorController::class, 'store'])->name('vendor.store');
    Route::get('/dashboard/vendor/show/{id}', [VendorController::class, 'show'])->name('vendor.show');
    Route::get('/dashboard/vendor/edit/{id}', [VendorController::class, 'edit'])->name('vendor.edit');
    Route::get('/dashboard/vendor/delete/{id}', [VendorController::class, 'destroy'])->name('vendor.delete');
    Route::patch('/dashboard/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');

    Route::get('/dashboard/user', [AdduserController::class, 'index'])->name('user.index');
    Route::get('/dashboard/user/create', [AdduserController::class, 'create'])->name('user.create');
    Route::post('/dashboard/user/store', [AdduserController::class, 'store'])->name('user.store');
    Route::get('/dashboard/user/edit/{id}', [AdduserController::class, 'edit'])->name('user.edit');
    Route::patch('/dashboard/user/update/{id}', [AdduserController::class, 'update'])->name('user.update');
    Route::get('/dashboard/user/delete/{id}', [AdduserController::class, 'destroy'])->name('user.delete');
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'Store']);
});

// Rute yang dapat diakses oleh 'user'
Route::middleware(['auth', 'CheckRole:user,admin,adminsuper'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/vendorview', [DashboardController::class, 'vendorview'])->name('vendor.view');
    Route::get('/dashboard/vendorview/search', [DashboardController::class, 'search'])->name('vendor.search');
    Route::get('/dashboard/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::get('/dashboard/profile/create', [UserProfileController::class, 'create'])->name('profile.create');
    Route::post('/dashboard/profile/store', [UserProfileController::class, 'store'])->name('profile.store');
    Route::get('/dashboard/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/dashboard/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/dashboard/projects', [DashboardProjectsController::class, 'index'])->name('projects.index');
    Route::get('/dashboard/projects/create', [DashboardProjectsController::class, 'create'])->name('projects.create');
    Route::post('/dashboard/projects/store', [DashboardProjectsController::class, 'store'])->name('projects.store');
    Route::get('/dashboard/projects/show/{id}', [DashboardProjectsController::class, 'show'])->name('projects.show');
    Route::get('/dashboard/projects/show/{id}/user', [DashboardProjectsController::class, 'user'])->name('projects.user');
    Route::get('/dashboard/projects/export', [DashboardProjectsController::class, 'export'])->name('projects.export');
    Route::get('/dashboard/projects/edit/{id}', [DashboardProjectsController::class, 'edit'])->name('projects.edit');
    Route::get('/dashboard/projects/delete/{id}', [DashboardProjectsController::class, 'destroy'])->name('projects.delete');
    Route::get('/dashboard/projects/search', [DashboardProjectsController::class, 'search'])->name('projects.search');
    Route::patch('/dashboard/projects/{id}', [DashboardProjectsController::class, 'update'])->name('projects.update');
    Route::get('/dashboard/projects/show/export/{id}', [DashboardProjectsController::class, 'export_show'])->name('projects_show.export');
    Route::get('/dashboard/projects/new', [DashboardProjectsController::class, 'NewProjects'])->name('projects.new');
    Route::get('/dashboard/projects/progress', [DashboardProjectsController::class, 'ProgressProjects'])->name('projects.progress');
    Route::get('/dashboard/projects/completed', [DashboardProjectsController::class, 'CompletedProjects'])->name('projects.completed');
    Route::get('/dashboard/projects/high', [DashboardProjectsController::class, 'HighProjects'])->name('projects.high');
    Route::get('/dashboard/projects/medium', [DashboardProjectsController::class, 'MediumProjects'])->name('projects.medium');
    Route::get('/dashboard/projects/low', [DashboardProjectsController::class, 'LowProjects'])->name('projects.low');
    Route::get('/dashboard/projects/pending', [DashboardProjectsController::class, 'PendingProjects'])->name('projects.pending');

    Route::get('/dashboard/projects/store/status/{projectId}', [StatusController::class, 'index'])->name('status.index');
    Route::get('/dashboard/projects/store/history/{projectId}', [StatusController::class, 'history'])->name('status.history');
    Route::get('/dashboard/projects/{id}/store/status/create', [StatusController::class, 'create'])->name('status.create');
    Route::post('/dashboard/projects/status/store/create', [StatusController::class, 'store'])->name('status.store');
    Route::get('/dashboard/projects/status/show/{id}', [StatusController::class, 'show'])->name('status.show');
    Route::get('/dashboard/projects/{project}/status/{status}/edit', [StatusController::class, 'edit'])->name('status.edit');
    Route::get('/dashboard/projects/{project}/status/{status}/delete', [StatusController::class, 'destroy'])->name('status.delete');
    Route::put('/dashboard/projects/{project}/status/{status}', [StatusController::class, 'update'])->name('status.update');

    Route::get('/dashboard/projects/show/add_user/{projects}', [UserAddController::class, 'add'])->name('projects.add_user');
    Route::get('/dashboard/projects/show/show_user/{user}', [UserAddController::class, 'show'])->name('projects.add_user_show');
    Route::post('/dashboard/projects/{projects}/show/add_user/store', [UserAddController::class, 'store'])->name('projects.add_user_store');
    Route::delete('/dashboard/projects/{projects}/delete-user/{user}', [UserAddController::class, 'removeUser'])->name('projects.add_user_delete');
    Route::delete('/dashboard/projects/{projects}/leave-user/{user}', [UserAddController::class, 'leaveUser'])->name('projects.add_user_leave');

    Route::get('/dashboard/projects/show/add_vendor/{projects}', [VendorAddController::class, 'add'])->name('projects.add_vendor');
    Route::post('/dashboard/projects/{projects}/show/add_vendor/store', [VendorAddController::class, 'store'])->name('projects.add_vendor_store');
    Route::delete('/dashboard/projects/{projects}/delete-vendor/{vendor}', [VendorAddController::class, 'removeVendor'])->name('projects.add_vendor_delete');
});
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard/profile/change-password', [UserProfileController::class, 'showChangePasswordForm'])->name('profile.show-change-password');
Route::post('/dashboard/profile/change-password', [UserProfileController::class, 'changePassword'])->name('profile.change-password');


