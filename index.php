<?php
include_once(dirname(__FILE__) . '/includes/init.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta  name:"linkzone"/>
<?php
include_once(dirname(__FILE__) . '/static/head.php');
?>
</head>
<body style="background:url(New-AAS-Map.jpg) no-repeat center center fixed;">
<div href="javascript:User.login();">
<?php
include_once(MAIN_PATH . 'content/header.php');
?>
</div>
    <div class="container">
<?php
if (file_exists(MAIN_PATH . 'content/' . CONTENT_PAGE . '.php')) {
    include_once(MAIN_PATH . 'content/' . CONTENT_PAGE . '.php');
} elseif (CONTENT_PAGE == "") {
    if (file_exists(MAIN_PATH . 'content/home.php')) {
        include_once(MAIN_PATH . 'content/home.php');
    } else {
        include_once(MAIN_PATH . 'content/404.php');
    }
} else {
    include_once(MAIN_PATH . 'content/404.php');
}
?>
    </div>
</body>
</html>
