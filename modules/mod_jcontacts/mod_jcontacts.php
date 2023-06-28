<?php

// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\Jcontacts\Site\Helper\JcontactsHelper;

$item = JcontactsHelper::getItem();

require ModuleHelper::getLayoutPath('mod_jcontacts', $params->get('layout', 'default'));