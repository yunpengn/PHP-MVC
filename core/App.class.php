<?php
/**
 * Created by PhpStorm.
 * User: neiln
 * Date: 2018/02/25
 * Time: 18:54
 */
class App {
    /**
     * Runs the application when the user enters a URL.
     *
     * @param string $url is the URL being entered.
     * @throws NotFoundException when the controller or method is not found.
     */
    public static function run(string $url) {
        $parsed = self::parseUrl($url);
        $params = self::parseParams();

        // Gets the path to the controller class.
        $url = "app/controllers/" . $parsed["controller"] . ".class.php";

        // Checks whether the controller file exists.
        if (file_exists($url)) {
            $c = new $parsed["controller"];
        } else {
            throw new NotFoundException("The requested controller " . $parsed["controller"] . " does not exist.\n");
        }

        // Calls the method in the controller class.
        if (method_exists($c, $parsed["method"])) {
            $m = $parsed["method"];
            $c->$m($params);
        } else {
            throw new NotFoundException("The requested method " . $parsed["method"] . " does not exist.\n");
        }
    }

    /**
     * Parses the URL parameters to route to the correct controller.
     * @param string $url is the URL being parsed.
     * @return array consisting of two items, controller name & method name.
     */
    private static function parseUrl(string $url): array {
        // Only takes the part of the URI without query string.
        $documentPath = explode('?', $url);
        // Divides the document path into two parts, controller name & method name.
        $path = explode('/', $documentPath[0]);
        // Stores the result in an associate array.
        $result = array();

        // Checks whether the given URL contains the controller & method name.
        if (count($path) == 2) {
            $result["controller"] = $path[0] . "Controller";
            $result["method"] = $path[1];
        } else if (count($path) > 2) {
            $controller = $path[count($path) - 2];
            $method = $path[count($path) - 1];
            header("Location: " . APP_URL);
            die();
        } else {
            // Otherwise, loads the default one.
            $result["controller"] = "HomeController";
            $result["method"] = "index";
        }

        return $result;
    }

    /**
     * Gets all the parameters for the controller method.
     *
     * @return array from the $_REQUEST parameter, consisting parameters from GET, POST and cookie.
     */
    private static function parseParams(): array {
        return $_REQUEST;
    }

    /**
     * Creates a customize auto-loader ready for use.
     * @param $className
     * @throws NotFoundException if the given class name cannot be found.
     */
    public static function myAutoLoader($className) {
        $controller = 'app/controllers/' . $className . '.class.php';
        $model = 'app/models/' . $className . '.class.php';
        $core = 'core/' . $className . '.class.php';
        $mailer = 'mailer/' . $className . '.class.php';

        if(file_exists($controller)) {
            require_once $controller;
        } else if (file_exists($model)) {
            require_once $model;
        } else if (file_exists($core)) {
            require_once $core;
        } else if (file_exists($mailer)){
            require_once $mailer;
        } else {
            throw new NotFoundException("The class named " . $className . " cannot be found.");
        }
    }
}
