<?php

namespace Kima\Component\jprofile\Site\View\Profile;

defined('_JEXEC') or die;

use Exception;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{

    /**
     * An array of items
     *
     * @var  array
     */
    protected $userItem;

    protected $userPublicationInfo;

    protected $subscribers;

    public $subscribersCount;

    protected $subscriptions;

    public $subscriptionsCount;

    public $subscribersPagination;

    public $subscriptionsPagination;

    public function display($tpl = null)
    {

        $app = Factory::getApplication();
        $input = $app->input;
        $user = Factory::getUser();

        $profileId = $input->getCmd('profile_id');

        if(empty($profileId) || empty(Factory::getUser($profileId)->id)){
            throw new Exception(Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'), 404);
        }

        $this->userItem = $this->get('Item');
        $this->userPublicationInfo = $this->get('PublicationInfo');
        $this->subscribers = $this->get('Items','Subscribers');
        $this->subscribersCount = $this->get('Total','Subscribers');
        $this->subscriptions = $this->get('Items','Subscriptions');
        $this->subscriptionsCount = $this->get('Total','Subscriptions');
        $this->subscribersPagination = $this->get('Pagination','Subscribers');
        $this->subscriptionsPagination = $this->get('Pagination','Subscriptions');

        $this->prepareDocument();

        parent::display($tpl);
    }


    protected function prepareDocument()
    {
        $this->setDocumentTitle(Text::_('COM_JPROFILE_PROFILE'));
    }
}
