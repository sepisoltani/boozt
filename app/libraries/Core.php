<?php

namespace App\libraries;

/*
 * Core Class for Creating URL and Loading Core Controllers
 * URL Format - /controller/method/param
 */

class Core
{
    /**
     * @var mixed|string
     */
    protected mixed $currentController = 'Home';
    /**
     * @var string
     */
    protected string $currentmethod = 'index';
    /**
     * @var array|false|string[]
     */
    protected array $params = [];

    /**
     * Parse urls
     * @return false|string[]
     */
    public function parseURL()
    {
        if (isset($_GET['url'])) { // if the url param is set do below
            $url = rtrim($_GET['url'], '/');

            $url = filter_var($url, FILTER_SANITIZE_URL);

            $url = explode('/', $url);

            return $url; // return the url to whatever place that it is been called, in our case, it is called by the __contsruct above.
        }
    }

    /**
     * Hold the class instance.
     * @var Core|null
     */
    private static ?Core $instance = null;

    /**
     *  The object is created from within the class itself
     *  only if the class has no instance.
     *  Singleton Design pattern :)
     * @return Core|null
     */
    public static function getInstance(): ?Core
    {
        if (self::$instance == null) {
            self::$instance = new Core();
        }
        return self::$instance;
    }

    /**
     * Private constructor because of singleton desing pattern
     * Core constructor.
     */
    private function __construct()
    {
        // If you want to output the value of the array use print_r($this->getUrl());
        $url = $this->parseURL();
        /*
         * Since all our request are routed to index.php, we need to act as though this file is located in there
         * Which is why I have .. to move out from the public directory (where the index.php is located), and then we
         * move into /app/controllers
         */
        if (isset($url[0])) {
            if (file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')) {
                // if the file exists, we set it as the current controller
                $this->currentController = ucwords($url[0]); // our default controller is Pages, which is defined above, anything founded would override it.
                /*
                 * Unset the 0 index, The unset() function would delete index 0, but would leave the other indexes
                 * You'll see the reason we ae using this below
                 */
                // unset the 0 index
                unset($url[0]);
            }
        }
        /*
         * Require the controller, if anything is not found, it would require the default pages, and instantiate it
         * if something is found, the founded file would have been set to the current controller above, we then require and instantiate it.
         */
        $controllerClass = 'App\\controllers\\' . $this->currentController;
        // instantiate controller class
        // if for example, the controller is Post, then it would be post = new Post
        $this->currentController = new $controllerClass;
        /*
         * Check for second parameter of the url, for example if we have pages/music/3,
         * then the second parameter would be music
         */
        if (isset($url[1])) {
            //check to see if methods exist in controller
            /*
             * method_exist takes two parameter, we are checking the currentcontroller first
             * and the method which is going to be the second part of the url
             */
            if (method_exists($this->currentController, $url[1])) {
                // if the method is there, we set the current method
                // so, the method would have to exist in the $this->currentController class, for example Pages.
                $this->currentmethod = $url[1];
                // unset the 1 index
                unset($url[1]);
            }
        }
        /*
         * Let's take care of the other parameters, by unsetting index 0 and 1, it is easy to take care of the rest
         * if there is paramters left in the $url we add them with the array_values, if otherwise, we default to empty array
         */
        // Get Params
        $this->params = $url ? array_values($url) : [];
        // call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentmethod], $this->params);
    }
}