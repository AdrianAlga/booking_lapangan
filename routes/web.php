<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisController;
use App\Http\Controllers\User\FieldController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTimeController;
use App\Http\Controllers\Admin\AdminFieldController;
use App\Http\Controllers\Admin\AdminBookingController;

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


// Route::get('/login', fn () => view('login'))->name('login');
// Route::get('/register', fn () => view('regis'))->name('register');
// Route::get('/field', fn()=> view('user.field'))->name('field');
// Route::get('/booking', fn()=> view('user.booking'))->name('booking');
// Route::get('/profile', fn()=> view('user.profile'))->name('profile');


// Route::get('/admin/field', fn()=> view('admin.field.index'))->name('admin.field.index');
// Route::get('/admin/field/create', fn()=> view('admin.field.create'))->name('admin.field.create');
// Route::get('/admin/field/edit', fn()=> view('admin.field.edit'))->name('admin.field.edit');
// Route::get('/admin/field/show', fn()=> view('admin.field.show'))->name('admin.field.show');

// Route::get('/admin/time', fn()=> view('admin.time'))->name('admin.time');
// Route::get('/admin/category', fn()=> view("admin.category.index"))->name('admin.category');

// Route::get('/admin/time', fn()=> view('admin.time'))->name('admin.time');
// Route::get('/admin/category', fn()=> view("admin.category.index"))->name('admin.category');

// Route::get('/admin/booking', fn()=> view('admin.booking.index'))->name('admin.booking.index');
// Route::get('/admin/booking/show', fn()=> view('admin.booking.show'))->name('admin.booking.show');

// Route::get('/admin/booking/field', fn()=> view('admin.booking.show_field'))->name('admin.booking.show_field');
// Route::get('/admin/booking/field/date', fn()=> view('admin.booking.show_date'))->name('admin.booking.show_date');
Route::get('/', fn () => redirect()->route('field'))->name('home')->middleware(['auth', 'user']);

Route::controller(LoginRegisController::class)->group(function () {
    Route::get('login', 'loginView')->name('login')->middleware('guest');
    Route::post('login', 'loginProcess')->name('loginProcess')->middleware('guest');
    Route::get('logout', 'logout')->name('logout')->middleware('auth');
    Route::get('regis', 'regisView')->name('regis')->middleware('guest');
    Route::post('regis', 'regisProcess')->name('regisProcess')->middleware('guest');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('field', [FieldController::class, 'index'])->name('field');
    Route::get('booking/{field}', [BookingController::class, 'index'])->name('booking');
    Route::post('booking', [BookingController::class, 'storeBooking'])->name('booking.store');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('profile/confirm/{booking}', [ProfileController::class, 'confirmPayment'])->name('profile.confirm');
    Route::delete('profile/{booking}', [ProfileController::class, 'destroyBooking'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('field', AdminFieldController::class)->names('admin.field');
        Route::resource('time', AdminTimeController::class)->except(["create", "edit", "show"])->names('admin.time');
        Route::resource('category', AdminCategoryController::class)->except(["create", "edit", "show"])->names('admin.category');
        Route::resource('booking', AdminBookingController::class)->only(["index", "show", "update", "destroy"])->names('admin.booking');
        Route::get('booking/field', [AdminBookingController::class, "show_field"])->name('admin.booking.show_field');
        Route::get('booking/{field}/date', [AdminBookingController::class, "show_date"])->name('admin.booking.show_date');
    });
});
