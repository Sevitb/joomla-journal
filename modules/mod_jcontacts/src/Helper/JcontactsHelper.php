<?php

namespace Joomla\Module\Jcontacts\Site\Helper;

use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class JcontactsHelper
{
    public static function getText()
    {
        return 'FooHelpertest';
    }

    public static function getItem()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__journal_contact_info'));

        $db->setQuery($query);

        $row = $db->loadObject();

        return $row;
    }
}
