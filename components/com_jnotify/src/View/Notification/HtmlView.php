<?php

namespace Kima\Component\jnotify\Site\View\Notification;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use jnotify\Library\Notification;
use Joomla\CMS\Toolbar\Toolbar;

class HtmlView extends BaseHtmlView
{

    /**
     * An array of items
     *
     * @var  array
     */
    protected $item;

    public $pagination;

    public function display($tpl = null)
    {
        $this->item = $this->get('Item');

        $user = Factory::getUser();
        $notification = new Notification();
        $app = Factory::getApplication();
        $document = $app->getDocument();
        $model = $this->getModel('notification');

        if ($this->item->state == 0) {
            $model->makeAsRead();
        }

        // $notification->sendForUser(1, 585, "Это тестовое оповещение из кода!", "Вот");
        // $notification->sendForUserGroup(1, 8, "Это тестовое оповещение из кода для группы пользователей!", "Вот!");


        if ($this->item->type == 1) {
            $document->setTitle($app->getCfg('sitename') . ' - ' . $this->item->custom_subject);
        } else{
            $document->setTitle($app->getCfg('sitename') . ' - ' . $this->item->subject_constant);
        }

        if ($user->id == 0) {
            $app->enqueueMessage(Text::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'), 'error');
            $app->redirect(Route::_('index.php?option=com_users&view=login'));
        }

        parent::display($tpl);
    }

    public function addToolbar()
    {
        $toolbar = new Toolbar('toolbar');

        $toolbar->appendButton('Standard', 'delete', 'Удалить', 'notification.delete', false);

        return $toolbar->render();
    }
}
