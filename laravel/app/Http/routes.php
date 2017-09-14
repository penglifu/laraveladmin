<?php



Route::get('/', function () {
    /*注意参数路由只设置一个默认值，不可设置两个参数都有默认值*/


    return view("welcome");//这里加载的就是文件resource下面的views中的末班页面所以
});

/*Route::get('News/{id?}',['as'=>'newsas', function ($id=10) {
    注意参数路由只设置一个默认值，不可设置两个参数都有默认值

echo route("newsas");//这里输出的就是当前路由

}]);*/


/*
 * 设置路由的时候，函数就写在了对应的控制器中了，这里只需要写路由规则
 * 比如下面的login，这里写的就是路由规则控制器之下login方法，所以方法就写在了对应的php页面面中，路由访问的就是php页面中的方法；
 *
 *
 * */


/*
 *
 * Route::get('admin/login/login', 'Admin\LoginController@login');
   Route::get('admin/login/index', 'Admin\LoginController@index');
*/
/*
 * 注意此处的路由设定规则，必须对应当前模块下面的操作。
 * 第一个参数为对应的是访问的路由规则，这里的路由规则设定，决定了浏览器中的访问规则，
 * 注意这里的大小写决定浏览器访问时的大小写，所以建议此处小写。
 * 所以这样设置时浏览器访问的写法就是这样的：如例：http://localhost/laravel/public/index.php/admin/login/index
 * 第二个参数为模块和模块下面的控制器，对应的laravel文件包含顺序最后一个为当前操作。
 * */

/*
 * 上面的路由规则有许多共同的地方那么就可以进行简写如下面的群组路由：
 * 'prefix'=>'admin/login':这设置路由前缀，也就是路由中共同地部分
 *'namespace'=>'Admin':这里的设置是命名空间的前缀，简化前面路由设置的写法
 * */
/*Route::group(['prefix'=>'admin/login','namespace'=>'Admin'],function(){

    Route::get('login', 'LoginController@login');
    Route::get('index', 'LoginController@index');

});*/


/*
 * 下面在路由上添加：中间件
 * 中间件的设置是在http文件下面的kernel.php文件中设置的
 *'middleware'=>'mmm':这里的对应的就是kernel设置的中间件，而且mmm就是设置中间件对应的数组下标，
 *同时：\App\Http\Middleware\Test::class,就是中间价下标mmm对应的内容，但是这个中间件规则对应的
 * 又是一个相应的php页面，就是Middleware文件下面的Test.php文件，Test文件中写的方法就是，在执行将要访问的
 * 页面之前需要执行的方法，所以中间件这个页面所写的方法可以对将要访问的页面进行限制。如：验证
 * 登录等方法判断就可以写在中间件页面中。、
 * 当设置了中间以后，就会先去执行，中间件页面中的内容，然后再去执行当前访问页面的额内容。
 * */
Route::group(['prefix'=>'admin/login','namespace'=>'Admin','middleware'=>'mmm'],function(){

    Route::get('login', 'LoginController@login');
    Route::get('index', 'LoginController@index');
    Route::get('update', 'LoginController@update');


});



/*
 *Route::post('/', function () {})
 *闭包路由的两种不同的访问方式：一种是get请求，一种是post请求。如果只设置其中一种路由的时候，只能以对应的路由去的访问。
 *
 *
 * 这是一个基本路由：在函数外面使用函数内部变量的一种方式
 * Route::get('Admin/{id?}/p/{curpage?}', function ($id,$curpage=4) {
    注意参数路由只设置一个默认值，不可设置两个参数都有默认值
    echo $id;
    echo $curpage;

    return view("文件名");//这里加载的就是文件resource下面的views中的模板对应的文件
    //注意输出只需要模板文件名就可以了，不需要后缀，除了return还可以用echo。

      注意laravel的模板引擎为blade，所以视图命名的后缀跟tp不一样，必须是 视图名.blade.php不可更改


});

Route::match(['get','post'],'路由规则',function(){
这种就是同时两种路由方式访问都可以；
});

Route::any()


*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


/*
 * 下面是群组路由器：
 * 路由群组路由器中可以设置的参数有，
 * 1、共同模块下的不同控制器为前缀："prefix"=>"Admin"
 *
 *
 * */







Route::group(["prefix"=>"Admin",'middleware' => ['web']], function () {


});
