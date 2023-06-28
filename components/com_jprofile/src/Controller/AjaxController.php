<?php

namespace Kima\Component\jprofile\Site\Controller;

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
    public function getCities()
    {
        $country_id = $this->input->post->getInt('country_id', 1);
        $region_id = $this->input->post->getInt('region_id', 1);
        $query = $this->input->post->getString('q', '');

        switch (Factory::getLanguage()->getTag()) {
            case 'ru-RU':
                $lang = 0;
                break;
            case 'en-GB':
                $lang = 3;
                break;
            default:
                $lang = 0;
                break;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.vk.com/method/database.getCities',
            CURLOPT_POSTFIELDS => [
                'country_id' => $country_id,
                'region_id' => $region_id,
                'need_all' => 1,
                'q' => $query,
                'lang' => $lang,
                'v' => '5.131',
                'access_token' => '1df18d1b1df18d1b1df18d1bd31ee350b811df11df18d1b7e0c52fe2879d39278ce0ef6'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data'
            ]
        ]);

        $cities = json_decode(curl_exec($curl))->response->items;

        curl_close($curl);

        echo new JsonResponse(json_encode($cities));
    }

    public function getRegions()
    {
        $country_id = $this->input->post->getInt('country_id', 1);
        $query = $this->input->post->getString('q', '');

        switch (Factory::getLanguage()->getTag()) {
            case 'ru-RU':
                $lang = 0;
                break;
            case 'en-GB':
                $lang = 3;
                break;
            default:
                $lang = 0;
                break;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.vk.com/method/database.getRegions',
            CURLOPT_POSTFIELDS => [
                'country_id' => $country_id,
                'need_all' => 1,
                'q' => $query,
                'lang' => $lang,
                'v' => '5.131',
                'access_token' => '1df18d1b1df18d1b1df18d1bd31ee350b811df11df18d1b7e0c52fe2879d39278ce0ef6'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data'
            ]
        ]);

        $regions = json_decode(curl_exec($curl))->response->items;

        curl_close($curl);

        echo new JsonResponse(json_encode($regions));
    }

    public function getUniversities()
    {
        $country_id = $this->input->post->getInt('country_id', 1);
        $city_id = $this->input->post->getInt('city_id', 1);
        $query = $this->input->post->getString('q', '');

        switch (Factory::getLanguage()->getTag()) {
            case 'ru-RU':
                $lang = 0;
                break;
            case 'en-GB':
                $lang = 3;
                break;
            default:
                $lang = 0;
                break;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.vk.com/method/database.getUniversities',
            CURLOPT_POSTFIELDS => [
                'country_id' => $country_id,
                'city_id' => $city_id,
                'need_all' => 1,
                'q' => $query,
                'lang' => $lang,
                'v' => '5.131',
                'access_token' => '1df18d1b1df18d1b1df18d1bd31ee350b811df11df18d1b7e0c52fe2879d39278ce0ef6'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data'
            ]
        ]);

        $regions = json_decode(curl_exec($curl))->response->items;

        curl_close($curl);

        echo new JsonResponse(json_encode($regions));
    }

    public function getFaculties()
    {
        $university_id = $this->input->post->getInt('university_id', 1);

        switch (Factory::getLanguage()->getTag()) {
            case 'ru-RU':
                $lang = 0;
                break;
            case 'en-GB':
                $lang = 3;
                break;
            default:
                $lang = 0;
                break;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.vk.com/method/database.getFaculties',
            CURLOPT_POSTFIELDS => [
                'university_id' => $university_id,
                'need_all' => 1,
                'lang' => $lang,
                'v' => '5.131',
                'access_token' => '1df18d1b1df18d1b1df18d1bd31ee350b811df11df18d1b7e0c52fe2879d39278ce0ef6'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data'
            ]
        ]);


        $regions = json_decode(curl_exec($curl))->response->items;

        curl_close($curl);

        echo new JsonResponse(json_encode($regions));
    }

    public function subscribe()
    {
        $object_id = $this->input->post->getInt('object_id', 1);
        $subject_id = $this->input->post->getInt('subject_id', 1);

        if (UserHelper::isSubscribed($object_id, $subject_id)) {
            return false;
        } else {
            if (UserHelper::subscribe($object_id, $subject_id)) {
                echo new JsonResponse(json_encode(["done" => true]));
            } else {
                return false;
            }
        }
    }

    public function unsubscribe()
    {
        $object_id = $this->input->post->getInt('object_id', 1);
        $subject_id = $this->input->post->getInt('subject_id', 1);

        if (UserHelper::isSubscribed($object_id, $subject_id)) {
            if (UserHelper::unsubscribe($object_id, $subject_id)) {
                echo new JsonResponse(json_encode(["done" => true]));
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
