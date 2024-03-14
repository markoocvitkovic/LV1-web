<?php

class DiplomskiRadoviDBHelper {

    protected $db;
    private static $instance = null;

    private function __construct(MyPDO $db) {
        $this->db = $db;
    }

    public function findAll() {
        return $this->db->query("SELECT * FROM radovi")->fetchAll();
    }

    public function insert($name, $text, $link, $oib) {
        $stmt = $this->db->prepare("INSERT INTO radovi (name, text, link, oib) VALUES (?, ?, ?, ?)");
        $valid = $stmt->execute([$name, $text, $link, $oib]);
        return $valid;
    }

    public static function getInstance(MyPDO $db) {
        if (self::$instance == null) {
            self::$instance = new DiplomskiRadoviDBHelper($db);
        }
        return self::$instance;
    }

    public function destroy() {
        $this->db->destroy();
    }
}
