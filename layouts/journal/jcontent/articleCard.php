<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Router\Route;
use jprofile\Library\UserHelper;

defined('_JEXEC') or die;

$articleId = isset($displayData->id) ? $displayData->id : '';
$articleCreatedBy = isset($displayData->created_by) ? $displayData->created_by : '';
$articleCoAuthors = isset($displayData->co_authors) ? $displayData->co_authors : '';
$articleState = isset($displayData->state) ? $displayData->state : 0;
$articleTitle = isset($displayData->title) ? $displayData->title : 'Без названия';
$articleHits = isset($displayData->hits) ? $displayData->hits : '0';
$articlePages = isset($displayData->pages) ? $displayData->pages : '0';
$articleAnnotation = isset($displayData->annotation) ? $displayData->annotation : 'Без аннотации';

$articleAuthors = UserHelper::getAuthorsNames($articleCreatedBy, $articleCoAuthors);

?>
<div class="article-card">
    <div class="article-card__header">
        <h2 class="article-card__title h-2">
            <a href="<?php echo Route::_('index.php?option=com_jcontent&view=article&id=' . $articleId) ?>"><?php echo $articleTitle ?> </a>
        </h2>
        <p class="p article-card__authors">
            <?php foreach ($articleAuthors as $author) : ?>
                <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $author['id']) ?>" class="article-card__author-name"><?php echo $author['name'] ?></a>
                <?php if ($author != end($articleAuthors)) : ?>
                    <span class="article-card__divider">•</span>
                <?php endif; ?>
            <?php endforeach; ?>
        </p>
    </div>
    <div class="article-card__statistic">
        <div class="article-card__hits" title="Количество просмотров">
            <span class="icon-hits"></span>
            <?php echo $articleHits ?>
        </div>
        <div class="article-card__page-count" title="Страницы">
            <span class="icon-copy"></span>
            <?php echo $articlePages ?>
        </div>
    </div>
    <div class="article-card__annotation">
        <h4 class="article-card__annotation-title h-4">Аннотация:</h4>
        <p class="p"><?php echo $articleAnnotation ?></p>
    </div>
</div>