<?php

namespace Kima\Component\jcontent\Site\View\Issue;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{

    public function display($tpl = null)
    {
        // Default article item
        $this->issueItem = $this->get('Item');
        // Get sections and articles 
        $this->articlesItems = $this->get('Items','Articles');
        $this->sectionsItems = $this->get('Items','Sections');

        $this->prepareDocument();

        parent::display($tpl);
    }

    protected function prepareDocument()
    {
        $this->setDocumentTitle(Text::_('COM_JCONTENT_ISSUE'));
    }
}
