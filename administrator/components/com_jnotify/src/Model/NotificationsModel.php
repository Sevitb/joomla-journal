<?php

namespace Kima\Component\jnotify\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

class NotificationsModel extends ListModel
{


    protected function getListQuery()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('notifications.*')
            ->select($db->quoteName(array('notifications_types.subject_constant', 'notifications_types.message_constant')))
            ->from($db->quoteName('#__journal_notifications', 'notifications'))
            ->join('INNER', $db->quoteName('#__journal_notifications_types', 'notifications_types') . ' ON ' . 'notifications.type' . '=' . 'notifications_types.id');

        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('notifications.custom_subject LIKE ' . $like);
        }

        $user = $this->getState('filter.user_id_to');
        if (!empty($user)) {
            $query->where($db->quoteName('notifications.user_id_to') . '=' . $user);
        } 

        $state = $this->getState('filter.state');
        if (is_numeric($state)) {
            $query->where($db->quoteName('notifications.state') . ' = ' . $db->quote($state));
        } elseif ($state === '') {
            $query->whereIn($db->quoteName('notifications.state'), array(0, 1));
        }

        $type = $this->getState('filter.type');
        if (!empty($type)) {
            $query->where($db->quoteName('notifications.type') . '=' . $type);
        } 

        // Order by
        $query->order('id');
        return $query;
    }
}
