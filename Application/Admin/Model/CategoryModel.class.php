<?php 
/**
 * 栏目管理的Model
 * @author: linminghuan
 * @date: 2017/9/14
 * @verson: 1.0
 * @description:  
 * （1）完成基本的功能；（2017/9/14）
 */
namespace Admin\Model;

use Think\Model;

class CategoryModel extends Model
{
	protected $tableName = 'categories';

	protected $_validate = array(
		array('name','require','栏目名必须！'), 
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
        }else{
            $param = I('post.sort');
        }
        return $param;
    }
}




?>


