<?php
function get($param){
	_get('catalog/product');
}


function post($param,$post){			
	_post('sku','catalog/product',$post);
}

function delete($param){			
	_delete('sku',$param,'catalog/product')	;
}