<?php
namespace model;

use PDO;
use PDOException;

class SqliteConnection
{
    private static $instance = null;
    private PDO $connection;

    /**
     * Private constructor for singleton pattern.
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO('sqlite:'.DB_FILE);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Échec de la connexion : ' . $e->getMessage();
            exit();
        }
    }

    /**
     * Get an instance of the SqliteConnection class.
     * @return SqliteConnection The single instance of this class.
     */
    public static function getInstance(): SqliteConnection
    {
        if (self::$instance == null) {
            self::$instance = new SqliteConnection();
        }
        return self::$instance;
    }

    /**
     * Get the established PDO connection.
     * @return PDO The PDO connection object.
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
