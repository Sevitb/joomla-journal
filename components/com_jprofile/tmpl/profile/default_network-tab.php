<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Layout\LayoutHelper;
use jprofile\Library\UserHelper;

defined('_JEXEC') or die;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();

$wa = $this->document->getWebAssetManager();


?>
<div class="tab-item tabs__tab-item">
    <ul class="tabs__list nav nav-tabs" id="networkTab" role="tablist">
        <li class="tabs__item nav-item">
            <span class="tabs__icon nav-link"></span>
            <span class="tabs__title h-6 nav-link active" id="subscribers-tab" data-bs-toggle="tab" data-bs-target="#subscribers" role="tab" aria-controls="subscribers" aria-selected="true"><?php echo Text::_('COM_JPROFILE_NETWORK_SUBSCRIBERS_TAB') . ' (' . $this->subscribersCount . ')' ?></span>
        </li>
        <li class="tabs__item nav-item">
            <span class="tabs__icon nav-link"></span>
            <span class="tabs__title h-6 nav-link" id="subscribtions-tab" data-bs-toggle="tab" data-bs-target="#subscribtions" role="tab" aria-controls="subscribtions" aria-selected="false"><?php echo Text::_('COM_JPROFILE_NETWORK_SUBSCRIBTIONS_TAB') . ' (' . $this->subscriptionsCount . ')'; ?></span>
        </li>
    </ul>
    <div class="tab-content" id="networkTabContent">
        <div class="subscribers tab-pane fade show active" id="subscribers" role="tabpanel" aria-labelledby="subscribers-tab">
            <?php if (!count($this->subscribers)) : ?>
                <?php echo LayoutHelper::render("journal.components.empty"); ?>
            <?php else : ?>
                <ul class="tab-item__list" data-list="subscribers">
                    <?php foreach ($this->subscribers as &$subscriber) : ?>
                        <li class="tab-item__list-item">
                            <?php
                            $this->item = &$subscriber;
                            echo $this->loadTemplate('subscriber-card'); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php echo $this->subscribersPagination->getListFooter(); ?>
            <?php endif; ?>
        </div>
        <div class="subscribtions tab-pane fade" id="subscribtions" role="tabpanel" aria-labelledby="subscribtions-tab">
            <?php if (!count($this->subscriptions)) : ?>
                <?php echo LayoutHelper::render("journal.components.empty"); ?>
            <?php else : ?>
                <ul class="tab-item__list" data-list="subscribtions">
                    <?php foreach ($this->subscriptions as &$subscribtion) : ?>
                        <li class="tab-item__list-item">
                            <?php
                            $this->item = &$subscribtion;
                            echo $this->loadTemplate('subscriber-card'); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php echo $this->subscriptionsPagination->getListFooter(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>