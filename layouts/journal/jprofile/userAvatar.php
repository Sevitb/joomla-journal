<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use jprofile\Library\User;
use jprofile\Library\UserHelper;

// No direct access to this file
defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseStyle('layout.style.juseravatar', 'media/layouts/css/journal/jprofile/juseravatar/user-avatar.css');


// User info
$userAvatar = isset($displayData) ? $displayData : null;
$size = isset($this->options['size']) ? $this->options['size'] : 'default';

?>
<div class="user-avatar user-avatar_<?php echo $size ?>">
    <?php if ($userAvatar) : ?>
        <img class="user-avatar__image" src="<?php echo $userAvatar; ?>" alt="">
    <?php else : ?>
        <img class="user-avatar__image" src="images/jprofile/avatars/default/banner.jpg" alt="">
    <?php endif; ?>
</div>