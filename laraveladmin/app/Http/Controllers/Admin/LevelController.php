<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class LevelController extends Controller
{

 //封装分类查询函数
   public  function sidemeun($all=array()) {


    $arr=DB::table('meun')->where('pid',0)->get();

    //print_r($arr);die;
    //循环添加数组到$arr中
    foreach ($arr as $v){
     //以zi为下标添加数组：
     $v->zi =DB::table('meun')->where('pid',$v->id)->get();
     $all[]=$v;

    }
    return $all;
    //print_r($all);die;
   }




 public function index(){
    $ar=DB::table('level')
        ->select('level.*')
        ->orderBy('time', 'desc')
        ->paginate(5);
  //print_r($ar);die;

     $p=new PageController();
     $page=$p->pageNum($ar);
     return view('admin/level/index',array('ar'=>$ar,'page'=>$page));

 }


 public function insert(){

  if($_POST){
   $input = Input::except('_token');//验证访问
    // print_r($input);die;
   $input['level']=json_encode($input['level']);
   $input['zi']=json_encode($input['zi']);

   $input["time"]=date("Y-m-d H:i:s",time());

   $result=DB::table('level')->insert($input);
   if($result){

    return redirect('admin/level/index');

   }else{

    echo '<script>alert("新增失败！")</script>';
    $sidemeun=$this->sidemeun();
//print_r($sidemeun);die;
    return view('admin/level/insert',array('sidemeun'=>$sidemeun));

   }


  }


  $sidemeun=$this->sidemeun();
//print_r($sidemeun);die;
  return view('admin/level/insert',array('sidemeun'=>$sidemeun));
 }


  public function update($id){

   if($_POST){
    $input = Input::except('_token');//验证token

    //print_r($input);die;
    $input['level']=json_encode($input['level']);//转换数组为字符串
    $input['zi']=json_encode($input['zi']);

    $input["time"]=date("Y-m-d H:i:s",time());//追加当前时间

    $result=DB::table('level')->where('id',$id)->update($input);

    if($result){

     return redirect('admin/level/index');

    }else{

     echo '<script>alert("修改失败！")</script>';

     $arr=DB::table('level')->where('id',$id)->first();
     $arr->level=json_decode($arr->level);
     $arr->zi=json_decode($arr->zi);
     //print_r($arr);die;
     $sidemeun=$this->sidemeun();
//print_r($sidemeun);die;
     return view('admin/level/update',array('sidemeun'=>$sidemeun,'arr'=>$arr));

    }

   }


   $arr=DB::table('level')->where('id',$id)->first();
   $arr->level=json_decode($arr->level);
   $arr->zi=json_decode($arr->zi);
    //print_r($arr);die;
   $sidemeun=$this->sidemeun();
//print_r($sidemeun);die;
   return view('admin/level/update',array('sidemeun'=>$sidemeun,'arr'=>$arr));
  }


 public function delete($id){

  $result=DB::table('level')->where('id',$id)->delete();
  if($result){
   return redirect('admin/level/index');

  }else{

   echo '<script>alert("删除失败！")</script>';
   $ar=DB::table('level')
       ->select('level.*')
       ->orderBy('time', 'desc')
       ->paginate(5);
   //print_r($ar);die;

   $p=new PageController();
   $page=$p->pageNum($ar);
   return view('admin/level/index',array('ar'=>$ar,'page'=>$page));

  }






 }










}
