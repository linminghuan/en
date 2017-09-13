<?php 
/**
 * 用户登录验证Traits
 * @author: linminghuan
 * @date: 2017/9/13
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/13）
 */
namespace Admin\Traits;

trait AuthTrait
{
	public function _initialize() {

        $this->checklogin();

    }



    private function checklogin() { 

        if ((!isset($_SESSION['name']) || !$_SESSION['name'])) {

			$this->redirect('Admin/Auth/index', '',2, '<meta charset="UTF-8"><span style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>禁止访问，请先登录</span>');

        }
    }
}




?>


