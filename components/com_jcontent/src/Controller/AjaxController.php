<?php

namespace Kima\Component\jcontent\Site\Controller;

use Exception;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Path;
use Joomla\CMS\Helper\MediaHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\User\User;
use Joomla\CMS\Session\Session;
use jprofile\Library\UserHelper;

Session::checkToken() or die(Text::_('JINVALID_TOKEN'));

class AjaxController extends BaseController
{

    public function getAuthors()
    {
        $q = $this->input->post->getString('q', '');

        $session = Factory::getSession();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName(array('id', 'firstname', 'secondname', 'thirdname')))
            ->from($db->quoteName('#__journal_users'))
            ->where($db->quoteName('firstname') . 'LIKE ' . $db->quote('%' . $q . '%'), 'OR')
            ->where($db->quoteName('secondname') . 'LIKE ' . $db->quote('%' . $q . '%'), 'OR')
            ->where($db->quoteName('thirdname') . 'LIKE ' . $db->quote('%' . $q . '%'));

        $authors = $db->setQuery($query)->loadObjectList();

        $authorsJson = array();

        foreach ($authors as $author) {
            if ($author->id == $session->get('current_user_id')){
                continue;
            }
            $authorJson = array('id' => $author->id, 'text' => UserHelper::getFormattedName("S f t", array('firstname' => $author->firstname, 'secondname' => $author->secondname, 'thirdname' => $author->thirdname)));
            array_push($authorsJson, $authorJson);
        }

        echo new JsonResponse(json_encode($authorsJson));
    }

    public function getReviewers()
    {
        $q = $this->input->post->getString('q', '');

        $session = Factory::getSession();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName(array('journal_users.id', 'journal_users.firstname', 'journal_users.secondname', 'journal_users.thirdname')))
            ->from($db->quoteName('#__journal_users', 'journal_users'))
            ->join('INNER', $db->quoteName('#__user_usergroup_map', 'usergroup') . 'ON' . $db->quoteName('usergroup.user_id') . '=' . $db->quoteName('journal_users.id'))
            ->where(
                '(' . $db->quoteName('journal_users.firstname') . 'LIKE ' . $db->quote('%' . $q . '%')
                . 'OR'
                    . $db->quoteName('journal_users.secondname') . 'LIKE ' . $db->quote('%' . $q . '%')
                . 'OR'
                    . $db->quoteName('journal_users.thirdname') . 'LIKE ' . $db->quote('%' . $q . '%')
                    . ')' 
                . 'AND'
                . $db->quoteName('usergroup.group_id') . '=' .  10
            );

        $authors = $db->setQuery($query)->loadObjectList();

        $authorsJson = array();

        foreach ($authors as $author) {
            if ($author->id == $session->get('current_user_id')){
                continue;
            }
            $authorJson = array('id' => $author->id, 'text' => UserHelper::getFormattedName("S f t", array('firstname' => $author->firstname, 'secondname' => $author->secondname, 'thirdname' => $author->thirdname)));
            array_push($authorsJson, $authorJson);
        }

        echo new JsonResponse(json_encode($authorsJson));
    }
}
