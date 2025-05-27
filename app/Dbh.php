<?php

namespace app;

use PDO;

class Dbh {
  private $conn;

  function __construct() {
    $servername = "127.0.0.1";
    $dbName = 'ppw_uas';
    $username = "root";
    $password = "";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->conn = $conn;
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function query(string $sql, array $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            // Log or handle the error appropriately
            echo "PDO Error: " . $e->getMessage();
            return false;
        }
    }
}
