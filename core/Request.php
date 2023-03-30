<?php
class Request
{
    private $__rules = [], $__messages = [], $__errors;

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->getMethod() == 'get';
    }

    public function isPost()
    {
        return $this->getMethod() == 'post';
    }

    public function getFields()
    {
        $dataField = [];

        if ($this->isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if (is_array($value)) {
                        $dataField[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataField[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if ($this->isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        return $dataField;
    }
    
    public function getFieldsWithData($data){
        $dataField = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            } else {
                $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $dataField;
    }

    public function rules($rules = [])
    {
        $this->__rules = $rules;
    }

    public function message($mess = [])
    {
        $this->__messages = $mess;
    }

    public function validate($data = [])
    {

        $checkValidate = true;

        if (!empty($this->__rules)) {
            foreach ($this->__rules as $key_rule => $rule) {
                $arr_rule = explode('|', $rule);//Tách dấu | trong mảng rule
                foreach ($arr_rule as $check_rule => $value_rule) {//Duyệt qua mảng rule
                    $arr_field = explode(':', $value_rule);//Xử lý trường hợp có dấu :
                    $field = reset($arr_field);
                    $fieldCondition = '';
                    if(count($arr_field)>1){
                        $fieldCondition = end($arr_field);
                    }
                    if($field=='required'){
                        if(empty($data[$key_rule])){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                    if($field=='min'&&empty($this->__errors[$key_rule])){
                        if(strlen(trim($data[$key_rule]))< $fieldCondition){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                    if($field=='max'&&empty($this->__errors[$key_rule])){
                        if(strlen(trim($data[$key_rule]))> $fieldCondition){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                    if($field=='email'&&empty($this->__errors[$key_rule])){
                        if(!filter_var($data[$key_rule],FILTER_VALIDATE_EMAIL)){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                    if($field=='selected'&&empty($this->__errors[$key_rule])){
                        if($data[$key_rule]==0){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                    if($field=='phone'&&empty($this->__errors[$key_rule])){
                        if(!preg_match('~(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b~',$data[$key_rule])){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                    if($field=='match'&&empty($this->__errors[$key_rule])){
                        if($data[$key_rule]!=$data[$fieldCondition]){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                    if($field=='unique'&&empty($this->__errors[$key_rule])){
                        $db = new Database();
                        $arr_check = explode(',',$fieldCondition);
                        $n = count($arr_check);
                        $row = 0;
                        if($n==2){
                            $table = reset($arr_check);
                            $fieldCol = end($arr_check);
                            $row = $db->getRows("select * from $table where $fieldCol = '".$data[$key_rule]."'");
                        }else if($n==3){
                            $table = reset($arr_check);
                            $fieldCol = $arr_check[1];
                            $id = end($arr_check);
                            $row = $db->getRows("select * from $table where $fieldCol = '".$data[$key_rule]."' and id <> $id");
                        }
                        if($row!=0){
                            $this->getErr($key_rule,$field);
                            $checkValidate = false;
                        }
                    }
                }
            }
        }

        // echo "<pre>";
        // print_r($this->__errors);
        // echo "</pre>";

        return $checkValidate;
    }

    public function getErr($key_rule,$field){
        $this->__errors[$key_rule][$field] = $this->__messages["$key_rule.$field"];
    }
    
    public function setErr($key_rule,$field,$msg = ""){
        $this->__errors[$key_rule][$field] = $msg;
    }

    public function error($fieldName = '')
    {
        if(!empty($this->__errors)){
            if(empty($fieldName)){
                return $this->__errors;
            }
            return reset($this->__errors[$fieldName]);
        }
    } 
}