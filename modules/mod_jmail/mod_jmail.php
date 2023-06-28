<?php


// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\Jmail\Site\Helper\JmailHelper;

$helper = new JmailHelper();

require ModuleHelper::getLayoutPath('mod_jmail', $params->get('layout', 'default'));