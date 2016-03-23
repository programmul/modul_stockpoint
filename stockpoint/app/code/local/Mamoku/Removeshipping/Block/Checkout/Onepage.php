<?php
/*
* Copyright (c) 2013 www.Mamoku.com 
*/
class Mamoku_Removeshipping_Block_Checkout_Onepage extends Mage_Checkout_Block_Onepage {
	protected function _getStepCodes() {
		return array('login', 'billing', 'shipping_method', 'payment', 'review');
	}
}