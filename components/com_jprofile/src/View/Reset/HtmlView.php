<?php

namespace Kima\Component\jprofile\Site\View\Reset;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Object\CMSObject;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Reset view class for Users.
 *
 * @since  1.5
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The Form object
     *
     * @var  \Joomla\CMS\Form\Form
     */
    protected $form;

    /**
     * The page parameters
     *
     * @var  \Joomla\Registry\Registry|null
     */
    protected $params;

    /**
     * The model state
     *
     * @var  CMSObject
     */
    protected $state;

    /**
     * The page class suffix
     *
     * @var    string
     * @since  4.0.0
     */
    protected $pageclass_sfx = '';

    /**
     * Method to display the view.
     *
     * @param   string  $tpl  The template file to include
     *
     * @return  mixed
     *
     * @since   1.5
     */
    public function display($tpl = null)
    {
        if (Factory::getUser()->id === 0) {
            throw new Exception(Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'), 404);
        }

        // This name will be used to get the model
        $name = $this->getLayout();

        // Check that the name is valid - has an associated model.
        if (!in_array($name, array('confirm', 'complete'))) {
            $name = 'default';
        }

        if ('default' === $name) {
            $formname = 'Form';
        } else {
            $formname = ucfirst($this->_name) . ucfirst($name) . 'Form';
        }

        // Get the view data.
        $this->form   = $this->get($formname);
        $this->state  = $this->get('State');
        $this->params = $this->state->params;

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new GenericDataException(implode("\n", $errors), 500);
        }

        // Escape strings for HTML output
        $this->pageclass_sfx = htmlspecialchars($this->params->get('pageclass_sfx', ''), ENT_COMPAT, 'UTF-8');

        $this->prepareDocument();

        parent::display($tpl);
    }

    /**
     * Prepares the document.
     *
     * @return  void
     *
     * @since   1.6
     * @throws  \Exception
     */
    protected function prepareDocument()
    {

        $this->params->def('page_heading', Text::_('COM_USERS_RESET'));

        $this->setDocumentTitle(Text::_('COM_JPROFILE_RESET_REQUEST_LABEL'));

        if ($this->params->get('menu-meta_description')) {
            $this->document->setDescription($this->params->get('menu-meta_description'));
        }

        if ($this->params->get('robots')) {
            $this->document->setMetaData('robots', $this->params->get('robots'));
        }
    }
}
