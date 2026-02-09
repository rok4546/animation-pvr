<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AnimeCollectionController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\SettingsController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/page/{slug}', [HomeController::class, 'page'])->name('page');

// Products Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product}/review', [ProductController::class, 'addReview'])->name('products.review');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// User Account Routes
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/password', [UserController::class, 'updatePassword'])->name('password.update');
    
    Route::get('/orders', [UserController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [UserController::class, 'orderDetails'])->name('order.details');
    
    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/{product}', [UserController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/{id}', [UserController::class, 'removeFromWishlist'])->name('wishlist.remove');
    
    Route::get('/addresses', [UserController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [UserController::class, 'storeAddress'])->name('addresses.store');
    Route::delete('/addresses/{id}', [UserController::class, 'deleteAddress'])->name('addresses.delete');
});

// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'view'])->name('view');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::post('/update/{product_id}', [CartController::class, 'update'])->name('update');
    Route::post('/remove/{product_id}', [CartController::class, 'remove'])->name('remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('process');
    Route::get('/confirmation/{order_id}', [CartController::class, 'confirmation'])->name('confirmation');
});

Route::get('/order-confirmation/{order}', [CartController::class, 'confirmation'])->name('order.confirmation');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Products Management
        Route::resource('products', AdminProductController::class);

        // Categories Management
        Route::resource('categories', CategoryController::class);

        // Orders Management
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::put('/orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');
        Route::put('/orders/{order}/tracking', [OrderController::class, 'updateTracking'])->name('orders.updateTracking');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

        // Pages Management
        Route::resource('pages', PageController::class);

        // Anime Collections Management
        Route::resource('anime-collections', AnimeCollectionController::class);

        // Banners Management
        Route::resource('banners', BannerController::class);
        Route::post('/banners/reorder', [BannerController::class, 'reorder'])->name('banners.reorder');

        // Coupons Management
        Route::resource('coupons', CouponController::class);
        Route::post('/coupons/generate-code', [CouponController::class, 'generateCode'])->name('coupons.generate-code');

        // Testimonials Management
        Route::resource('testimonials', TestimonialController::class);
        Route::post('/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
        Route::post('/testimonials/{testimonial}/feature', [TestimonialController::class, 'toggleFeatured'])->name('testimonials.feature');

        // Newsletter Management
        Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
        Route::delete('/newsletter/{newsletter}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');
        Route::get('/newsletter/export', [NewsletterController::class, 'export'])->name('newsletter.export');

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/sales', [DashboardController::class, 'salesReport'])->name('sales');
            Route::get('/products', [DashboardController::class, 'productsReport'])->name('products');
            Route::get('/customers', [DashboardController::class, 'customersReport'])->name('customers');
            Route::get('/inventory', [DashboardController::class, 'inventoryReport'])->name('inventory');
        });

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/general', [SettingsController::class, 'general'])->name('general');
            Route::post('/general', [SettingsController::class, 'updateGeneral'])->name('general.update');
            
            Route::get('/shipping', [SettingsController::class, 'shipping'])->name('shipping');
            Route::post('/shipping', [SettingsController::class, 'updateShipping'])->name('shipping.update');
            
            Route::get('/payment', [SettingsController::class, 'payment'])->name('payment');
            Route::post('/payment', [SettingsController::class, 'updatePayment'])->name('payment.update');
            
            Route::get('/seo', [SettingsController::class, 'seo'])->name('seo');
            Route::post('/seo', [SettingsController::class, 'updateSeo'])->name('seo.update');
        });
    });
});

