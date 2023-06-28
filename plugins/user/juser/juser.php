<?php

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\LanguageFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Mail\MailTemplate;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\User\User;
use Joomla\CMS\User\UserHelper;
use Joomla\Database\Exception\ExecutionFailureException;
use Joomla\Database\ParameterType;
use Joomla\Registry\Registry;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects


class PlgUserJuser extends CMSPlugin
{

    protected $app;

    protected $db;

    public function onUserAfterSave($user, $isNew, $success, $msg)
    {

        $this->db = Factory::getDbo();
        $this->app = Factory::getApplication();

        if ($isNew) {
            try {
                $this->db->setQuery(
                    $this->db->getQuery(true)
                        ->insert($this->db->quoteName('#__journal_users'))
                        ->columns($this->db->quoteName(array('id', 'user_id', 'firstname')))
                        ->values(' " ' . $user['id'] . '" , "' . $user['id'] . '" , "' . $user['name'] . '"')
                )->execute();
            } catch (Exception $e) {
                $this->app->enqueueMessage($e->getMessage(), 'error');
            }
            try {
                $this->db->setQuery(
                    $this->db->getQuery(true)
                        ->insert($this->db->quoteName('#__journal_user_params'))
                        ->columns($this->db->quoteName('user_id'))
                        ->values("'" .  $user['id'] . "'" )
                )->execute();
            } catch (Exception $e) {
                $this->app->enqueueMessage($e->getMessage(), 'error');
            }
        } else {
            return;
        }
    }
}
