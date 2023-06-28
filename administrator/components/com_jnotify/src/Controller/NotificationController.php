<?php

namespace Kima\Component\jnotify\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Table\Table;
use jnotify\Library\Notification;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

class NotificationController extends FormController
{
    public function save($key = null, $urlVar = null)
    {
        $app        = Factory::getApplication();
        $notification = new Notification();
        $input      = $app->input;
        $data = $input->get('jform', array(), 'array');

        $userGroup = isset($data['usergroup']) ? $data['usergroup'] : null;
        $customSubject = isset($data['custom_subject']) ? $data['custom_subject'] : null;
        $customMessage = isset($data['custom_message']) ? $data['custom_message'] : null;

        if ($userGroup == 1 || $userGroup == 9) {
            if (!$data['user_id_to']) {
                $app->enqueueMessage('Данным группам пользователей нельзя отправлять оповещения', 'warning');
                $app->redirect(Route::_('index.php?option=com_jnotify'));
            } else {
                if ($data['type'] == 1) {
                    $notification->sendForUser($data['type'], $data['user_id_to'], $data['material_id'], $data['custom_subject'], $data['custom_message']);
                    $app->enqueueMessage(Text::_('JLIB_APPLICATION_SAVE_SUCCESS'), 'message');
                    $app->redirect(Route::_('index.php?option=com_jnotify'));
                } else {
                    $notification->sendForUser($data['type'], $data['user_id_to'], $data['material_id']);
                    $app->enqueueMessage(Text::_('JLIB_APPLICATION_SAVE_SUCCESS'), 'message');
                    $app->redirect(Route::_('index.php?option=com_jnotify'));
                }
            }
        } else {
            if ($data['type'] == 1) {
                $notification->sendForUserGroup($data['type'], $userGroup, $data['material_id'], $customSubject, $customMessage);
                $app->enqueueMessage(Text::_('JLIB_APPLICATION_SAVE_SUCCESS'), 'message');
                $app->redirect(Route::_('index.php?option=com_jnotify'));
            } else {
                $notification->sendForUserGroup($data['type'], $userGroup, $data['material_id']);
                $app->enqueueMessage(Text::_('JLIB_APPLICATION_SAVE_SUCCESS'), 'message');
                $app->redirect(Route::_('index.php?option=com_jnotify'));
            }
        }
    }
}
