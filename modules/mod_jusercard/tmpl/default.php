<?php

use Joomla\CMS\Factory;

// No direct access to this file
defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseScript('bootstrap.popover', 'media/vendor/bootstrap/js/popover.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('bootstrap.popper', 'media/vendor/bootstrap/js/popper.js', $options = [], ['type' => 'module']);

$wa->useScript('jquery');

$wa->addInlineScript('$(function() {$(`[data-bs-toggle="tooltip"]`).tooltip();})');


$wa->registerAndUseStyle('template.jusercard', 'media/mod_jusercard/css/jusercard.css');

print_r($userItem);

?>
<div class="user-card">
    <div class="user-card__row">
        <div class="user-card__avatar">
            <img class="user-card__avatar-image" src="/images/banners/banner.jpg" alt="">
        </div>
        <div class="user-card__info">
            <h4 class="user-card__name h-4">Иванов И. Иван</h4>
            <div class="user-card__group">
                <span class="icon-pencil-alt"></span>
                <span class="user-card__group-name" data-bs-toggle="tooltip" data-bs-placement="right" title="Здесь отображатеся ваша группа.">Автор</span>
            </div>
            <div class="user-card__post">
                <p class="p">
                    Д.э.н., доцент, профессор кафедры менеджмента Владимирского филиала
                </p>
            </div>
            <div class="user-card__city">г. Волгоград</div>
            <!-- <div class="user-card__email">email@mail.ru</div> -->
        </div>
    </div>
</div>