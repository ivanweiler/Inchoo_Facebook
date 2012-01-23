<?php
/**
 * Data helper
 *
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	public function getConnectUrl()
	{
		return $this->_getUrl('inchoo_facebook/customer_account/connect', array('_secure'=>true));
	}
	
	public function isFacebookCustomer($customer)
	{
		if($customer->getFacebookUid()) {
			return true;
		}
		return false;
	}

}