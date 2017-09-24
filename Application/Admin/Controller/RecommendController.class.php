<?php 
/**
 * Recommend的控制器
 * @author: linminghuan
 * @date: 2017/9/24
 * @verson: 1.0
 * @description:  
 * （1）完成基本的功能；（2017/9/24）
 */
namespace Admin\Controller;

use Admin\Controller\AdminController;

class RecommendController extends AdminController
{
	public function create()
	{
		$this->assign('category', 'recommend');
		$this->display('Recommend/create');
	}

	public function insert()
	{
		$recommend = D('recommend');
		if($recommend->create()){
			$res = $recommend->add();
			if($res){
				$this->redirect('Admin/Recommend/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>增加成功</font>');
			}else{
				if(APP_DEBUG){
					$this->error($recommend->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error($recommend->getError());
		}
	}

	public function index()
	{
		$recommend = M('recommends');
		$p = 1;
		$status = $_GET['status'];
		if($_GET['p']){
			$p = $_GET['p'];
		}
		if($status != null && $status !=" "){
			$map['status'] = array('eq',$status);
		}
		if(!empty($map)){
			$list = $recommend->where($map)->order('update_at')->page($p.',10')->select();
			$count = $recommend->where($map)->count();
		}else{
			$list = $recommend->order('update_at')->page($p.',10')->select();
			$count = $recommend->count();
		}
		$this->assign('data',$list);// 赋值数据集
		$Page = new \Think\Page($count,10);//实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('category', 'recommend');
		$this->display('Recommend/Index');
	}

	public function edit($id)
	{
		if(isset($id)){
			$recommend = M('recommends');
			$data = $recommend->find($id);
			if($data){
				$this->assign('data', $data);
				$this->assign('category', 'recommend');
				$this->display('Recommend/edit');
			}else{
				if(APP_DEBUG){
					$this->error($article->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error('404，没找到！');
		}

	}
}




?>


