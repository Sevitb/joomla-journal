<?php

namespace Kima\Component\jcontent\Site\View\Archive;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{
    
    public function display($tpl = null)
    {
        // Issues items
        $this->issuesItems = $this->get('Items');

        $this->prepareDocument();
        
        parent::display($tpl);
    }

    protected function prepareDocument()
    {
        $this->setDocumentTitle(Text::_('COM_JCONTENT_ARCHIVE'));
    }
}