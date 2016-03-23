<?php
/*
* Copyright (c) 2013 www.Mamoku.com 
*/
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Mamoku_Removeshipping_Checkout_OnepageController extends Mage_Checkout_OnepageController {
  /**
     * save checkout billing address
     */
	public function saveBillingAction()
	{
			if ($this->_expireAjax()) {
					return;
			}
			if ($this->getRequest()->isPost()) {
//            $postData = $this->getRequest()->getPost('billing', array());
//            $data = $this->_filterPostData($postData);
		
					$data = $this->getRequest()->getPost('billing', array());
					$customerAddressId = $this->getRequest()->getPost('billing_address_id', false);

					if (isset($data['email'])) {
							$data['email'] = trim($data['email']);
					}
					$result = $this->getOnepage()->saveBilling($data, $customerAddressId);

					if (!isset($result['error'])) {
							/* check quote for virtual */
							if ($this->getOnepage()->getQuote()->isVirtual()) {
									$result['goto_section'] = 'payment';
									$result['update_section'] = array(
											'name' => 'payment-method',
											'html' => $this->_getPaymentMethodsHtml()
									);
							} elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
									$result['goto_section'] = 'shipping_method';
									//$result['update_section'] = array(
									//		'name' => 'shipping-method',
									//		'html' => $this->_getShippingMethodsHtml()
									//);

									// $result['allow_sections'] = array('shipping');
									// $result['duplicateBillingInfo'] = 'true';
							} else {
									$result['goto_section'] = 'shipping';
							}
					}

					$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
			}
	}
}