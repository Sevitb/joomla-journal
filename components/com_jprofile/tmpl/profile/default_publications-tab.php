<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Layout\LayoutHelper;

defined('_JEXEC') or die;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();
$session = Factory::getSession();

$wa = $this->document->getWebAssetManager();


?>
<div class="general-tab__publications tab-item tabs__tab-item tabs__tab-item_publications">
    <div class="tab-item__header">
        <h6 class="h-6 tab-item__title"><?php echo Text::_('COM_JPROFILE_PUBLICATIONS_COUNT') . " " . $this->userPublicationsCount; ?></h6>
    </div>
    <div class="tab-item__body">
        <ul class="tab-item__list">
            <?php foreach ($this->userPublicationInfo as &$articleItem) : ?>
                <?php if ($articleItem->state != 1 && $session->get('current_user_id') != $app->input->getInt('profile_id')) : ?>
                    <?php continue; ?>
                <?php else : ?>
                    <li class="tab-item__list-item">
                        <?php
                        $this->articleItem = &$articleItem;
                        echo $this->loadTemplate('article-card'); ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>