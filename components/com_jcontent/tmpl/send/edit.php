<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Router\Route;

$user = Factory::getUser();
$app  = Factory::getApplication();

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');
// Use custom script assets
$wa->registerAndUseScript('component.onSave.jcontent.script', 'media/com_jcontent/js/onSendSave.js');



?>
<section class="content-section">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-lg-8">
                <div class="content-section__main-column default-block">
                    <div id="bcrumbs">
                        <?php echo ModuleHelper::renderModule('breadcrumbs'); ?>
                    </div>
                    <form action="<?php echo Route::_('index.php?option=com_jcontent&view=send&layout=edit'); ?>" method="POST" name="adminForm" id="adminForm" class="form-validate form-vertical" enctype="multipart/form-data">
                        <?php echo $this->form->renderField('section_id'); ?>
                        <?php echo $this->form->renderField('title'); ?>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('co_authors'); ?>
                            </div>
                            <div class="col-12 col-lg-6">
                                <?php echo $this->form->renderField('reviewers'); ?>
                            </div>
                        </div>
                        <?php echo $this->form->renderField('files'); ?>
                        <span class="btn mt-3" onclick="fetchData()" type="button" data-bs-toggle="modal" data-bs-target="#checkModal">Отправить</span>
                        <input type="hidden" name="task" />
                        <?php echo HTMLHelper::_('form.token'); ?>
                    </form>
                    <script src="media/com_jcontent/js/filesFieldHandler.js"></script>
                    <script src="media/com_jcontent/js/coAuthorFieldHandler.js"></script>
                </div>
            </div>
            <?php echo LayoutHelper::render('journal.components.sidebar') ?>
        </div>
    </div>
</section>
<div class="modal fade" tabindex="-1" id="checkModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-body">
                <h4 class="h-4 modal__title mb-3">Отправить заявку?</h4>
                <p class="p mb-4">Пожалуйста, убедитесь в правильности предоставленных данных. Если все поля заполненны корректно, нажмите кнопку отправить. </p>
                <div class="btn-toolbar justify-content-around">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('send.save')">
                            <?php echo Text::_('JSUBMIT'); ?>
                        </button>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>