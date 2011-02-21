<?php
class Inchoo_Facebook_Block_Template extends Mage_Core_Block_Template
{
	
	public function isSecure()
	{
		return Mage::app()->getStore()->isCurrentlySecure();
	}
	
	public function getApiKey()
	{
		return Mage::getSingleton('facebook/config')->getApiKey();
	}
	
	public function getConnectUrl()
	{
		return $this->getUrl('facebook/customer_account/connect');
	}
	
	public function getRequiredPermissions()
	{
		return json_encode('email');
	}
	
}