<?php
/**
 * 图片管理Controller
 * @author: linminghuan
 * @date: 2017/9/13
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/13）
 */
namespace Admin\Controller;

use Think\Controller;

error_reporting(E_ALL ^ E_NOTICE);

class PhotoController extends Controller{
	public function index(){
		$photo = M('photos');
		$p = 1;
		$status = $_GET['status'];
		$category = $_GET['category'];
		if($_GET['p']){
			$p = $_GET['p'];
		}
		if($status != null && $status !=" "){
			$map['status'] = array('eq',$status);
		}
		if($category != null && $category !=" "){
			$map['category'] = array('eq',$category);
		}
		if(!empty($map)){
			$list = $photo->where($map)->order('update_at')->page($p.',10')->select();
			$count = $photo->where($map)->count();
		}else{
			$list = $photo->order('update_at')->page($p.',10')->select();
			$count = $photo->count();
		}
		$this->assign('data',$list);// 赋值数据集
		// 查询满足要求的总记录数
		$Page = new \Think\Page($count,10);//实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$category = "photo";
		$this->assign('category',$category);
		$this->display('Photo/index'); // 输出模板
	}

	public function insert(){
		$photo = D('photos');
		if($photo->create()){
			$result = $photo->add();
			if($result){
				$this->redirect('Admin/Photo/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>图片增加成功</font>');
			}else{
				$this->error('增加文章失败');
			}
		}else{
			$this->error($article->getError());
		}
		/*$oldurl = $this->GetImgUrl(I('post.url'));
		$photoName = strchr($oldurl,"Temp/");
		$photoName = strchr($photoName,"/");
		$newurl = "/zhaosheng/Public/Upload/Image".$photoName;
		dump($oldurl);
		dump($newurl);
		if(rename($oldurl,$newurl)){
			$data["note"] = I("post.note");
			$data["author"] = I("post.author");
			$data["status"] = I("post.status");
			$data["category"] = I("post.category");
			$data["update_at"] = NOW_TIME;
			$data["url"] = $newurl;
			$result = $photo->add($data);
			if($result){
				$this->redirect('Admin/Photo/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>图片更新成功</font>');
			}else{
				$this->error($photo->getError());
			}
		}else{
			$this->error($photo->getError());
		}*/
	}

	public function edit($id){
		$photo = M('photos');
		if($id == 0){
			$data = $photo->select();
		}else{
			$data = $photo->find($id);
		}
		if($data){
			//$data->content = htmlentities($data->content);
			$this->assign('data',$data);
			//var_dump($data);
			$category = "photo";
			$this->assign('category',$category);
			$this->display('Photo/edit');
		}else{
			$this->display('Photo/index');
		}
	}

	public function create(){
		$photo = M('photos');
		$category = "photo";
		$this->assign('category',$category);
		$this->display('Photo/create');
	}

	public function update($id){
		$photo = D('photos');
		if($photo->create()){
			$result = $photo->where('id = '.$id)->save();
			if($result !== false){
				$this->redirect('Admin/Photo/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>图片更新成功</font>');
			}else{
				$this->error($photo->getError());
			}
		}else{
			$this->error($photo->getError());
		}
	}

	public function delete($id){
		$photo = M('photos');
		$data = $photo->find($id);
		$tmp = str_replace("/zhaosheng/","./",$data['url']);
		if(unlink($tmp)){
			$result = $photo->delete($id);
			if($result){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('删除失败');
		}
	}

	public function GetImgUrl($str){
		$str = strchr($str,"/");
		$str = strchr($str,"&quot;",true);
		return $str;
	}


}

?>