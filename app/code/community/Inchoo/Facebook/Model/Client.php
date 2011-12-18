<?php
/**
 * Facebook Graph/Rest client
 *
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_Model_Client
{
	const FACEBOOK_REST_URI = 'https://api.facebook.com/restserver.php';
	const FACEBOOK_REST_READ_ONLY_URI = 'https://api-read.facebook.com/restserver.php';
	const FACEBOOK_GRAPH_URI = 'https://graph.facebook.com';

	protected $_apiKey;
	protected $_secret;
	protected $_session;
	
	protected $_accessToken;

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
    
    public function setAccessToken($accessToken)
	{
		$this->_accessToken = $accessToken;
		return $this;
	}
	
	public function call(/* polymorphic */)
	{
		$args = func_get_args();
		if (is_array($args[0]) || substr($args[0],0,1)!='/' ) {
			return call_user_func_array(array($this, 'rest'), $args);
		} else {
			return call_user_func_array(array($this, 'graph'), $args);
		}
	}
	
	public function graph($path, $params=array())
	{
		if ($path[0] != '/') {
			$path = '/'.$path;
		}
		$url = self::FACEBOOK_GRAPH_URI.$path;

		$params['method'] = 'GET'; //??
		
		$result = $this->_oauthRequest($url, $params);

		if(is_array($result) && isset($result['error'])) {
			throw new Mage_Core_Exception($result['error']['message'], 0);
		}
		
		return $result;
	}
	
	public function rest(/* polymorphic */)
	{
		$args = func_get_args();
		if (is_array($args[0])) {
			$params = $args[0];
		} else {
			$params = isset($args[1]) ? $args[1] : array(); 
			$params['method'] = $args[0];
		}
		
		$defaultParams = array(
			'api_key' => $this->_apiKey,
			'format'  => 'json-strings',
		);
		
		$params = array_merge($defaultParams, $params);
		
		if($this->_isReadOnlyMethod($params['method'])) {
			$url = self::FACEBOOK_REST_READ_ONLY_URI;
		} else {
			$url = self::FACEBOOK_REST_URI;
		}
		
	    $result = $this->_oauthRequest($url, $params);
	    
		if(is_array($result) && isset($result['error_code'])) {
			throw new Mage_Core_Exception($result['error_msg'], $result['error_code']);
		}
		
	    return $result;
	}
	
	public function restBatch($batch_queue)
	{
		$method_feed = array();
		
		foreach($batch_queue as $call)
		{
			$p = $this->_prepareParams($call);
			$method_feed[] = http_build_query($p,'','&');
		}
		
		$params = array(
			'method_feed' => json_encode($method_feed),
			'serial_only' => true
		);
		
		return $this->rest('batch.run', $params);
	}
	
	protected function _getAccessToken()
	{
		if($this->_accessToken) {
			return $this->_accessToken;
		}
		
		try {
			$accessTokenResponse = self::_getHttpClient()
				->setUri(self::FACEBOOK_GRAPH_URI.'/oauth/access_token')
				->setMethod(Zend_Http_Client::POST)
				->resetParameters()
				->setParameterPost($this->_prepareParams(array(
					'client_id'		=>	$this->_apiKey,
					'client_secret'	=>	$this->_secret,
					'redirect_uri'	=>	'',
					'code'			=>	$this->_session->getCode(),
				)))
				->request()
				->getBody();
				
		    $responseParams = array();
    		parse_str($accessTokenResponse, $responseParams);
    		if (isset($responseParams['access_token'])) {
      			$this->_accessToken = $responseParams['access_token'];
    		}				
		} catch(Exception $e) {}
		
		if(!$this->_accessToken) {
			$this->_accessToken = $this->_apiKey .'|'. $this->_secret;
		}
		
		return $this->_accessToken;
	}
	
	protected function _prepareParams($params)
	{
	    foreach ($params as $key => &$val) {
      		if (!is_array($val)) continue;
        	$val = Zend_Json::encode($val);
    	}
    	
		return $params;
	}
	
	protected function _oauthRequest($url, $params)
	{
		
		if (!isset($params['access_token'])) {
			$params['access_token'] = $this->_getAccessToken();
		}
				
		$params = $this->_prepareParams($params);
		
		$client = self::_getHttpClient()
				->setUri($url)
				->setMethod(Zend_Http_Client::POST)
				->resetParameters()
				->setParameterPost($params);

		try {
			$response = $client->request();
		} catch(Exception $e) {
			throw new Mage_Core_Exception('Service temporarily unavailable.');
		}
		
		$result = Zend_Json::decode($response->getBody());
		
		return $result;			
	}
	
	private static function _getHttpClient()
    {
        if (!self::$_httpClient instanceof Varien_Http_Client) {
            self::$_httpClient = new Varien_Http_Client();
        }

        return self::$_httpClient;
    }
    
    private function _isReadOnlyMethod($method)
    {
		return in_array(strtolower($method), array(
			'admin.getallocation',
            'admin.getappproperties',
            'admin.getbannedusers',
            'admin.getlivestreamvialink',
            'admin.getmetrics',
            'admin.getrestrictioninfo',
            'application.getpublicinfo',
            'auth.getapppublickey',
            'auth.getsession',
            'auth.getsignedpublicsessiondata',
            'comments.get',
            'connect.getunconnectedfriendscount',
            'dashboard.getactivity',
            'dashboard.getcount',
            'dashboard.getglobalnews',
            'dashboard.getnews',
            'dashboard.multigetcount',
            'dashboard.multigetnews',
            'data.getcookies',
            'events.get',
            'events.getmembers',
            'fbml.getcustomtags',
            'feed.getappfriendstories',
            'feed.getregisteredtemplatebundlebyid',
            'feed.getregisteredtemplatebundles',
            'fql.multiquery',
            'fql.query',
            'friends.arefriends',
            'friends.get',
            'friends.getappusers',
            'friends.getlists',
            'friends.getmutualfriends',
            'gifts.get',
            'groups.get',
            'groups.getmembers',
            'intl.gettranslations',
            'links.get',
            'notes.get',
            'notifications.get',
            'pages.getinfo',
            'pages.isadmin',
            'pages.isappadded',
            'pages.isfan',
            'permissions.checkavailableapiaccess',
            'permissions.checkgrantedapiaccess',
            'photos.get',
            'photos.getalbums',
            'photos.gettags',
            'profile.getinfo',
            'profile.getinfooptions',
            'stream.get',
            'stream.getcomments',
            'stream.getfilters',
            'users.getinfo',
            'users.getloggedinuser',
            'users.getstandardinfo',
            'users.hasapppermission',
            'users.isappuser',
            'users.isverified',
            'video.getuploadlimits'
		));    	
    }

}