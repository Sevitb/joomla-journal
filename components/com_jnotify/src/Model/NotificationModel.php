<?php

namespace Kima\Component\jnotify\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

defined('_JEXEC') or die;

class NotificationModel extends BaseDatabaseModel
{
    public function getItem($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('id', 0, 'int');
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('notifications.*')
            ->select($db->quoteName(array('notifications_types.subject_constant', 'notifications_types.message_constant')))
            ->from($db->quoteName('#__journal_notifications','notifications'))
            ->join('INNER',$db->quoteName('#__journal_notifications_types','notifications_types') . ' ON ' . 'notifications.type' . '=' . 'notifications_types.id' )
            ->where($db->quoteName('notifications.id') . ' = ' . $db->quote($pk));

        $db->setQuery($query);

        $row = $db->loadObject();

        return $row;
    }

    public function delete($pk)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->delete($db->quoteName('#__journal_notifications'));
        $query->where($db->quoteName('id') . ' = ' . $pk);

        $db->setQuery($query);

        $db->execute();
    }

    public function makeAsRead($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('id', 0, 'int');
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->update($db->quoteName('#__journal_notifications'))
            ->set(array($db->quoteName('state') . ' = ' . 1))
            ->where($db->quoteName('id') . ' = ' . $pk);

        $db->setQuery($query);
        $db->execute();

        return;
    }
}
