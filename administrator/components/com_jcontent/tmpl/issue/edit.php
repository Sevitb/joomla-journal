<?php

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');
?>
<form action="<?php echo Route::_('index.php?option=com_jcontent&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
  <div class="main-card">
  <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'general', 'recall' => true, 'breakpoint' => 768]); ?>
    <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'general', 'Выпуск'); ?>
    <div class="row">
      <div class="col-lg-9">
        <?php echo $this->form->renderField('title'); ?>
        <?php echo $this->form->renderField('id'); ?>
        <?php echo $this->form->renderField('type'); ?>
      </div>
      <div class="col-lg-3">
        <?php echo $this->form->renderField('state'); ?>
      </div>
      <input type="hidden" name="task" value="section.edit" />
      <?php echo HTMLHelper::_('form.token'); ?>
    </div>
    <?php echo HTMLHelper::_('uitab.endTab'); ?>
  </div>
</form>