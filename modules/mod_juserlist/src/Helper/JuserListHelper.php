<?php

namespace Joomla\Module\JuserList\Site\Helper;

use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class JuserListHelper
{
    public static function getItems()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName(array('users.id')))
            ->select($db->quoteName('usergroup.group_id'))
            ->select('journal_users.*')
            ->from($db->quoteName('#__users', 'users'))
            ->join('INNER', $db->quoteName('#__user_usergroup_map', 'usergroup') . ' ON ' . $db->quoteName('usergroup.user_id') . ' = ' . $db->quoteName('users.id'))
            ->join('INNER', $db->quoteName('#__journal_users', 'journal_users') . ' ON ' . $db->quoteName('journal_users.id') . ' = ' . $db->quoteName('users.id'))
            ->where($db->quoteName('usergroup.group_id') . ' = ' . 4);

        $db->setQuery($query);

        $usersInfo = $db->loadObjectList();

        return $usersInfo;
    }
}
