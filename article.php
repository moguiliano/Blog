<?php

/**
 * cette page permet d'afficher un article
 */
require_once('libraries/autoload.php');

$controller = new \Controllers\Article();
$controller->show();

