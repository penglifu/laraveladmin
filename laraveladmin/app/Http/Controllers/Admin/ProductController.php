<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Finder\SplFileInfo;

class ProductController extends Controller
{


    public function index(){
        //查询记录
        $ar = DB::table('product')
            ->Join('category', 'product.category', '=', 'category.id')
            ->select('product.*', 'category.name')
            ->orderBy('time', 'desc')
            ->paginate(5);

        //print_r($ar);die;
        foreach($ar as $k=>$v){

        $images=$v->images;
            unset($v->images);
        $ar[$k]->images=json_decode($images);

        }
        //print_r($ar);die;

        //实例化自己封装的分页页码类，并调用分页函数
        $p=new PageController();//实例化分页类
        $page=$p->pageNum($ar);//调用分页类中的函数
        //print_r($page);die;

        //加载视图：
        return view('admin/product/index',array('ar'=>$ar,'page'=>$page));

    }


    public function insert(){

        if($_POST){
            $input = Input::except('_token');
            //print_r($input);die;
            //获取厚度库存并求和：array_sum()
            $thickrepertory=$input["thickrepertory"];
            $numthick=array_sum($thickrepertory);
            //print_r($numthick);die;

            //获取尺寸库存并求和：array_sum()
            $sizerepertory=$input["sizerepertory"];
            $numsize=array_sum($sizerepertory);

            //获取颜色库存并求和：array_sum()
            $colorrepertory=$input["colorrepertory"];
            $numcolor=array_sum($colorrepertory);

            if ($numsize>$numthick){//判断尺寸尺码输入库存总数超过厚度之和

                echo ("<script>alert('尺码输入库存总数超过厚度之和！')</script>");
                   //从新加载视图
                $category=DB::table('category')->where('pid',6)->get();
                return view("admin/product/insert",array('category'=>$category));

            }

            if ($numcolor>$numthick){//判断颜色输入库存总数超过厚度之和

                echo ("<script>alert('颜色输入库存总数超过厚度之和！')</script>");
                //从新加载视图
                $category=DB::table('category')->where('pid',6)->get();
                return view("admin/product/insert",array('category'=>$category));

            }

            //转换数组为字符串
            $thickness=$input["thickness"];
            $input["thickness"]=json_encode($thickness);
            $size=$input["size"];
            $input["size"]=json_encode($size);
            $introduce=$input["introduce"];
            $input["introduce"]=json_encode($introduce);
            $thickrepertory=$input["thickrepertory"];
            $input["thickrepertory"]=json_encode($thickrepertory);
            $sizerepertory=$input["sizerepertory"];
            $input["sizerepertory"]=json_encode($sizerepertory);
            $colorrepertory=$input["colorrepertory"];
            $input["colorrepertory"]=json_encode($colorrepertory);

            //print_r($input);die;

            //获取传递图片的下标
            $check_image=$input["check_image"];
            unset($input["check_image"]);//取值后删除数组不需要的下标字段

            //根据下标判断上传时候选择图片之后是否有删除：
            $tmp_name=$input["images"];
            $image=[];
            foreach ($tmp_name as $k=>$v){//循环多张图片
                if (in_array($k, $check_image)){//判断图片选择之后是否有删除
                    $image[]=$v;//保存未删除的图片
                }

            }
          // print_r($images);die;
            //循环多张图片：
            $images=[];
            $thumb_img=[];
            $water_img=[];
            foreach($image as $k=>$v){

                $files=$v;//获取单张图片信息

                if($files->isValid()){//检查文件上传是否有效
                    //获取文件名称
                    $imagename_old=$files->getClientOriginalName();
                    $tmp=$files->guessClientExtension();//获取文件类型
                    $imagename=time().rand(1000,9999).$imagename_old;//生成文件新名字

                    $path= 'storage/Uploads/Product/';//定义上传文件的路径文件夹
                    $tmper=array('jpg', 'gif', 'png', 'jpeg');//限制上传文件类型
                    if(!in_array($tmp,$tmper)){//判断提示
                        echo '<script>alert("不支持该类型图片上传！")</script>';
                        //从新加载视图
                        $category=DB::table('category')->where('pid',6)->get();
                        return view("admin/product/insert",array('category'=>$category));

                    }

                    if (!file_exists($path)){//判断定义的路径是否存在
                        mkdir($path,0777,true);//不存在生成文件路径
                    }

                    $files->move($path,$imagename);//转移路径
                    $images[]=$path.$imagename;//储存路径到数组中

                    $img =new ImgController();//实例自己封装缩略图所在的类，然后调用封装的函数
                    //生成缩略图
                    $thumb_name=time().rand(1000,9999)."thumb_".$imagename_old;//生成名字
                    $thumb_img[]=$img->thumb($path.$imagename,$path.$thumb_name);//生成路径


                    //生成水印图
                    $water_name=time().rand(1000,9999)."water_".$imagename_old;//生成名字
                    $water_img[]=$img->water($path.$imagename,$path.$water_name,$water_file=('shuiyin.png'));//生成水印图路径


                }

                $input['images']=json_encode($images);//储存路径到数组中
                $input['thumb_img']=json_encode($thumb_img);//储存路径到数组中
                $input['water_img']=json_encode($water_img);//储存路径到数组中



            }


            $input['time']=date("Y-m-d H:i:s",time());
            $result=DB::table('product')->insert($input);
            if($result){

                return redirect('admin/product/index');

            }else{

                echo '<script>alert("新增失败！")</script>';
                //从新加载视图
                $category=DB::table('category')->where('pid',6)->get();
                return view("admin/product/insert",array('category'=>$category));

            }




        }

        $category=DB::table('category')->where('pid',6)->get();
        //print_r($category);die;
        //加载视图：
        return view("admin/product/insert",array('category'=>$category));
    }


    public function update($id){

        if($_POST){

            $input = Input::except('_token');
            //获取厚度库存并求和：array_sum()
            $thickrepertory=$input["thickrepertory"];
            $numthick=array_sum($thickrepertory);
            //print_r($numthick);die;

            //获取尺寸库存并求和：array_sum()
            $sizerepertory=$input["sizerepertory"];
            $numsize=array_sum($sizerepertory);

            //获取颜色库存并求和：array_sum()
            $colorrepertory=$input["colorrepertory"];
            $numcolor=array_sum($colorrepertory);

            if ($numsize>$numthick){//判断尺寸尺码输入库存总数超过厚度之和

                echo ("<script>alert('尺码输入库存总数超过厚度之和！')</script>");
                //从新加载视图
                $category=DB::table('category')->where('pid',6)->get();
                return view("admin/product/insert",array('category'=>$category));

            }

            if ($numcolor>$numthick){//判断颜色输入库存总数超过厚度之和

                echo ("<script>alert('颜色输入库存总数超过厚度之和！')</script>");
                //从新加载视图
                $category=DB::table('category')->where('pid',6)->get();
                return view("admin/product/insert",array('category'=>$category));

            }

            //转换数组为字符串
            $thickness=$input["thickness"];
            $input["thickness"]=json_encode($thickness);
            $size=$input["size"];
            $input["size"]=json_encode($size);
            $introduce=$input["introduce"];
            $input["introduce"]=json_encode($introduce);
            $thickrepertory=$input["thickrepertory"];
            $input["thickrepertory"]=json_encode($thickrepertory);
            $sizerepertory=$input["sizerepertory"];
            $input["sizerepertory"]=json_encode($sizerepertory);
            $colorrepertory=$input["colorrepertory"];
            $input["colorrepertory"]=json_encode($colorrepertory);

           // print_r($input);die;

          //处理图片上传-----------------------------------
            //定义三个空数组接收三种图片
            $images=[];
            $thumb_img=[];
            $water_img=[];

            //处理原图图片是否全部删除--------------------------------------------
            if (!empty($input["images_old"])){//判断原图是否删除
                $images_old=$input["images_old"];//获取上传图片的临时下标
                //print_r($images_old);die;
                unset($input["images_old"]);//数据库不存在对应的字段删除临时下标

                $oldarr= DB::table('product')->where('id', $id)->first();//查询数据库中的记录
                //print_r($oldarr);die;
                $oldimages=json_decode($oldarr->images);//把字符串图片转换为数组
                $oldthumb_img=json_decode($oldarr->thumb_img);
                $oldwater_img=json_decode($oldarr->water_img);
                //print_r($oldimages);die;
                //保存原图没被删除的路径--------------------------------------

                foreach ($oldimages as $k=>$v){//循环多张图片
                    if (in_array($k, $images_old)){//判断数据库中取出的图片的下标是否在传参过来的临时临时下标中
                        $images[]=$v;//保存未删除的原图在定义的数组中
                    }else{
                        if (file_exists($oldimages[$k]))
                            unlink($oldimages[$k]);

                    }

                }


                foreach ($oldthumb_img as $k=>$v){//循环多张图片
                    if (in_array($k, $images_old)){//判断数据库中取出的图片的下标是否在传参过来的临时临时下标中
                        $thumb_img[]=$v;//保存未删除的原图在定义的数组中
                    }else{
                        if (file_exists($oldthumb_img[$k]))
                            unlink($oldthumb_img[$k]);

                    }

                }


                foreach ($oldwater_img as $k=>$v){//循环多张图片
                    if (in_array($k, $images_old)){//判断数据库中取出的图片的下标是否在传参过来的临时临时下标中
                        $water_img[]=$v;//保存未删除的原图在定义的数组中
                    }else{
                        if (file_exists($oldwater_img[$k]))
                            unlink($oldwater_img[$k]);

                    }

                }
            }else {//当前原图全部删除的时候：删除原图对应的所有图片

                $yuanarr= DB::table('product')->where('id', $id)->first();//根据id查出所有的记录
                //print_r($yuanarr);die;
                $yuanimages=json_decode($yuanarr->images);//转换字符串图片为数组
                $yuanthumb_img=json_decode($yuanarr->thumb_img);
                $yuanwater_img=json_decode($yuanarr->water_img);
                //print_r($yuanimages);die;
                foreach ($yuanimages as $k=>$v){//删除对应的文件中的图片
                    if (file_exists($yuanimages[$k]));
                    unlink($yuanimages[$k]);
                    if (file_exists($yuanthumb_img[$k]));
                    unlink($yuanthumb_img[$k]);
                    if (file_exists($yuanwater_img[$k]));
                    unlink($yuanwater_img[$k]);
                }

            }



            //处理新上传的图片是否上传的时候有删除-------------------------------------
            if (!empty($input["check_image"])) {
                $check_image = $input["check_image"];//获取上传图片的临时下标
                unset($input["check_image"]);//数据库不存在对应的字段删除临时下标
                $tmp_name = $input['images'];//获取图片的临时路径
                $imagesshang = [];
                foreach ($tmp_name as $k => $v) {//循环多张图片
                    if (in_array($k, $check_image)) {//判断图片的下标是否在传参过来的临时临时下标中
                        $imagesshang[] = $v;//保存在的临时路径
                    }

                }
              //print_r($imagesshang);die;

                foreach($imagesshang as $v){

                    $files=$v;//获取单张图片信息

                    if($files->isValid()){//检查文件上传是否有效
                        //获取文件名称
                        $imagename_old=$files->getClientOriginalName();
                        $tmp=$files->guessClientExtension();//获取文件类型
                        $imagename=time().rand(1000,9999).$imagename_old;//生成文件新名字

                        $path= 'storage/Uploads/Product/';//定义上传文件的路径文件夹
                        $tmper=array('jpg', 'gif', 'png', 'jpeg');//限制上传文件类型
                        if(!in_array($tmp,$tmper)){//判断提示
                            echo '<script>alert("不支持该类型图片上传！")</script>';
                            //从新加载视图
                            $category=DB::table('category')->where('pid',6)->get();
                            return view("admin/product/insert",array('category'=>$category));

                        }

                        if (!file_exists($path)){//判断定义的路径是否存在
                            mkdir($path,0777,true);//不存在生成文件路径
                        }

                        $files->move($path,$imagename);//转移路径
                        $images[]=$path.$imagename;//储存路径到数组中

                        $img =new ImgController();//实例自己封装缩略图所在的类，然后调用封装的函数
                        //生成缩略图
                        $thumb_name=time().rand(1000,9999)."thumb_".$imagename_old;//生成名字
                        $thumb_img[]=$img->thumb($path.$imagename,$path.$thumb_name);//生成路径


                        //生成水印图
                        $water_name=time().rand(1000,9999)."water_".$imagename_old;//生成名字
                        $water_img[]=$img->water($path.$imagename,$path.$water_name,$water_file=('shuiyin.png'));//生成水印图路径


                    }



                }

            }

            $input['images']=json_encode($images);//储存路径到数组中
            $input['thumb_img']=json_encode($thumb_img);//储存路径到数组中
            $input['water_img']=json_encode($water_img);//储存路径到数组中


            //添加当前时间
            $input['time']=date("Y-m-d H:i:s",time());
            $result=DB::table('product')->where('id',$id)->update($input);//删除对应的记录
            if($result){

                return redirect('admin/product/index');

            }else{

                echo '<script>alert("修改失败！")</script>';//提示错误，从新加列表页面
                //从新加载视图
                //print_r($id);die;
                $ar = DB::table('product')->where('id', $id)->first();

                $introduce=json_decode($ar->introduce);
                $ar->introduce=$introduce;

                $images=json_decode($ar->images);
                $ar->images=$images;

                $thickness=json_decode($ar->thickness);
                $ar->thickness=$thickness;

                $size=json_decode($ar->size);
                $ar->size=$size;

                $thickrepertory=json_decode($ar->thickrepertory);
                $ar->thickrepertory=$thickrepertory;

                $sizerepertory=json_decode($ar->sizerepertory);
                $ar->sizerepertory=$sizerepertory;

                $colorrepertory=json_decode($ar->colorrepertory);
                $ar->colorrepertory=$colorrepertory;

                //print_r($ar);die;
                $category_id = $ar->category;
                $categoryall = DB::table('category')->where('pid', 6)->get();

                return view("admin/product/update", array('categoryall' => $categoryall, 'ar' => $ar, 'category_id' => $category_id));

            }



        }



        //print_r($id);die;
        $ar = DB::table('product')->where('id', $id)->first();

        $introduce=json_decode($ar->introduce);
        $ar->introduce=$introduce;

        $images=json_decode($ar->images);
        $ar->images=$images;

        $thickness=json_decode($ar->thickness);
        $ar->thickness=$thickness;

        $size=json_decode($ar->size);
        $ar->size=$size;

        $thickrepertory=json_decode($ar->thickrepertory);
        $ar->thickrepertory=$thickrepertory;

        $sizerepertory=json_decode($ar->sizerepertory);
        $ar->sizerepertory=$sizerepertory;

        $colorrepertory=json_decode($ar->colorrepertory);
        $ar->colorrepertory=$colorrepertory;

        //print_r($ar);die;
        $category_id = $ar->category;
        $categoryall = DB::table('category')->where('pid', 6)->get();

        return view("admin/product/update", array('categoryall' => $categoryall, 'ar' => $ar, 'category_id' => $category_id));
    }



    public function delete($id){

        $yuanarr=DB::table('product')->where('id',$id)->first();

        //print_r($yuanarr);die;
        if(!empty($yuanarr->images)){
        $yuanimages=json_decode($yuanarr->images);
        $yuanthumb_img=json_decode($yuanarr->thumb_img);
        $yuanwater_img=json_decode($yuanarr->water_img);
        //print_r($yuanimages);die;
        foreach ($yuanimages as $k=>$v){
            if (file_exists($yuanimages[$k]));
            unlink($yuanimages[$k]);
            if (file_exists($yuanthumb_img[$k]));
            unlink($yuanthumb_img[$k]);
            if (file_exists($yuanwater_img[$k]));
            unlink($yuanwater_img[$k]);
        }
      }

        $result=DB::table('product')->where('id',$id)->delete();
        if($result>0){

            return redirect('admin/product/index');

        }else{


            echo '<script>alert("删除失败！")</script>';
            //从新加载视图
            //查询记录
            $ar = DB::table('product')
                ->Join('category', 'product.category', '=', 'category.id')
                ->select('product.*', 'category.name')
                ->orderBy('time', 'desc')
                ->paginate(5);

            //print_r($ar);die;
            foreach($ar as $k=>$v){

                $images=$v->images;
                unset($v->images);
                $ar[$k]->images=json_decode($images);

            }
            //print_r($ar);die;

            //实例化自己封装的分页页码类，并调用分页函数
            $p=new PageController();//实例化分页类
            $page=$p->pageNum($ar);//调用分页类中的函数
            //print_r($page);die;

            //加载视图：
            return view('admin/product/index',array('ar'=>$ar,'page'=>$page));

        }





    }




}
