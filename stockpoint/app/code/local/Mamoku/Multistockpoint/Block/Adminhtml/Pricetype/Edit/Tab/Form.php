<?php
class Mamoku_Multistockpoint_Block_Adminhtml_Pricetype_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("multistockpoint_form", array("legend"=>Mage::helper("multistockpoint")->__("Item information")));

				
						
					
						$fieldset->addField("typename", "text", array(
						"label" => Mage::helper("multistockpoint")->__("type name"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "typename",
						));
					
						$fieldset->addField("minqty", "text", array(
						"label" => Mage::helper("multistockpoint")->__("minqty"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "minqty",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getPricetypeData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getPricetypeData());
					Mage::getSingleton("adminhtml/session")->setPricetypeData(null);
				} 
				elseif(Mage::registry("pricetype_data")) {
				    $form->setValues(Mage::registry("pricetype_data")->getData());
				}
				return parent::_prepareForm();
		}
}
