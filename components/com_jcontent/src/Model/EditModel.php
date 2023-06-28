<?php

namespace Kima\Component\jcontent\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Helper\TagsHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\Table\Table;
use Joomla\Database\ParameterType;
use Joomla\Registry\Registry;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\MVC\Model\AdminModel;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects


class EditModel extends AdminModel
{
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_jcontent.form', 'articlePass', array('control' => 'jform', 'load_data' => $loadData));

        // if (empty($form)) {
        //     $errors = $this->getErrors();
        //     throw new Exception(implode("\n", $errors), 500);
        // }

        return $form;
    }

    public function getTable($name = 'Article', $prefix = 'Administrator', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }
}
