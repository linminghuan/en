<?php 
/**
 * 栏目管理的Controller
 * @author: linminghuan
 * @date: 2017/9/14
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/14）；
 * （2）添加index方法；（2017/9/15）；
 * （3）修复create方法显示父级栏目名错误；添加edit、update、delete方法（2017/9/15）；
 */
namespace Admin\Controller;

use Think\Controller;
use Admin\Traits\AuthTrait;
use Admin\Traits\UtilTrait;

class CategoryController extends Controller
{
	public function create($pid = null)
	{
		$category = M('categories');
		if($pid){
			$map['id'] = $pid;
			$data = $category->where($map)->field('id,name')->select();
		}else{
			$data = $category->where("name='menu'")->field('id,name')->select();
		}
		$pid = $data[0]['id'];
		$pname = $data[0]['name'];
		$this->assign('category', 'category');
		$this->assign('pid', $pid);
		$this->assign('pname', $pname);
		$this->display('Category/create');
	}

	public function insert()
	{
		$category = D('category');
		if($category->create()){
			$res = $category->add();
			if($res){
				$this->redirect('Admin/Category/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>栏目增加成功</font>');
			}else{
				if(APP_DEBUG){
					$this->error($category->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error($category->getError());
		}
	}

	public function index()
	{
		$categoryArr = Array();
		$category = M('categories');
		$data = $category->where("name='menu'")->field('id')->select();
		$res = $this->subCategory($category, $data[0]['id']);
		$this->assign('category', 'category');
		$this->assign('data', $res);
		$this->display('Category/index');

	}

	//递归查询所有的栏目
	private function subCategory($model, $pid)
	{
		$categoryArr = Array();
		$map['pid'] = $pid;
		$tmp = $model->where($map)->select();
		if(count($tmp) != 0){
			foreach ($tmp as $key => $value) {
				$tmp1 = $this->subCategory($model, $value['id']);
				$value['next'] = $tmp1;
				$categoryArr[] = $value;
			}
			return $categoryArr;
		}else{
			return;
		}
	}

	public function edit($pid, $id)
	{
		if(isset($id)){
			$category = D('category');
			$data = $category->find($id);
			if(count($data) != 0){
				$tmp = $category->find($pid);
				if(count($tmp) == 0){
					if(APP_DEBUG){
						$this->error($category->getError());
					}else{
						$this->error('500，服务器错误！');
					}
				}
				$data['pname'] = $tmp['name'];
				$this->assign('category', 'category');
				$this->assign('data',$data);
				$this->display('Category/edit');
			}else{
				if(APP_DEBUG){
					$this->error($category->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error('404, 没找到！');
		}
	}

	public function update($pid, $id)
	{
		if(isset($id)){
			$category = D('category');
			if($category->create()){
				$res = $category->where('id='.$id)->save();
				if($res){
					$this->redirect('Admin/Category/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>栏目更新成功</font>');
				}else{
					$this->error($category->getError());
				}
			}else{
				if(APP_DEBUG){
					$this->error($category->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error('404，没找到！');
		}
		
	}

	public function delete($pid, $id)
	{
		//删除功能待完成
		$this->error('403，目前禁用删除，可以修改是否显示代替本操作！');
		return;
		if(isset($id)){
			$category = M('categories');
			$res = $category->delete($id);
			if($res){
				$this->success('删除成功');
			}else{
				if(APP_DEBUG){
					$this->error($category->getError());
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


