<?php

namespace Kima\Component\jnotify\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class NotificationTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__journal_notifications', 'id', $db);
    }
}