<?php

/**
 * @package Joomla.Site
 * @subpackage com_jnotify
 * 
 * @copyright Copyright (C) 2005 - 2020 Open Source Metters, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Kima\Component\jnotify\Site\Service;


use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\Database\DatabaseInterface;

\defined('_JEXEC') or die;

/**
 * Routing class from com_jnotify
 * 
 * @since 1.0.0
 */
class Router extends RouterView
{
    public function __construct(SiteApplication $app, AbstractMenu $menu, CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
	{
        echo 'did it!';
        die();
    }
}
