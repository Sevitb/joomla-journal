<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use jprofile\Library\UserHelper;

defined('_JEXEC') or die;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();
$session = Factory::getSession();
$wa = $this->document->getWebAssetManager();

$userCountry = isset(json_decode($this->item->country)->text) ? json_decode($this->item->country)->text : null;
$userCity = isset(json_decode($this->item->city)->text) ? json_decode($this->item->city)->text : null;
$userOrganization = isset(json_decode($this->item->organization)->text) ? json_decode($this->item->organization)->text : null;


?>
<div class="subscriber-card">
    <div class="subscriber-card__avatar">
        <?php echo LayoutHelper::render('journal.jprofile.userAvatar', $this->item->avatar_image, null, ['size' => 'middle']) ?>
    </div>
    <div class="subscriber-card__user-info">
        <h4 class="subscriber-card__name h-4">
            <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $this->item->id); ?>">
                <?php echo UserHelper::getFormattedName('S f t', ['firstname' => $this->item->firstname, 'secondname' => $this->item->secondname, 'thirdname' => $this->item->thirdname]) ?>
            </a>
        </h4>
        <div class="subscriber-card__university">
            <?php echo $userOrganization; ?>
        </div>
        <div class="subscriber-card__geo">
            <?php if ($userCity) : ?>
                <span class="subscriber-card__city"><?php echo $userCity ?></span>
            <?php endif; ?>
            <?php if ($userCity) : ?>
                <span class="subscriber-card__country"><?php echo $userCountry ?></span>
            <?php endif; ?>
        </div>
        <div class="subscriber-card__controls-btn">
            <?php if($this->item->id != $session->get('current_user_id') && $session->get('current_user_id') != 0): ?>
                <?php echo LayoutHelper::render('journal.jprofile.userSubscribeButton', $this->item->id) ?>
            <?php endif; ?>
        </div>
    </div>
</div>