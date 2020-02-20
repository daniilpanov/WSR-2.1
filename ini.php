<?php
//
header("Content-Type: application/json");
//
spl_autoload_register(function ($namespace)
{
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $namespace);

    require_once $path . ".php";
});

//
function getUrl()
{
    return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function getRequestMethod()
{
    return $_SERVER['REQUEST_METHOD'];
}

// Инициализируем полдключение к БД
(new \app\controllers\Db("localhost", "urmxrpcd_m2", "urmxrpcd", "zDVhjJ"))->connect();

