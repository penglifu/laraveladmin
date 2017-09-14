<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Input;

class MessageadminController extends Controller
{

    public function index(){

        $list=DB::table('admin')
            ->Join('level', 'admin.level', '=', 'level.id')
            ->select('admin.*','level.name')
            ->orderBy('time', 'desc')
            ->paginate(5);

        $M=new PageController();
        $page=$M->pageNum($list);


        return view('admin/messageadmin/index',array('list'=>$list,'page'=>$page));

    }


    public function insert(){

        if($_GET){
            $input = Input::except('_token');

            //print_r($input);die;
            $input['password']=Crypt::encrypt($input['password']);//加密
            $result=DB::table('admin')->insert($input);
            //print_r($result);die;
            if($result){

                return redirect('admin/messageadmin/index');

            }else{

                echo '<script>alert("新增失败！")</script>';
                $level=DB::table('level')->get();
                return view('admin/messageadmin/insert',array('level'=>$level));


            }

        }



        if($_POST){
            $input = Input::except('_token');
            //print_r($input);die;

            if($input['name']=='names'){
                $param=$input['param'];
                $result=DB::table('admin')->where('names',$param)->first();
                if($result){
                    echo '用户名重复！';die;
                }else{

                    echo 'y' ;die;

                }

            }else{
                $param=$input['param'];
                $result=DB::table('admin')->where('email',$param)->first();
                if($result){
                    echo '邮箱重复！';die;
                }else{
                    echo 'y' ;die;
                }

            }

        }



        $level=DB::table('level')->get();
        return view('admin/messageadmin/insert',array('level'=>$level));

    }


    public function update($id){

        if($_GET){

            $input = Input::except('_token');//验证token，防攻击
            $input['password']=Crypt::encrypt($input['password']);//laravel加密
            $result=DB::table('admin')->where('id',$id)->update($input);
            if($result){

              return redirect('admin/messageadmin/index');


            }else{

                echo '<script>alert("修改失败！")</script>';
                $arr=DB::table('admin')->where('id',$id)->first();
                $level=DB::table('level')->get();
                return view('admin/messageadmin/update',array('level'=>$level,'arr'=>$arr));
            }




        }




        if($_POST){
            $input = Input::except('_token');
            //print_r($input);die;

            if($input['name']=='names'){
                $param=$input['param'];

                $result=DB::table('admin')->where('id',$id)->first();
                if($result && $result->id!=$id){
                    echo '验证失败！';die;
                }else{

                    echo 'y' ;die;

                }

            }else{
                $param=$input['param'];
                $result=DB::table('admin')->where('id',$id)->first();
                if($result && $result->id!=$id){
                    echo '验证失败！';die;
                }else{
                    echo 'y' ;die;
                }

            }

        }



        $arr=DB::table('admin')->where('id',$id)->first();
        $level=DB::table('level')->get();
        return view('admin/messageadmin/update',array('level'=>$level,'arr'=>$arr));
    }


    public function delete($id){
          $result=DB::table('admin')->where('id',$id)->delete();
        //print_r($result);die;
        if($result){
            return redirect('admin/messageadmin/index');

        }else{
            echo '<script>alert("删除失败！")</script>';
            $list=DB::table('admin')
                ->Join('level', 'admin.level', '=', 'level.id')
                ->select('admin.*','level.name')
                ->orderBy('time', 'desc')
                ->paginate(5);

            $M=new PageController();
            $page=$M->pageNum($list);
            return view('admin/messageadmin/index',array('list'=>$list,'page'=>$page));

        }



    }


}
