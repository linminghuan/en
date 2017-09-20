<?php
/**
 * 文章管理Controller
 * @author: linminghuan
 * @date: 2017/9/16
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/16）
 * （2）添加list方法；（2017/9/17）
 */
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller 
{
    public function index()
    {
    	$article = M('articles');
    	$category = M('categories');
    	$photo = M('photos');
    	//导航栏
    	$category = M('categories');
    	$map['status'] = 1;
    	$menuData = $category->where("name='menu'")->ORDER('sort')->field('id,name,pid')->select();
    	$menuData = $this->subCategory($category, $menuData[0]['id'], ['navigation'=>1]);
    	$this->assign('menuData', $menuData);
    	//轮播图
    	$map['status'] = 1;
    	$photoData = $photo->where($map)->select();
    	$this->assign('photoData', $photoData);
        $this->display('Index/index');
    }

    //递归查询所有的栏目
	private function subCategory($model, $pid, $where = [])
	{
		$categoryArr = Array();
		if(isset($where)) $map = $where;
		$map['pid'] = $pid;
		$tmp = $model->where($map)->field('id,name,pid')->select();
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

    //返回栏目列表
    public function list($id)
    {
        if(isset($id)){
            //返回左边导航栏数据
            $category = M('categories');
            $tmp = $category->find($id);
            $tmp['next'] = $this->subCategory($category, $id);
            $this->assign('lNavData', $tmp);
            $this->display('Index/list');
        }else{
            $this->error('404, 没找到！');
        }
    }
}