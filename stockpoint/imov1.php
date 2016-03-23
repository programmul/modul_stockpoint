<?php
error_reporting(E_ALL);
include('lib/magento.php');

if(file_exists('api/'.$param->model.'.php')){	
	include('api/'.$param->model.'.php');
	if($param->model != 'auth' && md5('sandbox')!=$param->token){
		 error('invalid token');
	}else	
	eval($method.'($GLOBALS["param"],$GLOBALS["post"]);');			
}else{
	error($param->model.' 404');
}
