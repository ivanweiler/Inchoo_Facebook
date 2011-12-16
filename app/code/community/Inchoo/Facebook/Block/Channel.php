<?php
/**
 * Facebook channel block
 * 
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Facebook_Block_Channel extends Inchoo_Facebook_Block_Template
{
    protected function _toHtml()
    {
		return '<script src="'.($this->isSecure() ? 'https://' : 'http://').'connect.facebook.net/'.($this->getData('locale') ?  $this->getData('locale') : $this->getLocale()).'/all.js"></script>';
    }
}