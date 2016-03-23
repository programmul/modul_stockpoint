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

class Mamoku_PaymentConfirmation_Adminhtml_CsoconfirmationController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction()
    {
		$this->loadLayout()
			->_setActiveMenu('paymentconfirmation/confirmation')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }

    public function indexAction()
    {
        if($this->_isAllowed()){
            $this->_redirect('*/*/pending');
        }
    }

    public function pendingAction()
    {
        if($this->_isAllowed()){
            $this->_initAction();
            $this->_addContent($this->getLayout()->createBlock('paymentconfirmation/adminhtml_csoconfirmation'));
            $this->renderLayout();
        }
    }

    public function allAction()
    {
        if($this->_isAllowed()){
            $this->_initAction();
            $this->_addContent($this->getLayout()->createBlock('paymentconfirmation/adminhtml_csoconfirmation'));
            $this->renderLayout();
        }
    }

    public function editAction()
    {
        if($this->_isAllowed()){

            $this->_initAction();
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('paymentconfirmation/adminhtml_csoconfirmation_edit'))
                    ->_addLeft($this->getLayout()->createBlock('paymentconfirmation/adminhtml_csoconfirmation_edit_tabs'));

            $this->renderLayout();
        }
    }

    public function acceptAction()
    {
        if($this->_isAllowed()){
            $currentDate = date('Y-m-d H:i:s');
            $id = $this->getRequest()->getParam('id');
            $_model = Mage::getModel('paymentconfirmation/confirmation');
            $info = unserialize($_model->getCollection()->loadById($id)->getInfo());
            $info['accepted_via'] = 'confirmation';
            $_model->setConfirmationId($id);
            $_model->setConfirmationStatus(1);
            $_model->setReviewDate($currentDate);
            $_model->setInfo(serialize($info));
            try {
                $_model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('paymentconfirmation')->__('The payment confirmation was successfully accepted'));
            }
            catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }

            $mode = strtolower(trim($this->getRequest()->getParam('m')));
            if($mode == 'p'){
                $this->_redirect('*/*/pending');
            }
            else{
                $this->_redirect('*/*/all');
            }
        }
    }

    public function rejectAction()
    {
        if($this->_isAllowed()){
            $currentDate = date('Y-m-d H:i:s');
            $id = $this->getRequest()->getParam('id');
            $_model = Mage::getModel('paymentconfirmation/confirmation');
            $info = unserialize($_model->getCollection()->loadById($id)->getInfo());
            $info['rejected_via'] = 'confirmation';
            $_model->setConfirmationId($id);
            $_model->setConfirmationStatus(2);
            $_model->setReviewDate($currentDate);
            $_model->setInfo(serialize($info));
            try {
                $_model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('paymentconfirmation')->__('The payment confirmation was successfully rejected'));
            }
            catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }

            $mode = strtolower(trim($this->getRequest()->getParam('m')));
            if($mode == 'p'){
                $this->_redirect('*/*/pending');
            }
            else{
                $this->_redirect('*/*/all');
            }
        }
    }

    /**
     * Export order grid to CSV format
     */
    // public function exportCsvAction()
    // {
    //     $fileName   = 'cso_paymentconfirmation_'.date('YmdHis').'.csv';
    //     $grid       = $this->getLayout()->createBlock('paymentconfirmation/adminhtml_csoconfirmation_grid');
    //     $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    // }

    /**
     *  Export order grid to Excel XML format
     */
    // public function exportExcelAction()
    // {
    //     $fileName   = 'cso_paymentconfirmation_'.date('YmdHis').'.xml';
    //     $grid       = $this->getLayout()->createBlock('paymentconfirmation/adminhtml_csoconfirmation_grid');
    //     $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    // }

    protected function _isAllowed()
    {
        $action = strtolower($this->getRequest()->getActionName());
        /*switch ($action) {
            case 'index':
            case 'pending':
            case 'all':
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/payment_confirmation/actions/view');
                break;
            case 'edit':
                return (Mage::getSingleton('admin/session')->isAllowed('admin/ksall/payment_confirmation/actions/accept') || Mage::getSingleton('admin/session')->isAllowed('admin/ksall/payment_confirmation/actions/reject'));
                break;
            case 'accept':
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/payment_confirmation/actions/accept');
                break;
            case 'reject':
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/payment_confirmation/actions/reject');
                break;
            default:
                return Mage::getSingleton('admin/session')->isAllowed('admin/ksall/payment_confirmation');
                break;*/
                return true;
        }
    }

}
