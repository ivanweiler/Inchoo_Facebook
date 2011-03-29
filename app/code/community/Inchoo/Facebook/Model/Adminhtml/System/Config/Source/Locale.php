<?php
class Inchoo_Facebook_Model_Adminhtml_System_Config_Source_Locale
{
    public function toOptionArray()
    {
        return Mage::getModel('facebook/locale')->getOptionLocales();
    }

}