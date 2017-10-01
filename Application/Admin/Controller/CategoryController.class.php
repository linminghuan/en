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
 * （4）subCategory使用新的写法；（2017/9/22）
 * （5）添加返回下级菜单的数据的接口；（2017/9/22）
 * （6）添加删除栏目同时删除所有子栏目和所有文章；（2017/10/1）
 */
namespace Admin\Controller;

use Admin\Controller\AdminController;
// use Admin\Traits\AuthTrait;
// use Admin\Traits\UtilTrait;

class CategoryController extends AdminController
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
		//只返回最顶级的菜单
		$tmp = $category->where("name='menu'")->order('sort')->select();
		$data = $category->where('pid='.$tmp[0]['id'])->select();
		$data = json_encode($data);
		$this->assign('category', 'category');
		$this->assign('data', $data);
		$this->display('Category/index');

	}

	//递归查询所有的栏目
	/*private function subCategory($model, $pid)
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
			return null;
		}
	}
*/
	private function subCategory($pid = 1, $where = array())
	{
		$category = M('categories');
		$categoryArr = Array();
		if(isset($where)) $map = $where;
        $map['navigation'] = array('eq', 1);
		$map['pid'] = $pid;
        $map['status'] = 1;
		$tmp = $category->where($map)->field('id,name,pid')->select();
		if(count($tmp) != 0){
			foreach ($tmp as $key => $value) {
				$tmp1 = $this->subCategory($value['id']);
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
			$category->startTrans();
			$res1 = $this->delSubCategory($id);
			if($res1){
				$res = $category->delete($id);
				if($res){
					$category->commit();
					$this->success('删除成功');
				}else{
					$category->rollback();
					if(APP_DEBUG){
						$this->error($category->getError());
					}else{
						$this->error('500，服务器错误！');
					}
				}
			}
			
		}else{
			$this->error('404，没找到！');
		}
	}

	//获取下一级菜单的接口
	public function getNextCategory($pid)
	{
		if(isset($pid)){
			$category = M('categories');
			$res['pid'] = $pid; 
			$map['pid'] = $pid;
			$data = $category->where($map)->order('sort desc')->select();
			$res['data'] = $data;
			if($data){
				return $this->ajaxReturn($res);
			}else{
				return null;
			}
		}
		

	}

	//根据pid删除栏目
	protected function delSubCategory($id)
	{
		$category = M('categories');
		$map['pid'] = $id;
		$this->delArticle($id);
		$data = $category->where($map)->select();
		if($data){
			foreach ($data as $key => $value) {
				$res = $this->delSubCategory($value['id']);
				$this->delArticle($value['id']);
				$res2 = $category->delete($value['id']);
			}
		}
		return true;
	}

	//根据category_id删除文章
	protected function delArticle ($category_id)
	{
		$article = D('article');
		$map['category_id'] = $category_id; 
		$data = $article->where($map)->select();
		foreach ($data as $key => $value) {
			$articleArr[] = $value['id'];
		}
		$this->uBatchDel($article, $articleArr);
	}
}




?>


