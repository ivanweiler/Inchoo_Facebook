<?php
/**
 * Facebook config model
 *
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler, Inchoo <web@inchoo.net>
 */
class Inchoo_Facebook_Model_Config
{
	const XML_PATH_API_KEY = 'customer/facebook/api_key';
	const XML_PATH_SECRET = 'customer/facebook/secret';
	
    public function isEnabled($storeId=null)
    {
        if(!$this->getApiKey($storeId) || !$this->getSecret($storeId)) {
        	return false;
        }
        
        return true;
    }
	
    public function getApiKey($storeId=null)
    {
    	return trim(Mage::getStoreConfig(self::XML_PATH_API_KEY, $storeId));
    }
    
    public function getSecret($storeId=null)
    {
    	return trim(Mage::getStoreConfig(self::XML_PATH_SECRET, $storeId));
    }
    
    public function getRequiredPermissions()
    {
    	return array('email');
    }

}
