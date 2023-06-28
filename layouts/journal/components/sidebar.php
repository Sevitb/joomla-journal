<?php

use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

$document = new HtmlDocument();

$modules = ModuleHelper::getModules('sidebar-right');
$attribs['style'] = 'jSidebarBlock'; 

?>
<aside class="content-section__aside-column col-12 col-lg-4">
    <?php foreach ($modules as $module) : ?>
        <?php echo ModuleHelper::renderModule($module,$attribs); ?>
    <?php endforeach; ?>
</aside>