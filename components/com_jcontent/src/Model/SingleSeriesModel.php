<?php

namespace Kima\Component\jcontent\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

defined('_JEXEC') or die;

class SingleSeriesModel extends BaseDatabaseModel
{
    public function getItem($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('id', 0, 'int');
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__journal_series'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($pk));

        $db->setQuery($query);

        $row = $db->loadObject();

        return $row;
    }
}
