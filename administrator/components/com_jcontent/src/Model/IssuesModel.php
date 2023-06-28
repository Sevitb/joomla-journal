<?php

namespace Kima\Component\jcontent\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * Jcontent Component Jcontent Model
 *
 * @since  1.6
 */
class IssuesModel extends ListModel
{
    protected function getListQuery()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('*')
            ->from($db->quoteName('#__journal_issues'));

        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('title LIKE ' . $like);
        }

        $state = $this->getState('filter.state');
        if (is_numeric($state)) {
            $query->where($db->quoteName('state') . ' = ' . $db->quote($state));
        } elseif ($state === '') {
            $query->whereIn($db->quoteName('state'), array(0, 1));
        }

        // Order by
        $query->order('id');
        return $query;
    }
}
