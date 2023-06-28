<?php

namespace Kima\Component\jprofile\Site\Model;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects


class ProfileEditModel extends AdminModel
{
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_jprofile.form', 'profile', array('control' => 'jform', 'load_data' => $loadData));

        // if (empty($form)) {
        //     $errors = $this->getErrors();
        //     throw new Exception(implode("\n", $errors), 500);
        // }

        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_jprofile.edit.profileedit.data', array());


        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function getItem($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('profile_id', 0, 'int');
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('journal_users.*')
            ->select($db->quoteName(array('users.email', 'users.username')))
            ->select($db->quoteName(array('usergroup_map.group_id')))
            ->select($db->quoteName(array('user_params.show_email')))
            ->from($db->quoteName('#__users', 'users'))
            ->join('INNER', $db->quoteName('#__journal_users', 'journal_users') . ' ON ' . 'users.id' . '=' . 'journal_users.id')
            ->join('INNER', $db->quoteName('#__user_usergroup_map', 'usergroup_map') . ' ON ' . 'users.id' . '=' . 'usergroup_map.user_id')
            ->join('INNER', $db->quoteName('#__journal_user_params', 'user_params') . ' ON ' . 'users.id' . '=' . 'user_params.user_id')
            ->where($db->quoteName('users.id') . ' = ' . $db->quote($pk));

        $db->setQuery($query);

        $row = $db->loadObject();

        return $row;
    }

    public function save($data)
    {

        $app = Factory::getApplication();
        $profileEditTable = $this->getTable('ProfileEdit');
        $usersTable = $this->getTable('Users');
        $userParamsTable = $this->getTable('UserParams');
        $data['user_id'] = $data['id'];
        
        if(!array_key_exists('show_email',$data)){
            $data['show_email'] = 0;
        }

        if(!$profileEditTable->bind($data)){
            $app->enqueueMessage("Ошибка в привязке таблицы профиля.", 'error');
        }

        if(!$usersTable->bind($data)){
            $app->enqueueMessage("Ошибка в привязке таблицы пользовалетей.", 'error');
        }

        if(!$userParamsTable->bind($data)){
            $app->enqueueMessage("Ошибка в привязке таблицы параметров.", 'error');
        }


        if(!$profileEditTable->save($data)){
            $app->enqueueMessage("Ошибка в сохранении таблицы профиля.", 'error');
        }

        if(!$usersTable->save($data)){
            $app->enqueueMessage("Ошибка в сохранении таблицы пользователей.", 'error');
        }

        if(!$userParamsTable->save($data)){
            $app->enqueueMessage("Ошибка в сохранении таблицы параметров.", 'error');
        }

        return true;
    }
}
