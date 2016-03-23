<?php
function get($param){
	_get('sales/order',$param);
}


function post($param,$post){			
	_post('entity_id','sales/order',$post);
}

function delete($param){			
	_delete('entity_id',$param,'sales/order')	;
}