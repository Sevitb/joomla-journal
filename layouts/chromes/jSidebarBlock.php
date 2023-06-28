<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

Factory::getApplication()->getDocument()
    ->getWebAssetManager()
    ->registerAndUseStyle('layouts.chromes.jSidebarBlock', 'layouts/chromes/jSidebarBlock.css');

$module = $displayData['module'];

?>
<?php if (!empty($module->content)) : ?>
    <div class="sidebar-block default-block">
        <?php if ($module->showtitle) : ?>
            <header class="sidebar-block__header">
                <h3 class="sidebar-block__title h-3"><?php echo $module->title; ?></h3>
            </header>
            <hr>
        <?php endif; ?>
        <div class="sidebar-block__body sidebar-block__nav-list">
            <?php echo $module->content; ?>
        </div>
    </div>
<?php endif; ?>