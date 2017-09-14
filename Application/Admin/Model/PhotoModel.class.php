<?php 
/**
 * 图片管理的Model;
 * @author: linminghuan
 * @date: 2017/9/14
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/14）
 */
namespace Admin\Model;

use Think\Model;

class PhotoModel extends Model
{
	protected $tableName = 'photos';

	protected $_validate = array(
		array('discription','require','描述必须！'), 
    );

	protected $_auto = array ( 
		array('update_at',"nowDate",3,'callback'),
		array('url','GetImgUrl',3,'callback'),
		array('editor','AutoEditor',1,'callback'),
    );

    protected function GetImgUrl($str)
    {
		$str = strchr($str,"/");
		$str = strchr($str,"&quot;",true);
		return $str;
	}

	protected function AutoEditor ($param)
	{
    	if(I('post.editor') == ''){
    		$param = $_SESSION['name'];
    	}else{
    		$param = I('post.editor');
    	}
    	return $param;
    }

    protected function nowDate ()
    {
    	return date('Y-m-d H:i:s');
    }

}




?>


