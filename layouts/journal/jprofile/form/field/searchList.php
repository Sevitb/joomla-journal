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

$html = array();
$attr = '';

if ($ajax) {
    $scriptFile = 'getDataFromAPI.js';
    $scriptName = 'script.listSearchAjax';
} else {
    $scriptFile = 'selectSearch.js';
    $scriptName = 'script.listSearch';
}

// Initialize the field attributes.
$attr .= !empty($class) ? ' class="form-select ' . $class . '"' : ' class="form-select"';
$attr .= !empty($size) ? ' size="' . $size . '"' : '';
$attr .= $multiple ? ' multiple' : '';
$attr .= $required ? ' required' : '';
$attr .= $autofocus ? ' autofocus' : '';
$attr .= $onchange ? ' onchange="' . $onchange . '"' : '';
$attr .= !empty($description) ? ' aria-describedby="' . ($id ?: $name) . '-desc"' : '';
$attr .= $dataAttribute;

$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseStyle('template.select', 'media/vendor/select2-4.0.13/dist/css/select2.min.css');
$wa->registerAndUseScript('script.select', 'media/vendor/select2-4.0.13/dist/js/select2.min.js');

$wa->registerAndUseScript($scriptName, 'media/layouts/js/journal/form/field/' . $scriptFile);
$wa->registerAndUseScript('script.onsave', 'media/layouts/js/journal/form/field/onsave.js');

// $wa->addInlineScript('
//     $(document).ready(function() {
//         $(".js-cities-data-ajax").select2();
//     });
// ');

// To avoid user's confusion, readonly="readonly" should imply disabled="disabled".
if ($readonly || $disabled) {
    $attr .= ' disabled="disabled"';
}

// Create a read-only list (no name) with hidden input(s) to store the value(s).
if ($readonly) {
    $html[] = HTMLHelper::_('select.genericlist', $options, '', trim($attr), 'value', 'text', $value, $id);

    // E.g. form field type tag sends $this->value as array
    if ($multiple && is_array($value)) {
        if (!count($value)) {
            $value[] = '';
        }

        foreach ($value as $val) {
            $html[] = '<input type="hidden" name="' . $name . '" value="' . htmlspecialchars($val, ENT_COMPAT, 'UTF-8') . '">';
        }
    } else {
        $html[] = '<input type="hidden" name="' . $name . '" value="' . htmlspecialchars($value, ENT_COMPAT, 'UTF-8') . '">';
    }
} else // Create a regular list passing the arguments in an array.
{
    $listoptions = array();
    $listoptions['option.key'] = 'value';
    $listoptions['option.text'] = 'text';
    $listoptions['list.select'] = $value;
    $listoptions['id'] = $id;
    $listoptions['list.translate'] = false;
    $listoptions['option.attr'] = 'optionattr';
    $listoptions['list.attr'] = trim($attr);
    $html[] = HTMLHelper::_('select.genericlist', $options, $name, $listoptions);
}

// echo implode($html);
$value = json_decode($value);
?>
<select class="form-select js-api-data<?php echo ($ajax ? '-ajax' : ''); ?>" style="width:100%;" name="<?php echo $name ?>" <?php echo trim($attr) ?>>
    <?php if ($value) : ?>
        <option value="<?php echo $value->id ?>"><?php echo $value->text ?></option>
    <?php endif; ?>
    <?php if ($options) : ?>
        <?php foreach ($options as $key => $option) : ?>
            <?php if ($key == $value->id) : ?>
                <?php continue; ?>
            <?php endif; ?>
            <option value="<?php echo $key ?>"><?php echo $option ?></option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>