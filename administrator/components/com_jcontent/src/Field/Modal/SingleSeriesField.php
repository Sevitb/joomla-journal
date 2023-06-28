<?php

namespace Kima\Component\jcontent\Administrator\Field\Modal;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Form\FormField;


defined('_JEXEC') or die;


/**
 * Supports a modal series picker.
 *
 * @since  1.6
 */
class SingleSeriesField extends FormField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.6
     */
    protected $type = 'Modal_SingleSeries';

    protected function getInput()
    {
        $clientId    = (int) $this->element['clientid'];
        $languages   = LanguageHelper::getContentLanguages(array(0, 1), false);

        // Load language
        Factory::getLanguage()->load('com_menus', JPATH_ADMINISTRATOR);

        // The active article id field.
        $value = (int) $this->value ?: '';

        // Create the modal id.
        $modalId = 'Item_' . $this->id;

        /** @var \Joomla\CMS\WebAsset\WebAssetManager $wa */
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();

        // Add the modal field script to the document head.
        $wa->useScript('field.modal-fields');


        // Setup variables for display.
        $linkSuffix = '&amp;layout=modal&amp;client_id=' . $clientId . '&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
        $linkItems  = 'index.php?option=com_menus&amp;view=items' . $linkSuffix;
        $linkItem   = 'index.php?option=com_menus&amp;view=item' . $linkSuffix;
        $modalTitle = Text::_('COM_MENUS_SELECT_A_MENUITEM');

        if (isset($this->element['language'])) {
            $linkItems  .= '&amp;forcedLanguage=' . $this->element['language'];
            $linkItem   .= '&amp;forcedLanguage=' . $this->element['language'];
            $modalTitle .= ' &#8212; ' . $this->element['label'];
        }

        $urlSelect = $linkItems . '&amp;function=jSelectMenu_' . $this->id;
        $urlEdit   = $linkItem . '&amp;task=item.edit&amp;id=\' + document.getElementById("' . $this->id . '_id").value + \'';
        $urlNew    = $linkItem . '&amp;task=item.add';

        if ($value) {
            $db    = $this->getDatabase();
            $query = $db->getQuery(true)
                ->select($db->quoteName('title'))
                ->from($db->quoteName('#__menu'))
                ->where($db->quoteName('id') . ' = :id')
                ->bind(':id', $value, ParameterType::INTEGER);

            $db->setQuery($query);

            try {
                $title = $db->loadResult();
            } catch (\RuntimeException $e) {
                Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
            }
        }

        // Placeholder if option is present or not
        if (empty($title)) {
            if ($this->element->option && (string) $this->element->option['value'] == '') {
                $title_holder = Text::_($this->element->option);
            } else {
                $title_holder = Text::_('COM_MENUS_SELECT_A_MENUITEM');
            }
        }

        $title = empty($title) ? $title_holder : htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        // The current menu item display field.
        $html  = '';

        if ($this->allowSelect || $this->allowNew || $this->allowEdit || $this->allowClear) {
            $html .= '<span class="input-group">';
        }

        $html .= '<input class="form-control" id="' . $this->id . '_name" type="text" value="' . $title . '" disabled="disabled" size="35">';

        // Select menu item button
        if ($this->allowSelect) {
            $html .= '<button'
                . ' class="btn btn-primary' . ($value ? ' hidden' : '') . '"'
                . ' id="' . $this->id . '_select"'
                . ' data-bs-toggle="modal"'
                . ' type="button"'
                . ' data-bs-target="#ModalSelect' . $modalId . '">'
                . '<span class="icon-file" aria-hidden="true"></span> ' . Text::_('JSELECT')
                . '</button>';
        }

        // New menu item button
        if ($this->allowNew) {
            $html .= '<button'
                . ' class="btn btn-secondary' . ($value ? ' hidden' : '') . '"'
                . ' id="' . $this->id . '_new"'
                . ' data-bs-toggle="modal"'
                . ' type="button"'
                . ' data-bs-target="#ModalNew' . $modalId . '">'
                . '<span class="icon-plus" aria-hidden="true"></span> ' . Text::_('JACTION_CREATE')
                . '</button>';
        }

        // Edit menu item button
        if ($this->allowEdit) {
            $html .= '<button'
                . ' class="btn btn-primary' . ($value ? '' : ' hidden') . '"'
                . ' id="' . $this->id . '_edit"'
                . ' data-bs-toggle="modal"'
                . ' type="button"'
                . ' data-bs-target="#ModalEdit' . $modalId . '">'
                . '<span class="icon-pen-square" aria-hidden="true"></span> ' . Text::_('JACTION_EDIT')
                . '</button>';
        }

        // Clear menu item button
        if ($this->allowClear) {
            $html .= '<button'
                . ' class="btn btn-secondary' . ($value ? '' : ' hidden') . '"'
                . ' id="' . $this->id . '_clear"'
                . ' type="button"'
                . ' onclick="window.processModalParent(\'' . $this->id . '\'); return false;">'
                . '<span class="icon-times" aria-hidden="true"></span> ' . Text::_('JCLEAR')
                . '</button>';
        }

        // Propagate menu item button
        if ($this->allowPropagate && count($languages) > 2) {
            // Strip off language tag at the end
            $tagLength = (int) strlen($this->element['language']);
            $callbackFunctionStem = substr("jSelectMenu_" . $this->id, 0, -$tagLength);

            $html .= '<button'
                . ' class="btn btn-primary' . ($value ? '' : ' hidden') . '"'
                . ' type="button"'
                . ' id="' . $this->id . '_propagate"'
                . ' title="' . Text::_('JGLOBAL_ASSOCIATIONS_PROPAGATE_TIP') . '"'
                . ' onclick="Joomla.propagateAssociation(\'' . $this->id . '\', \'' . $callbackFunctionStem . '\');">'
                . '<span class="icon-sync" aria-hidden="true"></span> ' . Text::_('JGLOBAL_ASSOCIATIONS_PROPAGATE_BUTTON')
                . '</button>';
        }

        if ($this->allowSelect || $this->allowNew || $this->allowEdit || $this->allowClear) {
            $html .= '</span>';
        }

        // Select menu item modal
        if ($this->allowSelect) {
            $html .= HTMLHelper::_(
                'bootstrap.renderModal',
                'ModalSelect' . $modalId,
                array(
                    'title'       => $modalTitle,
                    'url'         => $urlSelect,
                    'height'      => '400px',
                    'width'       => '800px',
                    'bodyHeight'  => 70,
                    'modalWidth'  => 80,
                    'footer'      => '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'
                        . Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</button>',
                )
            );
        }

        // New menu item modal
        if ($this->allowNew) {
            $html .= HTMLHelper::_(
                'bootstrap.renderModal',
                'ModalNew' . $modalId,
                array(
                    'title'       => Text::_('COM_MENUS_NEW_MENUITEM'),
                    'backdrop'    => 'static',
                    'keyboard'    => false,
                    'closeButton' => false,
                    'url'         => $urlNew,
                    'height'      => '400px',
                    'width'       => '800px',
                    'bodyHeight'  => 70,
                    'modalWidth'  => 80,
                    'footer'      => '<button type="button" class="btn btn-secondary"'
                        . ' onclick="window.processModalEdit(this, \'' . $this->id . '\', \'add\', \'item\', \'cancel\', \'item-form\'); return false;">'
                        . Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</button>'
                        . '<button type="button" class="btn btn-primary"'
                        . ' onclick="window.processModalEdit(this, \'' . $this->id . '\', \'add\', \'item\', \'save\', \'item-form\'); return false;">'
                        . Text::_('JSAVE') . '</button>'
                        . '<button type="button" class="btn btn-success"'
                        . ' onclick="window.processModalEdit(this, \'' . $this->id . '\', \'add\', \'item\', \'apply\', \'item-form\'); return false;">'
                        . Text::_('JAPPLY') . '</button>',
                )
            );
        }

        // Edit menu item modal
        if ($this->allowEdit) {
            $html .= HTMLHelper::_(
                'bootstrap.renderModal',
                'ModalEdit' . $modalId,
                array(
                    'title'       => Text::_('COM_MENUS_EDIT_MENUITEM'),
                    'backdrop'    => 'static',
                    'keyboard'    => false,
                    'closeButton' => false,
                    'url'         => $urlEdit,
                    'height'      => '400px',
                    'width'       => '800px',
                    'bodyHeight'  => 70,
                    'modalWidth'  => 80,
                    'footer'      => '<button type="button" class="btn btn-secondary"'
                        . ' onclick="window.processModalEdit(this, \'' . $this->id . '\', \'edit\', \'item\', \'cancel\', \'item-form\'); return false;">'
                        . Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</button>'
                        . '<button type="button" class="btn btn-primary"'
                        . ' onclick="window.processModalEdit(this, \'' . $this->id . '\', \'edit\', \'item\', \'save\', \'item-form\'); return false;">'
                        . Text::_('JSAVE') . '</button>'
                        . '<button type="button" class="btn btn-success"'
                        . ' onclick="window.processModalEdit(this, \'' . $this->id . '\', \'edit\', \'item\', \'apply\', \'item-form\'); return false;">'
                        . Text::_('JAPPLY') . '</button>',
                )
            );
        }

        // Note: class='required' for client side validation.
        $class = $this->required ? ' class="required modal-value"' : '';

        // Placeholder if option is present or not when clearing field
        if ($this->element->option && (string) $this->element->option['value'] == '') {
            $title_holder = Text::_($this->element->option);
        } else {
            $title_holder = Text::_('COM_MENUS_SELECT_A_MENUITEM');
        }

        $html .= '<input type="hidden" id="' . $this->id . '_id" ' . $class . ' data-required="' . (int) $this->required . '" name="' . $this->name
            . '" data-text="' . htmlspecialchars($title_holder, ENT_COMPAT, 'UTF-8') . '" value="' . $value . '">';

        return $html;
    }

    /**
     * Method to get the field label markup.
     *
     * @return  string  The field label markup.
     *
     * @since   3.7.0
     */
    protected function getLabel()
    {
        return str_replace($this->id, $this->id . '_name', parent::getLabel());
    }
}
