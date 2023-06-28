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

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

?>
<form action="<?php echo Route::_('index.php?option=com_jnotify&view=notifications'); ?>" method="post" id="adminForm" name="adminForm">

    <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

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
                    <th><?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'state', $listDirn, $listOrder); ?></th>
                    <th><?php echo HTMLHelper::_('searchtools.sort', 'Тема', 'subject', $listDirn, $listOrder); ?></th>
                    <th>ID Пользователя</th>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody class="js-draggable">
                <?php
                $iconStates = array(
                    0  => 'icon-times',
                    1  => 'icon-check',
                );
                ?>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr class="row<?php echo $i ?>">
                        <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                        <td>
                            <span class="tbody-icon">
                                <span class="<?php echo $iconStates[$this->escape($item->state)]; ?>" aria-hidden="true"></span>
                            </span>
                        </td>
                        <td>
                            <?php if ($item->type == 1) : ?>
                                <?php echo $item->custom_subject; ?>
                            <?php else : ?>
                                <?php echo Text::_($item->subject_constant); ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $item->user_id_to; ?></td>
                        <td><?php echo $item->id; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->pagination->getListFooter(); ?>
    <?php endif; ?>
    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>