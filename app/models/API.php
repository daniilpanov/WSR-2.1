<?php


namespace app\models;


abstract class API
{
    public $method;
    public $data;
    public $url;

    public $user;

    const STATUS = [
        200 => "OK",
        201 => "Created",
        403 => "Forbidden",
        404 => "Not Found",
        422 => "Unrpocessable entity"
    ];

    public function __construct()
    {
        $this->user = (isset($_SERVER['PHP_AUTH_USER'])) ?
            [
                'login' => $_SERVER['PHP_AUTH_USER'],
                'password' => $_SERVER['PHP_AUTH_PW']
            ] : null;
        $this->url =
            array_key_exists("path", $parsed = parse_url(getUrl()))
                ? $parsed['path'] : null;
        $this->method = getRequestMethod();
        $this->data = $_REQUEST;
    }

    public function response($status = 200)
    {
        $msg = (array_key_exists($status, self::STATUS) ? self::STATUS[$status] : "");
        header($_SERVER['SERVER_PROTOCOL'] . " " . $status . " " . $msg);
        if ($this->data)
            echo json_encode($this->data);
    }

    abstract public function getAll();
    abstract public function getOne($id);
    abstract public function patch($id);
    abstract public function put($id);
    abstract public function delete($id);
    abstract public function post();
}