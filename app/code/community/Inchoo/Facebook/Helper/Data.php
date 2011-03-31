<?php
/**
 * Data helper
 *
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler <ivan.weiler@gmail.com>
 */
class Inchoo_Facebook_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	public function getConnectUrl()
	{
		return $this->_getUrl('facebook/customer_account/connect', array('_secure'=>true));
	}
	
	public function isFacebookCustomer($customer)
	{
		if($customer->getFacebookUid()) {
			return true;
		}
		return false;
	}

}