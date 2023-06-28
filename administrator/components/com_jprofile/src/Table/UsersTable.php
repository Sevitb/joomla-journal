<?php

namespace Kima\Component\jprofile\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class UsersTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__users', 'id', $db);
    }
}