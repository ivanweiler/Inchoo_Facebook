<?php
/**
 * Facebook channel block
 * 
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler <ivan.weiler@gmail.com>
 */
class Inchoo_Facebook_Block_Channel extends Inchoo_Facebook_Block_Template
{

    protected function _toHtml()
    {
		return '<script src="'.($this->isSecure() ? 'https://' : 'http://').'connect.facebook.net/'.($this->getData('locale') ?  $this->getData('locale') : $this->getLocale()).'/all.js"></script>';
    }

}