<?php

use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

$document = new HtmlDocument();
$module = ModuleHelper::getModule('mod_login');

?>
<div class="system-mesasge">
    <jdoc:include type="message" />
</div>