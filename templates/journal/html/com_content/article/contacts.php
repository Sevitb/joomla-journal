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


$jmail = ModuleHelper::getModule('mod_jmail');
$jcontacts = ModuleHelper::getModule('mod_jcontacts');
$jmap = ModuleHelper::getModule('mod_jmap');

?>
<section class="content-section">
    <div class="container">
        <div class="content-section__main-column default-block">
            <div class="row gy-3">
                <div class="col-12 col-lg-6">
                    <?php echo ModuleHelper::renderModule($jmail); ?>
                </div>
                <div class="col-12 col-lg-6">
                    <?php echo ModuleHelper::renderModule($jcontacts); ?>
                </div>
                <div class="col-12 ">
                    <?php echo ModuleHelper::renderModule($jmap); ?>
                </div>
            </div>
        </div>
    </div>
</section>