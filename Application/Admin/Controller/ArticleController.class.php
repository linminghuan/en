<?php 
/**
 * 文章管理Controller
 * @author: linminghuan
 * @date: 2017/9/15
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/15）
 */
namespace Admin\Controller;

use Think\Controller;
use Admin\Traits\AuthTrait;
use Admin\Traits\UtilTrait;

class ArticleController extends Controller
{
	use AuthTrait;
	use UtilTrait;

	public function allCategory()
	{
		$category = M('categories');
		$map['name'] = array('NEQ', 'menu');
		$map['status'] = array('EQ', '1');
		$data = $category->where($map)->field('id,name')->select();
		if($data){
			return $data;
		}else{
			if(APP_DEBUG){
				$this->error($category->getError());
			}else{
				$this->error('500，服务器错误！');
			}
		}
	}
	
	public function create()
	{
		$data = $this->allCategory();
		$this->assign('category', 'article');
		$this->assign('data', $data);
		$this->display('Article/create');
	}

	public function insert()
	{
		$article = D('article');
		if($article->create()){
			$res = $article->add();
			if($res){
				$this->redirect('Admin/Article/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>文章增加成功</font>');
			}else{
				if(APP_DEBUG){
					$this->error($article->getError());
				}else{
					$this->error('500，服务器错误！');
				}
			}
		}else{
			$this->error($article->getError());
		}
	}

	public function index()
	{
		$article = M('articles');
		$p = 1;
		if($_GET['p']){
			$p = $_GET['p'];
		}
		$category_id = $_GET['category_id'];
		$qText = $_GET['qText'];//查询字符串
		$status = $_GET['status'];
		if($category_id != null && $category_id !=" "){
			$map['category_id'] = array('eq',$category_id);
		}
		if($qText != null && $qText !=" "){
			$map['title'] = array('like','%'.$qText.'%');
		}
		if($status != null && $status !=" "){
			$map['status'] = array('like',$status);
		}
		if(!empty($map)){
			$list = $article->where($map)->order('update_at')->page($p.',15')->select();
			$count = $article->where($map)->count();
		}else{
			$list = $article->order('update_at')->page($p.',15')->select();
			$count = $article->count();
		}
		//获取栏目名
		foreach($list as $key => $value){
			$tmp = M('categories')->field('name')->find($value['category_id']);
			if(!$tmp){
				$this->error('500，服务器错误！');
			}
			$list[$key]['cname'] = $tmp['name'];
		}
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取	
		$this->assign('data',$list);// 赋值数据集
		// 查询满足要求的总记录数
		$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		//所有的栏目
		$categories = $this->allCategory();
		$this->assign('categories', $categories);
		$this->assign('category', "article");
		$this->display('Article/index'); // 输出模板
	}

	public function edit($id)
	{
		if(isset($id)){
			$article = M('articles');
			$data = $article->find($id);
			if($data){
				$data['category'] = $this->allCategory();
				$this->assign('category', 'article');
				$this->assign('data', $data);
				$this->display('Article/edit');
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
			$article = D('article');
			if($article->create()){
				$res = $article->where('id = '.$id)->save();
				if($res){
					$this->redirect('Admin/Article/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>文章更新成功</font>');
				}else{
					if(APP_DEBUG){
						$this->error($article->getError());
					}else{
						$this->error('500错误,更新文章失败');
					}
				}
			}else{
				$this->error($article->getError());
			}
		}else{
			$this->error('404，没找到！');
		}
	}

	public function delete($id)
	{
		if(isset($id)){
			$article = M('articles');
			$res = $article->delete($id);
			if($res){
				$this->success('删除成功');
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

	public function batchDel()
	{
		//不能使用M函数
		$article = D('articles');
		$this->uBatchDel($article);
	}
}




?>


