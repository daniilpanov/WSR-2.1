<?php


namespace app\models;


use app\controllers\Db;

class UserAPI extends API
{
    public function getAll()
    {
        $this->response(404);
    }

    public function getOne($id)
    {
        Db::get()->query();
    }

    public function patch($id)
    {
        // TODO: Implement patch() method.
    }

    public function put($id)
    {
        // TODO: Implement put() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function post()
    {
        // TODO: Implement post() method.
    }
}