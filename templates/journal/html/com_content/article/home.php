<?php


defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();
$wa  = $app->getDocument()->getWebAssetManager();

$wa->useScript('core');

$wa->registerAndUseStyle('template.homepage', 'media/templates/site/journal/css/home-page.css');

?>
<section class="canvas-section" style="background-image: url('/images/canvases/main-page-banner.jpg')">
    <div class="canvas-section__block">
        <h1 class="canvas-section__title h-1">Вестник <br><span class="canvas-section__title_bottom">Консорциума</span></h1>
        <div class="canvas-section__body">
            <p class="canvas-section__subtitle">Научные публикации в разных категориях</p>
            <?php
            // <div class="searchbar">
            //     <input class="searchbar__input" type="text" placeholder="Введите название статьи...">
            //     <button class="searchbar__button icon-search"></button>
            // </div> 
            // <jdoc:include type="modules" name="searchbar" />
            ?>
        </div>
    </div>
</section>
<section class="about-section">
    <div class="container">
        <div class="about-section__row row ">
            <div class="about-section__text-container col-12 col-lg-8">
                <h2 class="about-section__title h-2">О Журнале</h2>
                <p class="p">
                    Основная цель журнала «Вестник Консорциума» («Серия Журнал») заключается в распространении идей устойчивого развития и продвижение исследований в разных научных отраслях через её призму для обеспечения научного фундамента к достижению технологического лидерства. Главная задача Журнала - служить эффективной площадкой для профессионального обсуждения широкого круга проблем обеспечения устойчивого развития, важным средством коммуникации между наукой, образованием и практикой.
                </p>
                <a class="btn" href="<?php echo Route::_('index.php?option=com_content&view=article&id=1') ?>">Узнать больше</a>
            </div>
            <div class="about-section__image-container col-12 col-lg-4">
                <img src="images/canvases/main-canvas.jpg" loading="lazy" alt="">
            </div>
        </div>
    </div>
</section>
<section class="join-section">
    <div class="container">
        <div class="join-section__row row ">
            <div class="join-section__image-container col-12 col-lg-6">
                <img src="images/group.png" style="width: 100%" loading="lazy" alt="">
            </div>
            <div class="join-section__text-container col-12 col-lg-6">
                <h2 class="join-section__title h-2">Присоединяйтесь</h2>
                <p class="p">
                    Если вы являетесь автором и хотите опубликовать свою статью в журнале "Вестник Консорциума", то мы предлагаем вам следующие преимущества:
                </p>
                <ul class="p row gy-2 mb-2">
                    <li>
                        - Широкий охват аудитории. Наш журнал имеет широкий охват читателей, включая ученых, исследователей, преподавателей и студентов.
                    </li>
                    <li>
                        - Быстрый процесс публикации. Мы стараемся максимально ускорить процесс публикации, чтобы ваши статьи могли быть опубликованы как можно быстрее.
                    </li>
                    <li>
                        - Удобный формат. Мы предоставляем удобный формат для авторов, который позволяет им легко и быстро отправлять свои статьи на рассмотрение.
                    </li>
                    <li>
                        - Высокая цитируемость. Наши статьи имеют высокую цитируемость, что позволяет авторам получить признание в научном сообществе.
                    </li>
                </ul>
                <p class="p">
                    Кроме того, мы предоставляем авторам возможность получать обратную связь от рецензентов и редакторов, что помогает улучшить качество статей и повысить их научную значимость.
                </p>
            </div>
        </div>
    </div>
</section>