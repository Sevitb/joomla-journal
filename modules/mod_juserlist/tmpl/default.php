<?php

use Joomla\CMS\Factory;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;
use jprofile\Library\UserHelper;

// No direct access to this file
\defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$app = Factory::getApplication();
$wa = $app->getDocument()->getWebAssetManager();



?>
<table class="table table-striped table-bordered">
    <tbody>
        <?php foreach ($usersItems as $key => $userItem) : ?>
            <tr>
                <th scope="row"><?php echo $key + 1 ?></th>
                <td>
                    <?php echo UserHelper::getFormattedName('S f t', ['firstname' => $userItem->firstname, 'secondname'=>$userItem->secondname, 'thirdname'=>$userItem->thirdname]); ?>
                </td>
                <td>
                    <?php echo $userItem->academic_degree ?>,
                    <?php echo $userItem->academic_title ?>
                </td>
                <td>
                    г. <?php echo $userItem->city ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>