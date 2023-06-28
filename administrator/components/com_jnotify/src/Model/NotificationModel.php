<?php

namespace Kima\Component\jnotify\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;

/**
 * Jcontent Component Jcontent Model
 *
 * @since  1.6
 */
class NotificationModel extends AdminModel
{
    public function save($data)
    {

        if (!array_key_exists('date_time',$data)) {
            $data['date_time'] = Factory::getDate('now')->toSql();
        }


        return parent::save($data);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_jcontent.notification', 'notification', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_jcontent.edit.notification.data', array());


        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }
}
