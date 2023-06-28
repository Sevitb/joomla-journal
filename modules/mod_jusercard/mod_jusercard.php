<?php

// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\JuserCard\Site\Helper\JuserCardHelper;

$helper = new JuserCardHelper();

$userItem = $helper->getItem(586);


require ModuleHelper::getLayoutPath('mod_jusercard', $params->get('layout', 'default'));