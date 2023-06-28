<?php

// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\Jnotify\Site\Helper\JnotifyHelper;

$items = JnotifyHelper::getItems();

require ModuleHelper::getLayoutPath('mod_jnotify', $params->get('layout', 'default'));