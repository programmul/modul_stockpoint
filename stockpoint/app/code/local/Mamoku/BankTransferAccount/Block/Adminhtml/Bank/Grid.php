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
 
class Mamoku_BankTransferAccount_Block_Adminhtml_Bank_Grid extends Mage_Adminhtml_Block_Widget_Grid 
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('banktransferaccount_bank_grid');
        $this->setUseAjax(false);
        $this->setDefaultSort('bank_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('banktransferaccount/bank')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('bank_id', array(
            'header'    => Mage::helper('banktransferaccount')->__('ID'),
            'align'     =>'left',
            'width'     => '70px',
            'index'     => 'bank_id'
        ));

        $this->addColumn('bank_name', array(
            'header'    => Mage::helper('banktransferaccount')->__('Bank Name'),
            'align'     =>'left',
            'index'     => 'bank_name'
        ));

        $this->addColumn('account_name', array(
            'header'    => Mage::helper('banktransferaccount')->__('Account Name'),
            'align'     =>'left',
            'index'     => 'account_name'
        ));

        $this->addColumn('account_no', array(
            'header'    => Mage::helper('banktransferaccount')->__('Account Number'),
            'align'     =>'left',
            'index'     => 'account_no'
        ));

        // $this->addColumn('bank_logo', array(
        //     'header'    => Mage::helper('banktransferaccount')->__('Bank Logo'),
        //     'align'     =>'left',
        //     'index'     => 'bank_logo'
        // ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('banktransferaccount')->__('Created Date'),
            'align'     =>'left',
            'type'      => 'datetime',
            'index'     => 'created_at'
        ));

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('banktransferaccount')->__('Status'),
            'align'     => 'left',
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => array(
                    0 => Mage::helper('banktransferaccount')->__('Disable'),
                    1 => Mage::helper('banktransferaccount')->__('Enable')
            )
        ));

        if($this->_isAllowedAction("edit")) {
            $actions[0] = array(
                'caption'   => Mage::helper('banktransferaccount')->__('Edit'),
                'url'       => array('base'=> '*/*/edit'),
                'field'     => 'id'
            );
        }

        if($this->_isAllowedAction("edit")) {
            $this->addColumn('action',
                array(
                'header'    =>  Mage::helper('banktransferaccount')->__('Action'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getBankId',
                'actions'   => $actions,
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true
            ));
        }

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        if($this->_isAllowedAction("edit")) {
            return $this->getUrl('*/*/edit', array('id' => $row->getBankId()));
        }
        return false;
    }

    protected function _isAllowedAction($action) {
        //return Mage::getSingleton('admin/session')->isAllowed("ksall/bank_transfer_account/actions/".$action);
        return true;
    }
}