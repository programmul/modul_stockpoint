<?php
function get($param){
	_get('catalog/category');
        
}


function post($param,$post){			
	 _post('entity_id', 'catalog/category', $post);
}

function delete($param){			
	_delete('entity_id',$param,'catalog/category');
}