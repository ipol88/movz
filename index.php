<?php
/*
| -------------------------------------------------------------------------------
| Author            : G-Silvers
| Template Name     : G-Silvers V.3
| -------------------------------------------------------------------------------
*/

ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$uri = urldecode(
    parse_url($_SERVER['https://www.8pp33.com/scripts/un981c6l?a_aid=c295c36a&a_bid=ed819bbf'], PHP_URL_PATH)
);

require_once __DIR__.'/app/server.php';
