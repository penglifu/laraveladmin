<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends PublicController {
	//定义图片路径：
	public $path= './Uploads/Banner/';//上传文件的路径文件夹
	public $width=100;//图片宽度
	public $height=100;//图片高度
	
	//新闻图片上传
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
		//print_r($images_path);die;
		//生成缩图
		$image = new \Think\Image();//实例化的是Think命名空间下的Image()不能更改设置缩略图根文件所在
		$image->open($images);//打开路径下的那张原图， 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
		$thumb_img=$this->path.$v["savepath"]."thumb_".$v["savename"];//拼接缩略图路径
		$image->thumb($this->width, $this->height,6)->save($thumb_img);//6代表生成宽高一致的缩略图
		//print_r($thumb_img);die;
		//生成水印图：
		$image = new \Think\Image();
		$image->open($images)->water('./shuiyin.png',1);
		$water_img=$this->path.$v["savepath"]."water_".$v["savename"];//拼接缩略图路径
		$image->thumb($this->width, $this->height,6)->save($water_img);
	
		/* 水印字体：
		 $new_img=$this->path.$v["savepath"]."new_".$v["savename"];
		 $image->open($images)->text('ThinkPHP','./FZGLJW.TTF',20,'#000000',9)->save($new_img);
		*/
		//print_r($water_img);die;
	
		//返回值
		return array("images"=>$images,"thumb_img"=>$thumb_img,"water_img"=>$water_img);
	}
	 
	//index分页方法：
	public function index() {
		//实例化数据库表查询数据：
		$num=8;
		$User = M('banner'); // 实例化news表对象
		$count = $User->count();// 查询满足要求的总记录数
		$Page = new \Admin\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
		$show = $Page->show();// 分页显示输出
		$list = $User->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$p=I("get.p",1);
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('p',$p);
		//print_r($show);die;
		//print_r($list);die;
	
		//加载模板
		$this->display();
	}
	 
	public function delete(){
		if (IS_GET){//判断删除是否触发
			$id=$_GET["id"];
			$Model = M('banner');
			$condition['id'] =$id;
			$arr=$Model->where($condition)->find();
			if (file_exists($arr["images"]))
				unlink($arr["images"]);
			if (file_exists($arr["thumb_img"]))
				unlink($arr["thumb_img"]);
			if (file_exists($arr["water_img"]))
				unlink($arr["water_img"]);
			$result=$Model->where($condition)->delete();
			if ($result>0){
				$this->redirect("Banner/index");
			}else {
				$this->error("删除失败！");
			}
		}
	
	}
	 
	//insert页面方法
	public function insert(){
	
		//print_r($category);die;
		//判断是否是post：
		if (IS_POST){
			$info=$this->upload();
			//保存图片路径到数组post中存储数据库
			$_POST["images"]=$info["images"];
			$_POST["thumb_img"]=$info["thumb_img"];
			$_POST["water_img"]=$info["water_img"];
			//print_r($_POST);die;
			//追加时间字段：
			$_POST["time"]=date("Y-m-d H:i:s",time());
			//调用新增：
			$result=M("banner")->data($_POST)->add();
			if ($result>0){
				$this->redirect("Banner/index");
			}else {
				$this->error("新增失败！");
			}
		}
		 
		//加载模板
		$this->display();
	
	}
	
	//Banner修改
	Public function update(){
		if(IS_GET){
			$id=$_GET["id"];
			//print_r($id);die;
		 $User = M("banner"); // 实例化User对象
		 $condition['id'] =$id;
		 $arr=$User->where($condition)->find();
		 $this->assign("arr",$arr);
		 
		}
	
		if (IS_POST){
			 
			if (!$_POST["images_old"]){//当删除原图时，删除对应原图文件
	
				$Model = M('banner');
				$id=I('get.id');
				//print_r($id);die;
				$condition['id'] =$id;
				$arr=$Model->where($condition)->find();
				//print_r($arr);die;
				if (file_exists($arr["images"]))
					unlink($arr["images"]);
				if (file_exists($arr["thumb_img"]))
					unlink($arr["thumb_img"]);
				if (file_exists($arr["water_img"]))
					unlink($arr["water_img"]);
			}
			if ( !empty($_POST["images"])){
				//上传新图但未删除原图时，首先删除原图对应的文件
				$Model = M('banner');
				$id=I('get.id');//获取当前id
				//print_r($id);die;
				$condition['id'] =$id;
				$arr=$Model->where($condition)->find();
				//print_r($arr);die;
				//删除对应的文件
				if (file_exists($arr["images"]))
					unlink($arr["images"]);
				if (file_exists($arr["thumb_img"]))
					unlink($arr["thumb_img"]);
				if (file_exists($arr["water_img"]))
					unlink($arr["water_img"]);
	
				$info=$this->upload();//调用上传函数
				//print_r($info);die;
				$_POST["images"]=$info["images"];
				$_POST["thumb_img"]=$info["thumb_img"];
				$_POST["water_img"]=$info["water_img"];
			}
	
			//追加时间字段：
			$_POST["time"]=date("Y-m-d H:i:s",time());
			//print_r($_POST);die;
			$Model = M('banner');
			$id=I('get.id');
			$condition["id"]=$id;
			//print_r($id);die;
			$result=$Model->data($_POST)->where($condition)->save();
	
			if ($result>0){
				$this->redirect("Banner/index");
			}else{
				$this->error("修改失败");
			}
		}
		//加载模板：
		$this->display();
	}
	
}