<?php

namespace Kima\Component\jcontent\Site\Controller;

use Exception;
use Joomla\CMS\MVC\Controller\FormController as BaseFromController;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Path;
use Joomla\CMS\Language\Language;
use Joomla\CMS\User\User;
use Joomla\CMS\Helper\MediaHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use phpseclib3\Common\Functions\Strings;

defined('_JEXEC') or die;

class ReviewController extends BaseFromController
{
    public function display($cachable = false, $urlparams = array())
    {

        return parent::display($cachable, $urlparams);
    }

    public function save($key = null, $urlVar = null)
    {
        $mediaHelper = new MediaHelper();
        $app        = Factory::getApplication();
        $lang       = Language::getInstance('RU-ru');
        $userId       = Factory::getUser()->id;
        $user       = User::getInstance($userId);
        $currentUri = Uri::getInstance();
        $mailer     = Factory::getMailer();
        $input      = $app->input;
        $model      = $this->getModel('send');
        $issueModel = $this->getModel('issue');

        // if ($user->authorise("core.create", "com_jcontent")) {
        //     $app->enqueueMessage(Text::_('JERROR_ALERTNOAUTHOR'), 'error');
        //     $app->setHeader('status', 403, true);

        //     return;
        // }


        // get the data from the HTTP POST request
        $data = $input->get('jform', array(), 'array');
        $data['files'] = [];

        if (array_key_exists('files', $input->files->get('jform', array()))) {
            $files = $input->files->get('jform', array())['files'];

            foreach ($files as $key => $file) {
                if ($file['error'] == 4) {
                    $data['files'] = null;
                } elseif ($file['error'] > 0) {
                    $app->enqueueMessage(Text::sprintf('COM_JPROFILE_ERROR_FILEUPLOAD', $file['error']), 'warning');
                } elseif ($file['error'] == 0) {

                    $file['name'] = File::makeSafe($file['name']);

                    if (!isset($file['name'])) {
                        $app->enqueueMessage(Text::_('COM_JPROFILE_ERROR_BADFILENAME'), 'warning');
                    }

                    $file['name'] = str_replace(' ', '-', $file['name']);

                    $mediaHelper->canUpload($file);

                    $relativePathname = Path::clean('documents/materials/' . $userId . '/' . str_replace(' ', '_', trim(htmlspecialchars($data['title']))) . '/' . $file['name']);
                    $absolutePathname = JPATH_ROOT . '/' . $relativePathname;

                    if (File::exists($absolutePathname)) {
                        File::delete($absolutePathname);
                    }

                    if (!File::upload($file['tmp_name'], $absolutePathname)) {
                        $app->enqueueMessage(Text::_('COM_JPROFILE_ERROR_FILEUPLOAD'));
                    }

                    array_push($data['files'], $relativePathname);
                }
            }
        }

        $data['files'] = json_encode($data['files']);

        $context = "$this->option.edit.$this->context";

        $form = $model->getForm($data, false);

        if (!$form) {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }

        $validData = $model->validate($form, $data);


        if ($validData === false) {
            // Get the validation messages.
            $errors = $model->getErrors();

            // Display up to three validation messages to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
                if ($errors[$i] instanceof Exception) {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                } else {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }

            // Save the form data in the session.
            $app->setUserState($context . '.data', $data);

            // Redirect back to the same screen.
            $this->setRedirect($currentUri);

            return false;
        }

        $validData['alias'] = trim(str_replace(" ", "-", $lang->transliterate($validData['title'])));
        $validData['issue_id'] = $issueModel->getCurrentIssue();


        if (!$model->save($validData)) {
            // Handle the case where the save failed

            // Save the data in the session.
            $app->setUserState($context . '.data', $validData);

            // Redirect back to the edit screen.
            echo $model->getError();
            die();

            $this->setRedirect($currentUri, 'Что-то пошло не так. Пожалуйста, попробуйте позже.', 'error');

            return false;
        }

        // clear the data in the form
        $app->setUserState($context . '.data', null);


        $mailer->addRecipient('peskovatzkov.vs@gmail.com');
        $mailer->setSubject("Новая заявка на публикацию от пользователя" . $user->name);
        $mailer->setBody("Пользователь предоставил следующие данные " . $validData['created_by']);
        try {
            $mailer->send();
        } catch (Exception $e) {
            Log::add('Caught exception: ' . $e->getMessage(), Log::ERROR, 'jerror');
        }

        $this->setRedirect(
            $currentUri,
            Text::_('Спасибо, заявка успешно отправлена!')
        );


        return true;
    }
}
