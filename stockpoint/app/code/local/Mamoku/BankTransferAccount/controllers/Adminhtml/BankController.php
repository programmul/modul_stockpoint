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

class Mamoku_BankTransferAccount_Adminhtml_BankController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction()
    {
		$this->loadLayout()
			->_setActiveMenu('banktransferaccount/bank')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }

    public function indexAction()
    {
        if($this->_isAllowed()){
            $this->_initAction();
            $this->_addContent($this->getLayout()->createBlock('banktransferaccount/adminhtml_bank'));
            $this->renderLayout();
        }
    }

    public function newAction()
    {
        if($this->_isAllowed()){

            $_model = Mage::getModel('banktransferaccount/bank');
            Mage::register('bank_data', $_model);

            $this->_initAction();
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('banktransferaccount/adminhtml_bank_edit'))
                    ->_addLeft($this->getLayout()->createBlock('banktransferaccount/adminhtml_bank_edit_tabs'));

            $this->renderLayout();
        }
    }

    public function editAction()
    {
        if($this->_isAllowed()){

            $id = $this->getRequest()->getParam('id');
            $_model = Mage::getModel('banktransferaccount/bank')->load($id);

            $this->_title($this->__('Edit Bank Data'));

            Mage::register('bank_data', $_model);

            $this->_initAction();
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('banktransferaccount/adminhtml_bank_edit'))
                    ->_addLeft($this->getLayout()->createBlock('banktransferaccount/adminhtml_bank_edit_tabs'));

            $this->renderLayout();
        }
    }

    public function saveAction()
    {
        if ($arrData = $this->getRequest()->getPost()) 
        {
            $_model = Mage::getModel('banktransferaccount/bank');
            $_model->setData($arrData);
            $id = $this->getRequest()->getParam('id');

            try 
            {
                if($id){
                    $_model->setId($id);
                }

                $_model->save();

                if($id){
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('banktransferaccount')->__('Bank account was successfully updated'));
                }
                else{
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('banktransferaccount')->__('New bank Account was successfully added'));
                }
                
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $_model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) 
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($arrData);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }

        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('banktransferaccount')->__('Unable to save the bank account'));
        $this->_redirect('*/*/');
    }

    // protected function _isActionAllowed($action)
    // {
    //     try {
    //         $session = Mage::getSingleton('admin/session');
    //         $resourceLookup = "admin/ksall/bank_transfer_account/actions/{$action}";
    //         $resourceId = $session->getData('acl')->get($resourceLookup)->getResourceId();
    //         if (!$session->isAllowed($resourceId)) {
    //             throw new Exception('');
    //         }
    //         return true;
    //     }
    //     catch (Exception $e) {
    //         $this->_forward('denied');
    //         return false;
    //     }
    // }

    protected function _isAllowed()
    {
        /*$action = strtolower($this->getRequest()->getActionName());
        switch ($action) {
            case 'index':
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/bank_transfer_account/actions/view');
                break;
            case 'new':
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/bank_transfer_account/actions/add');
                break;
            case 'edit':
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/bank_transfer_account/actions/edit');
                break;               
            default:
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/bank_transfer_account');
                break;
        }*/
        return true;
    }

}
