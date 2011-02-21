<?php

$installer = $this;
/* @var $installer Mage_Customer_Model_Entity_Setup */

$installer->startSetup();

$installer->addAttribute('customer', 'facebook_uid', array(
        'type'	 => 'varchar',
        'label'		=> 'Facebook Uid',
        'visible'   => false,
		'required'	=> false
));

$installer->endSetup();
