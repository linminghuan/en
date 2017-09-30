<?php 
/**
 * recommend的model
 * @author: linminghuan
 * @date: 2017/9/24
 * @verson: 1.0
 * @description:  
 * （1）完成基本功能；（2017/9/24）
 */
namespace Admin\Model;

use Think\Model;

class RecommendModel extends Model
{
	protected $tableName = 'recommends';

	protected $_validate = array(
		array('url','require','链接必须！'), 
		array('cover','require','封面必须'),
    );

    protected $_auto = array ( 
		array('update_at',"nowDate",3,'callback'),
        array('sort','AutoSort',1,'callback'),
    );

    protected function nowDate ()
    {
    	return date('Y-m-d H:i:s');
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
}




?>


