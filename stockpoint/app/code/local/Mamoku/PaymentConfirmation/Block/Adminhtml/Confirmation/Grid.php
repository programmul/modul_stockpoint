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
 
class Mamoku_PaymentConfirmation_Block_Adminhtml_Confirmation_Grid extends Mage_Adminhtml_Block_Widget_Grid 
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('paymentconfirmation_confirmation_grid');
        $this->setUseAjax(false);
        $this->setDefaultSort('order_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $pageAction = strtolower(trim($this->getRequest()->getActionName()));
        $collection = Mage::getModel('paymentconfirmation/confirmation')->getCollection();
        $collection->addFieldToFilter('confirmation_type', 0);
        if($pageAction == 'pending'){
            $collection->addFieldToFilter('confirmation_status', 0);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $pageAction = strtolower(trim($this->getRequest()->getActionName()));

        $this->addColumn('confirmation_id', array(
            'header'    => Mage::helper('paymentconfirmation')->__('ID'),
            'align'     =>'left',
            'width'     => '70px',
            'index'     => 'confirmation_id'
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Date'),
            'align'     =>'left',
            'type'      => 'datetime',
            'index'     => 'created_at'
        ));

        $this->addColumn('order_id', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Order No'),
            'align'     =>'left',
            'width'     => '70px',
            'index'     => 'order_id'
        ));

       /* $this->addColumn('customer_name', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Name'),
            'align'     =>'left',
            'index'     => 'customer_name'
        ));

        $this->addColumn('customer_email', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Email'),
            'align'     =>'left',
            'index'     => 'customer_email'
        ));*/

        $this->addColumn('transfer_date', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Transfer Date'),
            'align'     =>'left',
            'type'      => 'date',
            'index'     => 'transfer_date',
        ));

        $this->addColumn('transfer_from', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Transfer From'),
            'align'     =>'left',
            'index'     => 'transfer_from',
        ));

        $this->addColumn('bank_account_name', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Depositor Name'),
            'align'     =>'left',
            'index'     => 'bank_account_name'
        ));

        $this->addColumn('transfer_to_bank', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Transfer To'),
            'align'     =>'left',
            'width'     => '300px',
            'filter'    => false,
            'sortable'  => false,
            'renderer'  => 'Mamoku_PaymentConfirmation_Block_Adminhtml_Confirmation_Grid_Column_Bank'
        ));

        $this->addColumn('transfer_method', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Transfer Method'),
            'align'     =>'left',
            'index'     => 'transfer_method',
            'renderer'  => 'Mamoku_PaymentConfirmation_Block_Adminhtml_Confirmation_Grid_Column_Paymentmethod'
        ));

        $this->addColumn('transfer_amount', array(
            'header'    => Mage::helper('paymentconfirmation')->__('Transfer Amount'),
            'align'     =>'left',
            'index'     => 'transfer_amount'
        ));

        if($pageAction != 'pending'){

            $this->addColumn('confirmation_status', array(
                'header'    => Mage::helper('paymentconfirmation')->__('Status'),
                'align'     => 'left',
                'index'     => 'confirmation_status',
                'type'      => 'options',
                'options'   => array(
                        0 => Mage::helper('paymentconfirmation')->__('Pending'),
                        1 => Mage::helper('paymentconfirmation')->__('Accepted'),
                        2 => Mage::helper('paymentconfirmation')->__('Rejected')
                )
            ));
        }

        if($pageAction == 'pending'){

            if($this->_isAllowedAction("accept") || $this->_isAllowedAction("reject")) {
                $actions[0] = array(
                    'caption'   => Mage::helper('paymentconfirmation')->__('Edit'),
                    'url'       => array('base'=> '*/*/edit/m/p'),
                    'field'     => 'id'
                );
            }

            if($this->_isAllowedAction("accept") || $this->_isAllowedAction("reject")) {
                $this->addColumn('action',
                    array(
                    'header'    =>  Mage::helper('paymentconfirmation')->__('Action'),
                    'width'     => '100px',
                    'type'      => 'action',
                    'getter'    => 'getConfirmationId',
                    'actions'   => $actions,
                    'filter'    => false,
                    'sortable'  => false,
                    'is_system' => true
                ));
            }
        }

        // $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        // $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        $pageAction = strtolower(trim($this->getRequest()->getActionName()));
        if($this->_isAllowedAction("accept") || $this->_isAllowedAction("reject")) {
            if($pageAction == 'pending'){
                return $this->getUrl('*/*/edit', array('id' => $row->getConfirmationId(), 'm' => 'p'));
            }
            elseif($pageAction == 'all'){
                return $this->getUrl('*/*/edit', array('id' => $row->getConfirmationId(), 'm' => 'a'));
            }
        }
        return false;
    }

    protected function _isAllowedAction($action) {
        //return Mage::getSingleton('admin/session')->isAllowed("ksall/payment_confirmation/actions/".$action);
        return true;
    }
}