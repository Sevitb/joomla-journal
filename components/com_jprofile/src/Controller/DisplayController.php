<?php

namespace Kima\Component\jprofile\Site\Controller;

use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

class DisplayController extends BaseController
{

    protected $default_view = 'profile';

    public function display($cachable = false, $urlparams = array())
    {
        $viewName = $this->input->get('view');

        if ($viewName == 'profile') {
            $view = $this->getView($viewName, 'html');
            $view->setModel($this->getModel('Subscriptions'));
            $view->setModel($this->getModel('Subscribers'));
        }

        return parent::display($cachable, $urlparams);
    }
}
