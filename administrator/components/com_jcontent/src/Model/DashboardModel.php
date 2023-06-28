<?php

namespace Kima\Component\jcontent\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

/**
 * Jcontent Component Jcontent Model
 *
 * @since  1.6
 */
class DashboardModel extends ListModel
{
    public function getTitle()
    {
        return 'Материалы журнала';
    }
}
