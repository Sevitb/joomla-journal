<?php

use Joomla\CMS\Factory;

// No direct access to this file
defined('_JEXEC') or die;

?>
<p class="p">Телефон: <br>
    <?php echo $params->get('phone'); ?></p>
<p class="p">Email: <br>
    <?php echo $params->get('email'); ?></p>
<p class="p">Режим работы: <br>
    <?php echo $params->get('working_hours'); ?></p>
<p class="p">Адрес: <br>
    <?php echo $params->get('adress'); ?></p>