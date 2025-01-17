<?php


use App\Http\Controllers\AdController;
use App\Http\Controllers\Admin\AppConfigController;
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
use App\Http\Controllers\PricingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



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
    Route::get('/terms&conditions', function () {
        return view('frontend.terms.terms');
    })->name('terms');
    Route::get('/policies', function () {
        return view('frontend.terms.policy');
    })->name('policies');
    Route::get('/email/verify', function () {
        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            return view('auth.verify-email');
        }
        return redirect()->route('home');
    })->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::resource('/home', HomeController::class);
    Route::middleware(['auth', 'verified'])->group(function () {
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
        Route::get('config', [AppConfigController::class, 'index'])->name('admin.config.index');
        Route::post('config', [AppConfigController::class, 'update'])->name('admin.config.update');

        ///////////////////////////ad featured
        Route::post('/ad/{id}/feature', [AdsController::class, 'featureAd'])->name('ad.feature');
        Route::post('/ad/{id}/update-feature', [AdsController::class, 'updateFeatureAd'])->name('ad.updateFeature');
        Route::get('/featured-ads', [AdsController::class, 'showFeaturedAds'])->name('ad.featured');
        // Route for un-featuring an ad
        Route::post('/ad/{id}/unfeature', [AdsController::class, 'unfeature'])->name('ad.unfeature');

        //////////////biding
        Route::get('/deal-page', [BidController::class, 'dealPage'])->name('deal.page');
        Route::post('/bids/{bidId}/pay', [PaymentController::class, 'pay'])->name('payment.pay');

        Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');
        Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/report', [ReportController::class, 'store'])->name('report.store');
        Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
        Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
        Route::post('/bids/{adId}/place', [BidController::class, 'placeBid'])->name('bids.place');
        Route::post('/bids/{bidId}/accept', [BidController::class, 'acceptBid'])->name('bids.accept');
        Route::post('/bids/{bidId}/reject', [BidController::class, 'rejectBid'])->name('bids.reject');
        Route::get('/bids', [BidController::class, 'showAllBids'])->name('bids.index');
        Route::get('/user/bids', [BidController::class, 'showMyBids'])->name('bids.myBids');
        Route::post('/ads/{ad}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::post('/feedback/{feedback}/response', [FeedbackController::class, 'storeResponse'])->name('feedback.response');
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.userManagement');
        Route::post('/admin/users/{id}/assign-role', [UserController::class, 'assignRole'])->name('admin.assignRole');
        Route::get('/admin/roles/create', [UserController::class, 'createRole'])->name('admin.roles.create');
        Route::post('/admin/roles/store', [UserController::class, 'storeRole'])->name('admin.roles.store');
        Route::get('/admin/roles', [UserController::class, 'listRoles'])->name('admin.roles.index');
        Route::get('/admin/roles/{id}/edit', [UserController::class, 'editRole'])->name('admin.roles.edit');
        Route::patch('/admin/roles/{id}', [UserController::class, 'updateRole'])->name('admin.roles.update');
        Route::delete('/admin/roles/{id}', [UserController::class, 'destroyRole'])->name('admin.roles.destroy');
        Route::patch('/admin/users/{id}/toggle', [UserController::class, 'toggleUserStatus'])->name('admin.toggleUserStatus');

        Route::patch('/ads/{ad}/toggle-verified', [AdController::class, 'toggleVerifiedStatus'])->name('ads.toggleVerifiedStatus');
        Route::get('/get-coin-price-and-balance', [AdController::class, 'getCoinPriceAndBalance']);
        Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
        Route::get('/user/profile/edit', [UserProfileController::class, 'edit'])->name('userProfile.edit');
        Route::post('user/profile/update', [UserProfileController::class, 'update'])->name('userProfile.update');
        Route::post('/user/profile/update-password', [UserProfileController::class, 'updatePassword'])->name('userProfile.updatePassword');
        Route::delete('user/profile/delete', [UserProfileController::class, 'destroy'])->name('userProfile.delete');
        Route::get('/profile/{user}', [UserProfileController::class, 'publicProfile'])->name('profile.public');
        Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
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
        Route::get('/user/transactions', [EasypayController::class, 'index'])->name('transactions.index');
        Route::delete('/transactions/{id}', [EasypayController::class, 'destroy'])->name('transactions.destroy');
        Route::post('/easypaisa/callback', [EasypaisaController::class, 'easypasahandleCallback'])->name('easypaisa.callback');
    });

    Route::get('/get-cities/{countryId}', [UserProfileController::class, 'getCities'])->name('getCities');
    Route::get('/get-localities/{cityId}', [UserProfileController::class, 'getLocalities'])->name('getLocalities');


    Route::get('/all-ad', [CategoryController::class, 'cat'])->name('categories.cat');
    Route::get('/all-ads', [CategoryController::class, 'catt'])->name('categoriess');

    Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('social.callback');
});
require __DIR__ . '/auth.php';
