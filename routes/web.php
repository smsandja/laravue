<?php
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//Page d'accueil
Route::get('/', 'ProductController@index')->name('products.index');
Route::get('/home', 'ProductController@index')->name('products.index');
Route::get('/commande', 'ProductController@commande')->name('products.commande');
/**Route::get('/commande', function () {
    return view('checkout.thankYou');
});*/


/* Product Routes */
Route::get('/Accueil', 'ProductController@index')->name('products.index');
Route::get('/detail/{slug}', 'ProductController@show')->name('products.show');
Route::get('/search', 'ProductController@search')->name('products.search');

/* Cart route*/
Route::group(['middleware' => ['auth']], function () {
Route::get('/panier', 'CartController@index')->name('cart.index');
Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');
Route::patch('/panier/{rowId}', 'CartController@update')->name('cart.update');
Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');
Route::post('/coupon', 'CartController@storeCoupon')->name('cart.store.coupon');
Route::delete('/coupon', 'CartController@destroyCoupon')->name('cart.destroy.coupon');
});



//voyager panel admin
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//checkout routes(paiement stripe)
Route::group(['middleware' => ['auth']], function () {
Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
Route::get('/merci', 'CheckoutController@thankYou')->name('checkout.thankYou');
});

//authentification
Auth::routes();

/*Route::get('/merci', function () {
    return view('checkout.thankYou');
});*/
//Route::get('/home', 'HomeController@index')->name('home');

