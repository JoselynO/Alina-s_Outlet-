<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Mail\MailableController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\GeneradorController;
use \App\Http\Controllers\OrdersController;

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

Route::get('/', function () {
    $categories = Category::all();
    return view('index')->with('categories', $categories);
})->name('principal');



Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'showCart'])->name('cart')->middleware(['auth']);
    Route::put('/', [CartController::class, 'updateCartLine'])->name('cart.update')->middleware(['auth']);
    Route::delete('/', [CartController::class, 'destroyCartLine'])->name('cart.destroy')->middleware(['auth']);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/shopby/{sex}', [ProductsController::class, 'getProductsBySex'])->name('products.bysex');
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductsController::class, 'create'])->name('products.create')->middleware(['auth', 'admin']);
    Route::post('/', [ProductsController::class, 'store'])->name('products.store')->middleware(['auth','admin']);
    Route::get('/{product}', [ProductsController::class, 'show'])->name('products.show');
    Route::post('/{product}', [ProductsController::class, 'addToCart'])->name('addToCart')->middleware(['auth']);
    Route::get('/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit')->middleware(['auth','admin']);
    Route::put('/{product}', [ProductsController::class, 'update'])->name('products.update')->middleware(['auth','admin']);
    Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('products.destroy')->middleware(['auth','admin']);
    Route::get('/{product}/edit-image', [ProductsController::class, 'editImage'])->name('products.editImage')->middleware(['auth','admin']);
    Route::patch('/{product}/edit-image', [ProductsController::class, 'updateImage'])->name('products.updateImage')->middleware(['auth','admin']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.index')->middleware(['auth', 'admin']);
    Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create')->middleware(['auth', 'admin']);
    Route::post('/', [CategoriesController::class, 'store'])->name('categories.store')->middleware(['auth','admin']);
    Route::get('/{category}', [CategoriesController::class, 'show'])->name('categories.show');
    Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit')->middleware(['auth','admin']);
    Route::put('/{category}', [CategoriesController::class, 'update'])->name('categories.update')->middleware(['auth','admin']);
    Route::delete('/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy')->middleware(['auth','admin']);
    Route::get('/{category}/edit-image', [CategoriesController::class, 'editImage'])->name('categories.editImage')->middleware(['auth','admin']);
    Route::patch('/{category}/edit-image', [CategoriesController::class, 'updateImage'])->name('categories.updateImage')->middleware(['auth','admin']);
});

Route::group(['prefix' => 'gestion'], function () {
    Route::get('/products', [ProductsController::class, 'products'])->name('gestion.products')->middleware(['auth', 'admin']);
    Route::get('/categories', [CategoriesController::class, 'categories'])->name('gestion.categories')->middleware(['auth', 'admin']);

});

Route::get('/payment', [CartController::class, 'payment'])->name('payment')->middleware(['auth']);
Route::name('print')->get('/imprimir', [OrdersController::class, 'generateInvoice'])->name('generate_invoice')->middleware(['auth']);
Route::get('/about', function () { return view('about'); })->name('about');
Route::post('/payment', [OrdersController::class, 'createOrder'])->name('order_process')->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

