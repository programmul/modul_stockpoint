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

class Mamoku_PaymentConfirmation_Block_Adminhtml_Csoconfirmation_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
    	parent::__construct();

        $this->_objectId    = 'id';
        $this->_blockGroup  = 'paymentconfirmation';
        $this->_controller  = 'adminhtml_confirmation';
        $this->_headerText = Mage::helper('paymentconfirmation')->__('CSO Confirmation Data');

        $this->_removeButton('save');
        $this->_removeButton('delete');
        $this->_removeButton('reset');

        $confirmationId = (int) $this->getRequest()->getParam('id');
        $_model = Mage::getModel('paymentconfirmation/confirmation');
        $status = $_model->getCollection()->loadById($confirmationId)->getStatus();
        if($status == 0){
            if($this->_isAllowedAction('reject')){
                $this->_addButton('reject', array(
                    'label'     => Mage::helper('paymentconfirmation')->__('Reject'),
                    'class'     => 'delete',
                    'onclick'   => 'deleteConfirm(\''. Mage::helper('paymentconfirmation')->__('Are you sure you want to REJECT this payment confirmation?')
                    .'\', \'' . $this->getRejectUrl() . '\')',
                ), -1);
            }

            if($this->_isAllowedAction('accept')){
                $this->_addButton('accept', array(
                    'label'     => Mage::helper('paymentconfirmation')->__('Accept'),
                    'class'     => 'save',
                    'onclick'   => 'deleteConfirm(\''. Mage::helper('paymentconfirmation')->__('Are you sure you want to ACCEPT this payment confirmation?')
                    .'\', \'' . $this->getAcceptUrl() . '\')',
                ), -1);
            }    
        }    
		
    }

    public function getBackUrl()
    {
        $mode = strtolower(trim($this->getRequest()->getParam('m')));
        if($mode == 'p'){
            return $this->getUrl('*/*/pending');
        }
        elseif($mode == 'a'){
            return $this->getUrl('*/*/all');
        }
    }

    public function getAcceptUrl(){
        $confirmationId = (int) $this->getRequest()->getParam('id');
        $_model = Mage::getModel('paymentconfirmation/confirmation');
        $status = $_model->getCollection()->loadById($confirmationId)->getStatus();
        if($status == 0){
            $mode = strtolower(trim($this->getRequest()->getParam('m')));
            return $this->getUrl('*/*/accept', array('id' => $confirmationId, 'm' => $mode));
        }
        return;
    }

    public function getRejectUrl(){
        $confirmationId = (int) $this->getRequest()->getParam('id');
        $_model = Mage::getModel('paymentconfirmation/confirmation');
        $status = $_model->getCollection()->loadById($confirmationId)->getStatus();
        if($status == 0){
            $mode = strtolower(trim($this->getRequest()->getParam('m')));
            return $this->getUrl('*/*/reject', array('id' => $confirmationId, 'm' => $mode));
        }
        return;
    }

    protected function _isAllowedAction($action) {
        //return Mage::getSingleton('admin/session')->isAllowed("ksall/payment_confirmation/actions/".$action);
        return true;
    }
}