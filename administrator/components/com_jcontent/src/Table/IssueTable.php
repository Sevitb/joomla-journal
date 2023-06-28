<?php

namespace Kima\Component\jcontent\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class IssueTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__journal_issues', 'id', $db);
    }
}