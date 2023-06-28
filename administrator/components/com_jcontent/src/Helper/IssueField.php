<?php

namespace Kima\Component\jcontent\Administrator\Field\Modal;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;


defined('_JEXEC') or die;


/**
 * Supports a modal series picker.
 *
 * @since  1.6
 */
class IssueField extends FormField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.6
     */
    protected $type = 'Modal_Issue';
}