<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GetcateController;
use Illuminate\Http\Request;
use App\Http\Controllers\CateController;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{

    public function index(){

        $C=new CateController();//实例化自己封装的类
        $category=$C->category();//调用类中的函数
        //print_r($category);die;

     return view('admin/category/index',array('category'=>$category));
    }

    public function insert(){

        if($_POST){
            $input = Input::except('_token');
            //print_r($input);die;

            $result=DB::table('category')->insert($input);
            if($result){

                return redirect('admin/category/index');

            }else{

                echo '<script>alert("新增失败！")</script>';
                $C=new CateController();
                $category=$C->category();
                //print_r($category);die;

                return view('admin/category/insert',array('category'=>$category));

            }


        }


        $C=new CateController();
        $category=$C->category();
        //print_r($category);die;

        return view('admin/category/insert',array('category'=>$category));


    }


    public function update($id)
    {

        if ($_POST) {

            if (Input::except('_token')) {//判断是否是ajax请求,验证ajax请求的token值是否存在
                $data= Input::except('_token');//获取ajax传递的数据
                /*if (!empty($data['__token'])) {
                    $id = $data['id'];//这儿注释的原因是因为这儿不能做判断？
                    $zi = DB::table('category')->where('pid', $id)->first();
                    print_r($zi);
                    die;

                }*/
               $id=$data['id'];
                $zi = DB::table('category')->where('pid', $id)->get();
                //print_r($zi);die;
                if(!empty($zi)){
                   echo json_encode($zi);die;//把对象转换为json格式

                }else{

                    echo 0;die;

                }



            }
        }
          if($_GET){
                $input = Input::except('_token');
                $result = DB::table('category')->where('id', $id)->update($input);
                if ($result) {

                    return redirect('admin/category/index');

                } else {
                    echo '<script>alert("修改失败！")</script>';
                    $id1 = $id;
                    //print_r($id1);die;
                    $GC = new GetcateController();
                    $category = $GC->getCategory($id);
                    $category = array_reverse($category, true);
                    //print_r($category);die;
                    $current = DB::table("category")->where('id', $id)->first();


                    return view('admin/category/update', array('category' => $category, 'current' => $current, 'id1' => $id1));

                }


          }

            $id1 = $id;
            //print_r($id1);die;
            $GC = new GetcateController();
            $category = $GC->getCategory($id);
            $category = array_reverse($category, true);
            //print_r($category);die;
            $current = DB::table("category")->where('id', $id)->first();


            return view('admin/category/update', array('category' => $category, 'current' => $current, 'id1' => $id1));
        }


    public function delete($id){

        $result=DB::table('category')->where('id',$id)->delete();
        if($result){

            return redirect('admin/category/index');
        }else{

            echo '<script>alert("删除失败！")</script>';
            $C=new CateController();//实例化自己封装的类
            $category=$C->category();//调用类中的函数
            //print_r($category);die;

            return view('admin/category/index',array('category'=>$category));

        }




    }




}
