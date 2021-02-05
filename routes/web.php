<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/404','ErrsiteController@index');

// Вступительная страница
Route::get('/home', ['as' => 'home.index', 'uses' => 'HomeController@index', 'middleware' => ['permission:client-list']]);

/* Пользователи */
Route::get('/users', ['as' => 'users.index', 'uses' => 'UsersController@index', 'middleware' => ['permission:client-list']]);
Route::get('/showuser/{id}', ['as' => 'users.show', 'uses' => 'UsersController@show', 'middleware' => ['permission:client-list']]);
Route::get('/users/create', ['as' => 'users.create', 'uses' => 'UsersController@create', 'middleware' => ['permission:client-list']]);
Route::get('/deleteuser/{id}', ['as' => 'users.delete', 'uses' => 'UsersController@delete', 'middleware' => ['permission:client-list']]);
Route::get('/edituser/{id}', ['as' => 'users.edit', 'uses' => 'UsersController@edit', 'middleware' => ['permission:client-list']]);
Route::post('/updateuser/{id}', ['as' => 'users.update', 'uses' => 'UsersController@update', 'middleware' => ['permission:client-list']]);
Route::post('/registeruser/', ['as' => 'users.createuser', 'uses' => 'UsersController@createuser', 'middleware' => ['permission:client-list']]);

/* Группы прав */
Route::get('/permissions', ['as' => 'permissions.index', 'uses' => 'PermissionsController@index', 'middleware' => ['permission:client-list']]);
Route::get('/permissions/create', ['as' => 'permissions.create', 'uses' => 'PermissionsController@create', 'middleware' => ['permission:client-list']]);
Route::get('/permissions/edit/{id}', ['as' => 'permissions.create', 'uses' => 'PermissionsController@edit', 'middleware' => ['permission:client-list']]);
Route::post('/permissions/update/{id}', ['as' => 'permissions.update', 'uses' => 'PermissionsController@update', 'middleware' => ['permission:client-list']]);
Route::get('/permissions/delete/{id}', ['as' => 'permissions.delete', 'uses' => 'PermissionsController@delete', 'middleware' => ['permission:client-list']]);
Route::get('/permissions/show/{id}', ['as' => 'permissions.show', 'uses' => 'PermissionsController@show', 'middleware' => ['permission:client-list']]);
Route::post('/permissions/createperm', ['as' => 'permissions.createperm', 'uses' => 'PermissionsController@createperm', 'middleware' => ['permission:client-list']]);

Route::post('/permissions/get', ['as' => 'perms.get', 'uses' => 'PermissionsController@getPermissions']);
Route::post('/permissions/set', ['as' => 'perms.set', 'uses' => 'PermissionsController@setPermissions']);


/* Статусы */
Route::get('/statuses', ['as' => 'status.show', 'uses' => 'StatusesController@index', 'middleware' => ['permission:client-list']]);
Route::get('/statuses/showstatus/{id}', ['as' => 'status.showstatus', 'uses' => 'StatusesController@show', 'middleware' => ['permission:client-list']]);
Route::get('/statuses/status/create', ['as' => 'status.create', 'uses' => 'StatusesController@create', 'middleware' => ['permission:client-list']]);
Route::get('/statuses/deletestatus/{id}', ['as' => 'status.deletestatus', 'uses' => 'StatusesController@delete', 'middleware' => ['permission:client-list']]);
Route::get('/statuses/editstatus/{id}', ['as' => 'status.editstatus', 'uses' => 'StatusesController@edit', 'middleware' => ['permission:client-list']]);
Route::post('/statuses/updatestatus/{id}', ['as' => 'status.updatestatus', 'uses' => 'StatusesController@update', 'middleware' => ['permission:client-list']]);
Route::post('/statuses/registerstatus/', ['as' => 'status.createuser', 'uses' => 'StatusesController@createstatus', 'middleware' => ['permission:client-list']]);

/* Сервисы */
Route::get('/additional', ['as' => 'additional.show', 'uses' => 'AdditionalController@index', 'middleware' => ['permission:client-list']]);
Route::get('/additional/showadditional/{id}', ['as' => 'additional.showadditional', 'uses' => 'AdditionalController@show', 'middleware' => ['permission:client-list']]);
Route::get('/additional/create', ['as' => 'additional.create', 'uses' => 'AdditionalController@create', 'middleware' => ['permission:client-list']]);
Route::get('/additional/deleteadditional/{id}', ['as' => 'additional.deleteadditional', 'uses' => 'AdditionalController@delete', 'middleware' => ['permission:client-list']]);
Route::get('/additional/editadditional/{id}', ['as' => 'additional.editadditional', 'uses' => 'AdditionalController@edit', 'middleware' => ['permission:client-list']]);
Route::post('/additional/updateadditinal/{id}', ['as' => 'additional.updateadditional', 'uses' => 'AdditionalController@update', 'middleware' => ['permission:client-list']]);
Route::post('/additional/registeradditional/', ['as' => 'additional.createadditional', 'uses' => 'AdditionalController@createadditional', 'middleware' => ['permission:client-list']]);

/* Услуги */
Route::get('/services', ['as' => 'additional.show', 'uses' => 'ServicesController@index', 'middleware' => ['permission:client-list']]);
Route::get('/services/showservices/{id}', ['as' => 'additional.showservice', 'uses' => 'ServicesController@show', 'middleware' => ['permission:client-list']]);
Route::get('/services/create', ['as' => 'additional.create', 'uses' => 'ServicesController@create', 'middleware' => ['permission:client-list']]);
Route::get('/services/deleteservice/{id}', ['as' => 'additional.deleteservice', 'uses' => 'ServicesController@delete', 'middleware' => ['permission:client-list']]);
Route::get('/services/editservice/{id}', ['as' => 'additional.editservice', 'uses' => 'ServicesController@edit', 'middleware' => ['permission:client-list']]);
Route::post('/services/updateservice/{id}', ['as' => 'additional.updateservice', 'uses' => 'ServicesController@update', 'middleware' => ['permission:client-list']]);
Route::post('/services/registerservice/', ['as' => 'additional.createservice', 'uses' => 'ServicesController@createservice', 'middleware' => ['permission:client-list']]);


/* Заказы */
Route::post('/orders/checkout', ['as' => 'orders.show', 'uses' => 'BasketController@checkout', 'middleware' => ['permission:client-list']]);
Route::get('/orders/', ['as' => 'orders.show', 'uses' => 'BasketController@orders', 'middleware' => ['permission:client-list']]);
Route::get('/orders/show/{id}', ['as' => 'orders.show', 'uses' => 'BasketController@showorder', 'middleware' => ['permission:client-list']]);

/*Товары*/
Route::get('/goods/', ['as' => 'goods.showall', 'uses' => 'ItemsController@showall', 'middleware' => ['permission:client-list']]);
Route::get('/goods/basket', ['as' => 'goods.basket', 'uses' => 'BasketController@show', 'middleware' => ['permission:client-list']]);
Route::get('/goods/additem', ['as' => 'goods.additemget', 'uses' => 'ItemsController@add', 'middleware' => ['permission:client-list']]);
Route::get('/goods/edit/{id}', ['as' => 'goods.edit', 'uses' => 'ItemsController@edit', 'middleware' => ['permission:client-list']]);
Route::get('/goods/show/{id}', ['as' => 'goods.show', 'uses' => 'ItemsController@show', 'middleware' => ['permission:client-list']]);
Route::post('/goods/additem', ['as' => 'goods.additempost', 'uses' => 'ItemsController@save', 'middleware' => ['permission:client-list']]);
Route::post('/goods/edit/{id}', ['as' => 'goods.edit', 'uses' => 'ItemsController@update', 'middleware' => ['permission:client-list']]);
Route::get('/goods/deleteitem/{id}', ['as' => 'goods.delete', 'uses' => 'ItemsController@delete', 'middleware' => ['permission:client-list']]);
Route::post('/goods/del_image', ['as' => 'goods.delimg', 'uses' => 'ItemsController@del_image', 'middleware' => ['permission:client-list']]);

/* Добавление удаление параметров к товарам */
Route::post('/goods/get_parameters' , ['as' => 'goods.getparam', 'uses' => 'ParametersController@get', 'middleware' => ['permission:client-list']]);
Route::post('/goods/save_parameters', ['as' => 'goods.setparam', 'uses' => 'ParametersController@save', 'middleware' => ['permission:client-list']]);


