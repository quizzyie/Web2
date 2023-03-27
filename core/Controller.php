<?php
class Controller
{
    public $db;
    public function model($nameModel)
    {
        $path = PATH_ROOT . "/app/models/$nameModel.php";

        if (file_exists($path)) {
            require_once $path;

            if (preg_match('~\/~', $nameModel)) {
                $arr_name = explode('/', $nameModel);
                $nameModel = end($arr_name);
            }
            if (class_exists($nameModel)) {
                $model = new $nameModel();
                return $model;
            }
        }

        return false;
    }

    public function renderView($path = "", $data = [])
    {
        $url = PATH_ROOT . "/app/views/$path.php";
        // echo $url;

        extract($data); //đổi key của mảng thành biến
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        if (file_exists($url)) {
            require_once $url;
            return true;
        }

        return false;
    }
}