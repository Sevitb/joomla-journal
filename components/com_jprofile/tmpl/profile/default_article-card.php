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


$wa = $this->document->getWebAssetManager();

$articleId = isset($this->articleItem->id) ? $this->articleItem->id : '';
$articleCreatedBy = isset($this->articleItem->created_by) ? $this->articleItem->created_by : '';
$articleCoAuthors = isset($this->articleItem->co_authors) ? $this->articleItem->co_authors : '';
$articleState = isset($this->articleItem->state) ? $this->articleItem->state : 0;
$articleTitle = isset($this->articleItem->title) ? $this->articleItem->title : 'Без названия';
$articleHits = isset($this->articleItem->hits) ? $this->articleItem->hits : '0';
$articlePages = isset($this->articleItem->pages) ? $this->articleItem->pages : '0';
$articleAnnotation = isset($this->articleItem->annotation) ? $this->articleItem->annotation : 'Без аннотации';

switch ($this->articleItem->state) {
    case '1':
        $articleStateText = Text::_('Принято к публикации');
        break;

    case '0':
        $articleStateText = Text::_('В процессе обработки');
        break;

    case '2':
        $articleStateText = Text::_('Отклонена');
        break;

    case '3':
        $articleStateText = Text::_('Нуждается в доработке');
        break;

    default:
        $articleStateText = Text::_('В процессе обработки');
        break;
}

$articleAuthors = UserHelper::getAuthorsNames($articleCreatedBy, $articleCoAuthors);

?>
<div class="article-card">
    <div class="article-card__row">
        <div class="article-card__info">
            <h5 class="article-card__title h-5">
                <a href="<?php echo Route::_('index.php?option=com_jcontent&view=article&id=' . $articleId) ?>">
                    <?php echo $articleTitle; ?>
                </a>
            </h5>
            <div class="article-card__authors">
                <?php foreach ($articleAuthors as $author) : ?>
                    <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $author['id']) ?>"><?php echo $author['name'] ?></a>
                    <?php if ($author != end($articleAuthors)) : ?>
                        <span class="article-card__divider">•</span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="article-card__stats">
                <div class="article-card__hits">
                    <span class="icon-hits"></span>
                    <?php echo $articleHits; ?>
                </div>
                <div class="article-card__pages">
                    <span class="icon-copy"></span>
                    <?php echo $articlePages; ?>
                </div>
            </div>
        </div>
        <!-- <div class="article-card__controls-btn">
            <button type="button" class="btn btn-white" data-bs-toggle="dropdown" aria-expanded="false">•••</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>

        </div> -->
        <div class="article-card__state article-card__state-<?php echo $this->articleItem->state ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $articleStateText; ?>"></div>
    </div>
</div>