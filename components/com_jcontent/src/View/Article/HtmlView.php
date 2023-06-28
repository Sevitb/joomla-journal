<?php

namespace Kima\Component\jcontent\Site\View\Article;

use Exception;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{
    
    public function display($tpl = null)
    {
        // Default article item
        $this->item = $this->get('Item');

        if(empty($this->item)){
            throw new Exception(Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'), 404);
        }

        $model = $this->getModel('article');

        $model->increaseHits();
        
        $this->prepareDocument();

        parent::display($tpl);
    }
    protected function prepareDocument()
    {
        $this->setDocumentTitle(Text::_($this->item->title));
    }
}