<?php

namespace jnotify\Library;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

class Notification
{

    protected $db;

    public $app;

    public function __construct()
    {
        $this->db = Factory::getDbo();
        $this->app = Factory::getApplication();
    }

    public function sendForUser($notificationType, $userId, $materialId = null, $subject = null, $message = null)
    {
        try {
            $this->insertData($notificationType, $userId, null, $materialId, $subject, $message);
            $emailList = $this->getUsersEmail($userId);
            $this->sendMail($subject, $message, $materialId, $emailList, $notificationType);
        } catch (Exception $e) {
            $this->app->enqueueMessage($e->getMessage(), 'error');
            $this->app->redirect(Uri::getInstance()->toString());
        }
    }

    public function sendForUserGroup($notificationType, $userGroupId, $materialId = null, $subject = null, $message = null)
    {
        try {
            $this->insertData($notificationType, null, $userGroupId, $materialId, $subject, $message);
            $emailList = $this->getUsersEmail(null, $userGroupId);
            $this->sendMail($subject, $message, $materialId, $emailList, $notificationType);
        } catch (Exception $e) {
            $this->app->enqueueMessage($e->getMessage(), 'error');
            $this->app->redirect(Uri::getInstance()->toString());
        }
    }

    protected function insertData($notificationType, $userId = null, $userGroupId = null, $materialId = null, $subject = null, $message = null)
    {
        $query = $this->db->getQuery(true);

        $columns = array(
            'user_id_to',
            'date_time',
            'state',
            'custom_subject',
            'custom_message',
            'type'
        );

        if (!empty($materialId)) {
            $columns[] = 'material_id';
        }

        $query->insert($this->db->quoteName('#__journal_notifications'))
            ->columns($this->db->quoteName($columns));

        if ($userId && $userId != 0) {

            $values = array(
                $this->db->quote($userId),
                $this->db->quote(Factory::getDate('now')->toSql()),
                $this->db->quote(0), 
                $this->db->quote($subject),
                $this->db->quote($message),
                $this->db->quote($notificationType)
            );
            if (!empty($materialId)) {
                $values[] = $this->db->quote($materialId);
            }

            $query->values(implode(",", $values));
        }

        if ($userGroupId) {

            $usersId = $this->getUsersId($userGroupId);

            if (!$usersId) {
                throw new Exception("К данной группе не принадлежит ни один пользователь!", 1);
            }

            foreach ($usersId as $userIdFromGroup) {
                $values = array(
                    $this->db->quote($userIdFromGroup),
                    $this->db->quote(Factory::getDate('now')->toSql()),
                    $this->db->quote(0),
                    $this->db->quote($subject),
                    $this->db->quote($message),
                    $this->db->quote($notificationType),
                );
                if (!empty($materialId)) {
                    $values[] = $this->db->quote($materialId);
                }
                $query->values(implode(",", $values));
            }
        }

        $this->db->setQuery($query);
        $this->db->execute();
    }

    protected function getUsersId($userGroupId)
    {
        $query = $this->db->getQuery(true);

        $query->select($this->db->quoteName('user_id'))
            ->from($this->db->quoteName('#__user_usergroup_map'))
            ->where($this->db->quoteName('group_id') . ' = ' . $userGroupId);

        $this->db->setQuery($query);

        return $this->db->loadColumn();
    }

    protected function getUsersEmail($userId = null, $userGroupId = null)
    {
        if ($userId) {
            $query = $this->db->getQuery(true);

            $query->select($this->db->quoteName('email'))
                ->from($this->db->quoteName('#__users'))
                ->where($this->db->quoteName('id') . ' = ' . $userId);

            $this->db->setQuery($query);

            return $this->db->loadResult();
        } else {
            if ($userGroupId) {

                $usersId = $this->getUsersId($userGroupId);

                if (!$usersId) {
                    throw new Exception("К данной группе не принадлежит ни один пользователь!", 1);
                }

                $query = $this->db->getQuery(true);

                $query->select($this->db->quoteName('email'))
                    ->from($this->db->quoteName('#__users'));



                foreach ($usersId as $userId) {
                    if ($userId != end($usersId)) {
                        $query->where($this->db->quoteName('id') . ' = ' . $userId, 'OR');
                    } else {
                        $query->where($this->db->quoteName('id') . ' = ' . $userId);
                    }
                }

                $this->db->setQuery($query);

                return $this->db->loadColumn();
            } else {
                throw new Exception("Не удалось отправить оповещение на почту.", 1);
            }
        }
    }

    protected function getNotificationData($notificationType)
    {
        $query = $this->db->getQuery(true);

        $query->select($this->db->quoteName(array('subject_constant', 'message_constant')))
            ->from($this->db->quoteName('#__journal_notifications_types'))
            ->where($this->db->quoteName('id') . ' = ' . $notificationType);

        $this->db->setQuery($query);

        return $this->db->loadObject();
    }

    public function sendMail($subject, $message, $materialId, $emailList, $notificationType)
    {
        $mailer = Factory::getMailer();

        if ($notificationType == 1) {
            $mailer->setSubject($subject);
            $mailer->setBody($message);
        } else {
            $notificationData = $this->getNotificationData($notificationType);
            $mailer->setSubject(Text::_($notificationData->subject_constant));
            $mailer->setBody(Text::_($notificationData->message_constant));
        }

        $mailer->addRecipient($emailList);

        if (!$mailer->Send()) {
            throw new Exception("Не удалось отправить сообщение на email.", 1);
            
        }
    }

    public function render($notificationType)
    {
    }
}
