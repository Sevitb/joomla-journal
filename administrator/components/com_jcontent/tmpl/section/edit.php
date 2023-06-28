<?php

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');
?>
<form action="<?php echo Route::_('index.php?option=com_jcontent&layout=edit&id=' . (int) $this->item->id); ?>" 
  method="post" name="adminForm" id="item-form" class="form-validate">

    <?php echo $this->form->renderField('title'); ?>
    <?php echo $this->form->renderField('id'); ?>
    <?php echo $this->form->renderField('state'); ?>
    
    <input type="hidden" name="task" value="section.edit" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>