<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

/** @var \Joomla\Component\Users\Site\View\Login\HtmlView $this */

$cookieLogin = $this->user->get('cookieLogin');

if (!empty($cookieLogin) || $this->user->get('guest')) {
    // The user is not logged in or needs to provide a password.
    echo $this->loadTemplate('login');
} else {
    $app = Factory::getApplication();
    $session = Factory::getSession();
    $app->redirect(Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $session->get('current_user_id')));
}
