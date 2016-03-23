<?php
function get($param){
	_get('konfirmasipembayaran/konfirmasipembayaran');
$data=mage:getModel('konfirmasipembayaran/konfirmasipembayaran');
	var_dump($data->getData());
}


// Module konfirmasi pembayaran