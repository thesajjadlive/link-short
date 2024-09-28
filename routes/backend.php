<?php
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::resource( 'roles', RoleController::class );
Route::resource( 'users', UserController::class );

Route::get('profile', [UserController::class,'profile'])->name('user.profile');
Route::put('profile/{id}', [UserController::class,'profile_update'])->name('user.profile_update');

/* Setting routes */
Route::group( ['prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::get( 'general', [SettingController::class, 'index'] )->name( 'general.index' );
    Route::patch( 'general', [SettingController::class, 'update'] )->name( 'general.update' );

    Route::get( 'appearance', [SettingController::class, 'appearance'] )->name( 'appearance.index' );
    Route::patch( 'appearance', [SettingController::class, 'appearanceUpdate'] )->name( 'appearance.update' );

    Route::get( 'privacy', [SettingController::class, 'privacy'] )->name( 'privacy.index' );
    Route::patch( 'privacy', [SettingController::class, 'privacyUpdate'] )->name( 'privacy.update' );

    Route::get( 'term', [SettingController::class, 'term'] )->name( 'term.index' );
    Route::patch( 'term', [SettingController::class, 'termUpdate'] )->name( 'term.update' );

    Route::get( 'about', [SettingController::class, 'about'] )->name( 'about.index' );
    Route::patch( 'about', [SettingController::class, 'aboutUpdate'] )->name( 'about.update' );
} );
