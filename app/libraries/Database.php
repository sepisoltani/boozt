<?php

namespace App\libraries;

use PDO;
use PDOException;

class Database
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbname = DB_NAME;
    private int $dbport = DB_PORT;
    private PDO $pdo;
    private string $error;


    // Hold the class instance.
    private static ?Database $instance = null;

    // The object is created from within the class itself
    // only if the class has no instance.
    // Singleton Design pattern :)
    public static function getInstance(): ?Database
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // The pdo connection is established in the private constructor.
    private function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';port=' . $this->dbport;
        $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="TRADITIONAL"');
        //create PDO instance
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            $this->createTablesIfNotExists();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    private function createTablesIfNotExists()
    {
        // SQL statement for creating new tables
        $statements = [
            //customers table schema
            'CREATE TABLE IF NOT EXISTS Customers( 
                id INT NOT NULL AUTO_INCREMENT,
                first_name  VARCHAR(100) NOT NULL, 
                last_name  VARCHAR(100) NOT NULL, 
                email VARCHAR(150) NOT NULL, 
                registered_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id));',

            //orders table schema
            'CREATE TABLE IF NOT EXISTS Orders (
                id INT NOT NULL AUTO_INCREMENT,
                customer_id INT NOT NULL,
                country VARCHAR(50) NOT NULL, 
                device VARCHAR(50) NOT NULL, 
                purchase_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (customer_id) REFERENCES Customers(id) ON UPDATE CASCADE ON DELETE CASCADE,
                PRIMARY KEY(id));',

            //orderItems table schema
            'CREATE TABLE IF NOT EXISTS OrderItems( 
                id INT NOT NULL AUTO_INCREMENT,
                order_id INT NOT NULL, 
                EAN INT NOT NULL, 
                quantity SMALLINT NOT NULL,
                price DOUBLE NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (order_id) REFERENCES Orders(id) ON UPDATE CASCADE ON DELETE CASCADE,
                PRIMARY KEY(id));',
        ];
        // execute SQL statements
        foreach ($statements as $statement) {
            $this->pdo->exec($statement);
        }
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public function getDbname(): string
    {
        return $this->dbname;
    }

    /**
     * @return int
     */
    public function getDbport(): int
    {
        return $this->dbport;
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }
}