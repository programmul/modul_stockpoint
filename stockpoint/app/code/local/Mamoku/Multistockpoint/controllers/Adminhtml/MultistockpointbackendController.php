<?php
class Mamoku_Multistockpoint_Adminhtml_MultistockpointbackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Multi Stock Point"));
	   $this->renderLayout();
    }
}