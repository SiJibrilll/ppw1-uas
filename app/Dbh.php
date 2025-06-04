<?php

namespace app;

use PDO;

class Dbh {
  private $conn;

  function __construct() {
    $servername = "localhost";
    $dbName = 'u985354573_imcomic';
    $username = "u985354573_admin";
    $password = "Akunbuatprojek1";

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

  function getConn() {
    return $this->conn;
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
  
  function paginate($table, $order = 'ASC', $page = 1, $limit = 10) {
    $offset = ($page - 1) * $limit;
    
    $stmt = $this->query("SELECT COUNT(*) FROM $table");
    $total_items = $stmt->fetchColumn();
    $total_pages = ceil($total_items / $limit);

    // Manually inject limit/offset (safe since they are cast as ints)
    $limit = (int) $limit;
    $offset = (int) $offset;
    $sql = "SELECT * FROM $table ORDER BY id $order LIMIT $limit OFFSET $offset";

    
    $stmt = $this->query($sql);
    $data = $stmt->fetchAll();

    return [
        'data' => $data,
        'total_pages' => $total_pages,
        'current_page' => $page
    ];
}
}
