<?php

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');
?>
<form action="<?php echo Route::_('index.php?option=com_jcontent&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

  <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

  <div class="main-card">
    <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'general', 'recall' => true, 'breakpoint' => 768]); ?>
    <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'general', 'Статья'); ?>
    <div class="row">
      <div class="col-lg-9">
        <?php echo $this->form->renderField('id'); ?>
        <?php echo $this->form->renderField('issue_id'); ?>
        <?php echo $this->form->renderField('section_id'); ?>
        <?php echo $this->form->renderField('annotation'); ?>
        <?php echo $this->form->renderField('quoting'); ?>
        <?php echo $this->form->renderField('literature'); ?>
        <?php echo $this->form->renderField('pages'); ?>
      </div>
      <div class="col-lg-3">
        <?php echo $this->form->renderField('state'); ?>
      </div>
    </div>

    <?php echo HTMLHelper::_('uitab.endTab'); ?>


    <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', 'Файлы'); ?>

    <button class="btn btn-success">
      Скачать файлы
    </button>

    <?php echo $this->form->renderField('file'); ?>

    <?php // echo LayoutHelper::render('joomla.edit.params', $this); 
    ?>

    <?php echo HTMLHelper::_('uitab.endTab'); ?>

    <input type="hidden" name="task" value="article.edit" />
    <?php echo HTMLHelper::_('form.token'); ?>
  </div>
</form>