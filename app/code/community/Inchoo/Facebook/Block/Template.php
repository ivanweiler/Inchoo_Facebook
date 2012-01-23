<?php
/**
 * Facebook connect template block
 * 
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_Block_Template extends Mage_Core_Block_Template
{
	
	public function isSecure()
	{
		return Mage::app()->getStore()->isCurrentlySecure();
	}
	
	public function getConnectUrl()
	{
		return $this->getUrl('inchoo_facebook/customer_account/connect', array('_secure'=>true));
	}
	
	public function getChannelUrl()
	{
		return $this->getUrl('inchoo_facebook/channel', array('_secure'=>$this->isSecure(),'locale'=>$this->getLocale()));
	}	
	
	public function getRequiredPermissions()
	{
		return json_encode('email,user_birthday');
	}
	
	public function isEnabled()
	{
		return Mage::getSingleton('inchoo_facebook/config')->isEnabled();
	}
	
	public function getApiKey()
	{
		return Mage::getSingleton('inchoo_facebook/config')->getApiKey();
	}
	
	public function getLocale()
	{
		return Mage::getSingleton('inchoo_facebook/config')->getLocale();
	}
	
    protected function _toHtml()
    {
        if (!$this->isEnabled()) {
            return '';
        }
        return parent::_toHtml();
    }
	
}