<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

/** @var \Joomla\Component\Users\Site\View\Login\HtmlView $cookieLogin */

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');

$usersConfig = ComponentHelper::getParams('com_users');
$this->params->set('page_heading', 'Вход');

?>
<section class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="com-users-login login content-section__main-column default-block col-12 col-lg-5 well">
                <svg onclick="window.location = '/'" class="svg-logo modal__svg-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1480.7 400.77">
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
                <?php if ($this->params->get('show_page_heading')) : ?>
                    <h2 class="h-2 text-center"><?php echo Text::_($this->escape($this->params->get('page_heading'))); ?></h2>
                <?php endif; ?>

                <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description', '')) != '') || $this->params->get('login_image') != '') : ?>
                    <div class="com-users-login__description login-description">
                    <?php endif; ?>

                    <?php if ($this->params->get('logindescription_show') == 1) : ?>
                        <?php echo $this->params->get('login_description'); ?>
                    <?php endif; ?>

                    <?php if ($this->params->get('login_image') != '') : ?>
                        <?php echo HTMLHelper::_('image', $this->params->get('login_image'), empty($this->params->get('login_image_alt')) && empty($this->params->get('login_image_alt_empty')) ? false : $this->params->get('login_image_alt'), ['class' => 'com-users-login__image login-image']); ?>
                    <?php endif; ?>

                    <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description', '')) != '') || $this->params->get('login_image') != '') : ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo Route::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="com-users-login__form form-validate form-horizontal well" id="com-users-login__form">

                    <fieldset>
                        <?php echo $this->form->renderFieldset('credentials', ['class' => 'com-users-login__input']); ?>

                        <?php if (PluginHelper::isEnabled('system', 'remember')) : ?>
                            <div class="com-users-login__remember">
                                <div class="form-check">
                                    <input class="form-check-input" id="remember" type="checkbox" name="remember" value="yes">
                                    <label class="form-check-label" for="remember">
                                        <?php echo Text::_('COM_USERS_LOGIN_REMEMBER_ME'); ?>
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php foreach ($this->extraButtons as $button) :
                            $dataAttributeKeys = array_filter(array_keys($button), function ($key) {
                                return substr($key, 0, 5) == 'data-';
                            });
                        ?>
                            <div class="com-users-login__submit control-group">
                                <div class="controls">
                                    <button type="button" class="btn btn-secondary w-100 <?php echo $button['class'] ?? '' ?>" <?php foreach ($dataAttributeKeys as $key) : ?> <?php echo $key ?>="<?php echo $button[$key] ?>" <?php endforeach; ?> <?php if ($button['onclick']) : ?> onclick="<?php echo $button['onclick'] ?>" <?php endif; ?> title="<?php echo Text::_($button['label']) ?>" id="<?php echo $button['id'] ?>">
                                        <?php if (!empty($button['icon'])) : ?>
                                            <span class="<?php echo $button['icon'] ?>"></span>
                                        <?php elseif (!empty($button['image'])) : ?>
                                            <?php echo HTMLHelper::_('image', $button['image'], Text::_($button['tooltip'] ?? ''), [
                                                'class' => 'icon',
                                            ], true) ?>
                                        <?php elseif (!empty($button['svg'])) : ?>
                                            <?php echo $button['svg']; ?>
                                        <?php endif; ?>
                                        <?php echo Text::_($button['label']) ?>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="com-users-login__submit control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo Text::_('JLOGIN'); ?>
                                </button>
                            </div>
                        </div>

                        <?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem', ''))); ?>
                        <input type="hidden" name="return" value="<?php echo base64_encode($return); ?>">
                        <?php echo HTMLHelper::_('form.token'); ?>
                    </fieldset>
                </form>
                <div class="com-users-login__options list-group">
                    <a class="com-users-login__reset list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>">
                        <?php echo Text::_('COM_USERS_LOGIN_RESET'); ?>
                    </a>
                    <a class="com-users-login__remind list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>">
                        <?php echo Text::_('COM_USERS_LOGIN_REMIND'); ?>
                    </a>
                    <?php if ($usersConfig->get('allowUserRegistration')) : ?>
                        <a class="com-users-login__register list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>">
                            <?php echo Text::_('COM_USERS_LOGIN_REGISTER'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>