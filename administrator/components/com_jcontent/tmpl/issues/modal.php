<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$app = Factory::getApplication();

if ($app->isClient('site')) {
    Session::checkToken('get') or die(Text::_('JINVALID_TOKEN'));
}

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('core')
    ->useScript('multiselect')
    ->registerAndUseScript('com_jcontent.admin-materials-modal', 'media/com_jcontent/js/admin-issues-modal.js');

$function  = $app->input->getCmd('function', 'jSelectIssue');
// $listOrder = $this->escape($this->state->get('list.ordering'));
// $listDirn  = $this->escape($this->state->get('list.direction'));
$onclick   = $this->escape($function);
$multilang = Multilanguage::isEnabled();

?>
<div class="container-popup">

    <form action="<?php echo Route::_('index.php?option=com_jcontent&view=issues&layout=modal&tmpl=component&function=' . $function . '&' . Session::getFormToken() . '=1'); ?>" method="post" name="adminForm" id="adminForm">

        <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-info">
                <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-sm">
                <caption class="visually-hidden">
                    <?php echo Text::_('COM_CONTENT_ARTICLES_TABLE_CAPTION'); ?>,
                    <span id="orderedBy"><?php echo Text::_('JGLOBAL_SORTED_BY'); ?> </span>,
                    <span id="filteredBy"><?php echo Text::_('JGLOBAL_FILTERED_BY'); ?></span>
                </caption>
                <thead>
                    <tr>
                        <th><?php echo HTMLHelper::_('grid.sort', 'Статус', 'state'); ?></th>
                        <th><?php echo HTMLHelper::_('grid.sort', 'Название', 'title'); ?></th>
                        <th><?php echo HTMLHelper::_('grid.sort', 'ID', 'id'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->items as $i => $item) : ?>
                        <tr class="row<?php echo $i ?>">
                            <td>
                                <span class="tbody-icon">
                                    <span aria-hidden="true"> <?php echo $item->state ?></span>
                                </span>
                            </td>
                            <td>
                                <?php $attribs = 'data-function="' . $this->escape($onclick) . '"'
                                    . ' data-id="' . $item->id . '"'
                                    . ' data-title="' . $this->escape($item->title) . '"';
                                ?>
                                <a class="select-link" href="javascript:void(0)" <?php echo $attribs; ?>>
                                    <?php echo $this->escape(Text::_($item->title)); ?>
                                </a>
                            </td>
                            <td><?php echo $item->id; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php // load the pagination. 
            ?>
            <?php // echo $this->pagination->getListFooter(); 
            ?>

        <?php endif; ?>

        <input type="hidden" name="task" value="">
        <input type="hidden" name="boxchecked" value="0">
        <?php echo HTMLHelper::_('form.token'); ?>

    </form>
</div>