<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\Helpers\Sidebar;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\Session\Session;


/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();
$session = Factory::getSession();
$wa  = $this->getWebAssetManager();

// Detecting Active Variables
$option    = $app->input->getCmd('option', '');
$view      = $app->input->getCmd('view', '');
$layout    = $app->input->getCmd('layout', '');
$task      = $app->input->getCmd('task', '');
$itemid    = $app->input->getCmd('Itemid', '');
$sitename  = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu      = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Current user object
$user = Factory::getUser();

$session->set('current_user_id', $user->id);

// Use scripts assets

// Use vendor styles assets
if ($wa->assetExists('style', 'bootstrap.css')) {
    $wa->disableStyle('bootstrap.css');
}
$wa->useStyle('bootstrap.css.grid');
$wa->useStyle('fontawesome');

$wa->registerAndUseScript('bootstrap.modal', 'media/vendor/bootstrap/js/modal.js', $options = [], ['type' => 'module']);

// Use custom styles assets
$wa->registerAndUseStyle('template', 'media/templates/site/journal/css/template.css');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
    <jdoc:include type="metas" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body>
    <div class="page-wrapper" id="page-wrapper">
        <?php // -- Header -- 
        ?>
        <?php echo LayoutHelper::render("journal.components.header", $user); ?>

        <!-- Page body -->
        <main class="main">
            <jdoc:include type="component" />
        </main>

        <?php if ($user->guest) : ?>
            <?php // -- Login -- 
            ?>
            <?php echo LayoutHelper::render("journal.modules.loginModal"); ?>
        <?php endif; ?>

        <?php // -- Message -- 
        ?>
        <?php echo LayoutHelper::render("journal.modules.message"); ?>

        <?php // -- Footer -- 
        ?>
        <?php echo LayoutHelper::render("journal.components.footer"); ?>
    </div>
</body>

</html>