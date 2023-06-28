<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\Module\Latest\Administrator\Helper\LatestHelper;
use jprofile\Library\User;
use jprofile\Library\UserHelper;

// No direct access to this file
defined('_JEXEC') or die;

$userData = UserHelper::getCardData($displayData);

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();


$wa->registerAndUseScript('bootstrap.dropdown', 'media/vendor/bootstrap/js/dropdown.min.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('bootstrap.popper', 'media/vendor/bootstrap/js/popper.js', $options = [], ['type' => 'module']);


$wa->addInlineScript('$(function() {$(`[data-bs-toggle="dropdown"]`).dropdown();})');

?>

<div class="user-menu dropdown">
    <div class="user-menu__avatar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo LayoutHelper::render('journal.jprofile.userAvatar', $userData->avatar_image, null, ['size' => 'small']) ?>
    </div>
    <ul class="user-menu__list dropdown-menu ">
        <li class="user-menu__list-item dropdown-item ">
            <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $displayData) ?>"> <span class="icon-user"></span> Профиль</a>
        </li>
        <li class="user-menu__list-item dropdown-item ">
            <a href="<?php echo Route::_('index.php?option=com_jnotify&view=Notifications') ?>"> <span class="icon-envelope"></span> Уведомления</a>
        </li>
        <li class="user-menu__list-item dropdown-item ">
            <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profileedit&layout=edit&profile_id=' . $displayData) ?>"> <span class="icon-cog"></span> Настройки</a>
        </li>
        <li class="user-menu__list-item dropdown-item ">
            <?php $userToken = Session::getFormToken(); ?>
            <a href="index.php?option=com_users&task=user.logout&<?php echo $userToken ?>=1"> <span class="icon-power-off"></span> Выход</a>
        </li>
    </ul>
</div>