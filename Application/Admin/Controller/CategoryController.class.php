<?php 
/**
 * 栏目管理的Controller
 * @author: linminghuan
 * @date: 2017/9/14
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/14）；
 * （2）添加index方法；（2017/9/15）；
 * （3）修复create方法显示父级栏目名错误；（2017/9/15）；
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
				$this->error('500错误,增加图片失败');
			}
		}else{
			if(APP_DEBUG){
				$this->error($photo->getError());
			}else{
				$this->error('500错误,增加栏目失败');
			}
			
		}
	}

	public function index()
	{
		$categoryArr = Array();
		$category = M('categories');
		$data = $category->where("name='menu'")->field('id')->select();
		$res = $this->subCategory($category, $data[0]['id']);
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
}




?>


