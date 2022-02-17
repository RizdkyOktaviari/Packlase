<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
//
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Auth::routes(['verify' => true]);



//route admin
Route::middleware(['auth'])->group(function () {
  Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    //route Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Route-JenisLayanan
    Route::get('/JenisLayanan', [App\Http\Controllers\Admin\JenisLayananController::class, 'index'])->name('Home-JenisLayanan');
    Route::get('/JenisLayanan/edit/{id}', [App\Http\Controllers\Admin\JenisLayananController::class, 'edit'])->name('Edit-JenisLayanan');
    Route::post('/JenisLayanan/update/{id}', [App\Http\Controllers\Admin\JenisLayananController::class, 'update'])->name('Update-JenisLayanan');

    //Route-Layanan
    Route::get('/Layanan', [App\Http\Controllers\Admin\LayananController::class, 'index'])->name('Home-Layanan');
    Route::get('/Layanan/create', [App\Http\Controllers\Admin\LayananController::class, 'create'])->name('Create-Layanan');
    Route::post('/Layanan/store', [App\Http\Controllers\Admin\LayananController::class, 'store'])->name('Store-Layanan');
    Route::get('/Layanan/edit/{id}', [App\Http\Controllers\Admin\LayananController::class, 'edit'])->name('Edit-Layanan');
    Route::post('/Layanan/update/{id}', [App\Http\Controllers\Admin\LayananController::class, 'update'])->name('Update-Layanan');
    Route::get('/Layanan/trash/{id}', [App\Http\Controllers\Admin\LayananController::class, 'trash'])->name('Trash-Layanan');
    Route::get('/Layanan/trashed', [App\Http\Controllers\Admin\LayananController::class, 'trashed'])->name('Trashed-Layanan');
    Route::get('/Layanan/restore/{id}', [App\Http\Controllers\Admin\LayananController::class, 'restore'])->name('Restore-Layanan');
    Route::get('/Layanan/delete/{id}', [App\Http\Controllers\Admin\LayananController::class, 'delete'])->name('Delete-Layanan');
    Route::delete('/Layanan/delete/image', [App\Http\Controllers\Admin\LayananController::class, 'deleteImage'])->name('delete-image');

    //route User
    Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('index-user');
    Route::get('/users/delete/{id}', [App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('delete-user');

    //route Voucher
    Route::get('/voucher', [App\Http\Controllers\Admin\VoucherController::class, 'index'])->name('index-voucher');
    Route::get('/voucher/changeStatus', [App\Http\Controllers\Admin\VoucherController::class, 'changeStatus'])->name('ubahStatus');
    Route::get('/voucher/create', [App\Http\Controllers\Admin\VoucherController::class, 'create'])->name('create-voucher');
    Route::post('/voucher/store', [App\Http\Controllers\Admin\VoucherController::class, 'store'])->name('store-voucher');
    Route::post('/voucher/update/{id}', [App\Http\Controllers\Admin\VoucherController::class, 'update'])->name('update-voucher');
    Route::get('/voucher/delete/{id}', [App\Http\Controllers\Admin\VoucherController::class, 'delete'])->name('delete-voucher');

    //route Komentar
    Route::get('/komentar', [App\Http\Controllers\Admin\KomentarController::class, 'index'])->name('index-komentar');
    Route::post('/komentar/balas', [App\Http\Controllers\Admin\KomentarController::class, 'reply'])->name('reply-komentar');
    Route::get('/komentar/delete/{id}', [App\Http\Controllers\Admin\KomentarController::class, 'delete'])->name('delete-komentar');

    //route Transaksi
    Route::get('/transaksi', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('index-transaksi');
    Route::get('/transaksi/layanan/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'jenisTransaction'])->name('jenisTransaction-transaksi');
    Route::get('/transaksi/detail/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'detail'])->name('detail-transaksi');
    Route::post('/transaksi/laporan', [App\Http\Controllers\Admin\TransactionController::class, 'report'])->name('report-transaksi');
    Route::post('/transaksi/status', [App\Http\Controllers\Admin\TransactionController::class, 'status'])->name('status-transaksi');
    Route::get('/transaksi/trash/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'trash'])->name('trash-transaksi');
    Route::get('/transaksi/trashed', [App\Http\Controllers\Admin\TransactionController::class, 'trashed'])->name('trashed-transaksi');
    Route::get('/transaksi/restore/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'restore'])->name('restore-transaksi');
    Route::get('/transaksi/delete/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'delete'])->name('delete-transaksi');
  });

  //Route Khusus User
  Route::get('/profile', App\Http\Livewire\Profile::class)->name('profile');
  Route::get('/profile/setting', App\Http\Livewire\SettingUser::class)->name('setting-user');
  Route::get('/profile/riwayat-transaksi', [App\Http\Controllers\Users\TransactionHistoryController::class, 'index'])->name('riwayat-transaksi');
  Route::get('/profile/detail-riwayat-transaksi/{id}', [App\Http\Controllers\Users\TransactionHistoryController::class, 'detail'])->name('detail-riwayat-transaksi');
  Route::post('/laundry/rate', [App\Http\Controllers\Users\TransactionHistoryController::class, 'rateLayanan'])->name('rate-layanan');

  //Route Transaksi Layanan
  Route::get('/laundry-in-aja', App\Http\Livewire\Laundry::class)->name('laundry');
  Route::get('/bersihin-yuk', App\Http\Livewire\Bersih::class)->name('bersih');
  Route::get('/titipin-sini-aja', App\Http\Livewire\Titip::class)->name('titip');
  Route::get('/paketin-yuk', App\Http\Livewire\Paket::class)->name('paket');
});
//Route-User
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
//Route-contact_us
Route::get('/contact-us', [App\Http\Controllers\ContactController::class, 'contact_us'])->name('contact_us');
Route::post('/contact-us/post', [App\Http\Controllers\ContactController::class, 'post_contact'])->name('contact_us-post');

// Midtrans Related
Route::get('midtrans/success', [App\Http\Controllers\API\MidtransController::class, 'success']);
Route::get('midtrans/unfinish', [App\Http\Controllers\API\MidtransController::class, 'unfinish']);
Route::get('midtrans/error', [App\Http\Controllers\API\MidtransController::class, 'error']);

//layanan
// Route::get('/layanan-user', [App\Http\Controllers\User\LayanananUserController::class, 'index'])->name('Home-Layanan');

// Route Google-login
// Google login
Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@handleGoogleCallback');
