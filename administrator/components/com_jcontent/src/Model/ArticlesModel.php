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
class ArticlesModel extends ListModel
{
    protected function getListQuery()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('articles.*')
            ->select($db->quoteName('issues.number', 'issue_number'))
            ->from($db->quoteName('#__journal_articles', 'articles'))
            ->join('INNER', $db->quoteName('#__journal_issues', 'issues') . 'ON' . $db->quoteName('articles.issue_id') . '=' . $db->quoteName('issues.id'));

        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('articles.title LIKE ' . $like);
        }

        $state = $this->getState('filter.state');
        if (is_numeric($state)) {
            $query->where($db->quoteName('articles.state') . ' = ' . $db->quote($state));
        } elseif ($state === '') {
            $query->whereIn($db->quoteName('articles.state'), array(0, 1));
        }

        $issue_id = $this->getState('filter.issue_id');
        if (is_numeric($issue_id)) {
            $query->where($db->quoteName('articles.issue_id') . ' = ' . $db->quote($issue_id));
        }

        // Order by
        $query->order('id');
        return $query;
    }
}
