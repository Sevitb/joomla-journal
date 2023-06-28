<?php

namespace Kima\Component\jcontent\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class ArticlesModel extends ListModel
{

    protected function getListQuery($pk = null)
    {
        $this->issue = $this->getIssue();

        $input = Factory::getApplication()->input;
        $viewName = $input->get('view');
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('*')
            ->from($db->quoteName('#__journal_articles'));

        if ($pk == null) {
            if ($pk = $input->get('id', 0, 'int') && $viewName != 'issue') {
                $query->where($db->quoteName('series_id') . ' = ' .  $db->quote($pk))
                    ->where($db->quoteName('issue_id') . ' = ' .  $db->quote($this->issue->id));
            }
            if ($pk = $input->get('issue_id', 0, 'int')) {
                $query->where($db->quoteName('issue_id') . ' = ' .  $db->quote($pk));
            }
        }

        return $query;
    }

    protected function getIssue($pk = null)
    {
        $input = Factory::getApplication()->input;
        $view  = $input->get('view');

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__journal_issues'));

        if ($view === 'issue') {
            $query->where($db->quoteName('state') . ' = ' . 2);
        } elseif ($view === 'singleseries'){
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
}
