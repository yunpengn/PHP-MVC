<?php
/**
 * Created by PhpStorm.
 * User: neiln
 * Date: 2018/03/03
 * Time: 12:47
 */
class Database {
    // The PHP database object (PDO).
    var $db;

    public function __construct() {
        // To establish connection to the database.
        try {
            $this->db = new PDO(DSN, DB_USER, DB_PASSWORD);
            // Set the error mode to throw exceptions.
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Catch the potential exception here for defensive programming practice.
            die("Cannot connect to the database. ". $e->getMessage() . "<br>");
        }
    }

    public function query(string $query, $variables = array()): array {
        // Prepared statement for query to the database later (to avoid SQL injection attack).
        $stmt = $this->db->prepare($query);

        // Query to the database or report error.
        try {
            $stmt->execute($variables);
        } catch (PDOException $e) {
            // Catch the potential exception here for defensive programming practice.
            die("Cannot query to the database. ". $e->getMessage() . "<br>");
        }

        // Fetch all the rows returned by the statement to an associate array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executes a single insert or update statement.
     *
     * @param string $query
     * @param array $variables
     * @return bool true if the statement executes successfully.
     */
    public function insertOrUpdate(string $query, $variables = array()): bool {
        // Prepared statement for query to the database later (to avoid SQL injection attack).
        $stmt = $this->db->prepare($query);
        // Query to the database or report error.
        try {
            $stmt->execute($variables);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Executes a series of queries as a transaction to ensure atomicity.
     *
     * @param array $query an array of queries to be executed within the transaction block.
     * @param array $params a 2D array containing the parameters for the queries.
     * @return bool true if the transaction is committed; false otherwise (rollback).
     */
    public function transact(array $query, array $params): bool {
        // Query to the database or report error.
        try {
            $this->db->beginTransaction();

            // Inserts statements into the transaction one-by-one.
            for ($i = 0; $i < count($query); $i++) {
                // Prepared statement for query to the database later (to avoid SQL injection attack).
                $stmt = $this->db->prepare($query[$i]);
                $stmt->execute($params[$i]);
            }

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}

