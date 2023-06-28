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
class SeriesModel extends ListModel
{
    protected function getListQuery()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('*')
            ->from($db->quoteName('#__journal_series'));

        // Order by
        $query->order('id');
        return $query;
    }
}
