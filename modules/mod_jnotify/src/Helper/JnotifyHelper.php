<?php

namespace Joomla\Module\Jnotify\Site\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class JnotifyHelper
{
    public static function getItems()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $user = Factory::getUser();

        // Select statement
        $query->select($db->quoteName(array('notifications.id', 'notifications.custom_subject','notifications.type','notifications.date_time')))
            ->select($db->quoteName('notifications_types.subject_constant'))
            ->from($db->quoteName('#__journal_notifications', 'notifications'))
            ->join('INNER', $db->quoteName('#__journal_notifications_types', 'notifications_types') . ' ON ' . 'notifications.type' . '=' . 'notifications_types.id' )
            ->where($db->quoteName('notifications.state') . ' = ' . 0)
            ->where($db->quoteName('notifications.user_id_to') . ' = ' . $user->id);

        $query->order('date_time DESC');

        $db->setQuery($query);

        return $db->loadObjectList();
    }
}
