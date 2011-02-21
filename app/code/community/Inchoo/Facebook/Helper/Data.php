<?php
/**
 * Data helper
 *
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler, Inchoo <web@inchoo.net>
 * @copyright  Copyright (c) 2010 Inchoo d.o.o. (http://inchoo.net)
 * @license    http://opensource.org/licenses/gpl-license.php  GNU General Public License (GPL)
 */
class Inchoo_Facebook_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	public function getConnectUrl()
	{
		return $this->_getUrl('facebook/customer_account/connect');
	}
	
	public function isFacebookCustomer($customer)
	{
		if($customer->getFacebookUid()) {
			return true;
		}
		return false;
	}

}