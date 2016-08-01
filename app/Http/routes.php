<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/',function(){
    return view('home');
});

Route::get('/home',function(){
    return view('welcome');
});

Route::get('admin/index', ['as' => 'admin.index', 'middleware' => ['auth','menu'], 'uses'=>'Admin\\IndexController@index']);

$this->group(['namespace' => 'Admin','prefix' => '/admin',], function () {
    Route::auth();
});

$router->group(['namespace' => 'Admin', 'middleware' => ['auth','authAdmin','menu']], function () {
    //权限管理路由
    Route::get('admin/permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('admin/permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::post('admin/permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询

    Route::resource('admin/permission', 'PermissionController');
    Route::put('admin/permission/update', ['as' => 'admin.permission.edit', 'uses' => 'PermissionController@update']); //修改
    Route::post('admin/permission/store', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@store']); //添加


    //角色管理路由
    Route::get('admin/role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('admin/role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('admin/role', 'RoleController');
    Route::put('admin/role/update', ['as' => 'admin.role.edit', 'uses' => 'RoleController@update']); //修改
    Route::post('admin/role/store', ['as' => 'admin.role.create', 'uses' => 'RoleController@store']); //添加


    //用户管理路由
    Route::get('admin/user/manage', ['as' => 'admin.user.manage', 'uses' => 'UserController@index']);  //用户管理
    Route::post('admin/user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('admin/user', 'UserController');
    Route::put('admin/user/update', ['as' => 'admin.user.edit', 'uses' => 'UserController@update']); //修改
    Route::post('admin/user/store', ['as' => 'admin.user.create', 'uses' => 'UserController@store']); //添加
    Route::post('admin/user/show', ['as' => 'admin.user.show', 'uses' => 'UserController@show']); //获取信息
    
    //栏目管理路由
    Route::get('admin/category/manage', ['as' => 'admin.category.manage', 'uses' => 'CategoryController@index']);  //用户管理
    Route::post('admin/category/index', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);
    Route::resource('admin/category', 'CategoryController');
    Route::put('admin/category/update', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@update']); //修改
    Route::post('admin/category/store', ['as' => 'admin.category.create', 'uses' => 'CategoryController@store']); //添加
    Route::post('admin/category/cateson', ['as' => 'admin.category.cateson', 'uses' => 'CategoryController@cateson']); //添加
    //公司管理路由
    Route::get('admin/company/ajax', ['as' => 'admin.company.ajax', 'uses' => 'CompanyController@ajax']);  //用户管理
    Route::get('admin/company/manage', ['as' => 'admin.company.manage', 'uses' => 'CompanyController@index']);  //用户管理
    Route::post('admin/company/index', ['as' => 'admin.company.index', 'uses' => 'CompanyController@index']);
    Route::resource('admin/company', 'CompanyController');
    Route::put('admin/company/update', ['as' => 'admin.company.edit', 'uses' => 'CompanyController@update']); //修改
    //Route::post('admin/upload_img','UploadController@imgUpload');
    Route::post('admin/company/store', ['as' => 'admin.company.create', 'uses' => 'CompanyController@store']); //添加
    Route::post('admin/company/region', ['as' => 'admin.company.region', 'uses' => 'CompanyController@region']); //添加
    Route::post('admin/company/show', ['as' => 'admin.company.show', 'uses' => 'CompanyController@show']); //添加
    
    Route::post('admin/upload_img','UploadController@imgUpload');
    
    
    //公司证件图片
    Route::get('admin/pape/{id}-{block}/create', ['as' => 'admin.pape.create', 'uses' => 'PapeController@create']);
    Route::resource('admin/pape', 'PapeController');
    Route::put('admin/pape/update', ['as' => 'admin.pape.edit', 'uses' => 'PapeController@update']); //修改
    Route::post('admin/pape/store', ['as' => 'admin.pape.create', 'uses' => 'PapeController@store']); //添加
    //项目管理路由
    Route::get('admin/xm/ajax', ['as' => 'admin.xm.ajax', 'uses' => 'XmController@ajax']);  //用户管理
    Route::get('admin/xm/manage', ['as' => 'admin.xm.manage', 'uses' => 'XmController@index']);  //用户管理
    Route::post('admin/xm/index', ['as' => 'admin.xm.index', 'uses' => 'XmController@index']);
    Route::resource('admin/xm', 'XmController');
    Route::put('admin/xm/update', ['as' => 'admin.xm.edit', 'uses' => 'XmController@update']); //修改
    Route::post('admin/xm/store', ['as' => 'admin.xm.create', 'uses' => 'XmController@store']); //添加
    Route::get('admin/xm/create/{id?}', ['as' => 'admin.xm.create', 'uses' => 'XmController@create']); //添加
    //
    Route::get('admin/joinstore/{cid}/create', ['as' => 'admin.joinstore.create', 'uses' => 'JoinstoreController@create']);
    Route::get('admin/joinstore/{cid?}', ['as' => 'admin.joinstore.index', 'uses' => 'JoinstoreController@index']);
    Route::post('admin/joinstore/index', ['as' => 'admin.joinstore.index', 'uses' => 'JoinstoreController@index']); //查询
    Route::put('admin/joinstore/update', ['as' => 'admin.joinstore.edit', 'uses' => 'JoinstoreController@update']); //修改
    Route::post('admin/joinstore/store', ['as' => 'admin.joinstore.create', 'uses' => 'JoinstoreController@store']); //添加
    //文章管理路由
    Route::get('admin/article/manage', ['as' => 'admin.article.manage', 'uses' => 'ArticleController@index']);  //用户管理
    Route::post('admin/article/index', ['as' => 'admin.article.index', 'uses' => 'ArticleController@index']);
    Route::resource('admin/article', 'ArticleController');
    Route::put('admin/article/update', ['as' => 'admin.article.edit', 'uses' => 'ArticleController@update']); //修改
    Route::post('admin/article/store', ['as' => 'admin.article.create', 'uses' => 'ArticleController@store']); //添加
    
    //问答管理路由
    Route::get('admin/question/manage', ['as' => 'admin.question.manage', 'uses' => 'QuestionController@index']);  //用户管理
    Route::post('admin/question/index', ['as' => 'admin.question.index', 'uses' => 'QuestionController@index']);
    Route::resource('admin/question', 'QuestionController');
    Route::put('admin/question/update', ['as' => 'admin.question.edit', 'uses' => 'QuestionController@update']); //修改
    Route::post('admin/question/store', ['as' => 'admin.question.create', 'uses' => 'QuestionController@store']); //添加


});

Route::get('admin', function () {
    return redirect('/admin/index');
});

Route::auth();



