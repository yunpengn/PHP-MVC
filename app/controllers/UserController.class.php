<?php
/**
 * Created by PhpStorm.
 * User: neiln
 * Date: 2018/04/25
 * Time: 19:49
 */
class UserController extends Controller {
    /**
     * Handles the user login logic.
     *
     * @param array $data is the parameters passed in.
     * @throws NotFoundException when the page is not found.
     */
    public function login($data = array()) {
        if (self::hasLogin()) {
            header("Location:" . APP_URL);
        }
        if (!isset($_POST["email"]) || !isset($_POST["password"])) {
            $this->show("User/login", $data);
            return;
        }

        // Validates by email.
        $result = User::validate($_POST["email"], $_POST["password"]);
        if (!empty($result)) {
            $_SESSION['authorized'] = true;
            $_SESSION['email'] = $result['email'];
            header("Location:" . APP_URL);
        } else {
        	$data["errorMessage"] = "You have entered an invalid email address or password.";
            $this->show("User/login", $data);
        }
    }

    /**
     * Handles the user sign-up logic.
     *
     * @param array $data is the parameters passed in.
     * @throws NotFoundException when the page is not found.
     */
    public function signUp($data = array()) {
        if (self::hasLogin()) {
            header("Location:" . APP_URL);
        }
        if (!isset($_POST["email"]) || !isset($_POST["password"])) {
            $this->show("User/signup", $data);
            return;
        }

        if (User::signUp($_POST["email"], $_POST["password"])) {
            $_SESSION['authorized'] = true;
            $_SESSION['email'] = $_POST["email"];
            header("Location:" . APP_URL);
        } else {
            $data["errorMessage"] = "The email address has been registered by someone else.";
            $this->show("User/signUp", $data);
        }
    }
}
