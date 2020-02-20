<?php
require_once "functions.php";
require_once "ini.php";

$url = parse_url(getUrl());

if (isset($_SESSION['user']))
{
    $users_control = new \app\controllers\Users();
    $users_control->request = new \app\models\UserAPI();

    $users_control->tokenLogin();
}

if (isset($url['path']) && $url['path'] != "/")
{
    $url['path'] = explode("/", $url['path']);
    array_shift($url['path']);
    $action = array_shift($url['path']);

    switch ($action)
    {
        case "signup":
            $users_control = new \app\controllers\Users();
            $users_control->request = new \app\models\UserAPI();

            $users_control->signup();
            break;

        case "login":
            $users_control = new \app\controllers\Users();
            $users_control->request = new \app\models\UserAPI();

            $users_control->login();
            break;

        case "logout":

            break;

        case "post":

            break;

        case "user":

            break;

        case "posts":

            break;

        case "posts_search":

            break;
    }
}