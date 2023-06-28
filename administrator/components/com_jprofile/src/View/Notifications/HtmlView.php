<?php

namespace Kima\Component\jnotify\Administrator\View\Notifications;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView 
{

      /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    public function display($tpl = null) 
    {

        $this->addToolbar();
        
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function addToolbar()
    {
        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');
        $toolbar->addNew('article.add');

        $toolbar->delete('articles.delete')
            ->text('JTOOLBAR_EMPTY_TRASH')
            ->message('JGLOBAL_CONFIRM_DELETE')
            ->listCheck(true);

        ToolbarHelper::title('Статьи', 'file-alt.png');
    }
}

?>