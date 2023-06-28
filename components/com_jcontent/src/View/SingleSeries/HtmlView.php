<?php

namespace Kima\Component\jcontent\Site\View\SingleSeries;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{
 
    public $issueItem;
    
    public function display($tpl = null)
    {

        // Default series item
        $this->item          = $this->get('Item');
        // Get published issue
        $this->issueItem     = $this->get('Item','Issue');
        // Get sections and articles 
        $this->articlesItems = $this->get('Items','Articles');
        $this->sectionsItems = $this->get('Items','Sections');

        $this->prepareDocument();
        
        parent::display($tpl);
    }

    protected function prepareDocument()
    {
        $this->setDocumentTitle(Text::_($this->item->title));
    }
}