<?php

require_once __DIR__ . "/vendor/autoload.php";

$code = mb_substr($_SERVER['REQUEST_URI'], 1);
if ($link = (new LinkModel())->getRealUrl($code)) {
    header('Location: ' . $link);
    exit;
}

header('Location: /404.php');

?>