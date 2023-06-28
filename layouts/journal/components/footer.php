<?php

use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

$document = new HtmlDocument();

$jcontacts = ModuleHelper::getModule('mod_jcontacts');

?>
<footer class="footer">
    <div class="container">
        <div class="footer__top">
            <div class="footer__column footer__column_1">
                <div class="footer__links">
                    <div class="footer__column-top">
                        <svg onclick="window.location = '/'" class="svg-logo footer__svg-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480.7 400.77">
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="Layer_1-2" data-name="Layer 1">
                                    <path d="M1232.4,210.27c0-57,.66-113.09-.91-169.12-.18-6.42-12.8-17.31-19.73-17.37S1197.45,34.29,1191,40.9c-4.89,5-8.65,11.13-12.91,16.75-3-7.19-8.91-14.5-8.6-21.54.92-21,18.18-35.3,40.58-36.08s40.79,11.47,43.3,32.91c3,25.65,3.05,51.69,3.45,77.57.52,33.18.13,66.36.13,105.12,20.68-8.47,38-13.1,52.5-22.25,12-7.62,20.28-9.54,33.48-2.46,45.86,24.57,92.19,22.25,137.76-3.76,1.88,84.37-79.1,200.72-211.34,212.56C1125.27,412.61,1020,304.65,1010.5,198.11c27.68,4.33,56.29,13.16,84.4,11.81,22.49-1.08,44.3-20.45,66.56-20.76,20.87-.29,41.91,13.87,63,21.38C1226.89,211.41,1230,210.39,1232.4,210.27Z" />
                                    <path d="M340.23,341.64H248V205.39L.11,342.36c0-32.47-.48-60.86.54-89.2.14-4.16,6.75-9.25,11.49-11.89Q172.08,152.11,332.35,63.5c1.82-1,4-1.31,7.88-2.52Z" />
                                    <path d="M578.63,342.67c0-32.84-.81-58.66.54-84.38.36-6.79,5.89-15.15,11.56-19.55Q703,151.57,816.07,65.54c4.49-3.43,10.27-7.19,15.51-7.28,36.73-.63,73.47-.34,111.86,3.91l-178.82,138,184,142c-44.39,0-82.39.43-120.36-.47-5.64-.14-11.42-6.22-16.64-10.19-35.91-27.35-71.69-54.86-109.22-83.62Z" />
                                    <path d="M536.12,171V59.57h94.73c0,36.67.29,74.06-.42,111.43-.08,3.93-5.47,8.46-9.34,11.5-26.23,20.52-52.71,40.72-74.73,57.66-12.13-4.25-20.21-9.4-28.37-9.55-43.55-.81-87.11-.38-131.89-.38V171Z" />
                                    <path d="M.93,204.88V59.69H95.28c0,28,.42,56-.4,83.86-.14,4.71-4.51,11.11-8.76,13.6C59.33,172.82,32,187.61.93,204.88Z" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="footer__column-bottom">
                        <a href="https://t.me/iscvolga" target="_blank"><img src="/media/templates/site/journal/images/social_media/telegram.svg" alt="telegram"></a>
                        <a href="https://rutube.ru/channel/25880533/" target="_blank"><img src="/media/templates/site/journal/images/social_media/rutube.svg" alt="rutube"></a>
                        <a href="https://yandex.ru/q/profile/6zj7514hhwt9n03v6yyn2gdc4w/?utm_medium=share&utm_campaign=user" target="_blank"><img src="/media/templates/site/journal/images/social_media/yandexQ.svg" alt="yandex"></a>
                    </div>
                </div>
            </div>
            <div class="footer__column footer__column_2">
                <div class="footer__info">
                    <?php if ($document->countModules('footer-contacts-info-module')) : ?>
                        <jdoc:include type="modules" name="footer-contacts-info-module" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer__column footer__column_3">
                <jdoc:include type="modules" name="footerMenu" />
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__column footer__column_1">
                <p>© <?php echo date("Y"); ?> АНО «ИНК». Все права защищены.</p>
                <p>ОГРН 1163443071230</p>
            </div>
            <div class="footer__column footer__column_2"></div>
            <div class="footer__column footer__column_3"></div>
        </div>
    </div>
</footer>