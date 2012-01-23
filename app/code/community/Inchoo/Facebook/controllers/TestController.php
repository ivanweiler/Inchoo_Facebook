<?php
class Inchoo_Facebook_TestController extends Mage_Core_Controller_Front_Action
{
	
    public function preDispatch()
    {
    	die();
    	$this->setFlag('', self::FLAG_NO_DISPATCH, true);
        parent::preDispatch();
		
        if(!$this->_getSession()->validate()) {
			echo $this->__('Facebook connection failed.');
			die();
    	}
    }
    
	public function graphTest1Action()
	{
		//var_dump($this->_getSession()->getUid());
		
		try {
			$result = $this->_getSession()->getClient()->call('/me');
			var_dump($result);
			
			//$result = $this->_getSession()->getClient()->call('/me/feed');
			//var_dump($result);
			
		} catch(Mage_Core_Exception $e) {
			echo $e->getMessage();
    	}
	} 
	
	private function _getSession()
	{
		return Mage::getSingleton('inchoo_facebook/session');
	}
	
	public function restTest1Action()
	{
		try {		
			$result = $this->_getSession()->getClient()->call('users.getInfo',array(
						'uids' => $this->_getSession()->getUid(), 
						'fields' => 'first_name, last_name, contact_email, sex, birthday_date'
			));
			var_dump($result);
			
		} catch(Mage_Core_Exception $e) {
			echo $e->getMessage();
    	}		
	}
	
	public function restTest2Action()
	{
		try {
			$result = $this->_getSession()->getClient()->call('stream.publish', 
					array(
						'uid' => $this->_getSession()->getUid(), 
						'message' => 'stream.publish API test 7 ..',
						'action_links' => array(
							array('text' => 'Test Link', 'href' => 'http://inchoo.net')
						)));
			var_dump($result);
			
		} catch(Mage_Core_Exception $e) {
			echo $e->getMessage();
    	}		
	}
	
	public function restTest3Action()
	{
		try {
			$result = $this->_getSession()->getClient()->call('users.hasAppPermission', array(
					'ext_perm' => 'email',
					'uid' => $this->_getSession()->getUid()
			));
			var_dump($result);
			
			$result = $this->_getSession()->getClient()->restBatch(array(
					array('method' => 'users.hasAppPermission', 'ext_perm' => 'publish_stream', 'uid' => $this->_getSession()->getUid()),
					array('method' => 'users.hasAppPermission', 'ext_perm' => 'email', 'uid' => $this->_getSession()->getUid()),
			));
			var_dump($result);			
			
		} catch(Mage_Core_Exception $e) {
			echo $e->getMessage();
    	}	
	}

	
	public function localeTestAction()
	{
		var_dump(Mage::getModel('inchoo_facebook/locale')->getOptionLocales());
		//var_dump(Mage::app()->getLocale()->getOptionLocales());
		return;
		
		$client = new Varien_Http_Client();
		$response = $client->setUri('http://www.facebook.com/translations/FacebookLocale.xml')
                //->setConfig(array('timeout' => 5)) //d:10
                ->request('GET')
                ->getBody();
		
		$xml = simplexml_load_string($response, null, LIBXML_NOERROR);
 		if( !$xml ) {
                return null;
        }	

        
        $locales = array();
        foreach($xml->locale as $item) {
        	$locales[(string)$item->codes->code->standard->representation] = (string)$item->englishName;
        }
        
        //var_dump($locales);

        //Mage::app()->saveCache(serialize($locales), 'inchoo_facebook_locale', array(), 7*24*60*60);
        //array(Mage_Core_Model_Config::CACHE_TAG)

        //$locales = unserialize(Mage::app()->loadCache('inchoo_facebook_locale')); //false
         
        var_dump($locales);
		
	}
	
}