<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\ImgController;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;//导入链接数据库命名空间
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;//导入input命名空间


class LoginController extends Controller
{
  public function login(Request $request){

 session_start();
if($_POST){
     $input=Input::except('_token');
   //print_r($input);die;
      $code=$input['param'];

    $VerifyCode=$_SESSION['VerifyCode'];//从session中获取验证码
      //print_r($VerifyCode);die;
      if (strtolower($code)==strtolower($VerifyCode)) {
          echo 'y';die;
      }else{
          echo '验证码输入错误！';die;
      }


  }

  /* session(['a'=>'999']);
   $a=session('a');
print_r($a);die;*/

   /*链接数据库的几种方法：
     get()获取多条，找出的是一个二维的数组
     first()获取一条，找出的是一个一维的数组
    * $arr=DB::table("admin")->where('id',值)->get();
    *$arr=DB::table("admin")->where(array('id'=>值))->get();
    *$arr=DB::table("admin")->where('id',值)->first();
    *$arr=DB::table("admin")->where(array('id'=>值))->first();
    * $arr=DB::table('admin')->lists('字段');查某个字段所有值
    * $arr=DB::table('admin')->select('字段','字段'....)->get();查多个字段
    *$arr=DB::table('admin')->select('字段')->distinct()->get();去掉字段重复的值
    * $arr=DB::table("admin")->where('id','!=',值)->get();查找不等于当前值得记录
    * */


 if($_GET){
   if($input=$request->all()){//判断是否是get请求

  //print_r($input);die;
      $names=$input["names"];//获取用户名
      $password=$input["password"];//获取密码
       if(!empty($input["remember"])){//判断是否勾选remember
       $remember=$input["remember"];
       }

     /*   //加密写法：注意：命名空间的添加
       $jbpassword=Crypt::encrypt($password);
       //print_r($jbpassword);die;
       $id = DB::table('admin')->insertGetId( ['names' =>$names, 'password' =>$jbpassword]);
       if($id>0){
           die;

       }*/
    $result=DB::table("admin")->where("names",$names)->first();

       //print_r($result);die;
       if($result){//代表用户名存在
            //解密数据库的密码：
           $dbpassword=Crypt::decrypt($result->password);
           if($password==$dbpassword){

              session(['names'=>$names]);//把用户名存到session中

               if(!empty($remember)){//判断remember是否为空，把用户名存到cookie中

                   $response = new Response($names);
                   $response->withCookie(cookie('name', '$names',60*60));
                   //return $response;
                   //echo 1;die;
               }


               /*$value = $request->cookie('names');
               //print_r($value);die;*/
              return redirect('admin/news/index');//跳转页面
           }else {

               return back()->with('msg', "密码错误");//返回上一页
           }

       }else{

          return back()->with('msg',"用户名错误");//返回上一页

       }

   }

 }


 return view('admin/login/login');//加载视图

  }


    public function loginout(Request $request){

        //清除session
            $request->session()->flush();


        //print_r(cookie("names"));die;
        //清除cookie
        if(!empty(cookie("names"))){
            $response = new Response();
            $response->withCookie(cookie('names', ''));
            $value = $request->cookie('names');
            //print_r($value);die;
            //return $response;
        }


        //print_r(cookie("names"));die;

        if(empty(session("names")) && empty($value) ){
        return redirect('admin/login/login');//跳转页面
        }

    }

    public function vcode(){



        $V=new ImgController();
        $vcode=$V->vCode(4);

    echo $vcode;die;

    }


    public function getpassword(){
        session_start();

        if($_POST){


            $input = Input::except('_token');//验证token值

            if(!empty($input['email'])){

                //print_r($input);die;
                unset($input['code']);
                unset($input['password1']);
                $input['password']=Crypt::encrypt($input['password']);
                $email=$input['email'];
                $result=DB::table('admin')->where('email',$email)->update($input);
                if($result){

                    echo '<script>alert("修改成功！")</script>';

                    return redirect('admin/login/login');//加载视图

                }else{

                    echo '<script>alert("修改失败！")</script>';die;

                }

            }


            $code=session('code');
            //print_r($input);
          //print_r($code);die;
           if($input['code']==$code){

               echo 1;die;
           }else{

               echo 0;die;

           }

        }

    return view('admin/login/getpassword');

    }


    public function sendemail(){

        $input = Input::except('_token');//验证token值
        //print_r($input);die;
        //print_r(1);die;
        $code =rand(100000,999999);
        //cookie("code",$code,time()+2*60);//将code存放在cookie中
        //Vendor("phpmailer.phpmailer");
        session(['code'=>$code]);


        //$mail             = new PHPMailer();//实例化一个邮件发送类
       include("../app/Http/Controllers/Admin/phpmailer/phpmailer.php");//加载邮件的库文件
        $mail             = new \PHPMailer();//实例化一个邮件发送类
        $body             = "验证码为:$code";//设置邮件发送内容
        $mail->IsSMTP(); // telling the class to use SMTP 使用smtp协议发送
        $mail->SMTPDebug  = 0;//错误调试：0表示不打开错误调试
        $mail->SMTPAuth   = true;
        $mail->CharSet    = "utf-8";
        $mail->Host       = "smtp.163.com"; // sets the SMTP server 设置发送邮件服务器，如：smtp.qq.com
        $mail->Port       = 25;                    // set the SMTP port for the GMAIL server 邮件发送服务的端口
        $mail->Username   = "penglifu123@163.com"; // SMTP account username 发送邮件的邮箱用户名，如：123@qq.com
        $mail->Password   = "penglifu123";        // SMTP account password 发送邮件的邮箱密码，如：123456，是123@qq.com的密码
        $mail->SetFrom('penglifu123@163.com', 'plf');//设置接收来源，如：123@qq.com
        $mail->AddReplyTo("penglifu123@163.com","plf");//回复邮箱，如果别人按回复按钮，会直接指定的回复邮箱
        $mail->Subject    = "找回密码";//标题,主题
        $mail->MsgHTML($body);//内容使用html格式


        $address = $input["email"];//接收方的邮箱地址

        $mail->AddAddress($address, "用户组");//有多个邮箱地址，使用多次
        // $mail->Send();//发送邮件
        $mail->Send();

        echo 1;




    }








}
