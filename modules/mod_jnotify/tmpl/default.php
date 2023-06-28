<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

use function PHPSTORM_META\type;

// No direct access to this file
defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseStyle('jnotify.template', 'media/mod_jnotify/css/template.css');
// $wa->registerAndUseScript('jnotify.script.template', 'media/mod_jnotify/js/notificationBarHandler.js', [], ['type' => 'module']);

?>
<div class="notification-bar">
    <?php if (count($items)) : ?>
        <div class="notification-bar__count">
            <span><?php echo count($items) ?></span>
        </div>
    <?php endif; ?>
    <svg class="notification-bar__icon" width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg" data-bs-toggle="dropdown" aria-expanded="false">
        <path d="M12.5243 2.73152C13.0542 2.73152 13.5731 2.77986 14.0765 2.87189V1.71642C14.0765 1.62884 14.0401 1.54954 13.9818 1.49122L13.9837 1.48931C13.9253 1.43185 13.845 1.39623 13.7565 1.39623H11.2914C11.2039 1.39623 11.1246 1.4327 11.0662 1.49101C11.0079 1.54933 10.9714 1.62864 10.9714 1.71621V2.87168C11.4757 2.77965 11.9948 2.73131 12.5237 2.73131L12.5243 2.73152ZM15.4729 3.24956C16.6814 3.6883 17.7667 4.38956 18.6594 5.28251C20.2335 6.85658 21.2102 9.02823 21.2102 11.4179V19.4343L24.7642 22.0508C24.9502 22.1867 25.0488 22.3983 25.0488 22.6117H25.0507V24.5725C25.0507 24.9582 24.7379 25.2702 24.353 25.2702H16.4333V25.8675C16.4333 26.9429 15.9937 27.9204 15.286 28.6282C14.5784 29.3359 13.6006 29.7755 12.5253 29.7755C11.45 29.7755 10.4725 29.3359 9.76464 28.6282C9.05703 27.9206 8.61742 26.9428 8.61742 25.8675V25.2702H0.69768C0.311953 25.2702 0 24.9574 0 24.5725V22.6117C0 22.3635 0.129564 22.1466 0.324656 22.0225L3.84134 19.4342V11.4178C3.84134 9.02839 4.81805 6.85674 6.39212 5.28246C7.28506 4.38951 8.37034 3.68906 9.57863 3.24951V1.7155C9.57863 1.24305 9.77097 0.813439 10.082 0.503413C10.3931 0.192329 10.8217 0 11.2941 0H13.7593C14.2298 0 14.6575 0.192334 14.9686 0.503413L14.9705 0.504261L14.9724 0.503413C15.2835 0.813433 15.4758 1.24306 15.4758 1.7155V3.24951L15.4729 3.24956ZM15.0369 25.27H10.0117V25.8674C10.0117 26.5578 10.2943 27.1853 10.7504 27.6412C11.2064 28.0971 11.8338 28.38 12.5243 28.38C13.2147 28.38 13.843 28.0973 14.2981 27.6412C14.754 27.1853 15.0369 26.5578 15.0369 25.8674V25.27ZM17.6717 6.26839C16.3501 4.94686 14.528 4.12709 12.5243 4.12709C10.5206 4.12709 8.69757 4.94795 7.37691 6.26839C6.05538 7.58992 5.23452 9.41295 5.23452 11.4166V19.7842H5.23262C5.23262 19.9986 5.13422 20.2092 4.94804 20.346L1.39401 22.9625V23.8746H23.6544V22.9625L20.1377 20.3742C19.9435 20.2501 19.8139 20.033 19.8139 19.785V11.4174C19.8139 9.41376 18.9931 7.59074 17.6715 6.26921L17.6717 6.26839Z" fill="#333333"></path>
    </svg>
    <div class="notification-bar__modal dropdown-menu">
        <div class="notification-bar__modal-header">
            <h5 class="notification-bar__modal-title"> <a href="<?php echo Route::_("index.php?option=com_jnotify&view=Notifications"); ?>">Уведомления</a></h5>
        </div>
        <hr class="dropdown-divider">
        <div class="notification-bar__modal-body">
            <ul class="notification-bar__notification-list">
                <?php if (count($items)) : ?>
                    <?php for ($index = 0; $index <= 2; $index++) : ?>
                        <?php if (array_key_exists($index, $items)) : ?>
                            <li class="notification-bar__notification dropdown-item" data-notification-id="<?php echo $items[$index]->id; ?>" title="Перейти к оповещению">

                                <a class="p" href="<?php echo Route::_('index.php?option=com_jnotify&view=Notification&id=' . $items[$index]->id); ?>">
                                    <?php if ($items[$index]->type == 1) : ?>
                                        <?php echo $items[$index]->custom_subject; ?>
                                    <?php else : ?>
                                        <?php echo Text::_((string) $items[$index]->subject_constant); ?>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php else : ?>
                    <li class="notification-bar__notification">
                        Пока нет оповещений
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>