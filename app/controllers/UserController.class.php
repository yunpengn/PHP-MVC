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
        	$data["errorMessage"] = "You have entered an invalid email/email address or password";
            $this->show("User/login", $data);
        }
    }

    /**
     * Handles the user sign-up logic.
     *
     * @param array $data is the parameters passed in.
     * @throws NotFoundException when the page is not found.
     */
    public function signup($data = array()) {
        if (!isset($_POST["email"]) || !isset($_POST["password"])) {
            $this->show("User/signup", $data);
            return;
        }

        $result = User::signUp($_POST["email"], $email, $password, $type);
        if ($result) {
            $_SESSION['authorized'] = true;
            $_SESSION['email'] = $email;
            $this->show("index", $data);
        } else {
            $data["errorMessage"] = "email/email address has registered.";
            $data["email"] = $email;
            $data["email"] = $email;
            $data["type"] = $type;
            $this->show("User/signup", $data);
        }
    }
}
