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

// Issue info
$issueNumber   = isset($this->issueItem->number) ? $this->issueItem->number : null;
$issueYear     = isset($this->issueItem->publish_up) ? date("Y", strtotime($this->issueItem->publish_up)) : null;
$issueFile     = isset($this->issueItem->file) ? $this->issueItem->file : null;
$issueType     = isset($this->issueItem->type) ? $this->issueItem->type : null;
$issueTitle    = isset($this->issueItem->title) ? $this->issueItem->title : null;


// Use custom styles assets
$wa->registerAndUseStyle('template.series-page', 'media/com_jcontent/css/series-page.css');
?>
<section class="content-section">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-lg-8">
                <div class="content-section__main-column default-block">
                    <div id="bcrumbs">
                        <?php echo ModuleHelper::renderModule('breadcrumbs'); ?>
                        <jdoc:include type="modules" name="breadcrumbs" />
                    </div>
                    <hr>
                    <div class="content-section__header">
                        <?php if ($issueTitle) : ?>
                            <h2 class="content-section__title h-2"> <?php echo $issueTitle ?></h2>
                            <?php if ($issueNumber) : ?>
                                <div class="content-section__issue-info-container">
                                    <span class="content-section__issue-number"><?php echo "№" . $issueNumber ?></span> | <span class="content-section__issue-year"><?php echo $issueYear ?></span>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <h2 class="content-section__title h-2"> <span class="content-section__issue-number"><?php echo "№" . $issueNumber ?></span> | <span class="content-section__issue-year"><?php echo $issueYear ?></span></h2>
                        <?php endif; ?>
                        <div class="content-section__tools">
                            <?php if ($issueFile) : ?>
                                <div class="content-section__download-issue">
                                    <a class="btn content-section__download-issue-btn" href="" download=""> <span class="icon-download"></span> Скачать выпуск <i class=""></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <?php if ($this->issueItem) : ?>
                        <div class="content-section__articles-list">
                            <!-- Sections -->
                            <?php if ($this->sectionsItems) : ?>
                                <?php foreach ($this->sectionsItems as &$sectionItem) : ?>
                                    <?php
                                    $this->sectionItem = &$sectionItem;
                                    echo $this->loadTemplate('section'); ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php if ($this->articlesItems) : ?>
                                    <?php foreach ($this->articlesItems as &$articleItem) : ?>
                                        <?php
                                        $this->articleItem = &$articleItem;
                                        echo $this->loadTemplate('article'); ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <?php
                        echo $this->loadTemplate('empty-list'); ?>
                    <?php endif; ?>
                    <hr>
                    <div class="content_section__extra-info">
                        <p class="p">
                            Дополнительная информация
                        </p>
                    </div>
                </div>
            </div>
            <?php echo LayoutHelper::render('journal.components.sidebar')?>
        </div>
    </div>
</section>