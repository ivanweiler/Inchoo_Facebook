<?php
/**
 * Facebook session model
 * 
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_Model_Session extends Varien_Object
{
	private $_client;
	private $_payload;
	private $_signature;

	public function __construct()
	{
		if($this->getCookie()) {
			list($encodedSignature, $payload) = explode('.', $this->getCookie(), 2);
			
    		//decode data
			$signature = base64_decode(strtr($encodedSignature, '-_', '+/'));
    		$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
    		
    		$this->setData($data);
    		
    		//compatibility hack
    		$this->setUid((string)$this->getUserId());
    		
    		$this->_signature = $signature;
    		$this->_payload = $payload;
		}
	}
	
	public function isConnected()
    {
		return $this->validate();
    }

    public function validate()
    {
    	if(!$this->hasData()) {
    		return false;
    	}
    	
		$expectedSignature = hash_hmac('sha256', $this->_payload, Mage::getSingleton('inchoo_facebook/config')->getSecret(), true);
		return ($expectedSignature==$this->_signature);
    }
     
    public function getCookie()
    {
    	return Mage::app()->getRequest()->getCookie('fbsr_'.Mage::getSingleton('inchoo_facebook/config')->getApiKey(), false);
    }
	     
	public function getClient()
	{
		if(is_null($this->_client)) {
			$this->_client = Mage::getModel('inchoo_facebook/client',array(
									Mage::getSingleton('inchoo_facebook/config')->getApiKey(),
									Mage::getSingleton('inchoo_facebook/config')->getSecret(),
									$this
							));
		}
		return $this->_client;
	}
	
}