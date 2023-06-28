<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');

?>
<section class="content-section">
    <div class="container">
        <div class="content-section__main-column default-block justify-content-center row">
            <form action="<?php echo Route::_('index.php?option=com_jprofile&task=reset.complete'); ?>" method="post" class="com-users-reset-complete__form form-validate col-12 col-lg-9 form-horizontal well">
                <?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
                    <fieldset>
                        <legend><?php echo Text::_($fieldset->label); ?></legend>
                        <p class="p"><?php echo Text::_($fieldset->description); ?></p>
                        <?php echo $this->form->renderFieldset($fieldset->name); ?>
                    </fieldset>
                <?php endforeach; ?>
                <div class="com-users-reset-complete__submit control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary validate">
                            <?php echo Text::_('JSUBMIT'); ?>
                        </button>
                    </div>
                </div>
                <?php echo HTMLHelper::_('form.token'); ?>
            </form>
        </div>
    </div>
</section>