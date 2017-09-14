<?php
namespace Home\Controller;
use Think\Controller;
class MemberCenterController extends MeCenterController {
	//图片上传---------------------------------------------------------
	//定义图片路径：
	public $path= './Uploads/MemberCenter/';//上传文件的路径文件夹
	public function upload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		if (!file_exists($this->path)){//判断定义的路径是否存在
			mkdir($this->path,0777,true);
		}
		$upload->rootPath = $this->path; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录 // 上传文件
	 
		//上传文件
		$info = $upload->upload();
		//print_r($info);die;
		//设置原图上传图片的路径：$info为一个数组
		foreach ($info as $v){
			$images=$this->path.$v["savepath"].$v["savename"];//拼接原图路径
		}
		//print_r($images);die;
		return $images;
	}
	//图片上传---------------------------------------------------------
	
	//个人信息---------------------------------------------------------
    public function MemberCenter (){
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	$username=session("username");
    	$arr=M("siteadmin")->where("`username`='$username'")->find();
    	$images=$arr["images"];
    	$this->assign("images",$images);
    	$this->assign("username",$username);
    	
    	$result=M('details')->where(" `username`='$username' ")->count();
    	$this->assign("result",$result);
    	
    	$result1=M('shopping')->where(" `username`='$username' && `state`='c' ")->count();
    	$this->assign("result1",$result1);
    	 
    	//猜你喜欢产品：
    	$four= M('product')->limit(4)->order('id desc')->select();
    	//print_r($four);die;
    	$this->assign("four",$four);
    	
    	
    	$time=date("Y-m-d",time());
    	$sult=M('details')->where(" `username`='$username' && `time`='$time' ")->select();
    	
    	$num=[];
    	foreach ($sult as $k=>$v){
    		
    		$number=$v["number"];
    		$promotion_price=$v["promotion_price"];
    		$price1=$number*$promotion_price;
    		$num[]=$price1;
    	}
    	$price=array_sum($num);
    	//print_r($price);die;
    	$this->assign("price",$price);
    	
    	//加载模板
    	$this->display();
    }
    //个人信息---------------------------------------------------------
    
    
    //修改密码---------------------------------------------------------
    public function ChangePassword(){
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	 
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	
    	//判断ajax：
    	if (IS_AJAX){
    		$param=md5($_POST['param']);
    		//print_r($username);die;
    		$arr=M("siteadmin")->where("`password`='$param'")->find();
    		//print_r($arr);die;
    		if ($arr){
    			echo "y";die;
    		}else{
    			echo "密码错误！";die;
    		}
    		
    	}
    	
    	if (IS_POST){
    		$password=md5($_POST['password']);
    		$_POST['password']=$password;
    		$username=session("username");
    		//print_r($username);die;
    		$result=M('siteadmin')->data($_POST)->where("`username`='$username'")->save();
    		//print_r($result);die;
    		if ($result>=0){
    			
    			echo "<script>alert('修改成功！')</script>";
    		}else{
    			echo "<script>alert('修改失败！')</script>";
    			
    		}
    		
    	}
    	//加载模板
    	$this->display();
    }
    //修改密码---------------------------------------------------------
    
   
    //收货地址---------------------------------------------------------
    public function MakeSureTheOrderAndTheAddress(){
    	

    	if(IS_AJAX){
    	
    		$id=$_POST['id'];
    		$result=M('address')->where("`id`='$id'")->delete();
    		if ($result>0){
    			echo 0;die;
    		}else {
    			echo 1;die;
    		}
    	}
    	 
    	 
    	
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	   
    	//查询地址：
    	$username=session("username");
    	$address=M("address")->where("`username`='$username'")->select();
    	//print_r($address);die;
    	$this->assign("address",$address);
    	
    	//print_r($address);die;
    	if (!empty($_GET)){
    		
    		if (is_array($_GET["checkbox"])){
    			
                $totals=$_GET["price"];
                
    			//print_r($_GET);die;
                $list=[];
    			foreach ($_GET["checkbox"] as $k=>$v){
    			
    				$id=$v;
    				$shop=M('shopping')->where(array("id"=>$id))->find();
    				//print_r($list);die;
    			    

    					$colorvalue=$shop["colorvalue"];
    					$product_id=$shop["product_id"];
    					//print_r($product_id);die;
    					$product= M('product')->where(array("id"=>$product_id))->find();//查询产品表
    					//print_r($product);die;
    					//取出字段
    					$des=$product["des"];
    					$promotion_price=$product["promotion_price"];
    						
    					$images=json_decode($product["images"]);
    				
    					//print_r($image);die;
    					foreach ($images as $k1=>$v1){
    						if ($k1==$colorvalue){
    							$image=$v1;
    						}
    				
    					}
    					//print_r($image);die;
    					//循环追加字段
    						
    					$price=$shop["number"]*$promotion_price;
    					$shop["price"]=$price;
    					
    					$shop["image"]=$image;
    					$shop["des"]=$des;
    					$shop["promotion_price"]=$promotion_price;
    						
    					
    					$list[]=$shop;
    			}
    			
    			
    			//print_r($list);die;
    			$this->assign('list',$list);// 赋值数据集
    			$this->assign("totals",$totals);
    			
    			
    			
    		}else {
    		
    		$id=$_GET["id"];
    		$state=$_GET["state"];
    		//print_r($state);die;
    		
    		$username=session("username");
    		
    		$list1 = M("shopping")->where(array("product_id"=>$id,"username"=>$username,"state"=>$state))->field("shopping.*,product.promotion_price,product.images,product.des")->join('LEFT JOIN __PRODUCT__ ON __SHOPPING__.product_id= __PRODUCT__.id' )->order('time DESC')->find();
    		//print_r($list1);die;
    		$price=$list1["promotion_price"]*$list1["number"];
    		$totals=$list1["promotion_price"]*$list1["number"];
    		$list1["price"]=$price;
    		
    		$colorvalue=$list1["colorvalue"];
    		//print_r($colorvalue);die;
    		$images=json_decode($list1["images"]);
    		//print_r($images);die;
    		foreach ($images as $k=>$v){
    			if ($k==$colorvalue){
    				$image=$v;
    				
    			}
    			
    			
    		}
    		//print_r($image);die;
    		
    		$list1["image"]=$image;
    		$list[]=$list1;
    	  //print_r($list);die;
    		$this->assign("list",$list);
    		$this->assign("totals",$totals);
    		}
    	}else {
    			echo "<script>alert('请选择商品！')</script>";
    			 
    		}
    	
    	

    		if (!empty($_POST)){
    			 
    		//print_r($_POST);die;
    			$address_id=$_POST["makesure_address"];
    			unset($_POST["makesure_address"]);
    			$_POST["address_id"]=$address_id;
    		
    			$color=json_encode($_POST["color"]);
    			$_POST["color"]=$color;
    			$shopping_id=json_encode($_POST["shopping_id"]);
    			//print_r($shopping_id);die;
    			
    			$_POST["shopping_id"]=$shopping_id;
    			$product_id=json_encode($_POST["product_id"]);
    			$_POST["product_id"]=$product_id;
    			$number=json_encode($_POST["number"]);
    			$_POST["number"]=$number;
    			$ordernum=json_encode($_POST["ordernum"]);
    			$_POST["ordernum"]=$ordernum;
    			
    			$_POST["username"]=session("username");
    		
    			$addr=M('indent')->where(array("color"=>$color,"shopping_id"=>$shopping_id,"number"=>$number,"status"=>1))->find();
    			//print_r($addr);die;
    			if(empty($addr)){
    				$_POST["time"]=date("Y-m-d",time());
    				$status=1;
    				$_POST["status"]=$status;
    				//print_r($_POST);die;
    				$result=M("indent")->data($_POST)->add();
    				if ($result>0){
    					$id=$result;
    				//print_r($result);die;
    				
    				$this->redirect("MemberCenter/OrderSubmitSuccess",array("id"=>$id));die;
    				}
    				//print_r($arr);die;
    		
    			}else{
    				 
    				echo "<script>alert('请勿重复提交订单！')</script>";
    				
    			}
    			 
    		}
    		
    		
    		
    		
    	//加载模板
    	$this->display();
    }
    //收货地址---------------------------------------------------------
    
    
    //提交失败---------------------------------------------------------
    public function OrderSubmitFail(){
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	   
    	//加载模板
    	$this->display();
    }
    //提交失败---------------------------------------------------------
    
    
    //提交成功---------------------------------------------------------
    public function OrderSubmitSuccess(){
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	
    	if($_GET["id"]){
    		$id=$_GET["id"];
    		//print_r($id);die;
    		$arra=M('indent')->where("`id`='$id'")->find();
    
    	//print_r($arr);die;
    	$address_id=$arra["address_id"];
    	$addr=M('address')->where("`id`='$address_id'")->find();
    	$arra["address"]=$addr["address"];
    	$arra["phone"]=$addr["phone"];
    	$arra["name"]=$addr["name"];
    	//print_r($arra);die;
    	$this->assign("arra",$arra);
    	
   	}
   	
   	if($_GET["ordernum"]){
   		
   		$ordernum=$_GET["ordernum"];
   		$id=$_GET["id"];
   		$arra=M('details')->where("`id`='$id'")->find();
   		//print_r($arra);die;
   		$price=$arra["promotion_price"]*$arra["number"];
   		$arra["price"]=$price;
   		//print_r($arra);die;
   		$this->assign("arra",$arra);
   		
   	}
   	
   	
   	
   	
    	//加载模板
    	$this->display();
    }
    //提交成功---------------------------------------------------------
    
    
    //资料修改---------------------------------------------------------
    public function PersonalDateModifyView(){
    if (IS_AJAX){
			$param=$_POST["param"];
			$id=I("get.id");
			//print_r($id);die;
			$arr=M('siteadmin')->where("`id`='$id'")->find();
			if (!empty($arr) && $arr["id"]!=I("get.id")){
				echo "验证失败！";die;
			}else{
				
				echo y;die;
					
			}
		}
    	
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	
    	$username=session("username");
    	//print_r($username);die;
    	$nick=M("siteadmin")->where("`username`='$username'")->find();
    	$this->assign("nick",$nick);
    	$id=$nick["id"];
    	
    	//用户修改信息：   
        if (!empty($_POST)){
        	if (!empty($_FILES['images']['name'])){
        	  //print_r($_FILES);die;
        	  $arr=M("siteadmin")->where("`id`='$id'")->find();
        	//print_r($arr);die;
        	 if (file_exists($arr["images"]))
   				unlink($arr["images"]);
        	   //print_r($arr);die;
        	//上传文件
        	$info=$this->upload();
        	//print_r($info);die;
        	$_POST["images"]=$info;
        	}else {
        		
        		unset($_POST["images"]);
        		
        	}
        	//追加时间字段：
        	$_POST["time"]=date("Y-m-d H:i:s",time());
        	
        	$result=M('siteadmin')->data($_POST)->where("`id`='$id'")->save();
        	
        	if ($result>0){
        		$this->redirect("MemberCenter/MemberCenter");
        	}else{
        		$this->error("修改失败");
        	}
        	
        }
    	 
    
    	//加载模板
    	$this->display();
    }
    //资料修改---------------------------------------------------------
    
    //购买记录---------------------------------------------------------
    public function PurchaseRecords(){
    	
    	

    	if(IS_AJAX){
    	   if (IS_POST){
    		$id=$_POST['id'];
    		$result=M('details')->where("`id`='$id'")->delete();
    		if ($result>0){
    			echo 0;die;
    		}else {
    			echo 1;die;
    		}
    		
    	   }
    		
    	if (IS_GET){
    		$id=$_GET['id'];
    		$shouhuo= "已收货";
    		$result1=M('details')->where("`id`='$id'")->setField('shouhuo',$shouhuo);
    		if ($result1>0){
    			    echo 0;die;
    			}else {
    				echo 1;die;
    			}
    			
    		
    	}
    		
    		
    	}
    	 
    	
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	 if (IS_GET){
    	 //print_r(strlen($_GET["ordernum"]));die;
    	   $num=strlen($_GET["ordernum"]);
    	  // print_r($num);die;
    	 if ($num>16){
    	 	$id=$_GET["id"];
    	 	//print_r($id);die;
    	 	
    	 	$arr=M("indent")->where("`id`='$id'")->find();
    	 	
    	 	$arr1=[];
    	 	$number=json_decode($arr["number"]);
    	 	$arr1["number"]=$number;
    	 	$color=json_decode($arr["color"]);
    	 	$arr1["color"]=$color;
    	 	$ordernum=json_decode($arr["ordernum"]);
    	 	$arr1["ordernum"]=$ordernum;
    	 	//print_r($arr1);die;
    	 	$arr2=[];
    	 	foreach($arr1["number"] as $k=>$v){
    	 		$arr2[] = array_column($arr1,$k);//在一个二维数组中取出k相同的 值；
    	 		
    	 		//print_r($arr2);die;
    	 	foreach ($arr2 as $k2=>$v2){
    	 		
    	 		$arr2[$k]["number"]=$v2[0];
    	 		unset($arr2[0][0]);
    	 		$arr2[$k]["color"]=$v2[1];
    	 		unset($arr2[0][1]);
    	 		$arr2[$k]["ordernum"]=$v2[2];
    	 		unset($arr2[0][2]);
    	 	}
    	 	
    	 	
    	 	//print_r($arr2);die;
    	 		
    	 		$product_id1=json_decode($arr["product_id"]);
    	 		//print_r($product_id1);die;
    	 		$arr7=[];
    	 		foreach ($product_id1 as $k1=>$v1){
    	 			$arr3=M("product")->where("`id`='$v1'")->find();
    	 		    
    	 			$image=json_decode($arr3['images']);
    	 			foreach ($image as $ki=>$vi ){
    	 				if ($arr2[0]['color']==$ki){
    	 					$arr7[$k1]["images"]=$vi;
    	 				}
    	 				
    	 				
    	 			}
    	 			
    	 			$product_id=$v1;
    	 			$arr7[$k1]["product_id"]=$product_id;
    	 			$des=$arr3['des'];
    	 			$promotion_price=$arr3['promotion_price'];
    	 			//print_r($arr3);die;
    	 			
    	 			$arr7[$k1]["des"]=$des;
    	 			$arr7[$k1]["promotion_price"]=$promotion_price;
    	 		}
    	 		
    	 		//print_r($arr7);die;
    	 		
    	 			
    	 			$arr4=M("indent")->where("`id`='$id'")->find();
    	 			
    	 			//print_r($arr4);die;
    	 			//放入地址，时间 
    	 			$arr2[$k]["time"]=$arr4["time"];
    	 			$arr2[$k]["chuxiao"]=$arr4["chuxiao"];
    	 			$arr2[$k]["maseege"]=$arr4["maseege"];
    	 			$arr2[$k]["discount"]=$arr4["discount"];
    	 			$arr2[$k]["peishong"]=$arr4["peishong"];
    	 			$address_id=$arr4["address_id"];
    	 			//查询地址，
    	 			$arr5=M("address")->where("`id`='$address_id'")->find();
    	 			//print_r($arr5);die;
    	 			$arr2[$k]["address"]=$arr5["address"];
    	 			$arr2[$k]["phone"]=$arr5["phone"];
    	 			$arr2[$k]["name"]=$arr5["name"];
    	 			$username=session("username");
    	 			$arr2[$k]["username"]=$arr5["username"];
    	 		
    	 		
    	 		 
    	 		
    	 	}
    	 	
    	 	//删除多余字段
    	 	 foreach ($arr2 as $k7=>$v7){
    	 		   unset($arr2[$k7]["0"]);
    	 		   unset($arr2[$k7]["1"]);
    	 		   unset($arr2[$k7]["2"]);
    	 		   unset($arr2[$k7]["color"]);
    	 	} 
    	 	
    	 	foreach ($arr2 as $k=>$v){
    	 		
    	 		foreach ($arr7 as $kr=>$vr){
    	 			
    	 			$arr2[$kr]["images"]=$vr["images"];
    	 			$arr2[$kr]["product_id"]=$vr["product_id"];
    	 			$arr2[$kr]["des"]=$vr["des"];
    	 			$arr2[$kr]["promotion_price"]=$vr["promotion_price"];
    	 			//print_r($vr);die;
    	 			
    	 			
    	 		}
    	 		
    	 	}
    	 	
    	 	//print_r($arr7);die;
    	   //print_r($arr2);die;
    	 	
    	 	
    	 	foreach ($arr2 as $k8=>$v8){
    	 		
    	 		  $_POST=$v8;
    	 		  $_POST["zhihu"]="已付款";
    	 		  $fahuo="未发货";
    	 		  $_POST["fahuo"]=$fahuo;
    	 		  $_POST["time1"]=date("Y-m-d H:i:s",time());
    	 		  $_POST["time2"]=date("Y-m",time());
    	 		 //print_r($_POST);die;
    	 		  $result=M("details")->data($_POST)->add();
    	 		
    	 	}
    	 	
    	 	if ($result>0){
    	 		$arr8=M("indent")->where("`id`='$id'")->find();
    	 		$shopping_id=json_decode($arr8["shopping_id"]);
    	 		foreach ($shopping_id as $ks=>$vs){
    	 			$arr9=M("shopping")->where("`id`='$vs'")->find();
    	 			$number=$arr9["number"];
    	 			$colorvalue=$arr9["colorvalue"];
    	 			
    	 			//print_r($arr9);die;
    	 			$thicknessvalue=$arr9["thicknessvalue"];
    	 			$sizevalue=$arr9["sizevalue"];
    	 			
    	 			
    	 			$product_id=$arr9["product_id"];
    	 			$arr10=M("product")->where("`id`='$product_id'")->find();
    	 			//print_r($arr10);die;
    	 			
    	 			$colorrepertory=json_decode($arr10["colorrepertory"]);
    	 			foreach ($colorrepertory as $k=>$v){
    	 				if ($colorvalue==$k){
    	 					$colorrepertory[$k]=$v-$number;
    	 				}
    	 				
    	 			}
    	 			$arr10["colorrepertory"]=json_encode($colorrepertory);
    	 			
    	 			
    	 			$thickness=json_decode($arr10["thickness"]);
    	 			$thickrepertory=json_decode($arr10["thickrepertory"]);
    	 			foreach ($thickness as $k=>$v){
    	 				if($thicknessvalue==$v){
    	 					$a=$k;
    	 			       foreach($thickrepertory as $k1=>$v1){
    	 					  if($a==$k1){
    	 					  	$thickrepertory[$k]=$v1-$number;
    	 					  	
    	 					  }
    	 						
    	 					}
    	 					
    	 				}
    	 				
    	 			}
    	 			$arr10["thickrepertory"]=json_encode($thickrepertory);
    	 			
    	 			
    	 			$size=json_decode($arr10["size"]);
    	 			$sizerepertory=json_decode($arr10["sizerepertory"]);
    	 			foreach ($size as $k=>$v){
    	 				if($sizevalue==$v){
    	 					$a=$k;
    	 					foreach($sizerepertory as $k1=>$v1){
    	 						if($a==$k1){
    	 							$sizerepertory[$k]=$v1-$number;
    	 			
    	 						}
    	 			
    	 					}
    	 					 
    	 				}
    	 			
    	 			}
    	 			//print_r($sizerepertory);die;
    	 			$arr10["sizerepertory"]=json_encode($sizerepertory);
    	 			
    	 			$_POST=$arr10;
    	 			
    	 			//print_r($_POST);die;
    	 			$result=M("product")->data($_POST)->where(array("id"=>$product_id))->save();
    	 			//print_r($result);die;
    	 			
    	 			
    	 			$result1=M("shopping")->where("`id`='$vs'")->delete();
    	 			
    	 		}
    	 		$result2=M("indent")->where("`id`='$id'")->delete();
    	 		
    	 	}
    	 	
    	 	
    	 	
    	 	
       }else{
       	  $id=$_GET["id"];
       	  
       	  $result=M("details")->where(array("id"=>$id))->setField('zhihu','已付款');
       	  if ($result>0){
       	  	$ordernum=$_GET["ordernum"];
       	  	
       	  	$arrk=M("details")->where("`id`='$id'")->find();
       	  	$shopping_idk=$arrk["shopping_id"];
       	  	
       	  	$result1=M("shopping")->where("`ordernum`='$ordernum' && `id`='$shopping_idk' ")->delete();
       	  	if($result1>0){
       	  	$this->redirect("MemberCenter/PurchaseRecords");
       	  	}
       	  	
       	  }
       }
    	
    }	

   //查看是否有未支付订单
    	 $mrr= M("indent")->select();
    	 
    	 $li=[];
    	// print_r($mrr);die;
    	 if($mrr){
    	 	
    	 	foreach ($mrr as $k=>$v){
    	 		$idin=$v["id"];
    	 		$pro_id=json_decode($v["product_id"]);
    	 		$number1=json_decode($v["number"]);
    	 		$color1=json_decode($v["color"]);
    	 		$ordernum1=json_decode($v["ordernum"]);
    	 		$shopping_id1=json_decode($v["shopping_id"]);
    	 		
    	 		$address_id=$v["address_id"];
    	 		//print_r(count($pro_id));die;
    	 		
    	 	if( count($pro_id)>1){
    	 			
    	 		foreach ( $pro_id as $k1=>$v1){
    	 			
    	 			$id2=$v["id"];
    	 			$li[$k]["indent_id"]=$id2;
    	 			$li[$k]["product_id"]=$v1;
    	 			
    	 			$zhihu="未支付";
    	 			$li[$k]["zhihu"]=$zhihu;
    	 			
    	 			$fahuo="未发货";
    	 			$li[$k]["fahuo"]=$fahuo;
    	 				
    	 			
    	 			$time=$v["time"];
    	 			$li[$k]["time"]=$time;
    	 			
    	 			$li[$k]["chuxiao"]=$v["chuxiao"];
    	 			$li[$k]["maseege"]=$v["maseege"];
    	 			$li[$k]["discount"]=$v["discount"];
    	 			$li[$k]["peishong"]=$v["peishong"];
    	 			
    	 			$arrk=M("address")->where("`id`='$address_id'")->find();
    	 			//print_r($arrk);die;
    	 			$li[$k]["address"]=$arrk["address"];
    	 			$li[$k]["phone"]=$arrk["phone"];
    	 			$li[$k]["name"]=$arrk["name"];
    	 			
    	 			
    	 			//print_r($v1);die;
    	 			
    	 			$mrr1=M("product")->where("`id`='$v1'")->find();
    	 			$des=$mrr1["des"];
    	 			$li[$k]["des"]=$des;
    	 			$promotion_price=$mrr1["promotion_price"];
    	 			$li[$k]["promotion_price"]=$promotion_price;
    	 			//print_r($mrr1);die;
    	 			$images=json_decode($mrr1["images"]);
    	 			
    	 			foreach ($images as $k2=>$v2){
    	 				
    	 				foreach ($color1 as $kc=>$vc){
    	 				if ($k2==$vc){
    	 					$li[$k]["images"]=$v2;
    	 			
    	 				}
    	 			  } 
    	 			}
    	 		
    	 			foreach ($number1 as $kc=>$vc){
    	 				if($k1==$kc){
    	 				$li[$k]["number"]=$vc;
    	 				}
    	 			}
    	 			
    	 			foreach ($ordernum1 as $kc=>$vc){
    	 				if ($k1==$kc){
    	 				$li[$k]["ordernum"]=$vc;
    	 				}
    	 			}
    	 			
    	 			foreach ($shopping_id1 as $kc=>$vc){
    	 				if ($k1==$kc){
    	 					$li[$k]["shopping_id"]=$vc;
    	 				}
    	 			}
    	 			
    	 			
    	 			
    	 			
    	 			
    	 			$hr[]=$li;
    	 			
    	 		}
    	 		
    	 		
    	 		//print_r($hr);die;
    	 		
    	 		foreach ($hr as $ki=>$vi){
    	 			//print_r($vi);die;
    	 			foreach ($vi as $k9=>$v9){
    	 				//print_r($v9);die;
    	 				$ordernum=$v9["ordernum"];
    	 			$_POST=$v9;
    	 			$username=session("username");
    	 			$_POST["username"]=$username;
    	 			$_POST["time1"]=date("Y-m-d H:i:s",time());
    	 			$mt=M("details")->where("`ordernum`='$ordernum' && `username`='$username'")->find();
    	 			if (!$mt){
    	 				$result=M("details")->data($_POST)->add();
    	 			}else{
    	 				$result=M('indent')->where("`id`='$idin'")->delete();
    	 			}
    	 		  }
    	 		}
    	 	}else {
    	 		
    	 		foreach ( $pro_id as $k1=>$v1){
    	 			//print_r($v1);die;	
    	 			$id2=$v["id"];
    	 			$li[$k]["indent_id"]=$id2;
    	 			$li[$k]["product_id"]=$v1;
    	 			
    	 			$zhihu="未支付";
    	 			$li[$k]["zhihu"]=$zhihu;
    	 			$fahuo="未发货";
    	 			$li[$k]["fahuo"]=$fahuo;
    	 			
    	 			$time=$v["time"];
    	 			$li[$k]["time"]=$time;
    	 			
    	 			$li[$k]["chuxiao"]=$v["chuxiao"];
    	 			$li[$k]["maseege"]=$v["maseege"];
    	 			$li[$k]["discount"]=$v["discount"];
    	 			$li[$k]["peishong"]=$v["peishong"];
    	 			//print_r($v1);die;
    	 				
    	 			$mrr1=M("product")->where("`id`='$v1'")->find();
    	 			$des=$mrr1["des"];
    	 			$li[$k]["des"]=$des;
    	 			$promotion_price=$mrr1["promotion_price"];
    	 			$li[$k]["promotion_price"]=$promotion_price;
    	 			
    	 			$arrk=M("address")->where("`id`='$address_id'")->find();
    	 			//print_r($arr5);die;
    	 			$li[$k]["address"]=$arrk["address"];
    	 			$li[$k]["phone"]=$arrk["phone"];
    	 			$li[$k]["name"]=$arrk["name"];
    	 			
    	 			//print_r($mrr1);die;
    	 			$images=json_decode($mrr1["images"]);
    	 				
    	 			foreach ($images as $k2=>$v2){
    	 		
    	 				foreach ($color1 as $kc=>$vc){
    	 					if ($k2==$vc){
    	 						$li[$k]["images"]=$v2;
    	 							
    	 					}
    	 				}
    	 			}
    	 		
    	 			foreach ($number1 as $kc=>$vc){
    	 				if($k1==$kc){
    	 					$li[$k]["number"]=$vc;
    	 				}
    	 			}
    	 				
    	 			foreach ($ordernum1 as $kc=>$vc){
    	 				if ($k1==$kc){
    	 					$li[$k]["ordernum"]=$vc;
    	 				}
    	 			}
    	 				
    	 			foreach ($shopping_id1 as $kc=>$vc){
    	 				if ($k1==$kc){
    	 					$li[$k]["shopping_id"]=$vc;
    	 				}
    	 			}
    	 				
    	 		}
    	 		
    	 		//print_r($li);die;
    	 		
    	 		foreach ($li as $ki=>$vi){
    	 			//print_r($vi);die;
    	 			$ordernum=$vi["ordernum"];
    	 			$_POST=$vi;
    	 			$username=session("username");
    	 			$_POST["username"]=$username;
    	 			$_POST["time1"]=date("Y-m-d H:i:s",time());
    	 			$mt=M("details")->where("`ordernum`='$ordernum' && `username`='$username'")->find();
    	 			//print_r($mt);die;
    	 			if (!$mt){
    	 				$result=M("details")->data($_POST)->add();
    	 			}else{
    	 				$result=M('indent')->where("`id`='$idin'")->delete();
    	 			}
    	 			
    	 			
    	 		}
    	 		
    	 		
    	 		
    	 	}
    	 	
    	}
    	 	
     }
    	  
    	
    	 
     //加载订单
    	 //实例化数据库表查询数据：
    	 $num=3;
         $User = M('details'); // 实例化news表对象
    	 $count = $User->count();// 查询满足要求的总记录数
    	 //print_r($count);die;
    	 $Page = new \Home\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
    	 $show = $Page->show();// 分页显示输出
    	
    	 $list = $User->order('time1 DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	// print_r( $list);die;
    	 
    	 
    	 
    	 $p=I("get.p",1);//获取当前页码，默认显示第一页
    	 $this->assign('list',$list);// 赋值数据集
    	 $this->assign('page',$show);// 赋值分页输出
    	 $this->assign('p',$p);//输出页码值
    	
    	 //print_r($list);die;
    	
    	
    	 
    	 if (!empty($_GET["oder"])){
    	 	$username=session("username");
    	 	$oder=$_GET["oder"];
    	 	//print_r($oder);die;
    	 	$num=3;
    	 	$User = M('details'); // 实例化news表对象
    	 	$count = $User->count();// 查询满足要求的总记录数
    	 	//print_r($count);die;
    	 	$Page = new \Home\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
    	 	$show = $Page->show();// 分页显示输出
    	 	$where['username'] = array('eq',$username);
    	 	$where['_string']="(des like '%$oder%') OR (ordernum like '%$oder')";
    	 	$list = $User->where($where)->order('time1 DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    	 	 //echo $User->getLastSql();die;
    	 	 //print_r( $list);die;
    	 	
    	 	$p=I("get.p",1);//获取当前页码，默认显示第一页
    	 	$this->assign('list',$list);// 赋值数据集
    	 	$this->assign('page',$show);// 赋值分页输出
    	 	$this->assign('p',$p);//输出页码值
    	 	
    	 	
    	 }
    	 
    	 
    	 
    	 
    	 
    	 
    	 
    	 
    	 
    	 
    	 
    	 
    	//加载模板
    	$this->display();
    }
    //购买记录---------------------------------------------------------
    
    
    //购物车---------------------------------------------------------
    public function ShoppingCart(){
    	if(IS_AJAX){
    	
    		$id=explode(",", $_POST['id']);
    		//print_r($id);die;
    		foreach ($id as $k=>$v){
    		//print_r($v);die;
    		 $result=M('shopping')->where("`id`='$v'")->delete();
    		}
    		if ($result>0){
    			echo 0;die;
    		}else {
    			echo 1;die;
    		}
    	}
    	
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
    	
    	//index分页方法：
    		//实例化数据库表查询数据：
    		$num=4;
    		$User = M('shopping'); // 实例化news表对象
    		$count = $User->where("`state`='b'")->count();// 查询满足要求的总记录数
    		//print_r($count);die;
    		$Page = new \Home\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
    		$show = $Page->show();// 分页显示输出
    		$list = $User->where("`state`='b'")->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$p=I("get.p",1);//获取当前页码，默认显示第一页
    		//print_r($list);die;
    		
    		foreach ($list as $k=>$v){//循环追加产品中的 购物车中需要的字段
    			$number=$v["number"];
    			$colorvalue=$v["colorvalue"];
	    		$product_id=$v["product_id"];
	    		$product= M('product')->where("`id`=$product_id")->find();//查询产品表
	    		//取出字段
	    		$des=$product["des"];
	    		$promotion_price=$product["promotion_price"];
	    		$price=$product["price"];
	    		$image=json_decode($product["images"]);
	    		
	    		//print_r($image);die;
	    		$images=$image["$colorvalue"];
	    		//print_r($images);die;
	    		//计算总价：
	    		if (!empty($promotion_price)){
	    		$total_value=$number*$promotion_price;
	    		}else{
	    		$total_value=$number*$price;
	    			
	    		}
	    		//循环追加字段
	    		$list[$k]["images"]=$images;
	    		$list[$k]["des"]=$des;
	    		$list[$k]["promotion_price"]=$promotion_price;
	    		$list[$k]["price"]=$price;
	    		$list[$k]["total_value"]=$total_value;
	    		//$list[$k]["images"]=json_decode($product[$k]);
	    		//print_r($product);die;
    		
    		}	
    		//print_r($list);die;
    		$this->assign('list',$list);// 赋值数据集
    		$this->assign('page',$show);// 赋值分页输出
    		$this->assign('p',$p);//输出页码值
    		//print_r($show);die;
    		//print_r($list);die;
    	    
    	
    	
    	
    	//加载模板
    	$this->display();
    }
    
    //购物车---------------------------------------------------------
    
    
    //修改地址---------------------------------------------------------
    public function ModificationAddress(){
    	//实例化数据库表meun
    	$User = M("sidebar"); // 实例化User对象
    	 
    	$side=$User->select();
    	$this->assign("side",$side);
    	//print_r($side);die;
        if (IS_GET){
        	$id=$_GET["id"];
        	$addr= M('address')->where("`id`='$id'")->find();
        	$this->assign("addr",$addr);
        	//print_r($addr);die;
        }
    	//判断post请求：
    	if (IS_POST){
    		$id=I("get.id");
    		if (!empty($id)){
    			$result=M('address')->data($_POST)->where("`id`='$id'")->save();
    			if ($result>0){
    				$this->redirect("MemberCenter/MakeSureTheOrderAndTheAddress");
    			}else {
    				$this->error("修改失败！");
    			}
    			
    		}else{
	    	    $username=session("username");
	    	    $_POST["username"]=$username;
	    	    //print_r($username);die;
	    		$result=M("address")->data($_POST)->add();
		    	if ($result>0){
		   	   	  $this->redirect("MemberCenter/MakeSureTheOrderAndTheAddress");
		   	   }else {
		   	   	  $this->error("新增失败！");
		   	   }
    		}
	   	   
	   	   
    	}
    	
    	
    	//加载模板
    	$this->display();
    }
    
    //修改地址---------------------------------------------------------
    public function Favorite(){
    if(IS_AJAX){
    	   
    	if(IS_GET){
    		 
    		$id=explode(",", $_GET['id']);
    		//print_r($id);die;
    		foreach ($id as $k=>$v){
    			//print_r($v);die;
    			$result=M('shopping')->where("`id`='$v' ")->delete();
    		}
    		if ($result>0){
    			echo 0;die;
    		}else {
    			echo 1;die;
    		}
    	}
    	
      if(IS_POST){
      
      	$result=M('shopping')->where(" `state`='c' ")->count();
      	
      	//print_r($result);die;
      	 if($result>20){
      		echo 3;die;
      	
      	}else{
      		
      		//转化字符串为数组； 
      		$ar=[];
      			$ar['id']=explode(",", $_POST['id']);
      			$ar['color']=explode(",", $_POST['color']);
      			
      			$list=[];
      			foreach($ar["id"] as $k=>$v){
      				$list[] = array_column($ar,$k);//在一个二维数组中取出k相同的 值；
      			  
      			}
      			
      	        foreach ($list as $k=>$v){
      				 
      				$result=M('shopping')->where("`colorvalue`='$v[1]' && `state`='c' ")->find();
      			}
      			//print_r($list);die;
      			
      			//print_r($result);die;
      			if (!empty($result)){
      				 
      				echo 2;die;
      				 
      			}else {
      	
      	
      				$arr=[];
      				foreach ($list as $k=>$v){
      					//print_r($v);die;
      					$arr[]=M('shopping')->where("`id`='$v[0]' && `state`='b'")->find();
      				}
      	
      				//print_r($arr);die;
      	
      				foreach ($arr as $k=>$v){
      					//print_r($v);die;
      	                    unset($v['id']);
      						$_POST=$v;
      						$state='c';
      						$_POST["state"]=$state;
      						
      						//print_r($_POST);die;
      						$result=M("shopping")->data($_POST)->add();
      					
      				}
      	
      	
      				if ($result>0){
      					echo 0;die;
      				}else {
      					echo 1;die;
      				}
      	
      	
      	
      			}
      	
      			 
      		}
      	
      	} 
      	
      	
      	
    }
   	
    	
    	
    	//购物车index分页方法：
    		//实例化数据库表查询数据：
    		$num=4;
    		$User = M('shopping'); // 实例化news表对象
    		$count = $User->where("`state`='c'")->count();// 查询满足要求的总记录数
    		//print_r($count);die;
    		$Page = new \Home\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
    		$show = $Page->show();// 分页显示输出
    		$list = $User->where("`state`='c'")->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$p=I("get.p",1);//获取当前页码，默认显示第一页
    		//print_r($list);die;
    		
    		foreach ($list as $k=>$v){//循环追加产品中的 购物车中需要的字段
    			$number=$v["number"];
    			$colorvalue=$v["colorvalue"];
	    		$product_id=$v["product_id"];
	    		$product= M('product')->where("`id`=$product_id")->find();//查询产品表
	    		//取出字段
	    		$des=$product["des"];
	    		$promotion_price=$product["promotion_price"];
	    		$price=$product["price"];
	    		$image=json_decode($product["images"]);
	    		
	    		//print_r($image);die;
	    		$images=$image["$colorvalue"];
	    		//print_r($images);die;
	    		//计算总价：
	    		if (!empty($promotion_price)){
	    		$total_value=$number*$promotion_price;
	    		}else{
	    		$total_value=$number*$price;
	    			
	    		}
	    		//循环追加字段
	    		$list[$k]["images"]=$images;
	    		$list[$k]["des"]=$des;
	    		$list[$k]["promotion_price"]=$promotion_price;
	    		$list[$k]["price"]=$price;
	    		$list[$k]["total_value"]=$total_value;
	    		//$list[$k]["images"]=json_decode($product[$k]);
	    		//print_r($product);die;
    		
    		}	
    		//print_r($list);die;
    		$this->assign('list',$list);// 赋值数据集
    		$this->assign('page',$show);// 赋值分页输出
    		$this->assign('p',$p);//输出页码值
    		//print_r($show);die;
    		//print_r($list);die;
    		
    		
    		
    		
    	//加载模板
    	$this->display();
    }
    
    
    
    Public function Orderdetail(){
    	
    	if (IS_GET){
    		$id=$_GET["id"];
    		$details= M('details')->where("`id`=$id")->find();
    		$number=$details["number"];
    		$promotion_price=$details["promotion_price"];
    		$price=$number*$promotion_price;
    		$details["price"]=$price;
    		//print_r($details);die;
    		$this->assign("details",$details);
    	}
    	
    	
    	
    	
    	$this->display();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}