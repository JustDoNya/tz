<?php

require(__DIR__ . '/../core/classes/db.class.php');
require(__DIR__ . '/../core/controller.php');

$index = controller::getInit();
$index->index();
