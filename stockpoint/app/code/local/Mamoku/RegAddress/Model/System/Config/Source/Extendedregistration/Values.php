<?php
/**
 * Values for the module configuration (dropdown field)
 * 
 * @author     Design:Slider GbR <magento@design-slider.de>
 * @copyright  (C)Design:Slider GbR <www.design-slider.de>
 * @license    OSL <http://opensource.org/licenses/osl-3.0.php>
 * @link       http://www.design-slider.de/magento_onlineshop/magento-extensions/registration-address/
 * @package    mamoku__RegAddress
 */
class Mamoku_RegAddress_Model_System_Config_Source_Extendedregistration_Values
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'no',
                'label' => Mage::helper('mamoku_regaddress')->__('No'),
            ),
            array(
                'value' => 'optional_address',
                'label' => Mage::helper('mamoku_regaddress')->__('Optional Address (default)'),
            ),
            array(
                'value' => 'forced_address',
                'label' => Mage::helper('mamoku_regaddress')->__('Forced Address'),
            ),
        );
    }
}