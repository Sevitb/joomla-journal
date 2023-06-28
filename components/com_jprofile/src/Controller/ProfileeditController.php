<?php

namespace Kima\Component\jprofile\Site\Controller;

defined('_JEXEC') or die;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Path;
use Joomla\CMS\Helper\MediaHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\User\User;

class ProfileEditController extends BaseController
{
    public function save($key = null, $urlVar = null)
    {
        $mediaHelper = new MediaHelper();
        $app        = Factory::getApplication();
        $user       = User::getInstance();
        $currentUri = Uri::getInstance();
        $input      = $app->input;
        $model      = $this->getModel('profileedit');

        if ($user->authorise("core.edit.own", "com_jprofile")) {
            $app->enqueueMessage(Text::_('JERROR_ALERTNOAUTHOR'), 'error');
            $app->setHeader('status', 403, true);

            return;
        }

        // get the data from the HTTP POST request
        $data = $input->get('jform', array(), 'array');
        $avatarImageFile = $input->files->get('jform', array())['avatar_image'];


        if ($avatarImageFile['error'] == 4) {
            $data['avatar_image'] = null;
        } elseif ($avatarImageFile['error'] > 0) {
            $app->enqueueMessage(Text::sprintf('COM_JPROFILE_ERROR_FILEUPLOAD', $avatarImageFile['error']), 'warning');
        } elseif ($avatarImageFile['error'] == 0) {

            $avatarImageFile['name'] = File::makeSafe($avatarImageFile['name']);

            if (!isset($avatarImageFile['name'])) {
                $app->enqueueMessage(Text::_('COM_JPROFILE_ERROR_BADFILENAME'), 'warning');
            }

            $avatarImageFile['name'] = str_replace(' ', '-', $avatarImageFile['name']);

            $mediaHelper->canUpload($avatarImageFile);

            $relativePathname = Path::clean('images/jprofile/avatars/' . $data['id'] . '/' . $avatarImageFile['name']);
            $absolutePathname = JPATH_ROOT . '/' . $relativePathname;

            if (File::exists($absolutePathname)) {
                File::delete($absolutePathname);
            }

            if (!File::upload($avatarImageFile['tmp_name'], $absolutePathname)) {
                $app->enqueueMessage(Text::_('COM_JPROFILE_ERROR_FILEUPLOAD'));
            }

            $data['avatar_image'] = $relativePathname;
        }

        $context = $this->option . ".edit." . $this->context;

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

        if (!$model->save($validData)) {
            // Handle the case where the save failed

            // Save the data in the session.
            $app->setUserState($context . '.data', $validData);

            // Redirect back to the edit screen.
            echo $model->getError();

            $this->setRedirect($currentUri, 'Что-то пошло не так. Пожалуйста, попробуйте позже.', 'error');

            return false;
        }

        // clear the data in the form
        $app->setUserState($context . '.data', null);

        $this->setRedirect(
            $currentUri,
            Text::_('Данные сохранены!')
        );


        return true;
    }
}
