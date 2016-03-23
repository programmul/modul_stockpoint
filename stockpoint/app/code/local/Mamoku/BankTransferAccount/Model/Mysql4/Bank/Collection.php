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

class Mamoku_BankTransferAccount_Model_Mysql4_Bank_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract 
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('banktransferaccount/bank');
    }

    protected function _getFirstItem()
    {
    	$collection = $this->getData();
    	return $collection[0];
    }

    public function getBankName()
    {
    	$collection = $this->_getFirstItem();
    	return $collection['bank_name'];
    }

    public function getAccountName()
    {
    	$collection = $this->_getFirstItem();
    	return $collection['account_name'];
    }

    public function getAccountNo()
    {
    	$collection = $this->_getFirstItem();
    	return $collection['account_no'];
    }

    public function getBankLogo()
    {
    	$collection = $this->_getFirstItem();
    	return $collection['bank_logo'];
    }

    public function isActive()
    {
    	$collection = $this->_getFirstItem();
    	return $collection['is_active'];
    }

    public function toOptionArray()
    {
        $arrayList[] = array('value' => '', 'label' => '');
        foreach ($this->getData() as $data) {
            $arrayList[] = array('value' => $data['bank_id'], 'label' => $data['bank_name'].' - '.$data['account_no']);
        }
        return $arrayList;
    }

    public function getTransferMethodArray()
    {
        $arrayList[] = array('value' => '', 'label' => '');
        $arrayList[] = array('value' => 'ATM', 'label' => 'ATM');
        $arrayList[] = array('value' => 'e-Banking', 'label' => 'e-Banking');
        $arrayList[] = array('value' => 'M-Banking', 'label' => 'M-Banking (SMS Banking)');
        return $arrayList;
    }
}