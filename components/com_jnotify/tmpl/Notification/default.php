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
$messageId = isset($this->item->id) ? $this->item->id : null;
$messageSubject = isset($this->item->custom_subject) ? $this->item->custom_subject : null;
$messageCustomMessage = isset($this->item->custom_message) ? $this->item->custom_message : null;
$messageSubjectConstant = isset($this->item->subject_constant) ? $this->item->subject_constant : null;
$messageMessageConstant = isset($this->item->message_constant) ? $this->item->message_constant : null;
$messageMaterialId = isset($this->item->material_id) ? $this->item->material_id : null;

$isCustomMessage = $this->item->type == 1 ? true : false;

$wa->registerAndUseStyle('template.notification-page', 'media/com_jnotify/css/notification-page.css');

?>

<section class="content-section">
    <div class="container">
        <div class="content-section__main-column default-block">
            <div class="content-section__header">
                <?php if ($isCustomMessage) : ?>
                    <h2 class="content-section__title h-2"> <?php echo $messageSubject; ?> </h2>
                <?php else : ?>
                    <h2 class="content-section__title h-2"> <?php echo Text::_($messageSubjectConstant); ?> </h2>
                <?php endif; ?>
                <time class="datetime"><?php echo date_format(date_create($this->item->date_time), "d.m.y | H:m"); ?></time>
            </div>
            <hr>
            <div class="content-section__body">

                <?php if ($isCustomMessage) : ?>
                    <p class="content-section__message p">
                        <?php echo $messageCustomMessage ?>
                    </p>
                <?php else : ?>
                    <p class="content-section__message p">
                        <?php echo Text::_($messageMessageConstant); ?>
                    </p>
                    <?php if ($messageCustomMessage) : ?>
                        <p class="content-section__message p">
                            <?php echo $messageCustomMessage; ?>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($messageMaterialId != 0) : ?>
                    <button class="btn"><?php echo Text::_('COM_JNOTIFY_GO_TO_ARTICLE'); ?></button>
                <?php endif; ?>
                <div class="content-section__control-buttons">
                    <form action="index.php?option=com_jnotify&view=Notifications" method="post" id="adminForm" class="content-section__body">
                        <button class="button-delete btn btn-danger" type="button" data-notification-id="<?php echo $this->item->id; ?>">
                            <span class="icon-delete" aria-hidden="true"></span>
                            <?php echo Text::_('COM_JNOTIFY_DELETE'); ?>
                        </button>
                        <input type="hidden" name="task" value="">
                        <input type="hidden" name="id" value="">
                        <script>
                            document.querySelector('.button-delete').onclick = (event) => {
                                document.querySelector('input[name=id]').value = event.target.dataset.notificationId;
                                Joomla.submitbutton('Notification.delete')
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>