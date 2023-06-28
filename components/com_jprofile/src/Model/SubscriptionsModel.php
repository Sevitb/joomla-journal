<?php

namespace Kima\Component\jprofile\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class SubscriptionsModel extends ListModel
{
    protected function getListQuery($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('profile_id', 0, 'int');
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select($db->quoteName('object_id'))
            ->from($db->quoteName('#__journal_subscriptions'))
            ->where($db->quoteName('subject_id') . '=' . $pk);

        $subscriptions = $db->setQuery($query)->loadColumn();

        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id','firstname', 'secondname', 'thirdname', 'avatar_image', 'city', 'country', 'organization')))
            ->from($db->quoteName('#__journal_users'));

        foreach ($subscriptions as $subscription) {
            $query->where($db->quoteName('id') . '=' . $subscription, 'OR');
        }

        return $query;
    }


}
