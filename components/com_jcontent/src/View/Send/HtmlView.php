<?php

namespace Kima\Component\jcontent\Site\View\Send;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\TagsHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Plugin\PluginHelper;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * HTML Article View class for the Content component
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
     * The item being created
     *
     * @var  \stdClass
     */
    protected $item;

    /**
     * The page to return to after the article is submitted
     *
     * @var  string
     */
    protected $return_page = '';

    /**
     * The model state
     *
     * @var  \Joomla\CMS\Object\CMSObject
     */
    protected $state;

    /**
     * The page parameters
     *
     * @var    \Joomla\Registry\Registry|null
     *
     * @since  4.0.0
     */
    protected $params = null;

    /**
     * The page class suffix
     *
     * @var    string
     *
     * @since  4.0.0
     */
    protected $pageclass_sfx = '';

    /**
     * The user object
     *
     * @var \Joomla\CMS\User\User
     *
     * @since  4.0.0
     */
    protected $user = null;

    /**
     * Should we show a captcha form for the submission of the article?
     *
     * @var    boolean
     *
     * @since  3.7.0
     */
    protected $captchaEnabled = false;

    /**
     * Should we show Save As Copy button?
     *
     * @var    boolean
     * @since  4.1.0
     */
    protected $showSaveAsCopy = false;

    /**
     * Execute and display a template script.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void|boolean
     */
    public function display($tpl = null)
    {
        $app  = Factory::getApplication();
        $user = $app->getIdentity();

        // Get model data.
        $this->item        = $this->get('Item');
        $this->form        = $this->get('Form');

        $this->sectionsItems = $this->get('Items','Sections');

        $this->prepareDocument();

        parent::display($tpl);
    }

    protected function prepareDocument()
    {
        $this->setDocumentTitle(Text::_('COM_JCONTENT_SEND_AN_ARTICLE'));
    }

}
