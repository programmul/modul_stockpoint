<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Mamoku
 * @package     Mamoku_PaymentConfirmation
 * @copyright   Copyright (c) 2015 mamoku
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Installer to create table mamoku_payment_confirmation
 *
 * @author      mamoku <info@mamoku.com>
 */

class Mamoku_PaymentConfirmation_Model_Observer
{
	protected $_faspay = 'Faspay';
	protected $_ipgdoku = 'IpgDoku';
    
    public function acceptConfirmation(Varien_Event_Observer $observer)
    {
    	$order = $observer->getEvent()->getInvoice()->getOrder();
    	$realOrderId = $order->getIncrementId();
    	$_model = Mage::getModel('paymentconfirmation/confirmation');
    	$collection = $_model->getCollection()->loadByOrder($realOrderId)->getLastItem();
    	if($collection){
    		$adminDate = $collection->getAdminDate();
	    	$confirmationStatus = $collection->getStatus();
	    	if(! $adminDate){
	    		$confirmationId = $collection->getId();
	    		$paymentCode = $order->getPayment()->getMethodInstance()->getCode();
	    		$currentDate = date('Y-m-d H:i:s');
		    	if($confirmationId && ($confirmationStatus == 0 || $confirmationStatus == 1 || $confirmationStatus == 2)){
		    		if($confirmationStatus != 1){
	    				$info = unserialize($_model->getCollection()->loadById($confirmationId)->getInfo());
	    				$info['accepted_via'] = 'invoice';
	    				$_model->setInfo(serialize($info));
	    			}
		    		if($paymentCode == 'banktransfer' || $paymentCode == 'instorepayment'){
		    			if($confirmationStatus == 0){
			    			$_model->setReviewDate($currentDate);
			    		}
			            $_model->setConfirmationStatus(1);
		    		}
		    		$_model->setConfirmationId($confirmationId);
		            $_model->setAdminDate($currentDate);
		            $_model->setInvoiceStatus($observer->getEvent()->getInvoice()->getStateName());
		            $_model->save();
		    	}
		    	else{
		    		$customerId = $order->getCustomerId();
		    		$customerGroupId = Mage::getModel('customer/customer')->load($customerId)->getGroupId();
		    		$csoGroupId = Mage::helper('paymentconfirmation/data')->getCSOGroupID();
		    		$orderId = $order->getId();

		    		$transferTo = '';
		    		if($paymentCode == 'banktransfer' || $paymentCode == 'instorepayment'){
		    			$transferTo = $paymentCode;
		    		}elseif(strstr($paymentCode, 'faspay') !== false){
		    			$transferTo = $this->_faspay;
		    		}elseif(strstr($paymentCode, 'ipgdoku') !== false){
		    			$transferTo = $this->_ipgdoku;
		    		}

		    		$info = array('created_via' => 'invoice', 'accepted_via' => 'invoice');
	    			$arrData = array();
	    			$arrData['order_id'] = $realOrderId;
	    			$arrData['transfer_date'] = '';
	    			$arrData['created_at'] = $currentDate;
	    			$arrData['transfer_method'] = $paymentCode;
	    			$arrData['transfer_amount'] = $order->getGrandTotal();
	    			$arrData['confirmation_status'] = 1;
	    			$arrData['review_date'] = $currentDate;
	    			$arrData['admin_date'] = $currentDate;
	    			$arrData['invoice_status'] = $observer->getEvent()->getInvoice()->getStateName();
	    			$arrData['customer_id'] = $customerId;
	    			$arrData['group_member'] = $customerGroupId;
	    			$arrData['customer_name'] = ucwords(strtolower($order->getCustomerFirstname().' '.$order->getCustomerLastname()));
	                $arrData['customer_email'] = strtolower($order->getCustomerEmail());
	                $arrData['transfer_from'] = '';
	    			$arrData['bank_account_name'] = '';
	    			$arrData['transfer_to'] = $transferTo;
	                $arrData['info'] = serialize($info);

	                if($customerGroupId == $csoGroupId){
		    			$arrData['confirmation_type'] = $customerGroupId;
		    		}
		    		else{
		    			$arrData['confirmation_type'] = 0;
		    		}
		    		
		    		$_model->setData($arrData);
	                $_model->save();
		    	}
	    	}
    	}
    }

    public function rejectConfirmation(Varien_Event_Observer $observer)
    {
    	$order = $observer->getEvent()->getOrder();
    	$realOrderId = $order->getIncrementId();
    	$_model = Mage::getModel('paymentconfirmation/confirmation');
    	$collection = $_model->getCollection()->loadByOrder($realOrderId)->getLastItem();
    	if($collection){
    		$adminDate = $collection->getAdminDate();
	    	$confirmationStatus = $collection->getStatus();
	    	if(! $adminDate){
	    		$confirmationId = $collection->getId();
	    		$paymentCode = $order->getPayment()->getMethodInstance()->getCode();
	    		$currentDate = date('Y-m-d H:i:s');
		    	if($confirmationId && ($confirmationStatus == 0 || $confirmationStatus == 1 || $confirmationStatus == 2)){
	    			if($confirmationStatus != 2){
	    				$info = unserialize($_model->getCollection()->loadById($confirmationId)->getInfo());
	    				$info['rejected_via'] = 'order';
	    				$_model->setInfo(serialize($info));
	    			}
	    			if($paymentCode == 'banktransfer' || $paymentCode == 'instorepayment'){
	    				if($confirmationStatus == 0){
			    			$_model->setReviewDate($currentDate);
			    		}
			            $_model->setConfirmationStatus(2);
			        }
			        $_model->setConfirmationId($confirmationId);
		            $_model->setAdminDate($currentDate);
		            $_model->setInvoiceStatus('');
		            $_model->save();
		    	}
		    	else{
		    		$customerId = $order->getCustomerId();
		    		$customerGroupId = Mage::getModel('customer/customer')->load($customerId)->getGroupId();
		    		$csoGroupId = Mage::helper('paymentconfirmation/data')->getCSOGroupID();
		    		$orderId = $order->getId();

		    		$transferTo = '';
		    		if($paymentCode == 'banktransfer' || $paymentCode == 'instorepayment'){
		    			$transferTo = $paymentCode;
		    		}elseif(strstr($paymentCode, 'faspay') !== false){
		    			$transferTo = $this->_faspay;
		    		}elseif(strstr($paymentCode, 'ipgdoku') !== false){
		    			$transferTo = $this->_ipgdoku;
		    		}

		    		$info = array('created_via' => 'order', 'rejected_via' => 'order');
	    			$arrData = array();
	    			$arrData['order_id'] = $realOrderId;
	    			$arrData['transfer_date'] = '';
	    			$arrData['created_at'] = $currentDate;
	    			$arrData['transfer_from'] = '';
	    			$arrData['bank_account_name'] = '';
	    			$arrData['transfer_to'] = $transferTo;
	    			$arrData['transfer_method'] = $paymentCode;
	    			$arrData['transfer_amount'] = $order->getGrandTotal();
	    			$arrData['confirmation_status'] = 2;
	    			$arrData['review_date'] = $currentDate;
	    			$arrData['admin_date'] = $currentDate;
	    			$arrData['invoice_status'] = '';
	    			$arrData['customer_id'] = $customerId;
	    			$arrData['group_member'] = $customerGroupId;
	    			$arrData['customer_name'] = ucwords(strtolower($order->getCustomerFirstname().' '.$order->getCustomerLastname()));
	                $arrData['customer_email'] = strtolower($order->getCustomerEmail());
	                $arrData['info'] = serialize($info);
		    		if($customerGroupId == $csoGroupId){
		    			$arrData['confirmation_type'] = $customerGroupId;
		    		}
		    		else{
		    			$arrData['confirmation_type'] = 0;
		    		}
		    		$_model->setData($arrData);
	                $_model->save();
		    	}
	    	}
    	}
    }

    /**
     * Create Payment Confirmation triggered from Faspay payment status
     * Mamoku_Faspay_PaymentController
     * Event => faspay_payment_status_save
     */
    public function createPaymentConfirmationForFaspay(Varien_Event_Observer $observer)
    {
    	$order = $observer->getEvent()->getOrder();
    	$orderStatus = $observer->getEvent()->getStatus();
    	$_model = Mage::getModel('paymentconfirmation/confirmation');
    	$confirmationStatus = 0;
    	if($orderStatus == Mage_Sales_Model_Order::STATE_NEW){
    		$info = array('created_via' => 'faspay');
    	}
    	elseif($orderStatus == Mage_Sales_Model_Order::STATE_PROCESSING){
    		$confirmationStatus = 1;
    		$info = array('created_via' => 'faspay', 'accepted_via' => 'faspay');
    	}
    	elseif($orderStatus == Mage_Sales_Model_Order::STATE_CANCELED){
    		$confirmationStatus = 2;
    		$info = array('created_via' => 'faspay', 'rejected_via' => 'faspay');
    	}
    	$currentDate = date('Y-m-d H:i:s');
    	$customerGroupId = Mage::getModel('customer/customer')->load($order->getCustomerId())->getGroupId();
    	$csoGroupId = Mage::helper('paymentconfirmation/data')->getCSOGroupID();
    	$confirmationType = $customerGroupId == $csoGroupId ? $csoGroupId : 0;
		$arrData = array();
		$arrData['order_id'] = $order->getIncrementId();
		$arrData['transfer_date'] = $currentDate;
		$arrData['created_at'] = $currentDate;
		$arrData['transfer_from'] = '';
		$arrData['bank_account_name'] = '';
		$arrData['transfer_to'] = $this->_faspay;
		$arrData['transfer_method'] = $order->getPayment()->getMethod();
		$arrData['transfer_amount'] = $order->getGrandTotal();
		$arrData['confirmation_type'] = $confirmationType;
		$arrData['confirmation_status'] = $confirmationStatus;
		$arrData['review_date'] = $currentDate;
		$arrData['admin_date'] = '';
		$arrData['invoice_status'] = '';
		$arrData['customer_id'] = $order->getCustomerId();
		$arrData['group_member'] = $customerGroupId;
		$arrData['customer_name'] = ucwords(strtolower($order->getCustomerFirstname().' '.$order->getCustomerLastname()));
        $arrData['customer_email'] = strtolower($order->getCustomerEmail());
        $arrData['info'] = serialize($info);
        $_model->setData($arrData);
        $_model->save();
    }

    /**
     * Create Payment Confirmation triggered from IPG DOKU payment status
     * Mamoku_IpgDoku_PaymentController
     * Event => ipgdoku_payment_status_save
     */
    public function createPaymentConfirmationForIpgDoku(Varien_Event_Observer $observer)
    {
    	$order = $observer->getEvent()->getOrder();
    	$orderStatus = $observer->getEvent()->getStatus();
    	$_model = Mage::getModel('paymentconfirmation/confirmation');
    	$confirmationStatus = 0;
    	if($orderStatus == Mage_Sales_Model_Order::STATE_PROCESSING){
    		$confirmationStatus = 1;
    		$info = array('created_via' => 'ipgdoku', 'accepted_via' => 'ipgdoku');
    	}
    	elseif($orderStatus == Mage_Sales_Model_Order::STATE_CANCELED){
    		$confirmationStatus = 2;
    		$info = array('created_via' => 'ipgdoku', 'rejected_via' => 'ipgdoku');
    	}
    	$currentDate = date('Y-m-d H:i:s');
    	$customerGroupId = Mage::getModel('customer/customer')->load($order->getCustomerId())->getGroupId();
    	$csoGroupId = Mage::helper('paymentconfirmation/data')->getCSOGroupID();
    	$confirmationType = $customerGroupId == $csoGroupId ? $csoGroupId : 0;
		$arrData = array();
		$arrData['order_id'] = $order->getIncrementId();
		$arrData['transfer_date'] = $currentDate;
		$arrData['created_at'] = $currentDate;
		$arrData['transfer_from'] = '';
		$arrData['bank_account_name'] = '';
		$arrData['transfer_to'] = $this->_ipgdoku;
		$arrData['transfer_method'] = $order->getPayment()->getMethod();
		$arrData['transfer_amount'] = $order->getGrandTotal();
		$arrData['confirmation_type'] = $confirmationType;
		$arrData['confirmation_status'] = $confirmationStatus;
		$arrData['review_date'] = $currentDate;
		$arrData['admin_date'] = '';
		$arrData['invoice_status'] = '';
		$arrData['customer_id'] = $order->getCustomerId();
		$arrData['group_member'] = $customerGroupId;
		$arrData['customer_name'] = ucwords(strtolower($order->getCustomerFirstname().' '.$order->getCustomerLastname()));
        $arrData['customer_email'] = strtolower($order->getCustomerEmail());
        $arrData['info'] = serialize($info);
        $_model->setData($arrData);
        $_model->save();
    }

}
