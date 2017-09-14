<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class Text
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


        /*
         * 后台边导航$all数据
        * 调用控制器与方法的函数传递到视图
        *
        * */
        $current=$this->getCurrentAction();
        $controller=$current['controller'];
        $method=$current['method'];
        //print_r($method);die;
        if($method!='login' && $method!='loginout'&& $method!='vcode' && $method!='getpassword' && $method!='sendemail' ){
        view()->share(array('controller'=>$controller,'method'=>$method));



         $names=session('names');
         // print_r($names);die;
         $l=DB::table('admin')->where('names',$names)->first();
         //print_r($l);die;
        $level=$l->level;
        //print_r($level);die;
        $w=DB::table('level')->where('id',$level)->first();
        //print_r($w);die;
        $level1=json_decode($w->level);
        //print_r($level1);die;
        foreach ($level1 as $k=>$v){

            $arr=DB::table('meun')->where('id',$v)->get();

            //print_r($arr);die;
            foreach($arr as $k1=>$v1){
                //print_r($v1);die;

                $zi=DB::table('meun')->where('pid',$v1->id)->get();
                $v1->zi=$zi;
                $all[]=$v1;
                //print_r($zi);die;

            }


        }
        //print_r($all);die;
        /*
         * 中间件中传值，如果是一维，不能直接传：view()->share('a'，$a);
         * 如果是二维也不能：view()->share('all',$all);
         * */
         view()->share('all',$all);

        }
        return $next($request);

    }


    /**
     * 获取当前控制器与方法
     *
     * @return array
     */
    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();

       list($class, $method) = explode('@', $action);

      return ['controller' => $class, 'method' => $method];


    }





}




