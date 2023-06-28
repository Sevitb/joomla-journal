<?php

namespace Kima\Component\jcontent\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

defined('_JEXEC') or die;

class IssueModel extends BaseDatabaseModel
{
    public function getItem($pk = null)
    {
        $input = Factory::getApplication()->input;
        $view  = $input->get('view');

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__journal_issues'));

        if ($view === 'issue') {
            $query->where($db->quoteName('state') . ' = ' . 2);
        } elseif ($view === 'singleseries') {
            $query->where($db->quoteName('state') . ' = ' . 1);
        }

        if ($pk == null) {
            if ($pk = $input->get('issue_id', 0, 'int')) {
                $query->where($db->quoteName('id') . ' = ' . $db->quote($pk));
            }
        }

        $db->setQuery($query);

        $row = $db->loadObject();

        return $row;
    }

    public function getCurrentIssue()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName('id'))
            ->from($db->quoteName('#__journal_issues'))
            ->order($db->quoteName('id') . ' DESC')
            ->setLimit('1');
        
        $db->setQuery($query);

        $result = $db->loadResult();

        return $result;
    }
}
