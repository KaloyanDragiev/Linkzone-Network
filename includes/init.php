<?php
error_reporting(E_ERROR);
ini_set("display_errors", false);

include_once(dirname(__FILE__) . '/config.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/Follow.php');
include_once(dirname(__FILE__) . '/Tweet.php');

$uri_path = $_SERVER["REQUEST_URI"];
$uri_obj = explode("/", $uri_path);

define("CONTENT_PAGE", $uri_obj[1]);
define("CONTENT_SUBPAGE", $uri_obj[2]);
define("CONTENT_PAGEC", $uri_obj[3]);
define("CONTENT_PAGED", $uri_obj[4]);

session_start();
?>
