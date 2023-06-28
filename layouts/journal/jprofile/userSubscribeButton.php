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
$session = Factory::getSession();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseScript('layout.script.subscribeButton', 'media/layouts/js/journal/jprofile/subscribeBtn.js', $options = [], ['type' => 'module']);

// User info
$userId = isset($displayData) ? $displayData : null;
$size = isset($this->options['size']) ? $this->options['size'] : 'default';
$isSubscribed = UserHelper::isSubscribed($userId, $session->get('current_user_id'));

?>
<button class="btn" data-object-id="<?php echo $userId ?>" onclick="subscribe(this, <?php echo $session->get('current_user_id') ?>,<?php echo $isSubscribed ?>)">
    <?php if (!$isSubscribed) : ?>
        Подписаться
    <?php else : ?>
        Отписаться
    <?php endif; ?>
</button>