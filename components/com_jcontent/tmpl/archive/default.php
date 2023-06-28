<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
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
$wa->registerAndUseStyle('component.style.archive-page', 'media/com_jcontent/css/archive-page.css');

?>
<section class="content-section">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-lg-8">
                <div class="content-section__main-column default-block">
                    <div id="bcrumbs">
                        <?php echo ModuleHelper::renderModule('breadcrumbs'); ?>
                    </div>
                    <hr>
                    <div class="content-section__header">
                        <h2 class="content-section__title h-2">Архив</h2>
                    </div>
                    <hr>
                    <div class="content-section__sections">
                        <?php if ($this->issuesItems) : ?>
                            <?php foreach ($this->issuesItems as $key => &$issueItem) : ?>
                                <?php $this->issueItem = &$issueItem;
                                $this->issueItemKey = $key;
                                  echo $this->loadTemplate('section');
                                ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php echo LayoutHelper::render('journal.components.sidebar')?>
        </div>
    </div>
</section>