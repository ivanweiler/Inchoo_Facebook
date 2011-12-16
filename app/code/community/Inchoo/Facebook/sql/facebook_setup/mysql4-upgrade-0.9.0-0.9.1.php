<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Facebook
 * @author      Ivan Weiler <ivan.weiler@gmail.com>
 * @copyright   Inchoo (http://inchoo.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
$installer = $this;
/* @var $installer Mage_Customer_Model_Entity_Setup */

$installer->startSetup();

//to help 1.3.x users that tried pre-release version
if (!$this->getAttribute('customer', 'facebook_uid', 'attribute_id')) {
	$installer->addAttribute('customer', 'facebook_uid', array(
	        'type'	 => 'varchar',
	        'label'		=> 'Facebook Uid',
	        'visible'   => false,
			'required'	=> false
	));
}

$installer->endSetup();
