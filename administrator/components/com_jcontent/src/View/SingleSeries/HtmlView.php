<?php

namespace Kima\Component\jcontent\Administrator\View\SingleSeries;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Toolbar\ToolbarFactoryInterface;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView{

    /**
	 * Title of the page
	 *
	 * @var  string
	 */
    public $title;

	/**
     * The actions the user is authorised to perform
     *
     * @var  \Joomla\CMS\Object\CMSObject
     */
    protected $canDo;

    /**
	 * An item
	 *
	 * @var  object
	 */
	protected $item;

    /**
	 * Form
	 *
	 * @var  object
	 */
	protected $form;


    /**
	 * Display the view.
	 *
	 * @param   string|null  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}


		if ($this->getLayout() !== 'modal')
		{
			$this->addToolBar();
		}

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
        
		Factory::getApplication()->input->set('hidemainmenu', true);

		$user       = $this->getCurrentUser();
        $userId     = $user->id;
        $isNew      = ($this->item->id == 0);

		// Built the actions for new and existing records.
		$canDo = $this->canDo;

		ToolbarHelper::title($isNew ? "Добавить серию" : "Редактировать серию",'folder-open.png');

        ToolbarHelper::apply('singleseries.apply');
        ToolbarHelper::save('singleseries.save');
		ToolbarHelper::cancel('singleseries.cancel');
    }
}