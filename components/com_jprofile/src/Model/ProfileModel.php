<?php

namespace Kima\Component\jprofile\Site\Model;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Kima\Component\jcontent\Administrator\Model\ArticlesModel;

defined('_JEXEC') or die;

class ProfileModel extends BaseDatabaseModel
{
    public function getItem($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('profile_id', 0, 'int');
        }

        $user = Factory::getUser();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('journal_users.*')
            ->select($db->quoteName(array('users.email')))
            ->select($db->quoteName(array('usergroup_map.group_id')))
            ->select($db->quoteName(array('user_params.show_email')))
            ->from($db->quoteName('#__users', 'users'))
            ->join('INNER', $db->quoteName('#__journal_users', 'journal_users') . ' ON ' . 'users.id' . '=' . 'journal_users.id')
            ->join('INNER', $db->quoteName('#__user_usergroup_map', 'usergroup_map') . ' ON ' . 'users.id' . '=' . 'usergroup_map.user_id')
            ->join('INNER', $db->quoteName('#__journal_user_params', 'user_params') . ' ON ' . 'users.id' . '=' . 'user_params.user_id')
            ->where($db->quoteName('users.id') . ' = ' . $db->quote($pk));

        $db->setQuery($query);

        $row = $db->loadObject();

        $row->isCurrentUser = $user->id === $row->id;

        return $row;
    }

    public function getPublicationInfo($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('profile_id', 0, 'int');
        }

        $coAuthorsCount = 3;

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__journal_articles'))
            ->where($db->quoteName('created_by') . ' = ' . $db->quote($pk), 'OR');

        for ($index = 0; $index <= $coAuthorsCount; $index++) {
            $query->where("JSON_EXTRACT(co_authors, '$[" . $index . "].id')" . ' = ' . $db->quote($pk), 'OR');
        }

        $db->setQuery($query);

        $result = $db->loadObjectList();

        return $result;
    }
}
