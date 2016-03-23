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

class Mamoku_BankTransferAccount_Block_Adminhtml_Bank_Edit_Tab_Bank extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $_model = Mage::registry('bank_data');

        $form = new Varien_Data_Form();
        $this->setForm($form);
        
        $fieldset = $form->addFieldset('bank_form', array('legend'=>Mage::helper('banktransferaccount')->__('General Information')));

        if( ! Mage::registry('bank_data')->getBankId())
        {
            $fieldset->addField('created_at', 'hidden', array(
                'name'      => 'created_at',
                'value'     => date('Y-m-d H:i:s')
            ));
        }
        
        $fieldset->addField('bank_name', 'text', array(
            'label'     => Mage::helper('banktransferaccount')->__('Bank Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'bank_name',
            'value'     => $_model->getBankName()
        ));

        $fieldset->addField('account_name', 'text', array(
            'label'     => Mage::helper('banktransferaccount')->__('Account Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'account_name',
            'value'     => $_model->getAccountName()
        ));

        $fieldset->addField('account_no', 'text', array(
            'label'     => Mage::helper('banktransferaccount')->__('Account Number'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'account_no',
            'value'     => $_model->getAccountNo()
        ));

        $fieldset->addField('is_active', 'select', array(
            'label'     => Mage::helper('banktransferaccount')->__('Status'),
            'name'      => 'is_active',
            'values'    => Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
            'value'     => $_model->getIsActive()
        ));

        return parent::_prepareForm();
    }
}
