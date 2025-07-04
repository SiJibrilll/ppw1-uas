<?php

namespace app;

use PDO;


class Dbh {
  private $conn;

  function __construct() {
    $config = require 'config.php';
    $servername = $config['db_host'];
    $dbName = $config['db_name'];
    $username = $config['db_user'];
    $password = $config['db_password'];

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
  
  function paginate($table, $order = 'ASC', $page = 1, $limit = 10, $column = 'id', $operator = '=', $where = '') {
    $offset = ($page - 1) * $limit;
    
    $stmt = $this->query("SELECT COUNT(*) FROM $table WHERE $column $operator ?", ["$where"]);
    $total_items = $stmt->fetchColumn();
    $total_pages = ceil($total_items / $limit);

    // Manually inject limit/offset (safe since they are cast as ints)
    $limit = (int) $limit;
    $offset = (int) $offset;
    $sql = "SELECT * FROM $table WHERE $column $operator ? ORDER BY id $order LIMIT $limit OFFSET $offset";

    
    $stmt = $this->query($sql, ["$where"]);
    $data = $stmt->fetchAll();

    return [
        'data' => $data,
        'total_pages' => $total_pages,
        'current_page' => $page
    ];
  }

  function paginateJoin($table, $order = 'ASC', $page = 1, $limit = 10, $foreignColumn = 'id', $foreignId = 0, $column = 'id', $operator = '=', $where = '') {
    $offset = ($page - 1) * $limit;
    
    $stmt = $this->query("SELECT COUNT(*) FROM $table WHERE $foreignColumn = ? AND $column $operator ?", [$foreignId, "$where"]);
    $total_items = $stmt->fetchColumn();
    $total_pages = ceil($total_items / $limit);

    // Manually inject limit/offset (safe since they are cast as ints)
    $limit = (int) $limit;
    $offset = (int) $offset;
    $sql = "SELECT * FROM $table WHERE $foreignColumn = ? AND $column $operator ? ORDER BY id $order LIMIT $limit OFFSET $offset";

    
    $stmt = $this->query($sql, [$foreignId, "$where"]);
    $data = $stmt->fetchAll();

    return [
        'data' => $data,
        'total_pages' => $total_pages,
        'current_page' => $page
    ];
}
}
