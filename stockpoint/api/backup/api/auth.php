<?php

function get($param){
	
	if($param->apikey=='123123'){		
		$token['token']=md5('sandbox');
		success('success',(object)$token);
	}else{
		error('notvalid');
	}
}