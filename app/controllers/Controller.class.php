<?php
/**
 * The base class for all controllers.
 *
 * Created by PhpStorm.
 * User: neiln
 * Date: 2018/02/25
 * Time: 21:27
 */
class Controller {
    /**
     * Displays a certain page to the user.
     *
     * @param $page
     * @param array $data is an optional parameter to pass in additional data.
     * @throws NotFoundException when the page is not found.
     */
    public function show($page, $data = array()) {
        extract($data);
        $url = "app/views/" . $page . ".php";

        // Includes the navigation bar.
        $this->includeNavigation();

        // Checks whether the page exists.
        if(file_exists($url)){
            require $url;
        } else {
            throw new NotFoundException("The given view " . $page . "cannot be found.");
        }
    }

    public function includeNavigation() {
        require "app/views/nav.php";
    }

    public static function hasLogin(): bool {
        return isset($_SESSION['authorized']) && $_SESSION['authorized'] == true;
    }
}
