<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class CateController extends Controller
{

//分类递归函数：
    //递归函数：
    public function category ($pid=0,$category=array(),$level=0){

        $arr=DB::table('category')->where('pid',$pid)->get();

        //print_r($arr);die;
        //循环查询子集：
        foreach ($arr as $k => $v) {
            //循环拼接标识符：
            for ($i=1; $i <= $level; $i++) {
                $str="";
                $str.="<span style='color:red'>";
                $str.="|-";
                $str.="</span>";
                $v->name=$str.$v->name;
            }

            //接收子集储存：
            $category[]=$v;
            //print_r($category);die;
            //调用函数本身，传递参数，重复查询子集：

            $category=$this->category($v->id,$category,$level+1);

        }
    // print_r($category);die;
        //返回数据给函数本身使用：
       return $category;
    }



}
