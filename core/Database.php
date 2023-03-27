<?php
class Database
{
    private $__conn;


    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function query($sql, $data=[], $statementStatus=false){
        $conn = $this->__conn;
        $query = false;
        try{
            $statement = $conn->prepare($sql);
    
            if (empty($data)){
                $query = $statement->execute();
            }else{
                $query = $statement->execute($data);
            }
    
        }catch (Exception $exception){
            $mess = $exception->getMessage();
            $data['message'] = $mess;
            App::$app->loadError('database',$data);
            die(); //Dừng hết chương trình
        }
    
        if ($statementStatus && $query){
            return $statement;
        }
    
        return $query;
    }

    //Lấy id vừa insert
    function insertId()
    {
        return $this->__conn->lastInsertId();
    }

    function insert($table, $dataInsert)
    {

        $keyArr = array_keys($dataInsert);
        $fieldStr = implode(', ', $keyArr);
        $valueStr = ':' . implode(', :', $keyArr);

        $sql = 'INSERT INTO ' . $table . '(' . $fieldStr . ') VALUES(' . $valueStr . ')';

        return $this->query($sql, $dataInsert);
    }

    function update($table, $dataUpdate, $condition = '')
    {

        $updateStr = '';
        foreach ($dataUpdate as $key => $value) {
            $updateStr .= $key . '=:' . $key . ', ';
        }

        $updateStr = rtrim($updateStr, ', ');

        if (!empty($condition)) {
            $sql = 'UPDATE ' . $table . ' SET ' . $updateStr . ' WHERE ' . $condition;
        } else {
            $sql = 'UPDATE ' . $table . ' SET ' . $updateStr;
        }

        return $this->query($sql, $dataUpdate);
    }

    function delete($table, $condition = '')
    {
        if (!empty($condition)) {
            $sql = "DELETE FROM $table WHERE $condition";
        } else {
            $sql = "DELETE FROM $table";
        }

        return $this->query($sql);
    }

    // //Lấy dữ liệu từ câu lệnh SQL - Lấy tất cả
    function getRaw($sql)
    {
        $statement = $this->query($sql, [], true);
        if (is_object($statement)) {
            $dataFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $dataFetch;
        }

        return false;
    }

    // //Lấy dữ liệu từ câu lệnh SQL - Lấy 1 bản ghi
    function firstRaw($sql)
    {
        $statement = $this->query($sql, [], true);
        if (is_object($statement)) {
            $dataFetch = $statement->fetch(PDO::FETCH_ASSOC);
            return $dataFetch;
        }

        return false;
    }

    //Lấy dữ liệu theo table, field, condition
    function get($table, $field = '*', $condition = '',$orderBy = '' )
    {
        $sql = 'SELECT ' . $field . ' FROM ' . $table;
        if (!empty($condition)) {
            $sql .= ' WHERE ' . $condition;
        }
        $sql .= " $orderBy";

        echo $sql;
        die();

        return $this->getRaw($sql);
    }

    function first($table, $field = '*', $condition = '')
    {
        $sql = 'SELECT ' . $field . ' FROM ' . $table;
        if (!empty($condition)) {
            $sql .= ' WHERE ' . $condition;
        }

        return $this->firstRaw($sql);
    }

    //function bổ sung
    //lấy số dòng câu truy vấn
    function getRows($sql)
    {
        $statement = $this->query($sql, [], true);
        if (!empty($statement)) {
            return $statement->rowCount();
        }
    }
}