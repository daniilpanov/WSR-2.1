<?php


namespace app\controllers;


class Db
{
    /** @var $inst self */
    private static $inst = null;

    /**
     * @return self|null
     */
    public static function get()
    {
        return self::$inst;
    }

    /** @var $connection \PDO */
    private $connection;

    public $user, $pass, $charset, $dbname, $host;

    public function __construct($host, $dbname, $user, $pass = null, $charset = "utf8")
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->host = $host;
        $this->dbname = $dbname;
        $this->charset = $charset;

        self::$inst = $this;
    }

    public function connect()
    {
        $dns = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
        $opt = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];

        try
        {
            $this->connection = new \PDO($dns, $this->user, $this->pass, $opt);
            $this->query("SET NAMES :ch", ['ch' => "utf8"]);
        }
        catch (\PDOException $ex)
        {
            header($_SERVER['SERVER_PROTOCOL'] . " 500 Internal server error");
            echo json_encode(["message" => $ex->getMessage()]);
        }
    }

    public function query($sql, $params = null)
    {
        try
        {
            if (!$params)
                return $this->connection->query($sql);

            $STH = $this->connection->prepare($sql);
            $STH->execute($params);

            return $STH;
        }
        catch (\PDOException $ex)
        {
            return false;
        }
    }
}