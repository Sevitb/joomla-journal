<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use jprofile\Library\User;
use jprofile\Library\UserHelper;

// No direct access to this file
defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$session = Factory::getSession();
$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseScript('bootstrap.dropdown', 'media/vendor/bootstrap/js/dropdown.min.js', $options = [], ['type' => 'module']);
$wa->registerAndUseScript('bootstrap.popper', 'media/vendor/bootstrap/js/popper.js', $options = [], ['type' => 'module']);

$wa->addInlineScript('$(function() {$(`[data-bs-toggle="dropdown"]`).dropdown();})');

$wa->registerAndUseStyle('layout.style.jusercard', 'media/layouts/css/journal/jprofile/jusercard/user-card.css');


// User info
$userId = isset($displayData->id) ? $displayData->id : null;
$userFirstName = isset($displayData->firstname) ? $displayData->firstname : null;
$userSecondName = isset($displayData->secondname) ? $displayData->secondname : null;
$userThirdName = isset($displayData->thirdname) ? $displayData->thirdname : null;
$userCity = isset($displayData->city) ? json_decode($displayData->city) : null;
$userAvatar = isset($displayData->avatar_image) ? $displayData->avatar_image : null;
$userEmail = isset($displayData->email) ? $displayData->email : null;
$userAcademicDegree = isset($displayData->academic_degree) ? $displayData->academic_degree : null;
$userAcademicTitle = isset($displayData->academic_title) ? $displayData->academic_title : null;
$userGroupId = isset($displayData->group_id) ? $displayData->group_id : null;

$isCurrentUser = $displayData->isCurrentUser;
$allowSubscribe = true;

switch ($userGroupId) {
    case 1:
    case 2:
    case 7:
    case 8:
    case 9:
        $userGroup = Text::_('TPL_USER_GROUP');
        $allowSubscribe = false;
        break;
    case 3:
        $userGroup = Text::_('TPL_AUTHOR_GROUP');
        break;
    case 4:
        $userGroup = Text::_('TPL_EDITOR_GROUP');
        break;
    case 10:
        $userGroup = Text::_('TPL_REVIEWER_GROUP');
        break;
    default:
        $userGroup = Text::_('TPL_NONE_GROUP');
        $allowSubscribe = false;
        break;
}

// User params
$showEmail = isset($displayData->show_email) && $displayData->show_email == 1 ? true : false;


?>
<div class="user-card">
    <?php if ($isCurrentUser) : ?>
        <a class="btn btn-white icon-ellipsis-h" href="<? echo Route::_('index.php?option=com_jprofile&view=profileedit&layout=edit&profile_id=' . $userId); ?>" data-bs-toggle="dropdown" aria-expanded="false" title="<?php echo Text::_('COM_JPROFILE_PROFILE_EDIT'); ?>">
        </a>
        <ul class="user-card__menu-list dropdown-menu">
            <li class="user-menu__menu-list-item dropdown-item ">
                <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profileedit&layout=edit&profile_id=' . $userId) ?>"> <span class="icon-cog"></span> Настройки</a>
            </li>
            <li class="user-menu__menu-list-item dropdown-item ">
                <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profileedit&layout=edit&profile_id=' . $userId) ?>"> <span class="icon-pencil"></span> Стать автором</a>
            </li>
        </ul>
    <?php endif; ?>
    <div class="user-card__row">
        <?php if ($userAvatar) : ?>
            <div class="user-card__avatar">
                <img class="user-card__avatar-image" src="<?php echo $userAvatar; ?>" alt="">
            </div>
        <?php else : ?>
            <div class="user-card__avatar">
                <img class="user-card__avatar-image" src="images/jprofile/avatars/default/banner.jpg" alt="">
            </div>
        <?php endif; ?>
        <div class="user-card__info">
            <h4 class="user-card__name h-4"><?php echo UserHelper::getFormattedName("S f t", array('firstname' => $userFirstName, 'secondname' => $userSecondName, 'thirdname' => $userThirdName)); ?></h4>
            <div class="user-card__group">
                <span class="icon-pencil-alt"></span>
                <span class="user-card__group-name" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo Text::_('COM_JPROFILE_USER_GROUP'); ?>">
                    <?php echo $userGroup ?>
                </span>
            </div>
            <div class="user-card__post">
                <p class="p">
                    <?php if ($userAcademicDegree) : ?>
                        <span class="user-card__academic-degree"><?php echo $userAcademicDegree; ?>, </span>
                    <?php endif; ?>
                    <?php if ($userAcademicTitle) : ?>
                        <span class="user-card__academic-title"><?php echo $userAcademicTitle; ?> </span>
                    <?php endif; ?>
                </p>
            </div>
            <?php if ($userCity) : ?>
                <div class="user-card__city">г. <?php echo $userCity->text; ?></div>
            <?php endif; ?>
            <?php if ($showEmail) : ?>
                <div class="user-card__email"><?php echo $userEmail; ?></div>
            <?php endif; ?>
            <?php if (!$isCurrentUser && $allowSubscribe && $session->get('current_user_id') != 0) : ?>
                <?php echo LayoutHelper::render('journal.jprofile.userSubscribeButton', $userId) ?>
            <?php endif; ?>
        </div>
    </div>
</div>