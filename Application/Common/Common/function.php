<?php 
/**
 * 
 * @author: linminghuan
 * @date: 2017/8/29
 * @verson: 1.0
 * @description: 自定应的工具函数库 
 * 
 */

function p($param)
{	
	var_dump($param);
	exit;
}

function clg($param)
{
	$date = date("Y/m/d H:i:s");
	echo '<script> console.log("'.$date.'-->");</script>';
	$param = json_encode($param);
	echo '<script> console.log('.$param.');</script>';
}


?>


