<?php

namespace Kima\Component\jnotify\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class NotificationsModel extends ListModel
{

    protected function getListQuery()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $user = Factory::getUser();

        // Select statement
        $query->select($db->quoteName(array('notifications.id', 'notifications.date_time', 'notifications.custom_subject', 'notifications.custom_message', 'notifications.state', 'notifications.type')))
            ->select($db->quoteName('notifications_types.subject_constant'))
            ->from($db->quoteName('#__journal_notifications', 'notifications'))
            ->join('INNER', $db->quoteName('#__journal_notifications_types', 'notifications_types') . ' ON ' . 'notifications.type' . '=' . 'notifications_types.id')
            ->where($db->quoteName('user_id_to') . '=' . $user->id);

        // Order by
        $query->order('date_time DESC');
        return $query;
    }
}
