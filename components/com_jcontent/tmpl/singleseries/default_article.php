<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

$articleId = isset($this->articleItem->id) ? $this->articleItem->id : '';
$articleCreatedBy = isset($this->articleItem->created_by) ? $this->articleItem->created_by : '';
$articleCoAuthors = isset($this->articleItem->co_authors) ? $this->articleItem->co_authors : '';
$articleState = isset($this->articleItem->state) ? $this->articleItem->state : 0;
$articleTitle = isset($this->articleItem->title) ? $this->articleItem->title : 'Без названия';
$articleHits = isset($this->articleItem->hits) ? $this->articleItem->hits : '0';
$articlePages = isset($this->articleItem->pages) ? $this->articleItem->pages : '0';
$articleAnnotation = isset($this->articleItem->annotation) ? $this->articleItem->annotation : 'Без аннотации';

?>
<?php if($articleState == 1):?>
<div class="article-card">
    <div class="article-card__header">
        <h2 class="article-card__title h-2">
            <a href="<?php echo Route::_('/index.php?option=com_jcontent&view=article&id='. $articleId); ?>"><?php echo $articleTitle ?> </a>
        </h2>
        <p class="p article-card__authors">
            <a href="/profile/Name" class="article-card__author-name">Анатольев Г.Г.</a>
            <span>,</span>
            <a href="/profile/Test" class="article-card__author-name">Последнее И.С.</a>
            <span>,</span>
            <a href="/profile/admin" class="article-card__author-name">Песковацков А.Н.</a>
            <span>,</span>
            <a href="/profile/username" class="article-card__author-name">Иванов И.И.</a>
        </p>
    </div>
    <div class="article-card__statistic">
        <div class="article-card__hits" title="Количество просмотров">
            <span class="_icon-views"></span>
            <?php echo $articleHits ?>
        </div>
        <div class="article-card__page-count" title="Страницы">
            <span class="_icon-pages"></span>
            <?php echo $articlePages ?>
        </div>
    </div>
    <div class="article-card__annotation">
        <h4 class="article-card__annotation-title h-4">Аннотация:</h4>
        <p class="p"><?php echo $articleAnnotation ?></p>
    </div>
</div>
<?php endif; ?>