<?php

class MyPDO {
    protected static $instance;
    public $pdo;

    private function __construct() {
        $host = "localhost";
        $dbName = "radovi";
        $charset = "utf8";
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName . ';charset=' . $charset;
        $this->pdo = new PDO($dsn, 'root', '', $opt);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __call($method, $args) {
        return call_user_func_array(array($this->pdo, $method), $args);
    }

    public function run($sql, $args = []) {
        if (!$args) {
            return $this->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function destroy() {
        self::$instance = null;
        $this->pdo = null;
    }
}
