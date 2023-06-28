<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

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

// Use custom styles assets
$wa->registerAndUseScript('bootstrap.tab', 'media/vendor/bootstrap/js/tab.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('bootstrap.popover', 'media/vendor/bootstrap/js/popover.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('bootstrap.popper', 'media/vendor/bootstrap/js/popper.js', $options = [], ['type' => 'module']);

$wa->useScript('keepalive')
    ->useScript('form.validate');

$wa->useScript('jquery');

$wa->addInlineScript('$(function() {$(`[data-bs-toggle="tooltip"]`).tooltip();})');

$wa->registerAndUseStyle('template.profile-page', 'media/com_jprofile/css/profileedit-page.css');
$wa->registerAndUseStyle('template.jusercard', 'media/layouts/css/journal/jprofile/jusercard/jusercard.css');
$wa->registerAndUseScript('script.formHandler', 'media/com_jprofile/js/formHandler.js')


?>
<section class="content-section">
    <div class="container">
        <form action="<?php echo Route::_('index.php?option=com_jprofile&view=profileedit&layout=edit&profile_id=' . $this->form->getValue('id')); ?>" enctype="multipart/form-data" method="POST" name="adminForm" id="adminForm" class="form-validate form-vertical">
            <div class="row ">
                <div class="tabs col-12 col-lg-3">
                    <div class="tabs__header tabs__header_v default-block">
                        <ul class="tabs__list tabs__list_v nav nav-tabs" id="userSettingsTab" role="tablist">
                            <li class="tabs__item nav-item">
                                <span class="tabs__icon nav-link"></span>
                                <span class="tabs__title tabs__title_v h-6 nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" role="tab" aria-controls="general" aria-selected="true"><?php echo Text::_('COM_JPROFILE_USER_GENERAL_TAB'); ?></span>
                            </li>
                            <li class="tabs__item nav-item">
                                <span class="tabs__icon nav-link"></span>
                                <span class="tabs__title tabs__title_v h-6 nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" role="tab" aria-controls="details" aria-selected="false"><?php echo Text::_('COM_JPROFILE_USER_DETAILS_TAB'); ?></span>
                            </li>
                            <li class="tabs__item nav-item">
                                <span class="tabs__icon nav-link"></span>
                                <span class="tabs__title tabs__title_v h-6 nav-link" id="author-info-tab" data-bs-toggle="tab" data-bs-target="#author-info" role="tab" aria-controls="author-info" aria-selected="false"><?php echo Text::_('COM_JPROFILE_USER_AUTHOR_INFO_TAB'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tabs__body tab-content content-section__main-column col-12 col-lg-9" id="userSettingstabContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general" tabindex="0">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('avatar_image'); ?>
                                <?php echo $this->form->renderField('username'); ?>
                                <a class="btn btn-white control-group" href="<?php echo Route::_('index.php?option=com_jprofile&view=reset'); ?>">
                                    <?php echo Text::_('COM_JPROFILE_CHANGE_PASSWORD') ?>
                                </a>
                                <div class="row">
                                    <div class="col-6">
                                        <?php echo $this->form->renderField('email'); ?>
                                    </div>
                                    <div class="col-6">
                                        <?php echo $this->form->renderField('show_email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('secondname'); ?>
                                <?php echo $this->form->renderField('firstname'); ?>
                                <?php echo $this->form->renderField('thirdname'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details" tabindex="0">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('country'); ?>
                                <?php echo $this->form->renderField('region'); ?>
                                <?php echo $this->form->renderField('city'); ?>
                            </div>
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('brief_bio'); ?>
                                <?php echo $this->form->renderField('awards'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="author-info" role="tabpanel" aria-labelledby="author-info" tabindex="0">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('post'); ?>
                                <?php echo $this->form->renderField('academic_degree'); ?>
                                <?php echo $this->form->renderField('academic_title'); ?>
                            </div>
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('organization'); ?>
                                <?php echo $this->form->renderField('division'); ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="tabs__control-btns ">
                        <button type="button" class="btn" onclick="Joomla.submitbutton('profileedit.save')">Сохранить</button>
                        <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $this->item->id); ?>" class="btn btn-danger">Отмена</a>
                    </div>
                </div>
                <?php echo $this->form->renderField('id'); ?>
                <?php echo $this->form->renderField('name'); ?>
                <input type="hidden" name="task" />
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </form>
    </div>
</section>