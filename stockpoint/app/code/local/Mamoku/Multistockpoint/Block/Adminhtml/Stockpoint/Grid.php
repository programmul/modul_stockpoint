<?php

class Mamoku_Multistockpoint_Block_Adminhtml_Stockpoint_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("stockpointGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("multistockpoint/stockpoint")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("multistockpoint")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("code", array(
				"header" => Mage::helper("multistockpoint")->__("code"),
				"index" => "code",
				));
				$this->addColumn("name", array(
				"header" => Mage::helper("multistockpoint")->__("stockpoint name"),
				"index" => "name",
				));
				$this->addColumn("address", array(
				"header" => Mage::helper("multistockpoint")->__("address"),
				"index" => "address",
				));
				$this->addColumn("email", array(
				"header" => Mage::helper("multistockpoint")->__("email"),
				"index" => "email",
				));
				$this->addColumn("telephone", array(
				"header" => Mage::helper("multistockpoint")->__("telephone"),
				"index" => "telephone",
				));
				$this->addColumn("officer", array(
				"header" => Mage::helper("multistockpoint")->__("officer"),
				"index" => "officer",
				));
				$this->addColumn("handphone", array(
				"header" => Mage::helper("multistockpoint")->__("handphone"),
				"index" => "handphone",
				));
				$this->addColumn("distribution_center", array(
				"header" => Mage::helper("multistockpoint")->__("distribution center"),
				"index" => "distribution_center",
				));
				$this->addColumn("branch", array(
				"header" => Mage::helper("multistockpoint")->__("branch"),
				"index" => "branch",
				));
				$this->addColumn("description", array(
				"header" => Mage::helper("multistockpoint")->__("description"),
				"index" => "description",
				));
				$this->addColumn("catatan", array(
				"header" => Mage::helper("multistockpoint")->__("catatan"),
				"index" => "catatan",
				));
				$this->addColumn("last_sync_time", array(
				"header" => Mage::helper("multistockpoint")->__("last syncronize"),
				"index" => "last_sync_time",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_stockpoint', array(
					 'label'=> Mage::helper('multistockpoint')->__('Remove Stockpoint'),
					 'url'  => $this->getUrl('*/adminhtml_stockpoint/massRemove'),
					 'confirm' => Mage::helper('multistockpoint')->__('Are you sure?')
				));
			return $this;
		}
			

}