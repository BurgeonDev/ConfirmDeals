<?php


use App\Http\Controllers\AdController;
use App\Http\Controllers\Frontend\AdsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Frontend\DashboardController as FrontendDashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EasypayController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\NewsletterAdminController;
use App\Http\Controllers\EasypaisaController;
use App\Http\Controllers\JazzCashController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', function () {
        return view('frontend.about.index');
    })->name('about');
    Route::get('/faq', function () {
        return view('frontend.faq.index');
    })->name('faq');
    Route::get('/pricing', function () {
        return view('frontend.pricing.index');
    })->name('pricing');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');


    Route::resource('/home', HomeController::class);






    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('countries', CountryController::class);
        Route::resource('cities', CityController::class);
        Route::resource('localities', LocalityController::class);
        Route::resource('professions', ProfessionController::class);
        Route::resource('coins', CoinController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('ads', AdController::class);
        Route::resource('user/ad', AdsController::class);
        Route::resource('user/dashboard', FrontendDashboardController::class);
        Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');
        Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');



        // Routes: web.php
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Bid Routes
        Route::middleware('auth')->group(function () {
            Route::post('/bids/{adId}/place', [BidController::class, 'placeBid'])->name('bids.place');
            Route::post('/bids/{bidId}/accept', [BidController::class, 'acceptBid'])->name('bids.accept');
            Route::post('/bids/{bidId}/reject', [BidController::class, 'rejectBid'])->name('bids.reject');
            Route::get('/bids', [BidController::class, 'showAllBids'])->name('bids.index');
            Route::get('/my-bids', [BidController::class, 'showMyBids'])->name('bids.myBids');
        });

        // Feedback Routes
        Route::post('/ads/{ad}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::post('/feedback/{feedback}/response', [FeedbackController::class, 'storeResponse'])->name('feedback.response');

        Route::middleware(['auth'])->group(function () {
            Route::post('/report', [ReportController::class, 'store'])->name('report.store');
            Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
            Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
        });



        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.userManagement');
        Route::post('/admin/users/{id}/assign-role', [UserController::class, 'assignRole'])->name('admin.assignRole');
        Route::get('/admin/roles/create', [UserController::class, 'createRole'])->name('admin.roles.create');
        Route::post('/admin/roles/store', [UserController::class, 'storeRole'])->name('admin.roles.store');
        Route::get('/admin/roles', [UserController::class, 'listRoles'])->name('admin.roles.index');
        Route::get('/admin/roles/{id}/edit', [UserController::class, 'editRole'])->name('admin.roles.edit');
        Route::patch('/admin/roles/{id}', [UserController::class, 'updateRole'])->name('admin.roles.update');
        Route::delete('/admin/roles/{id}', [UserController::class, 'destroyRole'])->name('admin.roles.destroy');
        Route::patch('/admin/users/{id}/toggle', [UserController::class, 'toggleUserStatus'])->name('admin.toggleUserStatus');

        Route::get('/category', [CategoryController::class, 'cat'])->name('categories.cat');
        Route::patch('/ads/{ad}/toggle-verified', [AdController::class, 'toggleVerifiedStatus'])->name('ads.toggleVerifiedStatus');

        Route::get('/get-coin-price-and-balance', [AdController::class, 'getCoinPriceAndBalance']);


        Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/user/profile/edit', [UserProfileController::class, 'edit'])->name('userProfile.edit');
        Route::post('user/profile/update', [UserProfileController::class, 'update'])->name('userProfile.update');
        Route::delete('user/profile/delete', [UserProfileController::class, 'destroy'])->name('userProfile.delete');

        Route::get('/profile/{user}', [UserProfileController::class, 'publicProfile'])->name('profile.public');
    });
    Route::middleware(['auth'])->group(function () {
        Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    });
    Route::get('/get-cities/{countryId}', [UserProfileController::class, 'getCities'])->name('getCities');
    Route::get('/get-localities/{cityId}', [UserProfileController::class, 'getLocalities'])->name('getLocalities');


    Route::get('/category', [CategoryController::class, 'cat'])->name('categories.cat');
    Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('social.callback');

    ////////////////newletter
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
    Route::get('/newsletters', [NewsletterAdminController::class, 'index'])->name('admin.newsletters.index');
    Route::delete('/newsletters/{id}', [NewsletterAdminController::class, 'destroy'])->name('admin.newsletters.destroy');
    Route::post('/newsletters/send', [NewsletterAdminController::class, 'sendNewsletter'])->name('admin.newsletters.send');

    ////////////////////payments
    Route::get('/paymentsway', function (Illuminate\Http\Request $request) {
        $price = $request->input('price');
        $packageName = $request->input('packageName');

        return view('frontend.pricing.paymentway', compact('price', 'packageName'));
    })->name('paymentsway');
    Route::post('/jazzcash', [JazzCashController::class, 'processPayment'])->name('jazzcash');
    Route::get('/jazzcash/callback', [JazzCashController::class, 'handleCallback'])->name('jazzcash.callback');
    Route::post('/easypaisa', [EasypaisaController::class, 'makePayment'])->name('easypaisa');
    Route::post('/easypaisa/callback', [EasypaisaController::class, 'easypasahandleCallback'])->name('easypaisa.callback');
});
require __DIR__ . '/auth.php';
