<?php

namespace Kima\Component\jcontent\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class ArchiveModel extends ListModel
{
    protected function getListQuery($pk = null)
    {
        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('id', 0, 'int');
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('*')
            ->from($db->quoteName('#__journal_issues'))
            ->where($db->quoteName('state') . '=' . 2);


        return $query;
    }
}
