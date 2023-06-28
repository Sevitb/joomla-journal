<?php

namespace Kima\Component\jcontent\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;

/**
 * Jcontent Component Jcontent Model
 *
 * @since  1.6
 */
class SingleSeriesModel extends AdminModel
{
    public function save($data)
    {
        

        if (empty($data['path'])) {
            if (Factory::getConfig()->get('unicodeslugs') == 1) {
                $data['path'] = OutputFilter::stringURLUnicodeSlug($data['alias']);
            } else {
                $data['path'] = OutputFilter::stringURLSafe($data['alias']);
            }
        }

        if (!$data['created_user_id']) {
            $user = Factory::getUser();
            $data['created_user_id'] = $user->id;
        }


        return parent::save($data);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_jcontent.singleseries', 'singleseries', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_jcontent.edit.singleseries.data', array());


        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }
}
