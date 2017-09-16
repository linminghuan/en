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
       $this->display('Index/index');
    }
}