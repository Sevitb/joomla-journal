<?php

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;

?>

<div class="card mb-3">
    <div class="card-header">
        <h2>
            <span class="icon-generic" aria-hidden="true"></span> <?php echo $this->title ?>
        </h2>
    </div>
    <div class="card-body">
        <nav class="quick-icons px-3 pb-3 h-100">
            <ul class="nav flex-wrap rounded">
                <li class="quickicon-group">
                    <ul class="list-unstyled d-flex w-100">
                        <li class="quickicon">
                            <a href="<?php echo Route::_('index.php?option=com_jcontent&view=series') ?>">
                                <div class="quickicon-info mx-auto">
                                    <div class="quickicon-icon">
                                        <div class="icon-folder-open" aria-hidden="true"></div>
                                    </div>
                                </div>
                                <div class="quickicon-name d-flex align-items-end justify-content-center">
                                    Серии </div>
                            </a>
                        </li>
                        <li class="quickicon-linkadd j-links-link d-flex">
                            <a class="d-flex" href=" <?php echo Route::_('index.php?option=com_jcontent&task=singleseries.add') ?>" title="Добавить серию">
                                <span class="icon-plus" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="quickicon-group">
                    <ul class="list-unstyled d-flex w-100">
                        <li class="quickicon">

                            <a href="/administrator/index.php?option=com_jcontent&amp;view=articles">
                                <div class="quickicon-info mx-auto">
                                    <div class="quickicon-icon">
                                        <div class="icon-file-alt" aria-hidden="true"></div>
                                    </div>
                                </div>
                                <div class="quickicon-name d-flex align-items-end justify-content-center">
                                    Статьи </div>
                            </a>
                        </li>
                        <li class="quickicon-linkadd j-links-link d-flex">
                            <a class="d-flex" href="/administrator/index.php?option=com_jcontent&amp;task=article.add" title="Добавить статью">
                                <span class="icon-plus" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="quickicon-group">
                    <ul class="list-unstyled d-flex w-100">
                        <li class="quickicon">
                            <a href="/administrator/index.php?option=com_jcontent&amp;view=issues">
                                <div class="quickicon-info mx-auto">
                                    <div class="quickicon-icon">
                                        <div class="icon-copy" aria-hidden="true"></div>
                                    </div>
                                </div>
                                <div class="quickicon-name d-flex align-items-end justify-content-center">
                                    Выпуски </div>
                            </a>
                        </li>
                        <li class="quickicon-linkadd j-links-link d-flex">
                            <a class="d-flex" href="/administrator/index.php?option=com_jcontent&amp;task=issue.add" title="Добавить выпуск">
                                <span class="icon-plus" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="quickicon-group">
                    <ul class="list-unstyled d-flex w-100">
                        <li class="quickicon">
                            <a href="<?php echo Route::_('index.php?option=com_jcontent&view=sections') ?>">
                                <div class="quickicon-info mx-auto">
                                    <div class="quickicon-icon">
                                        <div class="icon-list" aria-hidden="true"></div>
                                    </div>
                                </div>
                                <div class="quickicon-name d-flex align-items-end justify-content-center">
                                    Разделы </div>
                            </a>
                        </li>
                        <li class="quickicon-linkadd j-links-link d-flex">
                            <a class="d-flex" href=" <?php echo Route::_('index.php?option=com_jcontent&task=section.add') ?>" title="Добавить раздел">
                                <span class="icon-plus" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>