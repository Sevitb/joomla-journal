<?php

namespace Kima\Component\jnotify\Site\Controller;

defined('_JEXEC') or die;

use Exception;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

class NotificationController extends BaseController
{

    public function delete($id = null)
    {
        $app = Factory::getApplication();
        $id = $app->input->getCmd('id');
        $model = $this->getModel();

        try {
            $model->delete($id);
            
            $app->enqueueMessage(Text::_('COM_JNOTIFY_NOTIFICATOIN_IS_DELETED'), 'message');
            $app->redirect(Route::_('index.php?option=com_jnotify&view=Notifications', false));
        } catch (Exception $e) {
            $app->enqueueMessage(Text::_('COM_JNOTIFY_DELETE_ERROR'), 'error');
            $app->redirect(Route::_('index.php?option=com_jnotify&view=Notifications', false));
        }
    }
}
