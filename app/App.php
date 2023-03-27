<?php
class App
{
    private $__controller, $__action, $__params, $__route ,$__db;

    static public $app;

    function __construct()
    {
        global $routes;

        self::$app = $this;

        $this->__route = new Route();

        if(class_exists('DB')){
            $dbObject = new DB();
            $this->__db = $dbObject->db;
        }
        
        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }
        $this->__action = 'index';
        $this->__params = [];
        $url = $this->getUrl();

        $this->__controller = 'Dashboard';
        
        $this->handleUrl();
    }

    function getUrl()
    {
        $url = '/';
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        }
        return $url;
    }

    function handleUrl()
    {
        $url = trim($this->getUrl(), '/');

        $url = $this->__route->handleRoute($url);


        $arrUrl = explode("/", $url);


        $urlCheck = '';
        if (!empty($arrUrl)) {
            foreach ($arrUrl as $key => $value) {
                
                $urlCheck .= $value . '/';

                if (!empty($arrUrl[$key - 1])) {
                    unset($arrUrl[$key - 1]);
                }

                $urlConvert = trim($urlCheck, '/');

                if (file_exists('app/controllers/' . $urlConvert . '.php')) {
                    $urlCheck = $urlConvert;
                    break;
                }

            }
        }
        if (!file_exists('app/controllers/' . $urlConvert . '.php')) {
            $urlCheck = $urlConvert.'/index';
            $arrUrl[1] = 'index';
            unset($arrUrl[0]);
        }

        $arrUrl = array_values($arrUrl);

        if (!empty($arrUrl[0])) {
            $this->__controller = $arrUrl[0];
            unset($arrUrl[0]);
        }

        if($urlCheck == '/'){
            $urlCheck = 'home';
        }

        $path =  'app/controllers/' . $urlCheck . '.php';
        if (file_exists($path)) {
            require_once 'controllers/' . $urlCheck . '.php';
            
            if (class_exists($this->__controller)) {
                Session::setSession('action',$this->__controller);
                $this->__controller = new $this->__controller();
                if(!empty($this->__db)){
                    $this->__controller->db = $this->__db;
                }
                unset($arrUrl[0]);
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }

        if (!empty($arrUrl[1])) {
            $this->__action = $arrUrl[1];
            unset($arrUrl[1]);
        }

        $this->__params = array_values($arrUrl);
        
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);

        } else {
            $this->loadError();
        }
    }

    public function loadError($name = '404',$data = [])
    {
        extract($data);
        require_once 'errors/' . $name . '.php';
    }
}