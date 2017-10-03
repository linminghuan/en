<?php 
/**
 * Homepage的控制器
 * @author: linminghuan
 * @date: 2017/9/24
 * @verson: 1.0
 * @description:  
 * （1）完成基本的功能；（2017/9/24）
 */
namespace Admin\Controller;

use Admin\Controller\AdminController;

class HomepageController extends AdminController
{
	public function allCategory()
	{
		$category = M('categories');
		$tmp = $category->where("name='homepage'")->select();
		$map['status'] = array('EQ', '1');
		$map['pid'] = $tmp[0]['id'];
		$data = $category->where($map)->field('id,name')->order('sort')->select();
		if($data){
			return $data;
		}else{
			return null;
		}
	}

	public function create()
	{
		$data = $this->allCategory();
		$this->assign('data', $data);
		$this->assign('category', 'homepage');
		$this->display('Homepage/create');
	}

	public function insert()
	{
		$homepage = D('homepage');
		if($homepage->create()){
			$res = $homepage->add();
			if($res){
				$this->redirect('Admin/Homepage/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>增加成功</font>');
			}else{
				if(APP_DEBUG){
					$this->error($homepage->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error($homepage->getError());
		}
	}

	public function index()
	{
		$homepage = M('homepages');
		$category = M('categories');
		$p = 1;
		$status = $_GET['status'];
		$category_id = $_GET['category_id'];
		$qText = $_GET['qText'];//查询字符串
		if($_GET['p']){
			$p = $_GET['p'];
		}
		if($status != null && $status !=" "){
			$map['status'] = array('eq',$status);
		}
		if($category_id != null && $category_id !=" "){
			$map['category_id'] = array('eq',$category_id);
		}
		if($qText != null && $qText !=" "){
			$map['title'] = array('like','%'.$qText.'%');
		}
		if(!empty($map)){
			$list = $homepage->where($map)->order('update_at')->page($p.',10')->select();
			$count = $homepage->where($map)->count();
		}else{
			$list = $homepage->order('update_at')->page($p.',10')->select();
			$count = $homepage->count();
		}
		if(count($list) != 0){
			//获取栏目名
			foreach($list as $key => $value){
				$category = M('categories');
				$tmp = $category->find($value['category_id']);
				// if(!$tmp){
				// 	$this->error('500，服务器错误！');
				// }
				$list[$key]['cname'] = $tmp['name'];
			}
			// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取	
			$this->assign('data',$list);// 赋值数据集
			// 查询满足要求的总记录数
			$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
			$show = $Page->show();// 分页显示输出
			$this->assign('page',$show);// 赋值分页输出
		}
		// //首页栏目
		// $temp = $category->where("name='homepage'")->select();
		// $dataCategory = $category->where('pid='.$temp[0]['id'])->select();
		// $this->assign('dataCategory', $dataCategory);
		//所有的栏目
		$categories = $this->allCategory();
		$this->assign('categories', $categories);
		// $this->assign('data',$list);// 赋值数据集
		// $Page = new \Think\Page($count,10);//实例化分页类 传入总记录数和每页显示的记录数
		// $show = $Page->show();// 分页显示输出
		// $this->assign('page',$show);// 赋值分页输出
		$this->assign('category', 'homepage');
		$this->display('Homepage/index');
	}

	public function edit($id)
	{
		if(isset($id)){
			$homepage = M('homepages');
			$data = $homepage->find($id);
			if($data){
				$data['category'] = $this->allCategory();
				$this->assign('data', $data);
				$this->assign('category', 'homepage');
				$this->display('Homepage/edit');
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

	public function update($id)
	{
		if(isset($id)){
			$homepage = D('homepage');
			if($homepage->create()){
				$res = $homepage->where('id='.$id)->save();
				if($res){
					$this->redirect('Admin/Homepage/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>Homepage更新成功</font>');
				}else{
					if(APP_DEBUG){
						$this->error($homepage->getError());
					}else{
						$this->error('500，服务器错误！');
					}
				}
			}else{
				$this->$homepage->error($this->getError());
			}
		}else{
			$this->$homepage->error('404，没找到！');
		}
	}

	public function delete($id)
	{
		if(isset($id)){
			$homepage = D('homepage');
			$res = $homepage->delete($id);
			if($res){
				$this->success('删除成功');
			}else{
				if(APP_DEBUG){
					$this->error($homepage->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->$homepage->error($homepage->getError());
		}
	}

	public function batchDel()
	{
		//不能使用M函数
		$homepage = D('homepage');
		parent::uBatchDel($homepage);
	}
}




?>


