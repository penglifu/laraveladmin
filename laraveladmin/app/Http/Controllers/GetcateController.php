<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class GetcateController extends Controller
{

    //分类修改递归函数
    function getCategory($id,$category=[]){
        if ($id!=0) {

            $arr=DB::table("category")->where('id',$id)->first();

            $pid=$arr->pid;
            //当当前需要查找的那条记录查找出来之后，再次查找当前点击那条记录的所有同级：

            $arrtj=DB::table("category")->where('pid',$pid) ->get();

            //存储当前记录同级数据：
            $category["$id"]=$arrtj;

            // print_r($category);die;

            $category=$this->getCategory($arr->pid,$category);
        }


        //返回值：
        return $category;
    }






}
