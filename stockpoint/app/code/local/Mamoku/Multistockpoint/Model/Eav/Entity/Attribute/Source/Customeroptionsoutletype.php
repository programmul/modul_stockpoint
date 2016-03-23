<?php
class Mamoku_Multistockpoint_Model_Eav_Entity_Attribute_Source_Customeroptionsoutletype extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
  protected $_options = null;

    function getAllOptions($withEmpty = false){
        $attribute = Mage::getModel('eav/config')->getAttribute('customer','outlet_type');
                    $atid = $attribute->getId();
                    $is_visible = $attribute->getIsVisible();
                    $storeId = 0;
                    $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
                    $sql = "select distinct o.*,ov.* from eav_attribute_option o
                            left join eav_attribute_option_value ov 
                            ON o.option_id = ov.option_id
                            where o.attribute_id = ".$atid." 
                            AND ov.store_id = ".$storeId."
                            "; 
            $rows = $connection->fetchAll($sql);
            $options = array();            
                foreach($rows as $row){
                $opt['label'] = $row['value'];
                $opt['value'] = $row['value'];
                $opt['visibility'] = $is_visible;
                $options[] = $opt;
                }                       
            return $options;
    }
    public function getOptionText($value)
    {
        $options = $this->getAllOptions(false);

        foreach ($options as $item) {
            if ($item['value'] == $value) {
                return $item['label'];
            }
        }
        return false;
    }
}
