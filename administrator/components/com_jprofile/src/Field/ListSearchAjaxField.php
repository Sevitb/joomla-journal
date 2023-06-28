<?php

namespace Kima\Component\jprofile\Administrator\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;
use Joomla\Database\ParameterType;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Language;

defined('_JEXEC') or die;

class ListSearchAjaxField extends ListField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $type = 'listSearchAjax';

    /**
     * Name of the layout being used to render the field
     *
     * @var    string
     * @since  1.0.0
     */
    protected $layout = 'journal.jprofile.form.field.searchList';


    /**
     * Method to get the field input markup for a generic list.
     * Use the multiple attribute to enable multiselect.
     *
     * @return  string  The field input markup.
     *
     * @since   1.0.0
     */
    protected function getInput()
    {
        $data = $this->getLayoutData();

        $data['options'] = (array) $this->getOptions();
        
        $data['ajax'] = 1;

        return $this->getRenderer($this->layout)->render($data);
    }
}
