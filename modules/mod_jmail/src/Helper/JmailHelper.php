<?php

namespace Joomla\Module\Jmail\Site\Helper;

use Joomla\CMS\Factory;
use Joomla\CMS\Mail\Mail;

defined('_JEXEC') or die;

class JmailHelper
{
    public static function getText()
    {
        return 'FooHelpertest';
    }

    public function sendMail()
    {
        $app = Factory::getApplication();
        $mailer = Factory::getMailer();

        $form = $app->input->getArray($_POST);

        if (isset($form['name'])) {
            $name = (string) htmlspecialchars($form['name']);
            $email = (string) htmlspecialchars($form['email']);
            $subject = (string) htmlspecialchars($form['subject']);
            $message = (string) htmlspecialchars($form['message']);

            $recipient = 'peskovatzkov.vs@gmail.com';
            $body = "<h2>{$subject}</h2>"
                ."<p>{$message}</p>"
                ."<p>Email отправителя: {$email}</p>";

            $mailer->isHtml(true);
            // $mailer->Encoding = 'base64';
            $mailer->addRecipient($recipient);
            $mailer->setSubject('Обратная связь с контактной формы Вестника консорциума!');
            $mailer->setBody($body);

            $send = $mailer->Send();
            if ($send === true) {
                return true;
            } else {
                return false;
            }
        }
        return '';
    }
}
