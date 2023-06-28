<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2018 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   string   $autocomplete    Autocomplete attribute for the field.
 * @var   boolean  $autofocus       Is autofocus enabled?
 * @var   string   $class           Classes for the input.
 * @var   string   $description     Description of the field.
 * @var   boolean  $disabled        Is this field disabled?
 * @var   string   $group           Group the field belongs to. <fields> section in form XML.
 * @var   boolean  $hidden          Is this field hidden in the form?
 * @var   string   $hint            Placeholder for the field.
 * @var   string   $id              DOM id of the field.
 * @var   string   $label           Label of the field.
 * @var   string   $labelclass      Classes to apply to the label.
 * @var   boolean  $multiple        Does this field support multiple values?
 * @var   string   $name            Name of the input field.
 * @var   string   $onchange        Onchange attribute for the field.
 * @var   string   $onclick         Onclick attribute for the field.
 * @var   string   $pattern         Pattern (Reg Ex) of value of the form field.
 * @var   boolean  $readonly        Is this field read only?
 * @var   boolean  $repeat          Allows extensions to duplicate elements.
 * @var   boolean  $required        Is this field required?
 * @var   integer  $size            Size attribute of the input.
 * @var   boolean  $spellcheck      Spellcheck state for the form field.
 * @var   string   $validate        Validation rules to apply.
 * @var   string   $live_search     Live search.
 * @var   string   $value           Value attribute of the field.
 * @var   array    $options         Options available for this field.
 * @var   string   $dataAttribute   Miscellaneous data attributes preprocessed for HTML output
 * @var   array    $dataAttributes  Miscellaneous data attribute for eg, data-*
 */

$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseStyle('filepond.style', 'media/vendor/filepond-master/dist/filepond.min.css');

$wa->registerAndUseScript('filepond.script', 'media/vendor/filepond-master/dist/filepond.min.js');
$wa->registerAndUseScript('filepondValidatePlugin.script', 'media/vendor/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js');
$wa->addInlineScript('
    $(document).ready(function () {
        const inputElement = document.querySelector(".filepond");
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const pond = FilePond.create(inputElement, {
            maxFiles: 10,
            labelIdle: `Перетащите сюда файлы или <span class="filepond--label-action"> выберите их на устройстве </span`,
            allowBrowse: true,
            allowMultiple: true,
            storeAsFile: true,
            dropValidation: true,
            maxFiles: 10,
            allowFileTypeValidation: true,
            acceptedFileTypes: ["application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/*", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"],
        });
    });
');

Text::script('Перетащите необходимые файлы в эту область мышкой или <span class="filepond--label-action"> выберите </span> их в проводнике');

?>
<input 
    type="file" 
    name="<?php echo $name ?>" 
    class="filepond" 
    multiple="multiple"
    <?php echo $required ? ' required' : ''; ?>>