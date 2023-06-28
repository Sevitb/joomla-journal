<?php

namespace Kima\Component\jcontent\Site\Controller;

use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

class DisplayController extends BaseController
{
    public function display($cachable = false, $urlparams = array()) 
    {
        $viewName = $this->input->get('view');

        if($viewName == 'SingleSeries'){
            $view = $this->getView($viewName, 'html');
            $view->setModel($this->getModel('Issue'));
            $view->setModel($this->getModel('Articles'));
            $view->setModel($this->getModel('Sections'));
        } elseif($viewName == 'issue'){
            $view = $this->getView($viewName, 'html');
            $view->setModel($this->getModel('Articles'));
            $view->setModel($this->getModel('Sections'));
        } elseif($viewName == 'form'){
            $view = $this->getView($viewName, 'html');
            $view->setModel($this->getModel('Sections'));
        }

        // $view = $this->getView('SingleSeries', 'html');
        // // echo $view;
        // $view->setModel($this->getModel('Issue'));
        // $view->setModel($this->getModel('Articles'));
        // $view->setModel($this->getModel('Sections'));

    

        // $issueView = $this->getView('Issue', 'html');
        
        // $issueView->setModel($this->getModel('Articles'));
        // $issueView->setModel($this->getModel('Sections'));

        return parent::display($cachable, $urlparams);
    }
}