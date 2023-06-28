<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;
use Joomla\CMS\Language\Text;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');
?>
<form action="<?php echo Route::_('index.php?option=com_jnotify&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

    <?php echo $this->form->renderField('type'); ?>

    <div class="main-card">
        <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'general', 'recall' => true, 'breakpoint' => 768]); ?>
        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'general', 'Основное'); ?>
        <div class="row">
            <div class="col-lg-9">
                <?php echo $this->form->renderField('custom_subject'); ?>
                <?php echo $this->form->renderField('custom_message'); ?>
                <?php echo $this->form->renderField('material_id'); ?>
                <?php echo $this->form->renderField('send_to_group'); ?>
                <?php echo $this->form->renderField('user_id_to'); ?>
                <?php echo $this->form->renderField('usergroup'); ?>
                <?php echo $this->form->renderField('id'); ?>
            </div>
            <div class="col-lg-3">
                <?php echo $this->form->renderField('state'); ?>
            </div>
        </div>

        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <input type="hidden" name="task" value="notification.edit" />
        <?php echo HTMLHelper::_('form.token'); ?>
    </div>
</form>
<script>
    $("select[name='jform[type]']").change((event) => {
        if (event.target.value == 1) {
            $("textarea[name='jform[custom_message]']").prop('required', true).addClass('required');
            $("input[name='jform[custom_subject]']").prop('required', true).addClass('required');
        } else {
            $("textarea[name='jform[custom_message]']").prop('required', false).removeClass('required');
            $("input[name='jform[custom_subject]']").prop('required', false).removeClass('required');
        }
    });
    $("select[name='jform[send_to_group]']").change((event) => {
        if (event.target.value == 1) {
            $("#jform_user_id_to").prop('required', false).removeAttr('value').removeClass('required');
            $("input[name='jform[user_id_to]']").prop('required', false).prop('value','').removeClass('required');
            $("select[name='jform[usergroup]']").prop('required', true).addClass('required');
        } else {
            $("select[name='jform[usergroup]").prop('required', false).removeClass('required');
            $("#jform_user_id_to").prop('required', true).addClass('required');
            $("input[name='jform[user_id_to]").prop('required', true).addClass('required');
        }
    });
</script>