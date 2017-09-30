<?php 
/**
 * Admin模块的基类
 * @author: linminghuan
 * @date: 2017/9/22
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/22）
 */
namespace Admin\Controller;

use Think\Controller;

/**
* 
*/
class AdminController extends Controller
{
	public function _initialize() {

        $this->checklogin();

    }

    private function checklogin() { 

        if ((!isset($_SESSION['username']) || !$_SESSION['username'])) {

			$this->redirect('Admin/Auth/index', '',2, '<meta charset="UTF-8"><span style='.'font-family:"微软雅黑";font-size:35px;color:#555;'.'>禁止访问，请先登录</span>');

        }
    }

    //删除文件的函数
	protected function delFile($url)
	{
		$tmp = '.'.$url;
		if(unlink($tmp)){
			return true; 
		}else{
			return false;
		}
	}

	//格式化上传的文件的路径函数
	protected function GetImgUrl($str)
	{
		$str = strchr($str,"/");
		$str = strchr($str,"&quot;",true);
		return $str;
	}

	protected function uBatchDel($model)
	{
		$delItems = I('delitems');
		$delItems = trim($delItems, ',');
		$delItems = explode(',', $delItems);
		if($model->db()->getTables() == 'photos'){
			foreach ($delItems as $id) {
				$data = $model->where('id', '=', $id)->field('url')->select();
				$res = $this->delFile($data[0]['url']);
			}
		}
		$model->startTrans();
		$res = $model->where(array('id'=>array('in',$delItems)))->delete();
		if($res){
			$model->commit();
			return true;
		}else{
			$model->rollback();
			return false;
		}
	}
	
}


?>


