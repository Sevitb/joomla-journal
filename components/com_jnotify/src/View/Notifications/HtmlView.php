<?php

namespace Kima\Component\jnotify\Site\View\Notifications;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\Toolbar;

class HtmlView extends BaseHtmlView
{

    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    public $pagination;

    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');


        $user = Factory::getUser();
        $app = Factory::getApplication();
        $document = $app->getDocument();

        $document->setTitle($app->getCfg('sitename') . ' - ' . Text::_('COM_JNOTIFY_NOTIFICATIONS'));

        if ($user->id == 0) {
            $app->enqueueMessage(Text::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'), 'error');
            $app->redirect(Route::_('index.php?option=com_users&view=login'));
        }

        parent::display($tpl);
    }

    public function addToolbar()
    {
        $toolbar = new Toolbar('toolbar');


        $toolbar->appendButton('Standard', 'delete', 'Удалить', 'Notification.delete', false);

        return $toolbar->render();
    }
}
