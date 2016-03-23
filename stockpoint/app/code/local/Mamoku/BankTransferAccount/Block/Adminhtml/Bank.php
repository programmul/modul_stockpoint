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
 * @package     Mamoku_BankTransferAccount
 * @copyright   Copyright (c) 2015 Mamoku Services (http://www.mamoku.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Installer to create table ks_bank_transfer_account
 *
 * @author      Team Mamoku <info@mamoku.com>
 */

class Mamoku_BankTransferAccount_Block_Adminhtml_Bank extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {

        parent::__construct();
        
        $this->_controller = 'adminhtml_bank';
        $this->_blockGroup = 'banktransferaccount';
        $this->_headerText = Mage::helper('banktransferaccount')->__('Manage Bank Account');

        if(! $this->_isAllowedAction("add")) {
            $this->_removeButton('add');
        }

    }

    protected function _prepareLayout() {

        $this->setChild('grid', $this->getLayout()->createBlock('banktransferaccount/adminhtml_bank_grid', 'bank.grid'));
		
        return parent::_prepareLayout();
    }

    public function getGridHtml() {
        return $this->getChildHtml('grid');
    }

    protected function _isAllowedAction($action) {
        //return Mage::getSingleton('admin/session')->isAllowed("ksall/bank_transfer_account/actions/".$action);
        return true;
    }

}