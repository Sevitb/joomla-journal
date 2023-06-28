<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Layout\LayoutHelper;
use jprofile\Library\UserHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();

$wa = $this->document->getWebAssetManager();

// Detecting Active Variables
$option    = $app->input->getCmd('option', '');
$view      = $app->input->getCmd('view', '');
$layout    = $app->input->getCmd('layout', '');
$task      = $app->input->getCmd('task', '');
$itemid    = $app->input->getCmd('Itemid', '');
$sitename  = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu      = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Article info
$articleId         = isset($this->item->id) ? $this->item->id : '';
$articleCreatedBy = isset($this->item->created_by) ? $this->item->created_by : '';
$articleCoAuthors = isset($this->item->co_authors) ? $this->item->co_authors : '';
$articleTitle      = isset($this->item->title) ? $this->item->title : 'Без названия';
$articleHits       = isset($this->item->hits) ? $this->item->hits : '0';
$articlePages      = isset($this->item->pages) ? $this->item->pages : '0';
$articleAnnotation = isset($this->item->annotation) ? $this->item->annotation : 'Без аннотации';
$articleLiterature = isset($this->item->literature) ? $this->item->literature : 'Без аннотации';
$articleQuoting    = isset($this->item->quoting) ? $this->item->quoting : 'Без аннотации';

$articleAuthors = UserHelper::getAuthorsNames($articleCreatedBy, $articleCoAuthors);

// Use custom styles assets
$wa->registerAndUseStyle('component.style.article-page', 'media/com_jcontent/css/article-page.css');


?>

<section class="media-section">
    <div class="container">
        <div class="col-12 default-block mb-0 p-4 article-top-info">
            <div class="article-top-info__stat">
                <span class="__dimensions_badge_embed__" data-doi="10.32609/0042-8736-2021-2-5-34" data-legend="always"></span>
                <script async src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>
            </div>
        </div>
    </div>
</section>
<section class="content-section">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-lg-8">
                <div class="content-section__main-column default-block">
                    <div id="bcrumbs">
                        <?php echo ModuleHelper::renderModule('breadcrumbs'); ?>
                    </div>
                    <hr>
                    <div class="content-section__header">
                        <h2 class="content-section__title h-2"><?php echo $articleTitle ?></h2>
                        <p class="p content-section__authors">
                            <?php foreach ($articleAuthors as $author) : ?>
                                <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $author['id']) ?>" class="article-card__author-name"><?php echo $author['name'] ?></a>
                                <?php if ($author != end($articleAuthors)) : ?>
                                    <span class="article-card__divider">•</span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </p>
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
                        <div class="content-section__tools">
                            <div class="content-section__download-issue">
                                <a class="btn content-section__download-issue-btn" href="" download=""> <span class="icon-download"></span> Скачать статью (PDF) <i class=""></i></a>
                            </div>
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-curtain data-shape="round" data-color-scheme="whiteblack" data-limit="0" data-more-button-type="short" data-services="messenger,vkontakte,odnoklassniki,viber,whatsapp,moimir"></div>
                        </div>
                    </div>
                    <hr>

                    <div class="content-section__article">
                        <?php if ($articleAnnotation) : ?>
                            <div class="content-section__annotation section-card">
                                <div class="section-card__title-container">
                                    <h4 class="section-card__title h-4">Аннотация</h4>
                                </div>
                                <div class="content-section__annotation-text">
                                    <p class="p">
                                        <?php echo $articleAnnotation; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($articleLiterature) : ?>
                            <div class="content-section__literature section-card">
                                <div class="section-card__title-container">
                                    <h4 class="section-card__title h-4">Список литературы</h4>
                                </div>
                                <div class="content-section__literature-text">
                                    <p class="p">
                                        <?php echo $articleLiterature; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($articleQuoting) : ?>
                            <div class="content-section__quoting section-card">
                                <div class="section-card__title-container">
                                    <h4 class="section-card__title h-4">Для цитирования</h4>
                                </div>
                                <div class="content-section__quoting-text">
                                    <p class="p">
                                        <?php echo $articleQuoting; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php echo LayoutHelper::render('journal.components.sidebar') ?>
        </div>
    </div>
</section>