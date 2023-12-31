<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Helper\ModuleHelper;

// Create shortcuts to some parameters.
$params  = $this->item->params;
$canEdit = $params->get('access-edit');
$user    = Factory::getUser();
$info    = $params->get('info_block_position', 0);
$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

// Check if associations are implemented. If they are, define the parameter.
$assocParam        = (Associations::isEnabled() && $params->get('show_associations'));
$currentDate       = Factory::getDate()->format('Y-m-d H:i:s');
$isNotPublishedYet = $this->item->publish_up > $currentDate;
$isExpired         = !is_null($this->item->publish_down) && $this->item->publish_down < $currentDate;

$juserlist = ModuleHelper::getModule('mod_juserlist');

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
                    <div class="content-section__header">
                        <?php if ($params->get('show_title')) : ?>
                            <<?php echo $htag; ?> itemprop="headline">
                                <h2 class="content-section__title h-2"><?php echo $this->escape($this->item->title); ?></h2>
                            </<?php echo $htag; ?>>
                            <?php if ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED) : ?>
                                <span class="badge bg-warning text-light"><?php echo Text::_('JUNPUBLISHED'); ?></span>
                            <?php endif; ?>
                            <?php if ($isNotPublishedYet) : ?>
                                <span class="badge bg-warning text-light"><?php echo Text::_('JNOTPUBLISHEDYET'); ?></span>
                            <?php endif; ?>
                            <?php if ($isExpired) : ?>
                                <span class="badge bg-warning text-light"><?php echo Text::_('JEXPIRED'); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($canEdit) : ?>
                            <?php echo LayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item)); ?>
                        <?php endif; ?>
                        <?php if ($this->params->get('show_page_heading')) : ?>
                            <h2 class="content-section__title h-2"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h2>
                        <?php endif;
                        if (!empty($this->item->pagination) && !$this->item->paginationposition && $this->item->paginationrelative) {
                            echo $this->item->pagination;
                        }
                        ?>
                        <?php // Content is generated by content plugin event "onContentAfterTitle" 
                        ?>
                        <?php echo $this->item->event->afterDisplayTitle; ?>
                    </div>
                    <?php echo ModuleHelper::renderModule($juserlist); ?>
                    <hr>
                    <div class="content_section__extra-info">
                        <p class="p">
                            Дополнительная информация
                        </p>
                    </div>
                </div>
            </div>
            <?php echo LayoutHelper::render('journal.components.sidebar') ?>
        </div>
    </div>
</section>