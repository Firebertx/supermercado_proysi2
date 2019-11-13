<?php

Auth::routes();
Route::get('/','MainController@home');

Route::get('/category','MainController@category');
Route::get('/category1','MainController@category1');
Route::get('/category2','MainController@category2');
Route::get('/category3','MainController@category3');
Route::get('/category4','MainController@category4');
Route::get('/category5','MainController@category5');
Route::get('/category6','MainController@category6');
Route::get('/category7','MainController@category7');
Route::get('/category8','MainController@category8');
Route::get('/category9','MainController@category9');
Route::get('/category10','MainController@category10');
Route::get('/category11','MainController@category11');
Route::get('/category12','MainController@category12');

Route::get('/combo','MainController@combo');
Route::get('/combo1','MainController@combo1');
Route::get('/combo2','MainController@combo2');
Route::get('/combo3','MainController@combo3');
Route::get('/combo4','MainController@combo4');
Route::get('/combo5','MainController@combo5');
Route::get('/combo6','MainController@combo6');
Route::get('/combo7','MainController@combo7');

Route::get('/promotions','MainController@promotion');
Route::get('/promotions1','MainController@promotion1');
Route::get('/promotions2','MainController@promotion2');
Route::get('/promotions3','MainController@promotion3');
Route::get('/promotions4','MainController@promotion4');
Route::get('/promotions5','MainController@promotion5');
Route::get('/promotions6','MainController@promotion6');
Route::get('/promotions7','MainController@promotion7');

Route::resource('shopping_carts','ShoppingCartsController');
Route::get('/carrito/registrar','ShoppingCartsController@store');
Route::get('/paypal','ShoppingCartsController@pay');
Route::get('/payments/store','PaymentsController@store');
Route::resource('in_shopping_carts','InShoppingCartsController',['only'=>['store','destroy']]);

//Reportes
Route::get('/admin/reporte_compras','IngresosController@reportePdf',['as'=>'admin'])->name('reporte_compra');
Route::post('/admin/reporteCompras','IngresosController@pdf',['as'=>'admin'])->name('compra_pdf');
Route::post('/admin/reporteComprasFechas','IngresosController@pdf2',['as'=>'admin']);

Route::get('/admin/reporte_ventas','EgresosController@reportePdf',['as'=>'admin'])->name('reporte_venta');
Route::post('/admin/reporteVentas','EgresosController@pdf',['as'=>'admin'])->name('venta_pdf');
Route::post('/admin/reporteVentasFechas','EgresosController@pdf2',['as'=>'admin']);

//Auth::routes(['verify'=>true]);
Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){
    Route::get('/', 'HomeController@index')->name('dashboard');

    Route::resource('users','UsersController',['as'=>'admin']);
    Route::resource('employees','EmployeesController',['as'=>'admin']);
    Route::resource('customers','CustomersController',['as'=>'admin']);
    Route::resource('roles','RolesController',['except'=>'show', 'as'=>'admin']);
    Route::resource('permissions','PermissionsController',['only'=>['index','edit','update'],'as'=>'admin']);

    Route::resource('products','ProductsController',['as'=>'admin']);
    Route::resource('categories','CategoriesController',['as'=>'admin']);
    Route::resource('brands','BrandsController',['as'=>'admin']);
    Route::resource('units','UnitsController',['as'=>'admin']);

    Route::resource('branchOffices','BranchOfficesController',['as'=>'admin']);
    Route::resource('providers','SuppliersController',['as'=>'admin']);
    Route::resource('warehouses','WarehousesController',['as'=>'admin']);
    Route::resource('inventories','InventoriesController',['as'=>'admin']);

    Route::resource('ingresos','IngresosController',['as'=>'admin']);
    Route::post('ingresos/fetch', 'IngresosController@fetch')->name('IngresosController.fetch');
    Route::resource('egresos','EgresosController',['as'=>'admin']);
    Route::post('egresos/fetch', 'EgresosController@fetch')->name('EgresosController.fetch');

    Route::resource('combos','ComboController',['as'=>'admin']);
    Route::resource('combos_products','ComboProductController',['as'=>'admin']);
    Route::resource('promotions','PromotionsController',['as'=>'admin']);
    Route::resource('promotions_products','PromotionProductsController',['as'=>'admin']);

    Route::resource('pedidos','PedidosController',['as'=>'admin']);
    Route::resource('solicitudes','SolicitudesController',['as'=>'admin']);


    Route::middleware('role:Administrador')
        ->put('users/{user}/roles', 'UsersRolesController@update')
        ->name('admin.users.roles.update');

    Route::middleware('role:Administrador')
        ->put('users/{user}/permissions', 'UsersPermissionsController@update')
        ->name('admin.users.permissions.update');

    Route::resource('bitacora','BitacoraController',['as'=>'admin']);
    Route::resource('backup','BackupController',['as'=>'admin']);

});