<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Layout\LayoutHelper;

defined('_JEXEC') or die;

$sectionId    = isset($this->sectionItem->id) ? $this->sectionItem->id : '';
$sectionState = isset($this->sectionItem->state) ? $this->sectionItem->state : 0;
$sectionTitle = isset($this->sectionItem->title) ? $this->sectionItem->title : 'Без названия';

$isThereArticles = false;

foreach ($this->articlesItems as $article) {
    if ($article->section_id == $sectionId && $article->state == 1) {
        $isThereArticles = true;
    }
}

?>
<?php if ($sectionState == 1 && $isThereArticles) : ?>
    <div class="section-card" id="<?php echo $sectionId ?>">
        <div class="section-card__title-container">
            <h4 class="section-card__title h-4"><?php echo $sectionTitle ?></h4>
        </div>
        <?php foreach ($this->articlesItems as &$articleItem) : ?>
            <?php if ($articleItem->section_id == $sectionId && $articleItem->state == 1) : ?>
                <?php echo LayoutHelper::render("journal.jcontent.articleCard", $articleItem); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>