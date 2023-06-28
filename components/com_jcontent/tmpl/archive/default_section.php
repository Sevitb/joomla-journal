<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

$issueId    = isset($this->issueItem->id) ? $this->issueItem->id : '';
$issueTitle = isset($this->issueItem->title) ? $this->issueItem->title : 'Без названия';
$issueYear  = isset($this->issueItem->publish_up) ? date("Y", strtotime($this->issueItem->publish_up)) : null;


?>
<?php if ($this->issueItem) : ?>
    <div class="section-card" id="<?php echo $issueYear ?>">
        <div class="section-card__title-container">
            <h4 class="section-card__title h-4"><?php echo $issueYear ?></h4>
        </div>
        <div class="section-card__issues-grid">
            <?php foreach ($this->issuesItems as $issueItem) : ?>
                <?php if (date("Y", strtotime($issueItem->publish_up)) === $issueYear) : ?>
                    <a class="section-card__issue-btn btn btn-white" href="<?php echo Route::_('/index.php?option=com_jcontent&view=issue&issue_id=' . $issueId); ?>">№<?php echo $issueItem->number ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>