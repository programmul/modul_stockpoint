<?php

class Mamoku_Multistockpoint_Adminhtml_LocationcoverageController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("multistockpoint/locationcoverage")->_addBreadcrumb(Mage::helper("adminhtml")->__("Locationcoverage  Manager"),Mage::helper("adminhtml")->__("Locationcoverage Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Multistockpoint"));
			    $this->_title($this->__("Manager Locationcoverage"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Multistockpoint"));
				$this->_title($this->__("Locationcoverage"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("multistockpoint/locationcoverage")->load($id);
				if ($model->getId()) {
					Mage::register("locationcoverage_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("multistockpoint/locationcoverage");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locationcoverage Manager"), Mage::helper("adminhtml")->__("Locationcoverage Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locationcoverage Description"), Mage::helper("adminhtml")->__("Locationcoverage Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("multistockpoint/adminhtml_locationcoverage_edit"))->_addLeft($this->getLayout()->createBlock("multistockpoint/adminhtml_locationcoverage_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("multistockpoint")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Multistockpoint"));
		$this->_title($this->__("Locationcoverage"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("multistockpoint/locationcoverage")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("locationcoverage_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("multistockpoint/locationcoverage");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locationcoverage Manager"), Mage::helper("adminhtml")->__("Locationcoverage Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locationcoverage Description"), Mage::helper("adminhtml")->__("Locationcoverage Description"));


		$this->_addContent($this->getLayout()->createBlock("multistockpoint/adminhtml_locationcoverage_edit"))->_addLeft($this->getLayout()->createBlock("multistockpoint/adminhtml_locationcoverage_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("multistockpoint/locationcoverage")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Locationcoverage was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setLocationcoverageData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setLocationcoverageData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("multistockpoint/locationcoverage");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("multistockpoint/locationcoverage");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'locationcoverage.csv';
			$grid       = $this->getLayout()->createBlock('multistockpoint/adminhtml_locationcoverage_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'locationcoverage.xml';
			$grid       = $this->getLayout()->createBlock('multistockpoint/adminhtml_locationcoverage_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
