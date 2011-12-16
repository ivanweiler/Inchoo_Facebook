<?php
/**
 * Facebook locale model
 *
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_Model_Locale
{
    public function getLocales()
    {
    	$locales = array();
    	$localesFile = Mage::app()->getConfig()->getModuleDir('etc', 'Inchoo_Facebook').DS.'FacebookLocales.xml';
		
    	$xml = simplexml_load_file($localesFile, null, LIBXML_NOERROR);
		if($xml && is_object($xml->locale)) {
			foreach($xml->locale as $item) {
        		$locales[(string)$item->codes->code->standard->representation] = (string)$item->englishName;
			}
        }   	
    	
        asort($locales);
    	return $locales;
    }
    
	public function getOptionLocales()
    {
    	$locales = array();
    	foreach($this->getLocales() as $value => $label) {
    		$locales[] = array(
				'value' => $value,
				'label' => $label  	
    		);	
    	}
    	return $locales;
    }
    
}