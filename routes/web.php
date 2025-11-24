<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas públicas
Route::get('/productos', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/productos/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/categoria/{slug}', [App\Http\Controllers\ProductController::class, 'category'])->name('products.category');
Route::get('/marca/{slug}', [App\Http\Controllers\ProductController::class, 'brand'])->name('products.brand');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // Rutas de administración
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    });
});
