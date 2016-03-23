<?php

class Mamoku_Multistockpoint_Block_Adminhtml_Locationcoverage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("locationcoverageGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("multistockpoint/locationcoverage")->getCollection();
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
                
				$this->addColumn("stockpoint_code", array(
				"header" => Mage::helper("multistockpoint")->__("location code"),
				"index" => "stockpoint_code",
				));
				$this->addColumn("propinsi", array(
				"header" => Mage::helper("multistockpoint")->__("propinsi"),
				"index" => "propinsi",
				));
				$this->addColumn("kota", array(
				"header" => Mage::helper("multistockpoint")->__("kota"),
				"index" => "kota",
				));
				$this->addColumn("kecamatan", array(
				"header" => Mage::helper("multistockpoint")->__("kecamatan"),
				"index" => "kecamatan",
				));
				$this->addColumn("kelurahan", array(
				"header" => Mage::helper("multistockpoint")->__("kelurahan"),
				"index" => "kelurahan",
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
			$this->getMassactionBlock()->addItem('remove_locationcoverage', array(
					 'label'=> Mage::helper('multistockpoint')->__('Remove Locationcoverage'),
					 'url'  => $this->getUrl('*/adminhtml_locationcoverage/massRemove'),
					 'confirm' => Mage::helper('multistockpoint')->__('Are you sure?')
				));
			return $this;
		}
			

}