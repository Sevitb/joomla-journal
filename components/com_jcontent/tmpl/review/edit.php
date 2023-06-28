<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Router\Route;
use jprofile\Library\UserHelper;

$user = Factory::getUser();
$app  = Factory::getApplication();

$articleCreatedBy = isset($this->item->created_by) ? $this->item->created_by : '';
$articleCoAuthors = isset($this->item->co_authors) ? $this->item->co_authors : '';
$articleTitle      = isset($this->item->title) ? $this->item->title : 'Без названия';
$articleReviewers = isset($this->item->reviewers) ? $this->item->reviewers : '';

$articleAuthors = UserHelper::getAuthorsNames($articleCreatedBy, $articleCoAuthors);
$articleReviewers = UserHelper::getAuthorsNames(null, $articleReviewers);

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');
// Use custom script assets;

?>
<section class="content-section">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-lg-8">
                <div class="content-section__main-column default-block">
                    <div id="bcrumbs">
                        <?php echo ModuleHelper::renderModule('breadcrumbs'); ?>
                    </div>
                    <form action="<?php echo Route::_('index.php?option=com_jcontent&view=send&layout=edit'); ?>" method="POST" name="adminForm" id="adminForm" class="form-validate form-vertical" enctype="multipart/form-data">
                        <div class="article-info">
                            <p class="p">
                                <span><strong>Название материала:</strong></span>
                                <span><?php echo $articleTitle ?></span>
                            </p>
                            <p class="p">
                                <span><strong>Авторы:</strong></span>
                                <?php foreach ($articleAuthors as $author) : ?>
                                    <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $author['id']) ?>" class="article-card__author-name"><?php echo $author['name'] ?></a>
                                    <?php if ($author != end($articleAuthors)) : ?>
                                        <span class="article-card__divider">•</span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </p>
                            <p>
                                <span><strong>Предложенные рецензенты:</strong></span>
                                <?php foreach ($articleReviewers as $author) : ?>
                                    <a href="<?php echo Route::_('index.php?option=com_jprofile&view=profile&profile_id=' . $author['id']) ?>" class="article-card__author-name"><?php echo $author['name'] ?></a>
                                    <?php if ($author != end($articleReviewers)) : ?>
                                        <span class="article-card__divider">•</span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </p>
                        </div>
                        <hr>
                        <div class="files">
                            <a class="btn content-section__download-issue-btn" href="" download="/documents/materials/<?php echo $articleCreatedBy ?>/<?php echo $articleTitle ?>"> <span class="icon-download"></span> Скачать файлы <i class=""></i></a>
                        </div>
                        <hr>
                        <?php echo $this->form->renderField('state'); ?>
                        <?php echo $this->form->renderField('reviewer_comment'); ?>
                        <span class="btn mt-3" onclick="fetchData()" type="button" data-bs-toggle="modal" data-bs-target="#checkModal">Отправить</span>
                        <input type="hidden" name="task" />
                        <?php echo HTMLHelper::_('form.token'); ?>
                    </form>
                </div>
            </div>
            <?php echo LayoutHelper::render('journal.components.sidebar') ?>
        </div>
    </div>
</section>