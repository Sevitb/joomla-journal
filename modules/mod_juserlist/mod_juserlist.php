<?php

// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\JuserList\Site\Helper\JuserListHelper;

$usersItems = JuserListHelper::getItems();

require ModuleHelper::getLayoutPath('mod_juserlist', $params->get('layout', 'default'));