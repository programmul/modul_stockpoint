<?php
class Mamoku_Multistockpoint_Block_Adminhtml_Stockpoint_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("multistockpoint_form", array("legend"=>Mage::helper("multistockpoint")->__("Item information")));

				
						$fieldset->addField("code", "text", array(
						"label" => Mage::helper("multistockpoint")->__("code"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "code",
						));

						$fieldset->addField("name", "text", array(
						"label" => Mage::helper("multistockpoint")->__("Stockpoint name"),
						"name" => "name",
						));
					
						$fieldset->addField("address", "text", array(
						"label" => Mage::helper("multistockpoint")->__("address"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "address",
						));
					
						$fieldset->addField("email", "text", array(
						"label" => Mage::helper("multistockpoint")->__("email"),
						"name" => "email",
						));
					
					
						$fieldset->addField("telephone", "text", array(
						"label" => Mage::helper("multistockpoint")->__("telephone"),
						"name" => "telephone",
						));
					
						$fieldset->addField("officer", "text", array(
						"label" => Mage::helper("multistockpoint")->__("officer"),
						"name" => "officer",
						));
						
						$fieldset->addField("handphone", "text", array(
						"label" => Mage::helper("multistockpoint")->__("handphone"),
						"name" => "handphone",
						));

						$fieldset->addField("distribution_center", "text", array(
						"label" => Mage::helper("multistockpoint")->__("distribution center"),
						"name" => "distribution_center",
						));

						$fieldset->addField("branch", "text", array(
						"label" => Mage::helper("multistockpoint")->__("branch"),
						"name" => "branch",
						));

						$fieldset->addField("description", "text", array(
						"label" => Mage::helper("multistockpoint")->__("description"),
						"name" => "description",
						));

						$fieldset->addField("catatan", "textarea", array(
						"label" => Mage::helper("multistockpoint")->__("catatan"),
						"name" => "catatan",
						));

						$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
						$fieldset->addField('last_sync_time', 'date', array(
						  'name'   => 'last_sync_time',
						  'label'  => Mage::helper('multistockpoint')->__('last syncronize'),
						  'title'  => Mage::helper('multistockpoint')->__('last syncronize'),
						  'image'  => $this->getSkinUrl('images/grid-cal.gif'),
						  'input_format' => $dateFormatIso,
						  'format'       => $dateFormatIso,
						  'time' => true
						));

				if (Mage::getSingleton("adminhtml/session")->getStockpointData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getStockpointData());
					Mage::getSingleton("adminhtml/session")->setStockpointData(null);
				} 
				elseif(Mage::registry("stockpoint_data")) {
				    $form->setValues(Mage::registry("stockpoint_data")->getData());
				}
				return parent::_prepareForm();
		}
}
