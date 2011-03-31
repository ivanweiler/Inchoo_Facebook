<?php
/**
 * Facebook session model
 * 
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler <ivan.weiler@gmail.com>
 */
class Inchoo_Facebook_Model_Session extends Varien_Object
{
	private $_client;

	public function __construct()
	{
		if($this->getCookie()){
			$data = array();
			parse_str(trim($this->getCookie(),'"'), $data);
			$this->setData($data);
		}
	}
	
	public function isConnected()
    {
    	if(!$this->validate()) {
    		return false;
    	}
		return true;
    }

    public function validate()
    {
		$params = $this->getData();
		unset($params['sig']);
		
		return ($this->getClient()->generateSig($params)==$this->getSig());
    }
     
    public function getCookie()
    {
    	return Mage::app()->getRequest()->getCookie('fbs_'.Mage::getSingleton('facebook/config')->getApiKey(), false);
    }
	     
	public function getClient()
	{
		if(is_null($this->_client)) {
			$this->_client = Mage::getModel('facebook/client',array(
									Mage::getSingleton('facebook/config')->getApiKey(),
									Mage::getSingleton('facebook/config')->getSecret(),
									$this
							));
		}
		return $this->_client;
	}
	
}