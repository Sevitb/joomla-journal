<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;

// No direct access to this file
defined('_JEXEC') or die;

$form = new Form('jmail_form');
$app = Factory::getApplication();

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$result = $helper->sendMail();

$resultClass = '';

if(gettype($result) == 'boolean'){
    $resultClass = $result ? 'form-success' : 'form-error';
}

?>
<form action="" method="POST" name="adminForm" id="adminForm" class="form-validate form-vertical <?php echo $resultClass; ?>">
    <div class="control-group">
        <div class="control-label">
            <label for="jform_name">
                ФИО
                <span class="star" aria-hidden="true">*</span>
            </label>
        </div>
        <div class="controls">
            <input id="jform_name" name="name" class="form-control required" type="text" required>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <label for="jform_email">
                Email
                <span class="star" aria-hidden="true">*</span>
            </label>
        </div>
        <div class="controls">
            <input id="jform_email" name="email" class="form-control required" type="email" required>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <label for="jform_subject">
                Тема
                <span class="star" aria-hidden="true">*</span>
            </label>
        </div>
        <div class="controls">
            <input id="jform_subject" name="subject" class="form-control required" type="text" required>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <label for="jform_message">
                Сообщение
                <span class="star" aria-hidden="true">*</span>
            </label>
        </div>
        <div class="controls">
            <textarea id="jform_message" name="message" class="form-control required" required></textarea>
        </div>
    </div>
    <input class="btn" type="submit" value="Отправить">
</form>