<?php
/**
 * Facebook REST client
 *
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler, Inchoo <web@inchoo.net>
 * @copyright  Copyright (c) 2010 Inchoo d.o.o. (http://inchoo.net)
 * @license    http://opensource.org/licenses/gpl-license.php  GNU General Public License (GPL)
 */

class Inchoo_Facebook_Model_Client
{
	const FACEBOOK_REST_URI = 'http://api.facebook.com/restserver.php';
	
	protected $_apiKey;
	protected $_secret;
	protected $_sessionKey;
	
	protected $_methodType;
	protected static $_httpClient;
	
	protected $_validPermissions = array('email', 'read_stream', 'publish_stream', 'offline_access', 'status_update', 'photo_upload', 'create_event', 'rsvp_event', 'sms', 'video_upload', 'create_note', 'share_item'); 
	
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
    	$this->_sessionKey  = isset($args[2]) ? $args[2] : null;
	}

	public function setSessionKey($sessionKey)
    {
    	$this->_sessionKey  = $sessionKey;
    }
    
    public function getValidPermissions()
    {
    	return $this->_validPermissions;
    }
    
	private static function _getHttpClient()
    {
        if (!self::$_httpClient instanceof Zend_Http_Client) {
            self::$_httpClient = new Zend_Http_Client();
        }

        return self::$_httpClient;
    }
	
	private function _generateSig($params_array)
	{
		$str = '';
    	ksort($params_array);
    	foreach ($params_array as $k=>$v) {
      		$str .= "$k=$v";
    	}
    	$str .= $this->_secret;
    	return md5($str);
	}
	
	private function _prepareParams($method, $params)
	{

		$defaultParams = array(
			'api_key' => $this->_apiKey,
			'call_id' => microtime(true),
			'format'  => 'JSON',
			'v'       => '1.0'
		);
		
		if($this->_sessionKey){
			$defaultParams['session_key'] = $this->_sessionKey;
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
		$params['sig'] = $this->_generateSig($params);
		
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
			throw new Mage_Core_Exception('Service unavaliable');
		}
		
		if(!$response->isSuccessful()) {
			throw new Mage_Core_Exception('Service unavaliable');
		}
		
		$result = Zend_Json::decode($response->getBody());

		//json decode returns float on long uid number? is_json check? old php?
		if(is_float($result)){
			$result = $response->getBody();
		}

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
	
	
	private function __get($var)
	{
		$this->_methodType = strtolower($var);
		return $this;
	}
	
	private function __call($method,$args)
	{
		if(empty($this->_methodType)) {
			throw new Mage_Core_Exception('Invalid method "'.$method.'"');
		}

		return $this->call($this->_methodType.'.'.$method, isset($args[0]) ? $args[0] : array());
	}


}