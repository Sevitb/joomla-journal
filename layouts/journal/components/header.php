<?php

use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\User\UserFactoryInterface;

defined('_JEXEC') or die;

$document = new HtmlDocument();

/** @var Joomla\CMS\Document\HtmlDocument */
$app = Factory::getApplication();
$wa  = $app->getDocument()->getWebAssetManager();

$user       = $displayData;
$userStatus = $user->guest;

$wa->registerAndUseScript('stickyHeader', 'media/layouts/js/journal/header/stickyHeader.js');

?>
<header class="header" id="header">
    <div class="container header__container">
        <div class="header__row">
            <div class="header__logo">
                <svg onclick="window.location = '/'" class="svg-logo header__svg-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480.7 400.77">
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

            <!-- Main navbar -->
            <?php if ($document->countModules('main-navbar')) : ?>
                <div class="mobile-menu-icon header__mobile-menu-icon">
                    <div class="mobile-menu-icon__icon-left"></div>
                    <div class="mobile-menu-icon__icon-right"></div>
                    <span></span>
                </div>
                <nav class="header__nav jnav jnav_horizontal">
                    <jdoc:include type="modules" name="main-navbar" />
                </nav>
            <?php endif; ?>

            <div class="header__tools">

                <!-- Languages switcher -->
                <!-- !!placeholder!! -->
                <div class="header__languages">
                    RU | EN
                </div>
                <!-- !!placeholder!! -->
                <?php if ($document->countModules('languages')) : ?>
                    <div class="header__languages">
                        <jdoc:include type="modules" name="languages" />
                    </div>
                <?php endif; ?>

                <!-- Notifications -->
                <?php if ($document->countModules('notifications')) : ?>
                    <div class="header__notifications">
                        <jdoc:include type="modules" name="notifications" />
                    </div>
                <?php endif; ?>

                <div class="header__personal-aria">

                    <?php if ($userStatus === 0) : ?>
                        <!-- Authorized -->
                        <!-- Personal aria menu -->
                        <?php echo LayoutHelper::render('journal.jprofile.userMenu', $user->id) ?>
                        <?php //if ($document->countModules('profile-navbar')) : 
                        ?>
                        <!-- <div class="header__personal-aria-menu">
                                <jdoc:include type="modules" name="profile-navbar" />
                            </div> -->
                        <?php //endif; 
                        ?>
                    <?php else : ?>
                        <!-- Not authorized -->
                        <div class="header__personal-aria-icon" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <svg class="svg-user" title="" width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.6133 15.683C21.2058 14.2639 22.9681 11.5097 22.9681 8.352C22.9681 3.74665 19.2216 0 14.6161 0C10.0107 0 6.26412 3.74653 6.26412 8.352C6.26412 11.5096 8.02643 14.2638 10.619 15.683C4.41053 16.8244 0 20.4573 0 23.664V28.5359C0 29.6874 0.936741 30.624 2.08812 30.624H27.1441C28.2957 30.624 29.2322 29.6875 29.2322 28.5359V23.664C29.232 20.4573 24.8215 16.8246 18.6133 15.683ZM7.65625 8.352C7.65625 4.51418 10.7784 1.392 14.6162 1.392C18.4536 1.392 21.5762 4.51418 21.5762 8.352C21.5762 12.1898 18.4536 15.312 14.6162 15.312C10.7784 15.312 7.65625 12.1898 7.65625 8.352ZM27.8402 28.536C27.8402 28.9203 27.5288 29.2319 27.1443 29.2319H2.08831C1.70404 29.2319 1.39237 28.92 1.39237 28.536V23.6641C1.39237 20.8624 6.94564 16.7041 14.6164 16.7041C22.2873 16.7041 27.8404 20.8624 27.8404 23.6641L27.8402 28.536Z" fill="#333333" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($userStatus === 0) : ?>
            <div class="header__subrow">
                <a class="btn d-block mx-auto my-1" style="width: max-content;" href="<?php echo Route::_('/index.php/for-authors/send-an-article?view=send&layout=edit') ?>">Отправить статью</a>
            </div>
        <?php endif; ?>
    </div>
</header>