<?php

namespace App\Http\Controllers\Admin;//命名空间，注意这里的命名空间的设置必须到对应的模块

use App\User;//导入命名空间
use App\Http\Controllers\Controller;
//导入当前类所对应的命名空间，这一步必须不然无法访问类中的方法，注意必须要到对应的控制器

class LoginController extends Controller
{
    public function login(){

   echo 100;


    }

    public function index(){

   /* echo 50;*/

        //传参数1：
        $a=10;

        //传递参数2：
        $b='<b>dsjfcdsabhdksa</b>';

        $arr=['id'=>100];
        //当只有$arr这个数组的时候，可以用下面的方法输出，而且在视图中直接输出$id
        //return view('admin/index',$arr);
        /*//加载视图传递一个参数:
        return view('admin/index')->with('a',$a);
       //或者用：
        //return view('admin.index')->with('a',$a);*/

        //传递多个参数：
       // return view('admin/index')->with('a',$a)->with('b',$b)->with('arr',$arr);

       //传递多个参数的另一种方式：以数组的形式：
       // return view('admin/index',array('a'=>$a,'b'=>$b,'arr'=>$arr));

        //传递多个参数的另一种方式：
       return view('admin/index',compact("a","b",'arr'));





    }


    public function update(){



        return view('admin/update');
    }


}
