<?php
/**
 * Created by PhpStorm.
 * User: neiln
 * Date: 2018/03/03
 * Time: 13:03
 */
class User {
    /**
     * Validates a user according to its email and password.
     * @param string $email to check
     * @param string $password to check
     * @return array of the user's information if the validation passes; an empty array otherwise.
     */
    public static function validateByEmail(string $email, string $password): array {
        $db = new Database();
        $query = "SELECT * FROM users WHERE email = ?;";
        $result = $db->query($query, array($email));

        // There should exist one row in the result. Otherwise, it means the user does not exist.
        if (empty($result)) {
            return array();
        }

        // To check whether the password matches with this username.
        // PHP secured password verify function is used (single-way hashed with bCrypt algorithm).
        $result_row = $result[0];
        if (password_verify($password, $result_row['password'])) {
            return $result_row;
        } else {
            return array();
        }
    }

    /**
     * Signs up a new user.
     * @param string $email to insert
     * @param string $password to insert
     * @return true if sign up success.
     */
    public static function signUp(string $email, string $password): bool {
        $db = new Database();
        $query = array();
        $params = array();

        // Creates a new row in the user table.
        array_push($query, "INSERT INTO users(username, password, email) VALUES (?, ?, ?);");
        array_push($params, array($username, password_hash($password, PASSWORD_BCRYPT), $email));

        // Creates a new owner row in the profile table.
        if ($type == "owner" || $type == "both") {
            array_push($query, "INSERT INTO user_profiles(username, type, score) VALUES (?, ?, ?);");
            array_push($params, array($username, "owner", 0));
        }

        // Creates a new care taker row in the profile table.
        if ($type == "peter" || $type == "both") {
            array_push($query, "INSERT INTO user_profiles(username, type, score) VALUES (?, ?, ?);");
            array_push($params, array($username, "peter", 0));
        }

        // Uses a transaction here to ensure atomicity.
        return $db->transact($query, $params);
    }
}
