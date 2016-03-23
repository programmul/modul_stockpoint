<?php
class Mamoku_Multistockpoint_Model_Mysql4_Stockpoint extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("multistockpoint/stockpoint", "id");
    }
}