<?php

use Joomla\CMS\Factory;

// No direct access to this file
defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('template.mod_jcontacts','media/mod_jcontacts/css/template.css');


?>
<div class="contact-info">
    <div class="contact-info__block">
        <h4 class="h-4 contact-info__title"><?php echo $params->get('organization_title'); ?></h4>
        <p class="p"><?php echo $params->get('organization_desc'); ?></p>
    </div>
    <div class="contact-info__block">
        <h4 class="h-4 contact-info__title">Адрес:</h4>
        <p class="p"><?php echo $params->get('adress'); ?></p>
    </div>
    <div class="contact-info__block">
        <h4 class="h-4 contact-info__title">Прямая связь:</h4>
        <p class="p"><a href="mailto: <?php echo $params->get('email'); ?>"><?php echo $params->get('email'); ?></a> <br>
            <a href="tel: <?php echo $params->get('phone'); ?>"><?php echo $params->get('phone'); ?></a></p>
    </div>
    <div class="contact-info__block">
        <h4 class="h-4 contact-info__title">Режим работы:</h4>
        <p class="p"><?php echo $params->get('working_hours'); ?></p>
    </div>
</div>