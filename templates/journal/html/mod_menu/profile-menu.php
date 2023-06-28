<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu.min.js', [], ['type' => 'module']);
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu-es5.min.js', [], ['nomodule' => true, 'defer' => true]);

// Use scripts assets
$wa->registerAndUseScript('template', 'media/templates/site/journal/js/modules/nav.js', [], ['type' => 'module']);

$id = '';

if ($tagId = $params->get('tag_id', '')) {
    $id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use mod-menu instead
?>
<ul<?php echo $id; ?> class="nav__list nav__list_vertical nav__list_vertical_default <?php echo $class_sfx; ?>">
    <?php foreach ($list as $i => &$item) {
        $itemParams = $item->getParams();
        $class      = 'nav__item item-' . $item->id;

        if ($item->level != 1) {
            $class .= ' nav__item_sublevel nav__item_sublevel_' . $item->level;
        }

        if ($item->id == $default_id) {
            $class .= ' default';
        }

        if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id)) {
            $class .= ' current';
        }

        if (in_array($item->id, $path)) {
            $class .= ' active';
        } elseif ($item->type === 'alias') {
            $aliasToId = $itemParams->get('aliasoptions');

            if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
                $class .= ' active';
            } elseif (in_array($aliasToId, $path)) {
                $class .= ' alias-parent-active';
            }
        }

        if ($item->type === 'separator') {
            $class .= ' divider';
        }

        if ($item->deeper) {
            $class .= ' deeper';
        }

        if ($item->parent) {
            $class .= ' parent';
        }

        echo '<li class="' . $class . '">';
        echo '<div class="nav__link-container">';

        switch ($item->type):
            case 'separator':
            case 'component':
            case 'heading':
            case 'url':
                require ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
                break;

            default:
                require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;

        if ($item->deeper) {
            echo '<div class="nav__dropdown-btn ' . ($item->level == 1 ? ' nav__dropdown-btn_level_1' : '') . ' fa-arrow-down" data-nav-item-id="' . $item->id . '"></div>';
        }

        echo '</div>';

        // The next item is deeper.
        if ($item->deeper) {
            echo '<ul class="nav__sublist' . ($item->level > 1 ? ' nav__sublist_level' : '') . ' nav__sublist_level_' . $item->level + 1 . '" data-nav-item-id="' . $item->id . '">';
        } elseif ($item->shallower) {
            // The next item is shallower.
            echo '</li>';
            echo str_repeat('</ul></li>', $item->level_diff);
        } else {
            // The next item is on the same level.
            echo '</li>';
        }
    }
    ?></ul>