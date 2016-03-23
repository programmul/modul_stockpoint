<?php
class Mamoku_Multistockpoint_Model_Eav_Entity_Attribute_Source_Customeroptionsimostatus extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
  protected $_options = null;

    public function getAllOptions($withEmpty = false){
        if (is_null($this->_options)){
            $this->_options = array();

            $this->_options[] = array('label'=> 'Option 1', 'value'=>1);
            $this->_options[] = array('label'=> 'Option 2', 'value'=>3);
            $this->_options[] = array('label'=> 'Option 3', 'value'=>3);
        }
        $options = $this->_options;
        if ($withEmpty) {
            array_unshift($options, array('value'=>'', 'label'=>''));
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
