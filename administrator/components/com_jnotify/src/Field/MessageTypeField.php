<?php

namespace Kima\Component\jnotify\Administrator\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

class MessageTypeField extends ListField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  4.0.0
     */
    protected $type = 'MessageType';

    public function getOptions(){

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__journal_notifications_types'));

        $rows = $db->setQuery($query)->loadObjectlist();

        foreach($rows as $row){
            $types[(int)$row->id] = Text::_($row->subject_constant);
        }

        // Merge any additional options in the XML definition.
        $options = parent::getOptions() + $types;

        return $options;
    }
}