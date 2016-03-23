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

class Mamoku_PaymentConfirmation_Block_Adminhtml_Csoconfirmation extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {

        parent::__construct();
        
        $this->_controller = 'adminhtml_csoconfirmation';
        $this->_blockGroup = 'paymentconfirmation';

        $this->_removeButton('add');
		
    }

    protected function _prepareLayout() {

        $this->setChild('grid', $this->getLayout()->createBlock('paymentconfirmation/adminhtml_csoconfirmation_grid', 'confirmation.grid'));
		
        return parent::_prepareLayout();
    }

    public function getGridHtml() {
        return $this->getChildHtml('grid');
    }

    public function getHeaderText()
    {
        $pageAction = strtolower(trim($this->getRequest()->getActionName()));
        if( $pageAction == 'pending') 
        {
            return Mage::helper('paymentconfirmation')->__('CSO Pending Confirmations');
        }
        elseif( $pageAction == 'all') 
        {
            return Mage::helper('paymentconfirmation')->__('CSO All Confirmations');
        }
    }

    protected function _isAllowedAction($action) {
        //return Mage::getSingleton('admin/session')->isAllowed("ksall/payment_Csoconfirmation/actions/".$action);
        return true;
    }

}