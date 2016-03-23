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
class Mamoku_PaymentConfirmation_IndexController extends Mage_Core_Controller_Front_Action
{

    
    public function saveAction()
    {
        $_helper = Mage::helper('paymentconfirmation/data');
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $customerId = Mage::getSingleton('customer/session')->get();
        $nowDate = date('Y-m-d H:i:s');

        if ($arrData = $this->getRequest()->getPost()):

            $data = array(
                'order_id'=>$arrData['order_id'],
                'customer_id'=>$customerId,
                'transfer_date'=>$nowDate,
                'transfer_from'=>$arrData['transfer_from'],
                'transfer_to'=>$arrData['transfer_to'],
                'transfer_amount'=>$arrData['transfer_amount'],
                'bank_account_name'=>$arrData['bank_account_name'],
                'notes'=>$arrData['notes'],
                'confirmation_type'=>0,
                'created_at'=>$nowDate
            );
            $arrData['transfer_from'];

            $dataemail = array(
                'order_id'=>$arrData['order_id'],
                'customer_id'=>$customerId,
                'transfer_date'=>$nowDate,
                'transfer_from'=>$arrData['transfer_from'],
                'transfer_to'=>$arrData['transferaccount'],
                'transfer_amount'=>$arrData['transfer_amount'],
                'bank_account_name'=>$arrData['bank_account_name'],
                'notes'=>$arrData['notes'],
                'confirmation_type'=>0,
                'created_at'=>$nowDate
            );



            $model = Mage::getModel('paymentconfirmation/confirmation')->setData($data);
            try {
                $collection = Mage::getModel('paymentconfirmation/confirmation')->getCollection()->addFieldToFilter('order_id', $arrData['order_id'])->getFirstItem();
                if($collection->getId()){
                    Mage::getSingleton('core/session')->addError($this->__('Your order confirmation is already in process'));
                    $this->_redirectReferer();
                }else{
                   $customer = Mage::getSingleton('customer/session')->getCustomer();
                    // This is the template name from your etc/config.xml
                    $template_id = 'notifikasibuatadmin';
                    
                    $email_to = 'sales@mamoku.com';
                    // Load our template by template_id
                    $email_template  = Mage::getModel('core/email_template')->loadDefault($template_id);
                    // Here is where we can define custom variables to go in our email template!
                    $email_template_variables = array(
                        'created' => $dataemail['created_at'],
                        'orderID' => $dataemail['order_id'],
                        'transferTo' => $dataemail['transfer_to'],
                        'transferAmount' => $dataemail['transfer_amount'],
                        'transferFrom' => $dataemail['transfer_from'],
                        'notes' => $dataemail['notes'],
                        'customerID' => $dataemail['customer_id']
                    );
                    $customer_name = ucwords(strtolower($customer->getFirstname().' '.$customer->getLastname()));
                    // I'm using the Store Name as sender name here.
                    $sender_name = Mage::getStoreConfig(Mage_Core_Model_Store::XML_PATH_STORE_STORE_NAME);
                    // I'm using the general store contact here as the sender email.
                    $sender_email = Mage::getStoreConfig('trans_email/ident_general/email');
                    $email_template->setSenderName($sender_name);
                    $email_template->setSenderEmail($sender_email);
                    //$email_template->setSubject($subject);

                    //Send the email!
                    $email_template->send($email_to, $customer_name, $email_template_variables);
                    $insertId = $model->save()->getId();

                    //echo "Data successfully inserted. Insert ID: ".$insertId;
                    Mage::getSingleton('core/session')->addSuccess($this->__('Thank you for sending a payment confirmation for this order'));
                    $this->_redirectReferer();
                }

            } catch (Exception $e){
                echo $e->getMessage();
            }
        endif;
    }


    public function _saveAction()
    {
        $_helper = Mage::helper('paymentconfirmation/data');
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $customerId = Mage::getSingleton('customer/session')->getId();
        $currentGroupID = Mage::getSingleton('customer/session')->getCustomerGroupId();
        $CSOGroupId = $_helper->getCSOGroupID();
        if($currentGroupID == $CSOGroupId){
            $enabledFeature = $_helper->isPaymentConfirmationCSOEnable();
        }
        else{
            $enabledFeature = $_helper->isPaymentConfirmationOtherEnable();
        }

        if($enabledFeature){
            if ($arrData = $this->getRequest()->getPost()) 
            {
                $isError = true;
                // Check is order state = new
                $order = Mage::getModel('sales/order')->load($arrData['oid']);
                if($order->getState() == 'new'){
                    // Check if payment confirmation with status = 0 already exist
                    $_model = Mage::getModel('paymentconfirmation/confirmation');
                    $exist = $_model->getCollection()->loadByOrder($arrData['order_id'])->getLastItem();
                    if(! ($exist->getId() && ($exist->getStatus() == 0 || $exist->getStatus() == 1))) {
                        $orderCustomerId = $order->getCustomerId();
                        if((int) $customerId == (int)$orderCustomerId){
                            $orderedAmount = $order->getGrandTotal();
                            if((int)$arrData['transfer_amount'] >= (int)$orderedAmount){
                                if($currentGroupID == $CSOGroupId){
                                    if(empty($arrData['transfer_date']) || 
                                       empty($arrData['shop_code']) || 
                                       empty($arrData['receipt_no']) || 
                                       empty($arrData['cashier_name']) || 
                                       empty($arrData['transfer_amount'])){

                                        Mage::getSingleton('core/session')->addError($this->__('Please fill the required fields in payment confirmation form'));

                                    }
                                    else{
                                        $arrData['confirmation_type'] = (int)$CSOGroupId;
                                        $arrData['buyer_email'] = strtolower($arrData['buyer_email']);
                                        $arrData['transfer_method'] = $order->getPayment()->getMethod();
                                        $arrData['transfer_to'] = $order->getPayment()->getMethod();
                                        $isError = false;
                                    }
                                }
                                else{

                                    if(empty($arrData['transfer_date']) || 
                                       empty($arrData['transfer_from']) || 
                                       empty($arrData['transfer_to']) || 
                                       empty($arrData['bank_account_name']) || 
                                       empty($arrData['transfer_method']) || 
                                       empty($arrData['transfer_amount'])){

                                        Mage::getSingleton('core/session')->addError($this->__('Please fill the required fields in payment confirmation form'));

                                    }
                                    else{
                                        $arrData['confirmation_type'] = 0;
                                        $isError = false;
                                    }
                                }
                            }
                            else{
                                Mage::getSingleton('core/session')->addError($this->__('Your transfer amount is less than the order amount'));
                            }
                        }
                        else{
                            Mage::getSingleton('core/session')->addError($this->__('Order not found'));
                        }
                    }
                    else{
                        Mage::getSingleton('core/session')->addSuccess($this->__('Thank you for sending a payment confirmation for this order'));
                    }    

                }
                
                if(! $isError){
                    $nowDate = date('Y-m-d H:i:s');
                    $info = array('created_via' => 'confirmation');
                    $arrData['group_member'] = (int)$currentGroupID;
                    $arrData['customer_name'] = ucwords(strtolower($customer->getFirstname().' '.$customer->getLastname()));
                    $arrData['customer_email'] = strtolower($customer->getEmail());
                    $arrData['created_at'] = $nowDate;
                    $arrData['confirmation_status'] = 0;
                    $arrData['info'] = serialize($info);
                    $_model->setData($arrData);

                    try 
                    {
                        $_model->save();
                        Mage::getSingleton('core/session')->addSuccess($this->__('Your payment confirmation has been sent successfully'));

                    } 
                    catch (Exception $e) 
                    {
                        Mage::getSingleton('core/session')->addError($e->getMessage());
                    }
                }

                // $this->_redirect('sales/order/history');
                $this->_redirectReferer();
                return;

            }
            Mage::getSingleton('core/session')->addError($this->__('Unable to find the confirmation data'));
            // $this->_redirect('sales/order/history');
            $this->_redirectReferer();
        }
        else{
            $this->_redirect('/');
        }
    }
}
