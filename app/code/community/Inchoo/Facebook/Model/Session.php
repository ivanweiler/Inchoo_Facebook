<?php
/**
 * Facebook Connect session model
 *
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler, Inchoo <web@inchoo.net>
 * @copyright  Copyright (c) 2010 Inchoo d.o.o. (http://inchoo.net)
 * @license    http://opensource.org/licenses/gpl-license.php  GNU General Public License (GPL)
 */
class Inchoo_Facebook_Model_Session extends Varien_Object
{
	public function __construct()
	{
		$this->setConnected(false);
		
		if($this->getCookie()){
			$data = array();
			parse_str(trim($this->getCookie(),'"'), $data);
			//$this->setData($data); //session_key only?
			if(isset($data['session_key'])){
				$this->setSessionKey($data['session_key']);
				$this->setConnected(true);
			}
		}
	}
	
	public function isConnected($refresh=false)
    {
    	if($refresh) { 
    		$this->checkConnection();
    	}
		return (bool)$this->getConnected();
    }
    
	public function checkConnection()
    {
		//Users.getLoggedInUser, Users.isAppUser
    	try{
    		//$isAppUser = $this->getClient()->users->isAppUser(array('session_key' => $this->getSessionKey()));
    		//if(!$isAppUser) $this->setConnected(false);
    		
    		//prevents UID from being faked && checks session
    		$uid = $this->getClient()->users->getLoggedInUser();
    		$this->setUid($uid);
    		
    	}catch(Mage_Core_Exception $e){
    		$this->setConnected(false);
    	}
    }
	
	public function getPermissions($refresh=false)
	{
		if($this->hasData('permissions') && !$refresh)
		{
			return $this->getData('permissions');
		}
		
		$validPermissions = $this->getClient()->getValidPermissions();
		
		$batchQueue = array();
		foreach($validPermissions as $permission) {
			$batchQueue[] = array('method' => 'users.hasAppPermission', 'ext_perm' => $permission, 'uid' => $this->getUid());
		}
		
		$hasPermissions = $this->getClient()->batch($batchQueue);
		
		$this->setPermissions(array_combine($validPermissions,$hasPermissions));
	}
	
	public function hasPermission($permission,$refresh=false)
	{
		$permissions = $this->getPermissions($refresh);
		return $permissions[$permission];
	} 
	
    public function getCookie()
    {
    	return Mage::app()->getRequest()->getCookie('fbs_'.Mage::getSingleton('facebook/config')->getApiKey(), false);
    }
	
	public function getClient()
	{
		if(!$this->hasData('client')) {
			$this->setClient(
				Mage::getModel('facebook/client',array(
									Mage::getSingleton('facebook/config')->getApiKey(),
									Mage::getSingleton('facebook/config')->getSecret(),
									$this->getSessionKey()
				))
			);
		}
		
		return $this->getData('client');
	}
	
}