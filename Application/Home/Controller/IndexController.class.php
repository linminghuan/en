<?php
/**
 * 文章管理Controller
 * @author: linminghuan
 * @date: 2017/9/16
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/16）
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
    	$menuData = $this->subCategory($category, $menuData[0]['id'], ['homepage'=>1]);
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
}