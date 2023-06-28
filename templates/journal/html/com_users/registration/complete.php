<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<section class="content-section">
    <div class="container">
        <div class="content-section__main-column default-block">
            <div class="com-users-registration-complete registration-complete">
                <?php if ($this->params->get('show_page_heading')) : ?>
                    <h1>
                        <?php echo $this->escape($this->params->get('page_heading')); ?>
                    </h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>