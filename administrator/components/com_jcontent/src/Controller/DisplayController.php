<?php

namespace Kima\Component\jcontent\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

class DisplayController extends BaseController
{
    /**
     * The default view.
     *
     * @var    string
     * @since  1.6
     */
    protected $default_view = 'dashboard';

    /**
     * Method to display a view.
     *
     * @param   boolean  $cachable   If true, the view output will be cached
     * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return  BaseController|boolean  This object to support chaining.
     *
     * @since   1.5
     */
    public function display($cachable = false, $urlparams = array())
    {
        // Get the document object.
		$document = Factory::getDocument();
        $vName    = $this->input->get('view', 'dashboard');
        $lName    = $this->input->get('layout', 'default');
        $vFormat  = $document->getType();
        $id       = $this->input->getInt('id');

        // Check for edit form.
        if ($vName == 'singleseries' && $lName == 'edit' && !$this->checkEditId('com_jcontent.edit.singleseries', $id)) {
            // Somehow the person just went to the form - we don't allow that.
            if (!\count($this->app->getMessageQueue())) {
                $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id), 'error');
            }

            $this->setRedirect(Route::_('index.php?option=com_jcontent&view=series', false));

            return false;
        }
        
        
        // if ($view = $this->getView($vName, $vFormat))
		// {
		// 	// Get the model for the view.
		// 	$model = $this->getModel($vName);
            
		// 	// Push the model into the view (as default).
		// 	$view->setModel($model, true);
		// 	$view->setLayout($lName);

		// 	// Push document object into the view.
		// 	$view->document = $document;
		// 	$view->display();
		// }

        return parent::display($cachable, $urlparams);
    }
}
