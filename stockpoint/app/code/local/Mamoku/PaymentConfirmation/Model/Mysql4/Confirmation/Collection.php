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

class Mamoku_PaymentConfirmation_Model_Mysql4_Confirmation_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract 
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('paymentconfirmation/confirmation');
    }

    public function loadById($confirmationId){
        $this->addFieldToFilter('confirmation_id', $confirmationId);
        return $this;
    }

    public function loadByOrder($orderId){
        $this->addFieldToFilter('order_id', $orderId);
        return $this;
    }

    public function getFirstItem(){
        $this->setOrder('confirmation_id', 'ASC')->count();
        $this->getSelect()->limit(1);
        return $this;
    }

    public function getLastItem(){
        $this->setOrder('confirmation_id', 'DESC')->count();
        $this->getSelect()->limit(1);
        return $this;
    }

    public function getId()
    {
        $collection = $this->getData();
        return @$collection[0]['confirmation_id'];
    }

    public function getOrderId()
    {
    	$collection = $this->getData();
    	return @$collection[0]['order_id'];
    }

    public function getCustomerId()
    {
    	$collection = $this->getData();
    	return @$collection[0]['customer_id'];
    }

    public function getTransferDate()
    {
    	$collection = $this->getData();
    	return @$collection[0]['transfer_date'];
    }

    public function getTransferFrom()
    {
    	$collection = $this->getData();
    	return @$collection[0]['transfer_from'];
    }

    public function getTransferTo()
    {
    	$collection = $this->getData();
    	return @$collection[0]['transfer_to'];
    }

    public function getTransferAmount()
    {
    	$collection = $this->getData();
    	return @$collection[0]['transfer_amount'];
    }

    public function getNotes()
    {
    	$collection = $this->getData();
    	return @$collection[0]['notes'];
    }

    public function getStatus()
    {
    	$collection = $this->getData();
    	return @$collection[0]['confirmation_status'];
    }

    public function getConfirmationDate()
    {
        $collection = $this->getData();
        return @$collection[0]['created_at'];
    }

    public function getConfirmationType()
    {
        $collection = $this->getData();
        return @$collection[0]['confirmation_type'];
    }

    public function getBankAccountName()
    {
        $collection = $this->getData();
        return @$collection[0]['bank_account_name'];
    }

    public function getTransferMethod()
    {
        $collection = $this->getData();
        return @$collection[0]['transfer_method'];
    }

    public function getCustomerName()
    {
        $collection = $this->getData();
        return @$collection[0]['customer_name'];
    }

    public function getCustomerEmail()
    {
        $collection = $this->getData();
        return @$collection[0]['customer_email'];
    }

    public function getShopCode()
    {
        $collection = $this->getData();
        return @$collection[0]['shop_code'];
    }

    public function getReceiptNo()
    {
        $collection = $this->getData();
        return @$collection[0]['receipt_no'];
    }

    public function getCashierName()
    {
        $collection = $this->getData();
        return @$collection[0]['cashier_name'];
    }

    public function getBuyerName()
    {
        $collection = $this->getData();
        return @$collection[0]['buyer_name'];
    }

    public function getBuyerEmail()
    {
        $collection = $this->getData();
        return @$collection[0]['buyer_email'];
    }

    public function getBuyerPhone()
    {
        $collection = $this->getData();
        return @$collection[0]['buyer_phone'];
    }

    public function getGroupMember()
    {
        $collection = $this->getData();
        return @$collection[0]['group_member'];
    }

    public function getInfo()
    {
        $collection = $this->getData();
        return @$collection[0]['info'];
    }

    public function getReviewDate()
    {
        $collection = $this->getData();
        return @$collection[0]['review_date'];
    }

    public function getAdminDate()
    {
        $collection = $this->getData();
        return @$collection[0]['admin_date'];
    }

    public function getOrderStatus()
    {
        $collection = $this->getData();
        return @$collection[0]['order_status'];
    }

    public function getInvoiceStatus()
    {
        $collection = $this->getData();
        return @$collection[0]['invoice_status'];
    }
    
}