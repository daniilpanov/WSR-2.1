<?php


namespace app\models;


use app\controllers\Db;

class PostsAPI extends API
{

    public function getAll()
    {
        
    }

    public function getOne($id)
    {
        return Db::get()->query("SELECT * FROM posts WHERE id=:id", ['id' => $id]);
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