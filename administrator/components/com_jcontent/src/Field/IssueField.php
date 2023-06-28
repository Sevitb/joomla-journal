<?php

namespace Kima\Component\jcontent\Administrator\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;
use Joomla\Database\ParameterType;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Language\Associations;


defined('_JEXEC') or die;

class IssueField extends ListField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  4.0.0
     */
    protected $type = 'Issue';


    public function getOptions(){

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName('number'))
            ->from($db->quoteName('#__journal_issues'));

        $rows = $db->setQuery($query)->loadObjectlist();

        foreach($rows as $row){
            $issues[] = $row->number;
        }

        // Merge any additional options in the XML definition.
        $options = array_merge(parent::getOptions(), $issues);

        return $options;
    }
}