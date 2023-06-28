<?php

namespace jprofile\Library;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\User\UserHelper as JoomlaUserHelper;

class UserHelper extends JoomlaUserHelper
{
    public static function getFormattedName(string $format, array $name)
    {
        $params = explode(' ', $format, 3);
        $result = "";

        if (!$name['secondname'] && !$name['thirdname']) {
            $result = ucfirst($name['firstname']);
        } else {
            foreach ($params as $param) {
                foreach ($name as $key => $namePart) {
                    if ($namePart) {
                        if (substr($key, 0, 1) == $param || strtoupper(substr($key, 0, 1)) == $param) {
                            if (ctype_upper($param)) {
                                $result .= ' ' . ucfirst($namePart) . ' ';
                            } else {
                                $result .= strtoupper(mb_substr($namePart, 0, 1, "UTF-8") . '.');
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }

    public static function getCardData($userId)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName(array('firstname', 'secondname', 'thirdname', 'avatar_image', 'city', 'country', 'organization')))
            ->from($db->quoteName('#__journal_users'))
            ->where($db->quoteName('id') . '=' . $userId);

        return $db->setQuery($query)->loadObject();
    }

    public static function getProfileData($userId)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__journal_users'))
            ->where($db->quoteName('id') . '=' . $userId);

        return $db->setQuery($query)->loadObject();
    }

    public static function getAuthorsNames($createdBy = null, $coAuthors = null)
    {
        if ($createdBy) {
            $authorsIds = [$createdBy];
        } else {
            $authorsIds = [];
        }

        foreach (json_decode($coAuthors) as $key => $value) {
            array_push($authorsIds, (int) $value->id);
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $authorsNames = [];

        $query->select($db->quoteName(array('id', 'firstname', 'secondname', 'thirdname')))
            ->from($db->quoteName('#__journal_users'));

        foreach ($authorsIds as $authorId) {
            $query->where($db->quoteName('id') . '=' . $authorId, 'OR');
        }

        $authors = $db->setQuery($query)->loadObjectList();

        foreach ($authors as $key => $author) {
            array_push($authorsNames, ['id' => $author->id, 'name' => self::getFormattedName('S f t', ['firstname' => $author->firstname, 'secondname' => $author->secondname, 'thirdname' => $author->thirdname])]);
        }

        return $authorsNames;
    }

    public static function isSubscribed($objectId, $subjectId)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName('subscribtion_id'))
            ->from($db->quoteName('#__journal_subscriptions'))
            ->where($db->quoteName('object_id') . '=' . $objectId)
            ->where($db->quoteName('subject_id') . '=' . $subjectId);

        if (!$db->setQuery($query)->loadObject()) {
            return false;
        }
        return true;
    }

    public static function subscribe($objectId, $subjectId)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->insert('#__journal_subscriptions')
            ->columns($db->quoteName(array('object_id', 'subject_id')))
            ->values("'" . $objectId . "','" . $subjectId . "'");

        return $db->setQuery($query)->execute();
    }

    public static function unsubscribe($objectId, $subjectId)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->delete('#__journal_subscriptions')
            ->where($db->quoteName('object_id') . '=' . $objectId)
            ->where($db->quoteName('subject_id') . '=' . $subjectId);

        return $db->setQuery($query)->execute();
    }
}
