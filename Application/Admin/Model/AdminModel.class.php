<?php 
/**
 * 后台基类
 * @author: linminghuan
 * @date: 
 * @verson: 1.0
 * @description:  
 * （1）未完成；（2017/9/30）
 * 
 */

namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{
	//封面路径
	protected $cover;
	//封面后缀
	protected $suffix;

	protected function AutoEditor ($param)
	{
    	if(I('post.editor') == ''){
    		$param = $_SESSION['username'];
    	}else{
    		$param = I('post.editor');
    	}
    	return $param;
    }

    protected function nowDate ()
    {
    	return date('Y-m-d H:i:s');
    }

    protected function AutoCover($param)
    {
        if(I('post.cover') == ''){
            $t = rand(1,2);
            $param = $this->cover.$t.$this->suffix;
        }else{
            $param = I('post.cover');
        }
        return $param;
    }

    protected function AutoSort($param)
    {
        if(I('post.sort') == ''){
            $param = M($this->tableName)->count();
            $param++;
        }else{
            $param = I('post.sort');
        }
        return $param;
    }

    protected function GetImgUrl($str)
    {
		$str = strchr($str,"/");
		$str = strchr($str,"&quot;",true);
		return $str;
	}
}



?>


