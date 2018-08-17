<?php
require_once __DIR__ . "/../vendor/autoload.php";

$res = [];

if (!empty($_POST) && !empty($_POST['url'])) {
    if ($link = (new LinkModel())->createLink($_POST['url'])) {
        $res['newLink'] = $link;
    }
}

echo json_encode($res);