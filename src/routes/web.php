<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\MypageController;

/*|--------------------------------------------------------------------------
|  Web Routes
//|--------------------------------------------------------------------------*/

// メール認証案内ページ
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 認証リンククリック後
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mypage/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 認証メール再送
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//プロフィール
Route::middleware('auth')->group(function () {
    Route::get('/mypage',[MypageController::class, 'index'])
        ->name('mypage.index');
    Route::get('/mypage/profile', [MypageController::class, 'profile'])
        ->name('mypage.profile');
    Route::get('/mypage/profile/edit', [MypageController::class, 'edit'])
        ->name('mypage.edit');
    Route::post('/mypage/profile', [MypageController::class, 'update'])
        ->name('mypage.update');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

});
// ===============================//
// 未ログインでも見られる//
// ===============================
Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

// ===============================//
// ログイン必須（いいね / コメント / 購入）
// ===============================
Route::middleware(['auth', 'verified'])->group(function () {

    // -------------------------
    // 購入フロー
    // -------------------------
    Route::get('/items/{item}/purchase', [PurchaseController::class, 'show'])
        ->name('purchase.show');
    Route::post('/purchase/complete/{item}', [PurchaseController::class, 'complete'])
        ->name('purchase.complete');
    Route::get('/purchase/address/edit/{item}', [PurchaseController::class, 'addressEdit'])
        ->name('purchase.address.edit');
    Route::post('/purchase/address/update', [PurchaseController::class, 'addressUpdate'])
        ->name('purchase.address.update');

    // -------------------------
    // コメント
    // -------------------------
    Route::post('/items/{item}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    // -------------------------
    // いいね
    // -------------------------
    Route::post('/items/{item}/like', [LikeController::class, 'store'])
        ->name('items.like');
    Route::delete('/items/{item}/like', [LikeController::class, 'destroy'])
        ->name('items.unlike');
});