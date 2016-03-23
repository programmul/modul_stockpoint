<?php
$installer = $this;
$installer->startSetup();


$installer->addAttribute("customer", "photo",  array(
    "type"     => "varchar",
    "backend"  => "catalog/category_attribute_backend_image",
    "label"    => "photo",
    "input"    => "image",
    "source"   => "",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

	));

        $attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "photo");


$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="checkout_register";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
		->setData("is_used_for_customer_segment", true)
		->setData("is_system", 0)
		->setData("is_user_defined", 1)
		->setData("is_visible", 1)
		->setData("sort_order", 100)
		;
        $attribute->save();

$installer->addAttribute('catalog_product', 'price_qty', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'price_qty',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false,
  'group'             => 'Design'
));



$installer->addAttribute("customer_address", "kecamatan",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "kecamatan",
    "input"    => "text",

    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

	));


//add stockpointcode attribute, by jef 20160316

$installer->addAttribute("customer_address", "stockpointcode",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "Stockpoint Code",
    "input"    => "text",

    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

    ));

        $attribute   = Mage::getSingleton("eav/config")->getAttribute("customer_address", "stockpointcode");


$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_customer_address";
$used_in_forms[]="customer_account_edit";
$used_in_forms[]="checkout_register";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_register_address";
$used_in_forms[]="customer_address_edit";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 1)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
        ;
        $attribute->save();



//add stockpointid attribute, by jef 20160316

$installer->addAttribute("customer_address", "stockpointid",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "Stockpoint ID",
    "input"    => "text",

    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

    ));

        $attribute   = Mage::getSingleton("eav/config")->getAttribute("customer_address", "stockpointid");


$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_customer_address";
$used_in_forms[]="customer_account_edit";
$used_in_forms[]="checkout_register";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_register_address";
$used_in_forms[]="customer_address_edit";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
        ->setData("is_used_for_customer_segment", true)
        ->setData("is_system", 0)
        ->setData("is_user_defined", 1)
        ->setData("is_visible", 1)
        ->setData("sort_order", 100)
        ;
        $attribute->save();



//end


        $attribute   = Mage::getSingleton("eav/config")->getAttribute("customer_address", "kecamatan");


$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_customer_address";
$used_in_forms[]="customer_account_edit";
$used_in_forms[]="checkout_register";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_register_address";
$used_in_forms[]="customer_address_edit";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
		->setData("is_used_for_customer_segment", true)
		->setData("is_system", 0)
		->setData("is_user_defined", 1)
		->setData("is_visible", 1)
		->setData("sort_order", 100)
		;
        $attribute->save();




$installer->addAttribute("customer_address", "kelurahan",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "kelurahan",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

	));

        $attribute   = Mage::getSingleton("eav/config")->getAttribute("customer_address", "kelurahan");


$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_customer_address";
$used_in_forms[]="customer_account_edit";
$used_in_forms[]="checkout_register";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_register_address";
$used_in_forms[]="customer_address_edit";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
		->setData("is_used_for_customer_segment", true)
		->setData("is_system", 0)
		->setData("is_user_defined", 1)
		->setData("is_visible", 1)
		->setData("sort_order", 100)
		;
        $attribute->save();


$installer->addAttribute("customer", "is_verified",  array(
    "type"     => "int",
    "backend"  => "",
    "label"    => "is_verified",
    "input"    => "select",
    "source"   => "eav/entity_attribute_source_boolean",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

	));

        $attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "is_verified");


$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
		->setData("is_used_for_customer_segment", true)
		->setData("is_system", 0)
		->setData("is_user_defined", 1)
		->setData("is_visible", 1)
		->setData("sort_order", 100)
		;
        $attribute->save();

$installer->addAttribute("customer", "stockpoint_id",  array(
    "type"     => "int",
    "backend"  => "",
    "label"    => "stockpoint_id",
    "input"    => "select",
    "source"   => "multistockpoint/eav_entity_attribute_source_customeroptions14451414802",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "stockpoint_id");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "outlet_type",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "outlet_type",
    "input"    => "select",
    "source"   => "multistockpoint/eav_entity_attribute_source_customeroptionsoutletype",    
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "outlet_type");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();

$installer->addAttribute("customer", "outlet_owner",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "outlet_owner",
    "input"    => "text",
    "source"   => "",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "outlet_owner");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
/*$installer->addAttribute("customer", "outlet_name",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "outlet_name",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "outlet_name");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();*/
$installer->addAttribute("customer", "ktp_number",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "ktp_number",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "ktp_number");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "npwp_type",  array(
    "type"     => "varchar",
    "label"    => "npwp_type",
    "input"    => "select",     
    "source"   => "multistockpoint/eav_entity_attribute_source_customeroptionsnpwp",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "npwp_type");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "npwp_number",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "npwp_number",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "npwp_number");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "npwp_name",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "npwp_name",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "npwp_name");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "npwp_address",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "npwp_address",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "npwp_address");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "mobile_number",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "mobile_number",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "mobile_number");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "email_cc",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "email_cc",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "email_cc");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "latitude",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "latitude",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "latitude");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "longitude",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "longitude",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "longitude");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "note_verification_pull_flag",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "note_verification_pull_flag",
    "input"    => "text",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "note_verification_pull_flag");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "verification_pull_date_time",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "verification_pull_date_time",
    "input"    => "date",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "verification_pull_date_time");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "imo_status",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "imo_status",
    "input"    => "select",
    "source"   => "multistockpoint/eav_entity_attribute_source_customeroptionsimostatus",      
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "imo_status");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute("customer", "imo_update_date_time",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "imo_update_date_time",
    "input"    => "date",    
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

  ));
$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "imo_update_date_time");
$used_in_forms = array();
$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="adminhtml_checkout";
        $attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
    ;
$attribute->save();
$installer->addAttribute('catalog_product', 'type', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Product Type',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));

$installer->addAttribute('catalog_product', 'mark', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Mark',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'highlight', array(
  'type'              => 'text',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Highlight',
  'input'             => 'textarea',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'isi_kemasan', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Isi Kemasam',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'varian', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Varian',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'Rasa', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Rasa',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'model', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Model',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'panjang', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Panjang',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'lebar', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Lebar',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'tinggi', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Tinggi',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'isi', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Isi',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'satuan', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Satuan',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'garansi', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Garansi',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'retur', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Retur',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'catatan', array(
  'type'              => 'text',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'catatan',
  'input'             => 'textarea',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'petunjuk_simpan', array(
  'type'              => 'text',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Petunjuk Penyimpanan',
  'input'             => 'textarea',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'petunjuk_khusus', array(
  'type'              => 'text',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Petunjuk Khusu',
  'input'             => 'textarea',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'bahan_utama', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Bahan Utama',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'masa_pajang', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Masa Pajang',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'kemasan', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Kemasan',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'wujud_isi', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Wujud Isi',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'sertifikasi', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Sertifikasi',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'aditif', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Aditif',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'musim', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Musim',
  'input'             => 'select',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'tujuan_penggunaan', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Tujuan Penggunaan',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'tipe_proses', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Tipe Proses',
  'input'             => 'text',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));
$installer->addAttribute('catalog_product', 'last_synchronize_time', array(
  'type'              => 'varchar',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Last Sinchronize Time',
  'input'             => 'date',
  'class'             => '',
  'source'            => 'catalog/product_attribute_source_layout',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false
));

$installer->endSetup();

