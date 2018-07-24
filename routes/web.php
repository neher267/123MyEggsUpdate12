<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'PublicController@index');
Route::get('contact-us', 'PublicController@contact_us');
Route::get('about-us', 'PublicController@about_us');
Route::get('all-gifts', 'PublicController@gifts');
Route::get('all-gifts/{gift}', 'PublicController@gift_details');
Route::get('/{category}/types','PublicController@category_types');
Route::get('{product}/packages', 'PublicController@product_packages');
Route::get('details','PublicController@details');
Route::get('popular-packages','PublicController@popular_packages');

Route::get('language/{locale}', 'PublicController@language_change');

Route::post('logout', 'Auth\SentinelLoginController@logout')->middleware('sentinel.auth');


Route::group(['namespace'=>'Auth', 'middleware'=>['guest']], function(){
	Route::post('login','SentinelLoginController@post_login');
	Route::get('login','SentinelLoginController@login');
});

Route::group(['middleware'=>['sentinel.auth']], function(){
	Route::resource('purchases','PurchaseController');
	Route::get('my-purchases', 'PurchaseController@individualIndex');
});

Route::group(['middleware'=>['sentinel.auth', 'customer']], function(){
	Route::resource('checkout','CheckoutController');
});

Route::group(['namespace'=>'Auth', 'middleware'=>['sentinel.auth']], function(){
	Route::get('dashboard','DashboardController@index');
	Route::get('profile','ProfileController@index');	
});

Route::group(['middleware'=>['sentinel.auth','buyer']], function(){
	Route::resource('packages','PackageController');
	Route::resource('trets','TretController');
	Route::resource('register','Auth\SentinelRegisterController');	
});

Route::group(['namespace'=>'Settings', 'middleware'=>['sentinel.auth']], function(){
	Route::resource('areas','AreaController');
	Route::resource('branches','BranchController');
	Route::resource('categories','CategoryController');

	//category image
	Route::get('categories/{category}/images', 'CategoryImageController@index')->name('category.images.index');
	Route::post('categories/{category}/images', 'CategoryImageController@store')->name('category.images.store');
	Route::get('categories/{category}/images/create', 'CategoryImageController@create')->name('category.images.create');
	//Route::get('categories/{category}/images/{image_id}/edit', 'CategoryImageController@edit')->name('category.images.edit');

	Route::PUT('categories/{category}/images/{image}', 'CategoryImageController@update')->name('category.images.update');
	
	Route::DELETE('categories/{category}/images/{image_id}', 'CategoryImageController@destroy')->name('category.images.destroy');

	/*Route::get('categories/{category}/images/{image_id}/active', 'CategoryImageController@active')->name('category.images.active');
	Route::PUT('categories/{category}/images/{image_id}/dactive', 'CategoryImageController@dactive')->name('category.images.dactive');*/


	//end category image

	Route::resource('departments','DepartmentController');
	Route::resource('districts','DistrictController');
	Route::resource('roles','RoleController');
	Route::resource('gifts','GiftController');

	// gift image
	Route::get('gifts/{gift}/images', 'GiftImageController@index')->name('gift.images.index');
	Route::post('gifts/{gift}/images', 'GiftImageController@store')->name('gift.images.store');
	Route::get('gifts/{gift}/images/create', 'GiftImageController@create')->name('gift.images.create');
	Route::get('gifts/{gift}/images/{image_id}/edit', 'GiftImageController@edit')->name('gift.images.edit');
	Route::PUT('gifts/{gift}/images/{image_id}', 'GiftImageController@update')->name('gift.images.update');
	Route::DELETE('gifts/{gift}/images/{image_id}', 'GiftImageController@destroy')->name('gift.images.destroy');
	//end gift image
	
});

Route::group(['namespace'=>'Hr', 'middleware'=>['sentinel.auth']], function(){
	Route::resource('stock','StockController');
	Route::resource('trets','TretController');
	Route::resource('avatar','ImageController');
	//expense
	Route::resource('expenses','ExpenseController');
	Route::get('my-expenses', 'ExpenseController@individualIndex');
	//end expense
	Route::resource('products','ProductController');	
	//Product Image
	Route::get('products/{product}/images', 'ProductImageController@index')->name('product.images.index');
	Route::post('products/{product}/images', 'ProductImageController@store')->name('product.images.store');
	Route::get('products/{product}/images/create', 'ProductImageController@create')->name('product.images.create');
	Route::get('products/{product_id}/images/{image_id}/edit', 'ProductImageController@edit')->name('product.images.edit');
	Route::PUT('products/{product}/images/{image}', 'ProductImageController@update')->name('product.images.update');
	Route::DELETE('products/{product_id}/images/{image_id}', 'ProductImageController@destroy')->name('product.images.destroy');
	//end product image	
	//product package
	Route::get('products/{product}/packages', 'ProductPackageController@packages')->name('product.packages');
	Route::get('products/{product}/packages/create','ProductPackageController@create')->name('product.packages.create');
	Route::get('products/{product}/packages/{package}/edit','ProductPackageController@edit')->name('product.packages.edit');
	Route::post('products/{product}/packages', 'ProductPackageController@store')->name('product.packages.store');
	Route::PUT('products/{product}/packages/{package}', 'ProductPackageController@update')->name('product.packages.update');
	Route::DELETE('products/{product}/packages/{package}', 'ProductPackageController@destroy')->name('product.packages.destroy');
	//end product package
	//product package image
	Route::get('products/{product_id}/packages/{package}/images', 'ProductPackageImageController@index')->name('product.package.images.index');
	Route::get('products/{product_id}/packages/{package}/images/create', 'ProductPackageImageController@create')->name('product.package.images.create');
	Route::post('products/{product_id}/packages/{package}/images', 'ProductPackageImageController@store')->name('product.package.images.store');
	Route::get('products/{product_id}/packages/{package}/images/{image_id}/edit', 'ProductPackageImageController@edit')->name('product.package.images.edit');
	Route::PUT('products/{product_id}/packages/{package}/images/{image_id}', 'ProductPackageImageController@update')->name('product.package.images.update');
	Route::DELETE('products/{product_id}/packages/{package}/images/{image_id}', 'ProductPackageImageController@destroy')->name('product.package.images.destroy');
	//end product package image	
});

Route::get('{title}/{package}', 'PublicController@package_details');



