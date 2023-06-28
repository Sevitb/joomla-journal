<?php

namespace Joomla\Module\JuserCard\Site\Helper;

use Exception;
use Joomla\CMS\Factory;
use Kima\Component\jprofile\Site\Model\ProfileModel;

defined('_JEXEC') or die;

class JuserCardHelper
{

    public function getItem($pk = null)
    {
        $app = Factory::getApplication();
        $profileModel = new ProfileModel();

        $input = Factory::getApplication()->input;
        $option    = $app->input->getCmd('option', '');
        $view      = $app->input->getCmd('view', '');

        $isArticle = $option == 'com_jcontent' && $view == 'article' ? true : false;

        if ($isArticle) {
            try {
                $pk = $this->getUserId($input->get('id', 0, 'int'));
            } catch (Exception $e) {
                $app->enqueueMessage($e->getMessage(), 'error');
            }
        } else {
            if ($pk == null) {
                $pk = $input->get('id', 0, 'int');
            }
        }
        return $profileModel->getItem($pk);
    }

    public function getUserId($pk = null)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName('created_by'))
            ->from($db->quoteName('#__journal_articles'))
            ->where($db->quoteName('id') . "=" . $pk);

        $db->setQuery($query);

        return $db->loadResult();
    }
}
