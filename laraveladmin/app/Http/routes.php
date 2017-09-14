<?php


/*
 * 登录页面：
 * 'prefix'=>'admin/login：路由前缀
 * 'namespace'=>'Admin'：命名空间前缀
 * 'middleware'=>'web'：中间件
 * */

 Route::group(['prefix'=>'admin/login','namespace'=>'Admin','middleware'=>'web'], function () {

     //设置登录页面的路由：
     Route::match(['get','post'],'login','LoginController@login');
     Route::match(['get','post'],'loginout','LoginController@loginout');
     Route::match(['get','post'],'getpassword','LoginController@getpassword');
     Route::match(['get','post'],'sendemail','LoginController@sendemail');
     Route::match(['get','post'],'vcode/{num}','LoginController@vcode',function($num){


     });

});



/*
 * 新闻页面：
 * 'prefix'=>'admin/News：路由前缀，区分大小写
 * 'namespace'=>'Admin'：命名空间前缀
 * 'middleware'=>'web'：中间件，设置表单提交token值必须
 * */
Route::group(['prefix'=>'admin/news','namespace'=>'Admin','middleware'=>'web'], function () {

    Route::match(['get','post'],'index','NewsController@index');
    Route::match(['get','post'],'insert','NewsController@insert');
    Route::match(['get','post'],'update/{id}','NewsController@update',function($id){


    });
    Route::match(['get','post'],'delete/{id}','NewsController@delete',function($id){


    });

});

/*
 * 产品页面：
 * 'prefix'=>'admin/Product：路由前缀，区分大小写
 * 'namespace'=>'Admin'：命名空间前缀
 * 'middleware'=>'web'：中间件，设置表单提交token值必须
 * */
Route::group(['prefix'=>'admin/product','namespace'=>'Admin','middleware'=>'web'], function () {

    Route::match(['get','post'],'index','ProductController@index');
    Route::match(['get','post'],'insert','ProductController@insert');
    Route::match(['get','post'],'update/{id}','ProductController@update',function($id){


    });
    Route::match(['get','post'],'delete/{id}','ProductController@delete',function($id){


    });

});


/*
 * 分类页面：
 * 'prefix'=>'admin/category：路由前缀，区分大小写
 * 'namespace'=>'Admin'：命名空间前缀
 * 'middleware'=>'web'：中间件，设置表单提交token值必须
 * */
Route::group(['prefix'=>'admin/category','namespace'=>'Admin','middleware'=>'web'], function () {

    Route::match(['get','post'],'index','CategoryController@index');
    Route::match(['get','post'],'insert','CategoryController@insert');
    Route::match(['get','post'],'update/{id}','CategoryController@update',function($id){


    });
    Route::match(['get','post'],'delete/{id}','CategoryController@delete',function($id){


    });

});



/*
 * 权限页面：
 * 'prefix'=>'admin/level：路由前缀，区分大小写
 * 'namespace'=>'Admin'：命名空间前缀
 * 'middleware'=>'web'：中间件，设置表单提交token值必须
 * */
Route::group(['prefix'=>'admin/level','namespace'=>'Admin','middleware'=>'web'], function () {

    Route::match(['get','post'],'index','LevelController@index');
    Route::match(['get','post'],'insert','LevelController@insert');
    Route::match(['get','post'],'update/{id}','LevelController@update',function($id){


    });
    Route::match(['get','post'],'delete/{id}','LevelController@delete',function($id){


    });

});


/*
 * 权限页面：
 * 'prefix'=>'admin/level：路由前缀，区分大小写
 * 'namespace'=>'Admin'：命名空间前缀
 * 'middleware'=>'web'：中间件，设置表单提交token值必须
 * */
Route::group(['prefix'=>'admin/messageadmin','namespace'=>'Admin','middleware'=>'web'], function () {

    Route::match(['get','post'],'index','MessageadminController@index');
    Route::match(['get','post'],'insert','MessageadminController@insert');
    Route::match(['get','post'],'update/{id}','MessageadminController@update',function($id){


    });
    Route::match(['get','post'],'delete/{id}','MessageadminController@delete',function($id){


    });

});