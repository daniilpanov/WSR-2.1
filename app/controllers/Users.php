<?php


namespace app\controllers;


use app\models\API;

class Users
{
    /** @var $request API */
    public $request;

    public function signup()
    {
        $login = $_REQUEST['login'];
        $pass = password($_REQUEST['pass']);
        $name = $_REQUEST['first_name'] . " " . $_REQUEST['surname'];

        $params = ['n' => $name, 'p' => $pass, 'ph' => $login];

        Db::get()->query(
            "INSERT INTO users (name, pass, phone) VALUE (:n, :p, :ph)",
            $params
        );

        $this->request->data = [
            'id' => Db::get()
                ->query("SELECT * FROM users WHERE name=:n AND pass=:p AND phone=:ph", $params)
                ->fetch()['id']
        ];
        $this->request->response(201);
    }

    public function tokenLogin()
    {
        $token = $_SERVER['HTTP_POSTMAN_TOKEN'];
        if (!isset($_SESSION['user']['token']) || $_SESSION['user']['token'] == $token)
        {
            $this->request->data = ['token' => "Incorrect token"];
            $this->request->response(403);
        }
    }

    public function login()
    {
        $login = $_REQUEST['login'];
        $pass = password($_REQUEST['pass']);
        $val_err = [];

        if (!validate($login, "([0-9]){11}"))
        {
            $val_err["phone"]
                = "Номер телефона должен быть в формате 88005555555 (содержать 11 цифр, без знаков +, -, ( и ))";
        }

        if (!empty($val_err))
        {
            $this->request->data = $val_err;
            $this->request->response(422);
            return;
        }

        $user = Db::get()->query("SELECT * FROM users WHERE phone=:login AND pass=:pass", ['login' => $login, 'pass' => $pass]);

        if (!$user || !$user = $user->fetch())
        {
            $this->request->data = ['login' => "Incorrect login or password"];
            $this->request->response(404);
            return;
        }

        $token = md5(rand());

        $_SESSION['user'] = ['id' => $user['id'], 'token' => $token];

        $this->request->data = ['token' => $token];
        $this->request->response(200);
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}