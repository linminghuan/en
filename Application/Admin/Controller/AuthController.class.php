<?php 
/**
 * 用户登录状态管理Controller
 * @author: linminghuan
 * @date: 2017/9/13
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/13）
 */
namespace Admin\Controller;

use Think\Controller;

class AuthController extends Controller
{
	public function index(){
		$this->display('Auth/index');
	}

	public function login(){
		$user = M('users');
		$Iname = I('name');
		$Ipassword = md5(I('password'));
		$map['name'] = $Iname;
		$result1 = $user->where($map)->select();
		if($Ipassword == $result1[0]['password']){
			$user->ip = $_SERVER['SERVER_ADDR'];
			$user->log_in = date('Y-m-d H:i:s');
			$res = $user->where('id', '=', $result1[0]['id'])->save();
			clg($res);
			if($res){
				session('name',$Iname);
				$this->redirect('Admin/Index/index', '',0, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>正在跳转……</font>');
			}else{
				$this->error('500错误，请重新登陆');
			}
		}else{
			$this->error('密码或用户名错误，请重新登陆');
		}
	}

	public function quit(){
		session('name',null);
		$this->display('Auth/index');
	}
}




?>


