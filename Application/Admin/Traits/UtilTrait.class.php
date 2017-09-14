<?php 
/**
 * 工具Traits
 * @author: linminghuan
 * @date: 2017/9/14
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/14）
 */
namespace Admin\Traits;

trait UtilTrait
{
	//删除文件的函数
	private function delFile($url)
	{
		$tmp = '.'.$url;
		if(unlink($tmp)){
			return true; 
		}else{
			return false;
		}
	}

	//格式化上传的文件的路径函数
	private function GetImgUrl($str)
	{
		$str = strchr($str,"/");
		$str = strchr($str,"&quot;",true);
		return $str;
	}

	private function uBatchDel($model)
	{
		$delItems = I('delitems');
		$delItems = trim($delItems, ',');
		$delItems = explode(',', $delItems);
		foreach ($delItems as $id) {
			$data = $model->where('id', '=', $id)->field('url')->select();
			$res = $this->delFile($data[0]['url']);
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


