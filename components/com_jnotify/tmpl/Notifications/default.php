<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Layout\LayoutHelper;

defined('_JEXEC') or die;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();

$wa = $this->document->getWebAssetManager();

// Detecting Active Variables
$option    = $app->input->getCmd('option', '');
$view      = $app->input->getCmd('view', '');
$layout    = $app->input->getCmd('layout', '');
$task      = $app->input->getCmd('task', '');
$itemid    = $app->input->getCmd('Itemid', '');
$sitename  = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu      = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Message info

$wa->useScript('core');

$wa->registerAndUseStyle('template.notifications-page', 'media/com_jnotify/css/notifications-page.css');

?>
<section class="content-section">
    <div class="container">
        <div class="content-section__main-column default-block">
            <div class="content-section__header">
                <h2 class="content-section__title h-2"> <?php echo Text::_('COM_JNOTIFY_NOTIFICATION_LABEL'); ?> (<?php echo count($this->items)?>) </h2>
            </div>
            <hr>
            <?php if (empty($this->items)) : ?>
                <?php echo LayoutHelper::render("journal.components.empty"); ?>
            <?php else : ?>
                <form action="<?php echo Route::_('index.php?option=com_jnotify&view=Notifications'); ?>" method="post" id="adminForm" class="content-section__body">
                    <?php foreach ($this->items as $item) : ?>
                        <div class="notification-card" data-notification-id="<?php echo $item->id; ?>">
                            <?php if ($item->state == 0) : ?>
                                <div class="notification-card__state-indicator"></div>
                            <?php endif; ?>
                            <div class="notification-card__info-container" onclick="window.location.href='<?php echo Route::_('index.php?option=com_jnotify&view=Notification&id=' . $item->id) ?>'">
                                <h4 class="notification-card__subject h-4">
                                    <?php if ($item->type == 1) : ?>
                                        <?php echo $item->custom_subject; ?>
                                    <?php else : ?>
                                        <?php echo Text::_($item->subject_constant); ?>
                                    <?php endif; ?>
                                </h4>
                                <time class="datetime"><?php echo date_format(date_create($item->date_time), "d.m.y | H:m"); ?></time>
                            </div>
                            <div class="notification-card__control-buttons">
                                <button class="button-delete btn btn-danger" type="button" data-notification-id="<?php echo $item->id; ?>">
                                    <span class="icon-delete" aria-hidden="true"></span>
                                    <?php echo Text::_('COM_JNOTIFY_DELETE'); ?>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php echo $this->pagination->getListFooter(); ?>
                    <input type="hidden" name="task" value="">
                    <input type="hidden" name="id" value="">
                    <script>
                        document.querySelectorAll('.button-delete').forEach((button) => {
                            button.onclick = (event) => {
                                document.querySelector('input[name=id]').value = event.target.dataset.notificationId;
                                Joomla.submitbutton('Notification.delete')
                            }
                        });
                    </script>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>