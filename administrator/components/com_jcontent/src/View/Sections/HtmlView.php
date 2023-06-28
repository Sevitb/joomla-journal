<?php

namespace Kima\Component\jcontent\Administrator\View\Sections;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\MVC\View\GenericDataException;

class HtmlView extends BaseHtmlView{

    /**
	 * An array of items
	 *
	 * @var  array
	 */
	protected $items;

    /**
	 * Display the view.
	 *
	 * @param   string|null  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}

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
		$toolbar->addNew('section.add');

		$toolbar->delete('sections.delete')
                    ->text('JTOOLBAR_EMPTY_TRASH')
                    ->message('JGLOBAL_CONFIRM_DELETE')
                    ->listCheck(true);

        ToolbarHelper::title('Разделы журнала','list.png');
    }
}