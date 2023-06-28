<?php

namespace Kima\Component\jprofile\Site\View\ProfileEdit;

defined('_JEXEC') or die;

use Exception;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{

    protected $item;

    protected $form;

    public function display($tpl = null)
    {
        $app = Factory::getApplication();
        $user = Factory::getUser();
        $input = $app->input;
        $profileId = $input->getCmd('profile_id');

        if (empty($profileId)) {
            throw new Exception(Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'), 404);
        }

        if ($user->id != $profileId) {
            $app->redirect(Route::_('index.php?option=com_jprofile&view=profileedit&layout=edit&profile_id=' . $user->id));
        }
        // Get the form to display
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $app = Factory::getApplication();

        $this->prepareDocument();

        // Call the parent display to display the layout file
        parent::display($tpl);
    }

    protected function prepareDocument()
    {
        Text::script('COM_JPROFILE_SELECT_VALUE');

        $this->setDocumentTitle(Text::_('COM_JPROFILE_PROFILE_EDIT'));
    }
}
