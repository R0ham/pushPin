<?php

class PrepareDB {

    private const dbhost = 'localhost:3306';
    private const dbuser = 'pushpin';
    private const dbpass = 'pushpin';
    private conn = null;

    public function __construct(){
        // create connection
        $this->conn = new mysqli($dbhost, $dbuser, $dbpass);
        // Check connection
        if ($this->conn->connect_error) {
            die('Could not connect: ' . $this->conn->connect_error);
        }
    }

    public function __destruct(){
        $this->conn->close();
    }

    // Create DB
    public function createDb(){
        echo "Creating DB pushpin <br>";
        $sql = "CREATE DATABASE pushpin";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully <br>";
        }
        else {
            echo "Error creating database: ". $conn->error;
            die('Failed to create DB: pushpin <br>');
        }
    }

    // Create table users
    public function createTables(){
        $sql = "CREATE TABLE IF NOT EXISTS pushpin.users (
            id          INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname   VARCHAR(50)     NOT NULL,
            lastname    VARCHAR(50)     NOT NULL,
            email       VARCHAR(20)     NOT NULL,
            organization VARCHAR(100)   NOT NULL,
            reg_date    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Tabele 'users' created successfully <br>";
        }
        else {
            echo "Error creating table: " . $conn->error;
        }
    }
}

$test = new PrepareDB();
$test->createDb();
$test->createTables();
?>
