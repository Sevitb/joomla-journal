<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\String\Inflector;

?>

<form action="index.php?option=com_jcontent&view=series" method="post" id="adminForm" name="adminForm">
    <?php if (empty($this->items)) : ?>
        <div class="alert alert-info">
            <span class="icon-info-circle" aria-hidden="true"></span>
            <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($this->items)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo HTMLHelper::_('grid.checkall'); ?></th>
                    <th>Status</th>
                    <th>Title</th>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody class="js-draggable">
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr class="row<?php echo $i?>">
                        <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                        <td><?php echo $item->state; ?></td>
                        <td><a href="<?php echo Route::_('index.php?option=com_jcontent&task=singleseries.edit&id=' . $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(Text::_($item->title)); ?>"><?php echo Text::_($item->title); ?></a></td>
                        <td><?php echo $item->id; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>