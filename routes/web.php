<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminFileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminSheduleController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAlertController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminCategoryController;

use App\Http\Controllers\TestController;
use App\Http\Controllers\DubleController;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Route::get('/lang/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/test', [TestController::class, 'index'])->name('index');
Route::get('/duble', [DubleController::class, 'index'])->name('index');


Route::get('/filter', [WelcomeController::class, 'filter'])->name('filter');
Route::get('/contact-us', 'App\Http\Controllers\Controller@contactus')->name('contactus');
Route::get('/faq', [Controller::class, 'faqs'])->name('faqs');
Route::get('/about-us', [Controller::class, 'aboutus'])->name('aboutus');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/delete-foto', [AdminEventController::class, 'deleteFoto'])->name('deleteFoto');

Route::get('/cities/{region}', 'EventController@getCitiesByRegion')->name('cities.by.region');
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home')); // Хлебные крошки для домашней страницы
});

Auth::routes();

Route::get('/', [WelcomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {

    Route::get('/restricted-access', function () {
        return view('restricted_access');
    })->name('restricted.access');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/home', [HomeController::class, 'index'])->name('home'); // Маршрут для домашней страницы

    Route::get('/partner', [HomeController::class, 'member'])->name('partner'); // Маршрут для страницы "Partner"
    Breadcrumbs::for('partner', function ($trail) {
        $trail->parent('home'); // Родительская хлебная крошка для домашней страницы
        $trail->push('Partner', route('partner')); // Текущая хлебная крошка "Partner"
    });

    Route::get('/client', [HomeController::class, 'member'])->name('member');
    Breadcrumbs::for('client', function ($trail) {
        $trail->parent('home'); // Родительская хлебная крошка для домашней страницы
        $trail->push('Client', route('member')); // Текущая хлебная крошка "Partner"
    });

    Route::get('/open/{id}', [HomeController::class, 'open'])->name('admin.open');
    Route::get('/open/{events_id}/lesson/{lesson_id}', [HomeController::class, 'openLesson'])->name('admin.openLesson');

    Route::get('/admin/alerts/count', [AdminAlertController::class, 'count'])->name('alerts.count');
    Route::get('/admin/get-orders-with-status', [AdminController::class, 'getOrdersWithStatus']);
    Route::get('/admin/get-order-details/{orderId}', [AdminController::class, 'getOrderDetails']);
    Route::get('/admin/update-order-status/{orderId}', [AdminController::class, 'updateOrderStatus']);

    Route::get('/admin/payments/all', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/admin/payments/create', [AdminPaymentController::class, 'create'])->name('admin.payments.create');
    Route::post('/admin/payments', [AdminPaymentController::class, 'store'])->name('admin.payments.store');

    Route::get('/admin/users/all', [AdminUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUsersController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/stats', [AdminUsersController::class, 'statistic'])->name('admin.users.statistic');
    Route::delete('/admin/users/destroy/{user}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/shedules/all', [AdminSheduleController::class, 'index'])->name('admin.shedules.index');
    Route::get('/admin/shedules/create', [AdminSheduleController::class, 'create'])->name('admin.shedules.create');
    Route::delete('/admin/shedules/{shedule}', [AdminSheduleController::class, 'destroy'])->name('admin.shedules.destroy');
    Route::post('/admin/shedules', [AdminSheduleController::class, 'store'])->name('admin.shedules.store');
    Route::get('/admin/shedules/settings', [AdminSheduleController::class, 'settings'])->name('admin.shedules.settings');

    Route::get('/admin/orders/all', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/admin/orders', [AdminOrderController::class, 'store'])->name('admin.orders.store');
    Route::get('/admin/orders/settings', [AdminOrderController::class, 'settings'])->name('admin.orders.settings');
    Route::get('/admin/orders/create', [AdminOrderController::class, 'create'])->name('admin.orders.create');
    Route::get('/admin/orders/stats', [AdminOrderController::class, 'statistic'])->name('admin.orders.statistic');

    Route::get('/admin/events/all', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::get('/admin/events/stats', [AdminEventController::class, 'statistic'])->name('admin.events.statistic');
    Route::get('/admin/events/settings', [AdminEventController::class, 'settings'])->name('admin.events.settings');
    Route::get('/admin/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/admin/events/st/{number}', [AdminEventController::class, 'searchTown'])->name('admin.events.searchTown')->withoutMiddleware(['auth']);
    Route::get('/admin/events/lesson/{id}', [AdminEventController::class, 'lesson'])->name('admin.events.lesson');
    Route::post('/admin/events/sl', [AdminEventController::class, 'lessonSaveData'])->name('admin.events.lessonSaveData');
    Route::post('/admin/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/admin/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/admin/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/admin/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
    Route::get('/admin/event/{id}', [AdminEventController::class, 'show'])->name('admin.events.show');
    Route::get('/admin/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/admin/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::post('/admin/events/upload-video', [AdminEventController::class, 'uploadVideo'])->name('admin.events.uploadVideo');
    Route::get('/admin/events/{id}/rl/{lesson}', [AdminEventController::class, 'redactLesson'])->name('admin.events.redactLesson');
    Route::post('/admin/events/{id}/rl/{lesson}/update', [AdminEventController::class, 'redactLessonUpdate'])->name('admin.events.redactLessonUpdate');
    Route::get('/category/{category}', [AdminCategoryController::class, 'getCategoryView']);
    Route::post('/admin/category/fetch-subcategory', [AdminCategoryController::class, 'fetchSubcategory']);
});

Route::post('/processReferral', [HomeController::class, 'processReferral'])->name('events.processReferral');

Route::get('/all', [EventController::class, 'all'])->name('all');
Route::get('/search', [WelcomeController::class, 'search'])->name('search');
Breadcrumbs::for('all', function ($trail) {
    $trail->parent('home'); // Родительская хлебная крошка для домашней страницы
    $trail->push('All', route('all')); // Текущая хлебная крошка "All"
});
Breadcrumbs::for('search', function ($trail) {
    $trail->parent('home'); // Родительская хлебная крошка для домашней страницы
    $trail->push('Search', route('search')); // Текущая хлебная крошка "All"
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
Route::get('/{id}', [EventController::class, 'show'])->name('events.show');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::post('/orders/store_no_reg', [OrderController::class, 'store_no_reg'])->name('orders.store_no_reg');


Route::post('/like', [EventController::class, 'handleLike']);
Route::post('/likeno', [EventController::class, 'handleLikeNo']);
Route::get('/load-more-events/{lastEventId}', [EventController::class, 'loadMoreEvents']);
//Route::get('/load-search-more-events/{lastEventId}', [WelcomeController::class, 'loadMoreEvents']);
Route::get('/load-search-more-events/{searchTerm}/{lastEventId}', [WelcomeController::class, 'loadMoreEvents'])->name('loadMoreEvents');





