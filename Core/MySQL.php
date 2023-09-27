<?php

/**
 * Weaver Framework - MySQL Database Connection Class
 *
 * This class provides a MySQL database connection and common database operations.
 * It implements the Singleton pattern to ensure a single database connection is used. 
 */

class MySQL
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;
    private static $instance;

    private function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    /**
     * Get the Singleton instance of the MySQL class.
     *
     * @return MySQL The MySQL instance.
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
        }
        return self::$instance;
    }

    /**
     * Establish a database connection.
     */
    private function connect()
    {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->conn->connect_error) {
                throw new Exception_("#MySQL Connection Error: " . $this->conn->connect_error);
            }
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
            throw $e;
        }
    }

    /**
     * Execute a database query.
     *
     * @param string $sql The SQL query to execute.
     * @return mixed The query result or false on error.
     */
    public function query($sql)
    {
        try {
            $result = $this->conn->query($sql);

            if (!$result) {
                throw new Exception_("#MySQL Query Error:" . $this->conn->error);
            }

            return $result;
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }

    /**
     * Retrieve query results as an array of objects.
     *
     * @param mysqli_result $result The query result.
     * @return array An array of objects representing query results.
     */
    public function result($result)
    {
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * Escape a string for safe use in SQL queries.
     *
     * @param string $string The string to escape.
     * @return string The escaped string.
     */
    public function escape($string)
    {
        return "'" . $this->conn->real_escape_string($string) . "'";
    }

    /**
     * Get the last inserted ID from an auto-increment field.
     *
     * @return int The last inserted ID.
     */
    public function insertID()
    {
        return $this->conn->insert_id;
    }

    /**
     * Lock a database table for write operations.
     *
     * @param string $table The name of the table to lock.
     */
    public function lockTable($table)
    {
        $this->query("LOCK TABLES {$table} WRITE");
    }

    /**
     * Lock multiple database tables for write operations.
     *
     * @param array $tables An array of table names to lock.
     */
    public function lockTables($tables)
    {
        $tableList = implode(' WRITE, ', $tables) . ' WRITE';
        $this->query("LOCK TABLES {$tableList}");
    }

    /**
     * Unlock previously locked database tables.
     */
    public function unlockTables()
    {
        $this->query("UNLOCK TABLES");
    }

    /**
     * Get the number of affected rows by the last INSERT, UPDATE, DELETE query.
     *
     * @return int The number of affected rows, or -1 if no query has been executed.
     */
    public function affectedRows()
    {
        if ($this->conn) {
            return $this->conn->affected_rows;
        } else {
            return -1;
        }
    }
}
