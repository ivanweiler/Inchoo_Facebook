<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_Model_Adminhtml_System_Config_Source_Locale
{
    public function toOptionArray()
    {
        return Mage::getModel('inchoo_facebook/locale')->getOptionLocales();
    }

}