<?php

namespace Kima\Component\jprofile\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class ProfileEditTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__journal_users', 'id', $db);
    }
}