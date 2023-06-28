<?php

use Joomla\CMS\Factory;

// No direct access to this file
defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseScript('ymap','https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<ваш API-ключ>');
$wa->addInlineScript("ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: {$params->get('coords')},
            zoom: {$params->get('zoom',15)},
            controls: ['smallMapDefaultSet']
        }, {
            searchControlProvider: 'yandex#search'
        }),

        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            `<div style='color: #FFFFFF; font-weight: bold;'>$[properties.iconContent]</div>`
        ),

        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: '{$params->get('hover_text','АНО «ИНК»')}',
            balloonContent: '{$params->get('click_text','400066, г. Волгоград, ул. М.Чуйкова, дом 9, оф.3')}',
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: '/media/mod_jmap/images/ISC.png',
            // Размеры метки.
            iconImageSize: [69, 38],
            // Смещение левого верхнего угла иконки относительно
            iconImageOffset: [-33, -38],
        });

    myMap.geoObjects
        .add(myPlacemark);
});");

?>
<div id="map" style="height:320px;"></div>