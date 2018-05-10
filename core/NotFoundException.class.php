<?php
/**
 * Created by PhpStorm.
 * User: neiln
 * Date: 2018/02/25
 * Time: 21:58
 */
class NotFoundException extends Exception {
    /**
     * Displays the 404 page.
     */
    public function showError() {
        $err_dir = 'public/404.php';

        // Checks whether the file exists.
        if(file_exists($err_dir)){
            $_POST["error_msg"] = $this->message;
            require $err_dir;
        } else {
            echo $this->message;
        }
    }
}

