<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Finder\SplFileInfo;



class NewsController extends Controller
{

       public function index(){
           //查询记录
           $ar = DB::table('news')
               ->Join('category', 'news.category', '=', 'category.id')
               ->select('news.*', 'category.name')
               ->orderBy('time', 'desc')
               ->paginate(5);

           //分页页码

           $currentpage=$ar->currentPage();//当前页
           $firstItem=$ar->firstItem();//当前页的第一条记录在数据库中排第几条
           $lastItem=$ar->lastItem();//当前页面最后一条记录在数据库中排第几条
           $lastPage=$ar->lastPage();//最后一页页码
           $nextPageUrl=$ar->nextPageUrl();//下一页的超链接地址
           $perPage=$ar->perPage();//每页显示的记录条数等于paginate(5)中设定的数字。
           $previousPageUrl=$ar->previousPageUrl();//上一页的超链接地址
           $total=$ar->total();//查询出的总记录条数
           $url=$ar->url(0);//url(3）当在其中输入页码的时候就会得到第几页的超链接,里面必须给默认值
           //print_r($lastPage);die;



           $fix_num=5;//定义一个变量固定显示几页
           $firstpage=$currentpage-floor($fix_num/2);//固定显示几页页码之后的开始页


           $endpage=$currentpage+floor($fix_num/2);

          // print_r($endpage);die;
           $page="";
           //拼接第一页
           $page.='<a href="'.$ar->url(1).'" title="First Page">&laquo; First</a>';


           //拼接第上一页
           $Previous=$currentpage-1;//上一页
           if($Previous<1) {//判断上一页小于一
               $page .= '<a href="' . $ar->url(1) . '" title="Previous Page">&laquo; Previous</a>';
               }else{
               $page.='<a href="'.$ar->url($Previous).'" title="Previous Page">&laquo; Previous</a>';
               }


            //拼接页码和当前页
           //当开始页小于一
           if($firstpage<1){
               $firstpage=1;
               $endpage=$fix_num;

           }

           //当结束页大于最后一页页码数
           if($endpage>$lastPage){
               $endpage=$lastPage;
               $firstpage=$lastPage-$fix_num+1;
           }

           //当最后一页小于固定页码


           if($lastPage<$fix_num){
               $endpage=$lastPage;
               $firstpage=1;
           }
           //print_r($endpage);die;

           //循环页码：
           for($i=$firstpage;$i<=$endpage;$i++){


               if($i==$currentpage ){

                   $page.='<a href="'.$ar->url($i).'" class="number current" title="'.$i.'">'.$i.'</a>';

               }else{
                   $page.='<a href="'.$ar->url($i).'" class="number " title="'.$i.'">'.$i.'</a>';

               }

            // print_r($i);die;
           }


          //拼接下一页
          $NextPage=$currentpage+1;//下一页
           if($NextPage>$lastPage) {//判断下一页大于总页码
               $page .= '<a href="' . $ar->url($lastPage) . '" title="Next Page">Next &raquo;</a>';
               }else{
               $page.='<a href="'.$ar->url($NextPage).'" title="Next Page">Next &raquo;</a>';
               }


           //拼接最后一页
           $page.='<a href="'.$ar->url($lastPage).'" title="Last Page">Last &raquo;</a>';



           //print_r($ar);die;

           //加载视图：
           return view('admin/news/index',array('ar'=>$ar,'page'=>$page));

       }





        public function insert(){

    if($_POST){
            $input = Input::except('_token');
           //print_r($input);die;

        //单图上传：

             $images=$input["images"];
             $files=$images;//从数组$input中取出图片信息
              if($files->isValid()){//检查文件上传是否有效
                  //获取文件名称
                  $imagename_old=$files->getClientOriginalName();
                  $tmp=$files->guessClientExtension();
                  $imagename=time().rand(1000,9999).$imagename_old;

                  $path= 'storage/Uploads/News/';//上传文件的路径文件夹
                  $tmper=array('jpg', 'gif', 'png', 'jpeg');
                   if(!in_array($tmp,$tmper)){
                      echo '<script>alert("不支持该类型图片上传！")</script>';die;

                   }

                  if (!file_exists($path)){//判断定义的路径是否存在
                      mkdir($path,0777,true);//不存在生成文件路径
                  }

                  $files->move($path,$imagename);//转移路径
                  $input['images']=$path.$imagename;//储存路径到数组中

                  $img =new ImgController();//实例自己封装缩略图所在的类，然后调用封装的函数
                  //生成缩略图
                  $thumb_name=time().rand(1000,9999)."thumb_".$imagename_old;//生成名字
                  $thumb_img=$img->thumb($path.$imagename,$path.$thumb_name);//生成路径
                  $input['thumb_img']=$thumb_img;//储存路径到数组中

                  //生成水印图
                  $water_name=time().rand(1000,9999)."water_".$imagename_old;//生成名字
                  $water_img=$img->water($path.$imagename,$path.$water_name,$water_file=('shuiyin.png'));//生成水印图路径
                  $input['water_img']=$water_img;//储存路径到数组中

              }

              $input['time']=date("Y-m-d H:i:s",time());
              $result=DB::table('news')->insert($input);
              if($result){

                  return redirect('admin/news/index');

              }else{

                  echo

                  $category=DB::table('category')->where('pid',1)->get();
                  //print_r($category);die;
                  //加载视图：
                  return view("admin/news/insert",array('category'=>$category));
              }

           }

             $category=DB::table('category')->where('pid',1)->get();
            //print_r($category);die;
            //加载视图：
            return view("admin/news/insert",array('category'=>$category));
        }


        public function update($id)//传递id
        {

            if($_POST){

                $input = Input::except('_token');
                //print_r($input);die;

                unset($input['images_old']);
                if(!empty($input['images'])){//当有图片上传的时候 首先应判断原图是否删除


                    $ar = DB::table('news')->where('id', $id)->first();
                    if(file_exists($ar->images));
                    unlink($ar->images);
                    if(file_exists($ar->thumb_img));
                    unlink($ar->thumb_img);
                    if(file_exists($ar->water_img));
                    unlink($ar->water_img);


                    //单图上传：

                    $images=$input["images"];
                    $files=$images;//从数组$input中取出图片信息
                    if($files->isValid()){//检查文件上传是否有效
                        //获取文件名称
                        $imagename_old=$files->getClientOriginalName();
                        $tmp=$files->guessClientExtension();
                        $imagename=time().rand(1000,9999).$imagename_old;

                        $path= 'storage/Uploads/News/';//上传文件的路径文件夹
                        $tmper=array('jpg', 'gif', 'png', 'jpeg');
                        if(!in_array($tmp,$tmper)){
                            echo '<script>alert("不支持该类型图片上传！")</script>';die;

                        }

                        if (!file_exists($path)){//判断定义的路径是否存在
                            mkdir($path,0777,true);//不存在生成文件路径
                        }

                        $files->move($path,$imagename);//转移路径
                        $input['images']=$path.$imagename;//储存路径到数组中

                        $img =new ImgController();//实例缩略图所在的类
                        //生成缩略图
                        $thumb_name=time().rand(1000,9999)."thumb_".$imagename_old;//生成名字
                        $thumb_img=$img->thumb($path.$imagename,$path.$thumb_name);//生成路径
                        $input['thumb_img']=$thumb_img;//储存路径到数组中

                        //生成水印图
                        $water_name=time().rand(1000,9999)."water_".$imagename_old;//生成名字
                        $water_img=$img->water($path.$imagename,$path.$water_name,$water_file=('shuiyin.png'));//生成水印图路径
                        $input['water_img']=$water_img;//储存路径到数组中

                    }





                }



                    $input['time']=date("Y-m-d H:i:s",time());
                    $result=DB::table('news')->where('id',$id)->update($input);
                    if($result){

                        return redirect('admin/news/index');

                    }else{

                        return  back()->with('<script>alert("修改失败！")</script>');

                    }



            }


             //print_r($id);die;
                $ar = DB::table('news')->where('id', $id)->first();
            //print_r($ar);die;
                $category_id = $ar->category;
                $categoryall = DB::table('category')->where('pid', 1)->get();

                //加载视图：
                return view("admin/news/update", array('categoryall' => $categoryall, 'ar' => $ar, 'category_id' => $category_id));


        }




    public function delete($id){//传递id


       $ar = DB::table('news')->where('id', $id)->first();

        if(!empty($ar->images)){
        if(file_exists($ar->images));
        unlink($ar->images);
        if(file_exists($ar->thumb_img));
        unlink($ar->thumb_img);
        if(file_exists($ar->water_img));
        unlink($ar->water_img);
        }

        $result=DB::table('news')->where('id',$id)->delete();

         if($result>0){

             return redirect('admin/news/index');

         }else{

             return  back()->withErrors('<script>alert("删除失败！")</script>');

         }



    }












}
