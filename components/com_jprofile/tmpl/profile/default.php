<?php

use Joomla\CMS\Factory;
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

$modules = ModuleHelper::getModules('sidebar-left');
$attribs['style'] = 'jSidebarBlock';

// User infoinfo
$userFirstname = isset($this->userItem->firstname) ? $this->userItem->firstname : null;
$userSecondname = isset($this->userItem->secondname) ? $this->userItem->secondname : null;
$userThirdname = isset($this->userItem->thirdname) ? $this->userItem->thirdname : null;
$userBriefBio = isset($this->userItem->brief_bio) ? $this->userItem->brief_bio : null;
$userEducation = isset($this->userItem->education) ? $this->userItem->education : null;
$userAffiliation = isset($this->userItem->affiliation) ? $this->userItem->affiliation : null;
$userAwards = isset($this->userItem->awards) ? $this->userItem->awards : null;

$this->userPublicationsCount = 0;

foreach ($this->userPublicationInfo as $articleItem) {
    if ($articleItem->state == 1) {
        $this->userPublicationsCount++;
    }
}

$isGeneralTab = $userBriefBio || $this->userPublicationsCount > 0 || $userAffiliation || $userAffiliation || $userEducation || $userAwards;


// Use custom styles assets
$wa->registerAndUseScript('bootstrap.tab', 'media/vendor/bootstrap/js/tab.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('bootstrap.popover', 'media/vendor/bootstrap/js/popover.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('bootstrap.popper', 'media/vendor/bootstrap/js/popper.js', $options = [], ['type' => 'module']);

$wa->useScript('jquery');


$wa->registerAndUseStyle('template.profile-page', 'media/com_jprofile/css/profile-page.css');

$wa->registerAndUseScript('component.script.tabs', 'media/com_jprofile/js/tabsHandler.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('component.script.pagination', 'media/com_jprofile/js/ajaxPaginationHandler.js', $options = [], ['type' => 'module']);

$wa->addInlineScript('
$(function() {$(`[data-bs-toggle="tooltip"]`).tooltip();})
');


?>
<section class="content-section">
    <div class="container">
        <div class="row ">
            <aside class="content-section__aside-column col-12 col-lg-4">
                <?php echo LayoutHelper::render('journal.jprofile.userCard', $this->userItem) ?>
                <?php foreach ($modules as $module) : ?>
                    <?php echo ModuleHelper::renderModule($module, $attribs); ?>
                <?php endforeach; ?>
            </aside>
            <div class="col-12 col-lg-8">
                <div class="content-section__main-column">
                    <div class="tabs">
                        <div class="tabs__header default-block">
                            <ul class="tabs__list nav nav-tabs" id="userTab" role="tablist">
                                <li class="tabs__item nav-item">
                                    <span class="tabs__icon nav-link"></span>
                                    <span class="tabs__title h-6 nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" role="tab" aria-controls="general" aria-selected="true"><?php echo Text::_('COM_JPROFILE_USER_GENERAL_TAB'); ?></span>
                                </li>
                                <li class="tabs__item nav-item">
                                    <span class="tabs__icon nav-link"></span>
                                    <span class="tabs__title h-6 nav-link" id="network-tab" data-bs-toggle="tab" data-bs-target="#network" role="tab" aria-controls="network" aria-selected="false"><?php echo Text::_('COM_JPROFILE_USER_NETWORK_TAB'); ?></span>
                                </li>
                                <li class="tabs__item nav-item">
                                    <span class="tabs__icon nav-link"></span>
                                    <span class="tabs__title h-6 nav-link" id="publications-tab" data-bs-toggle="tab" data-bs-target="#publications" role="tab" aria-controls="publications" aria-selected="false"><?php echo Text::_('COM_JPROFILE_USER_PUBLICATIONS_TAB'); ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="tabs__body tab-content" id="userTabContent">
                            <div class="tabs__content-item general-tab tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <?php if ($isGeneralTab) : ?>
                                    <?php if ($userBriefBio) : ?>
                                        <div class="general-tab__brief-bio tab-item tabs__tab-item tabs__tab-item_brief-bio">
                                            <div class="tab-item__header">
                                                <h6 class="h-6 tab-item__title"><?php echo Text::_('COM_JPROFILE_BRIEF_BIO'); ?></h6>
                                            </div>
                                            <div class="tab-item__body">
                                                <p class="p tab-item__text">
                                                    <?php echo $userBriefBio; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php echo $this->loadTemplate('publications-tab'); ?>
                                    <?php if ($userAffiliation) : ?>
                                        <div class="general-tab__affiliation tab-item tabs__tab-item tabs__tab-item_affiliation">
                                            <div class="tab-item__header">
                                                <h6 class="h-6 tab-item__title"><?php echo Text::_('COM_JPROFILE_AFFILIATION'); ?></h6>
                                            </div>
                                            <div class="tab-item__body">
                                                <p class="p tab-item__text">
                                                    <?php echo $userAffiliation ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($userEducation) : ?>
                                        <div class="general-tab__education tab-item tabs__tab-item tabs__tab-item_education">
                                            <div class="tab-item__header">
                                                <h6 class="h-6 tab-item__title"><?php echo Text::_('COM_JPROFILE_EDUCATION'); ?></h6>
                                            </div>
                                            <div class="tab-item__body">
                                                <p class="p tab-item__text">
                                                    <?php echo $userEducation ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($userAwards) : ?>
                                        <div class="general-tab__awards tab-item tabs__tab-item tabs__tab-item_awards">
                                            <div class="tab-item__header">
                                                <h6 class="h-6 tab-item__title"><?php echo Text::_('COM_JPROFILE_AWARDS'); ?></h6>
                                            </div>
                                            <div class="tab-item__body">
                                                <p class="p tab-item__text">
                                                    <?php echo $userAwards; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="tab-item tabs__tab-item tabs__tab-item_brief-bio">
                                        <div class="tab-item__body">
                                            <?php echo LayoutHelper::render("journal.components.empty"); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="tabs__content-item network-tab tab-pane fade" id="network" role="tabpanel" aria-labelledby="network-tab">
                                <?php echo $this->loadTemplate('network-tab'); ?>
                            </div>
                            <div class="tabs__content-item publications-tab tab-pane fade" id="publications" role="tabpanel" aria-labelledby="publications-tab">
                                <?php if ($this->userPublicationsCount > 0) : ?>
                                    <?php echo $this->loadTemplate('publications-tab'); ?>
                                <?php else : ?>
                                    <div class="tab-item tabs__tab-item tabs__tab-item_publications">
                                        <div class="tab-item__body">
                                            <?php echo LayoutHelper::render("journal.components.empty"); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>