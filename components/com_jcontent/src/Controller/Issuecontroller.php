<?php


namespace Kima\Component\jcontent\Site\Controller;

use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;



class IssueController extends BaseController
{
    public function display($cachable = false, $urlparams = array())
    {
        // $view = $this->getView('Issue', 'html');
        // $view->setModel($this->getModel('Articles'));
        // $view->setModel($this->getModel('Sections'));

        return parent::display($cachable, $urlparams);
    }
}
