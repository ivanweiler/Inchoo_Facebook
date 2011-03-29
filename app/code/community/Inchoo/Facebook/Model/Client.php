<?php
/**
 * Facebook REST client
 *
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Inchoo <web@inchoo.net>
 */
class Inchoo_Facebook_Model_Client
{
	const FACEBOOK_REST_URI = 'https://api.facebook.com/restserver.php';

	protected $_apiKey;
	protected $_secret;	
	protected $_session;
	
	protected $_methodType;
	protected static $_httpClient; 

	
	public function __construct()
	{
		$args = func_get_args();
		
		if(isset($args[0]) && is_array($args[0])) {
			$args = $args[0];
		}
		
		if(count($args)<2) {
			trigger_error('Missing arguments for Inchoo_Facebook_Model_Client::__construct()',E_USER_ERROR);
		}
		
		$this->_apiKey      = $args[0];
		$this->_secret      = $args[1];
    	
		$session = isset($args[2]) ? $args[2] : null;

		if(is_array($session)) {
			$this->_session  = new Varien_Object($session);
		} elseif($session instanceof Varien_Object) {
			$this->_session = $session;
		} else {
			$this->_session  = new Varien_Object();
		}
	}

	public function setSession($session)
    {
    	$this->_session = $session;
    	return $this;
    }
    
	public function generateSig($params)
	{
		$str = '';
    	ksort($params);
    	foreach ($params as $k=>$v) {
      		$str .= "$k=$v";
    	}
    	$str .= $this->_secret;
    	return md5($str);
	}
	
	private function _prepareParams($method, $params)
	{
		$defaultParams = array(
			'api_key' => $this->_apiKey,
			'format'  => 'json-strings',
		);
		
		//new OAuth thingy
		if (!isset($params['access_token'])) {
			if ($this->_session->hasData('access_token')) {
	        	$params['access_token'] = $this->_session->getData('access_token');
	      	} else {
	      		//??
	        	$params['access_token'] = $this->_apiKey .'|'. $this->_secret;
	      	}
		}
      	
		$params = array_merge($defaultParams, $params);
	    foreach ($params as $key => &$val) {
      		if (!is_array($val)) continue;
        	$val = Zend_Json::encode($val);
    	}
    	
    	$params['method'] = $method;
		
		if(isset($params['sig'])) {
			unset($params['sig']);
		}
		$params['sig'] = $this->generateSig($params);
		
		return $params;
	}
		
	public function call($method, $args=array())
	{
		$params = $this->_prepareParams($method, $args);
		
		$client = self::_getHttpClient()
				->setUri(self::FACEBOOK_REST_URI)
				->setMethod(Zend_Http_Client::POST)
				->resetParameters()
				->setParameterPost($params);	

		try {
			$response = $client->request();
		} catch(Exception $e) {
			throw new Mage_Core_Exception('Service unavaliable'); //$e->getMessage()
		}
		
		if(!$response->isSuccessful()) {
			throw new Mage_Core_Exception('Service unavaliable');
		}
		
		$result = Zend_Json::decode($response->getBody());

		if(is_array($result) && isset($result['error_code'])) {
			throw new Mage_Core_Exception($result['error_msg'], $result['error_code']);
		}
		
		return $result;
	}
	
	public function batch($batch_queue)
	{
		$method_feed = array();
		
		foreach($batch_queue as $call)
		{
			$p = $this->_prepareParams($call['method'], $call);
			$method_feed[] = http_build_query($p,'','&');
		}
		
		$params = array(
			'method_feed' => json_encode($method_feed),
			'serial_only' => true
		);
		
		return $this->call('batch.run', $params);
	}
	
	public function __get($var)
	{
		$this->_methodType = strtolower($var);
		return $this;
	}

	public function __call($method,$args)
	{
		if(empty($this->_methodType)) {
			throw new Mage_Core_Exception('Invalid method "'.$method.'"');
		}

		return $this->call($this->_methodType.'.'.$method, isset($args[0]) ? $args[0] : array());
	}
	
	private static function _getHttpClient()
    {
        if (!self::$_httpClient instanceof Varien_Http_Client) {
            self::$_httpClient = new Varien_Http_Client();
        }

        return self::$_httpClient;
    }

}