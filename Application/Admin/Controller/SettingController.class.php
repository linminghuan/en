<?php 
/**
 * 系统设置
 * @author: linminghuan
 * @date: 2017/9/23
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/23）
 */
namespace Admin\Controller;

use Admin\Controller\AdminController;

class SettingController extends AdminController
{
	public function index()
	{
		$user_id = $_SESSION['user_id'];
		$setting = M('settings');
		$data = $setting->find($user_id);
		$this->assign('data', $data);
		$this->assign('category', 'setting');
		$this->display('Setting/index');
	}

	public function update()
	{
		$user_id = $_SESSION['user_id'];
		$setting = D('setting');
		//$data = $setting->where('user_id='.$user_id)->select();
		if($setting->create()){
			$res = $setting->where('user_id='.$user_id)->save();
			if($res){
				$this->redirect('Admin/Setting/index', '',2, '<meta charset="UTF-8"><font style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>设置更新成功</font>');
			}else{
				if(APP_DEBUG){
					$this->error($setting->getError());
				}else{
					$this->error('500错误,更新设置失败');
				}
			}
		}else{
			$this->error($setting->getError());
		}
	}
}




?>


