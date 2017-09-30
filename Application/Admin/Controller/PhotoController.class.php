<?php
/**
 * 图片管理Controller
 * @author: linminghuan
 * @date: 2017/9/13
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/13）
 * （2）修改update方法的写法，以适应新的图片上传插件；（2017/9/22）
 */
namespace Admin\Controller;

use Admin\Controller\AdminController;
// use Admin\Traits\AuthTrait;
// use Admin\Traits\UtilTrait;

error_reporting(E_ALL ^ E_NOTICE);

class PhotoController extends AdminController
{
	// use AuthTrait;
	// use UtilTrait;
	
	public function index()
	{
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

	public function insert()
	{
		$photo = D('photo');//D方法实例化时需要传入完整类名，而不是表名；
		if($photo->create()){
			$result = $photo->add();
			if($result){
				$this->redirect('Admin/Photo/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>图片增加成功</font>');
			}else{
				if(APP_DEBUG){
					$this->error($photo->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error($photo->getError());
		}
	}

	public function edit($id)
	{
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

	public function create()
	{
		$photo = M('photos');
		$category = "photo";
		$this->assign('category',$category);
		$this->display('Photo/create');
	}

	public function update($id)
	{
		$photo = D('photo');
		if($photo->create()){
			/*//替换图片
			$oldUrl = I('oldUrl');
			if(isset($photo->url)){
				$res = $this->delFile($oldUrl);
				if(!$res) $this->error('500，服务器错误'); 
			}else{
				$photo->url = $oldUrl;
			}*/
			$result = $photo->where('id = '.$id)->save();
			if($result !== false){
				$this->redirect('Admin/Photo/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>图片更新成功</font>');
			}else{
				if(APP_DEBUG){
					$this->error($photo->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error($photo->getError());
		}
	}

	public function delete($id)
	{
		$photo = M('photos');
		$data = $photo->find($id);
		$result = $photo->delete($id);
		if($result){
			$this->success('删除成功');
		}else{
			if(APP_DEBUG){
				$this->error($photo->getError());
			}else{
				$this->error('500，服务器错误！');
			}
		}
		// $res = $this->delFile($data['url']);
		// if($res){
		// 	$result = $photo->delete($id);
		// 	if($result){
		// 		$this->success('删除成功');
		// 	}else{
		// 		if(APP_DEBUG){
		// 			$this->error($photo->getError());
		// 		}else{
		// 			$this->error('500，服务器错误！');
		// 		}
		// 	}
		// }else{
		// 	$this->error('删除失败');
		// }
	}

	public function batchDel()
	{
		//不能使用M函数
		$photo = D('photos');
		$this->uBatchDel($photo);
	}

}

?>