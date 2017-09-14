<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/1
 * Time: 18:28
 */

namespace App\Http\Middleware;

use Closure;

class Test//注意：设置中间件页面的时候，这里的类名必须与kernel文件中设置的规则名字一致。
{

 public function handle($request,Closure $next){//不可更改

//handle不能更改，他是最底层的相当于一个基类函数
     //执行的内容----------
     //如每个页面需要执行的共同内容都可以放在这
     //还可以在此处进行验证

     echo 100;
     //执行的内容----------


     return $next($request);//不可更改

 }


}