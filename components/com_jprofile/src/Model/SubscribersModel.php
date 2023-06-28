<?php

namespace Kima\Component\jprofile\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

defined('_JEXEC') or die;

class SubscribersModel extends ListModel
{

    public function __construct($config = array(), MVCFactoryInterface $factory = null)
    {

        parent::__construct($config, $factory);
    }

    protected function getListQuery($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('profile_id', 0, 'int');
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select($db->quoteName('subject_id'))
            ->from($db->quoteName('#__journal_subscriptions'))
            ->where($db->quoteName('object_id') . '=' . $pk);

        $subscribers = $db->setQuery($query)->loadColumn();

        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id', 'firstname', 'secondname', 'thirdname', 'avatar_image', 'city', 'country', 'organization')))
            ->from($db->quoteName('#__journal_users'));

        foreach ($subscribers as $subscriber) {
            $query->where($db->quoteName('id') . '=' . $subscriber, 'OR');
        }

        return $query;
    }
}
