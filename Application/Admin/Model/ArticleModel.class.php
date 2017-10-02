<?php 
/**
 * 文章管理的Model
 * @author: linminghuan
 * @date: 2017/9/15
 * @verson: 1.0
 * @description:  
 * 
 */
namespace Admin\Model;

use Think\Model;

class ArticleModel extends Model
{
	protected $tableName = 'articles';

	protected $_validate = array(
		array('title','require','标题必须！'), 
		array('content','require','正文必须！'), 
		array('category_id','require','栏目必须！'), 
    );

    protected $_auto = array ( 
		array('update_at',"nowDate",3,'callback'),
		array('editor','AutoEditor',1,'callback'),
        array('cover', 'AutoCover',3,'callback'),
        array('sort','AutoSort',1,'callback'),
        array('discription','AutoDiscription',1,'callback'),
    );

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
            $param = '/en/Public/Home/Images/article'.$t.'.jpg';
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

    protected function AutoDiscription($param)
    {
        $disc = I('post.discription');
        if($disc != ''){
            if(strlen($disc) >= 250){
                $disc = substr($disc,0,250);
                $param = $disc.'...';
            }else{
                $param = $disc.'...';
            }
            return $param;
        }
    }
}




?>


