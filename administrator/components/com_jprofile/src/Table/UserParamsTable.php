<?php

namespace Kima\Component\jprofile\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class UserParamsTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__journal_user_params', 'user_id', $db);
    }
}