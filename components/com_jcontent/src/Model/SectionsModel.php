<?php

namespace Kima\Component\jcontent\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

class SectionsModel extends ListModel
{

    protected function getListQuery($pk = null)
    {

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('*')
            ->from($db->quoteName('#__journal_sections'));


        return $query;
    }
}
