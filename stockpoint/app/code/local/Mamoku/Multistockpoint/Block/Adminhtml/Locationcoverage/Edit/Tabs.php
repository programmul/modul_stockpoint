<?php
class Mamoku_Multistockpoint_Block_Adminhtml_Locationcoverage_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("locationcoverage_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("multistockpoint")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("multistockpoint")->__("Item Information"),
				"title" => Mage::helper("multistockpoint")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("multistockpoint/adminhtml_locationcoverage_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
