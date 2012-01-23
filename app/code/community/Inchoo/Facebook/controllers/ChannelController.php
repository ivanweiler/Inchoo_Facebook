<?php
/**
 * Facebook channel controller
 *
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_ChannelController extends Mage_Core_Controller_Front_Action
{
	
	public function indexAction()
	{
		/**
		 * http://developers.facebook.com/docs/reference/javascript/FB.init/
		 * 
		 * You MUST send valid Expires headers and ensure the channel file is cached by the browser. 
		 * We recommend caching indefinitely.
		 * 
		 */
		
		$expires = 365*24*60*60; //1 year
		$this->getResponse()
				->setHeader('Pragma', '', true)
				->setHeader('Cache-Control', 'maxage='.$expires, true)
				->setHeader('Expires', gmdate('D, d M Y H:i:s', time()+$expires), true)
				->setHeader('Last-Modified', gmdate('D, d M Y H:i:s', time()))
				;
		
		if($this->getRequest()->getHeader('If-Modified-Since')) {
			$this->getResponse()->setHttpResponseCode(304);
		}
		
		$locale = $this->getRequest()->getParam('locale', false);
		if(!$locale) {
			$locale = Mage::getSingleton('inchoo_facebook/config')->getLocale();
		}
		
		$this->getResponse()->setBody(
			$this->getLayout()->createBlock('inchoo_facebook/channel')
			->setLocale($locale)
			->toHtml()
		);
	}
	
}