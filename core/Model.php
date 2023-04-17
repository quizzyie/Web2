<?php
abstract class Model extends Database
{
    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }
    
    abstract function tableFill();

    abstract function fieldFill();

    // public function getAllData()
    // {
    //     $tableName = $this->tableFill();
    //     $fieldSelect = $this->fieldFill();
    //     $sql = "select $fieldSelect from $tableName orderby create_at desc";
    //     $query = $this->db->getRaw($sql);
    //     return $query;
    // }

    public function getFirstData($condition = '')
    {
        $tableName = $this->tableFill();
        $fieldSelect = $this->fieldFill();
        $query = $this->db->first($tableName,$fieldSelect,$condition);
        
        return $query;
    }

    public function getFirstTableData($table,$condition){
        return $this->db->first($table,'*',$condition);
    }

    public function getFirstRaw($sql){
        return $this->db->firstRaw($sql);
    }
    
    public function getData($condition="",$orderBy = "",$limit = ""){
        $tableName = $this->tableFill();
        $fieldSelect = $this->fieldFill();
        $sql = "select $fieldSelect from $tableName $orderBy $limit";
        if(!empty($condition)){
            $sql = "select $fieldSelect from $tableName where $condition $orderBy $limit";
        }
        return $this->db->getRaw($sql);
    }

    public  function getTableData($table,$condition = "",$orderBy = "",$limit=""){
        $fieldSelect = $this->fieldFill();
        $sql = "select $fieldSelect from $table $orderBy $limit";
        if(!empty($condition)){
            $sql = "select $fieldSelect from $table where $condition $orderBy $limit";
        }
        return $this->db->getRaw($sql);
    }

    public function getRawModel($sql){
        return $this->db->getRaw($sql);
    }

    public function addData($data = []){
        $tableName = $this->tableFill();
        if(!empty($data)){
            return $this->db->insert($tableName,$data);
        }
        return false;
    }

    public function addTableData($table,$data = []){
        if(!empty($data)){
            return $this->db->insert($table,$data);
        }
        return false;
    }

    public function updateData($data = [],$condition = ""){
        $tableName = $this->tableFill();
        if(!empty($data)){
            return $this->db->update($tableName,$data,$condition);
        }
        return false;
    }

    public function updateTableData($table,$data = [],$condition = ""){
        if(!empty($data)){
            return $this->db->update($table,$data,$condition);
        }
        return false;
    }

    public function deleteData($condition = ""){
        $tableName = $this->tableFill();
        return $this->db->delete($tableName,$condition);
    }

    public function deleteTableData($table,$condition=""){
        return $this->db->delete($table,$condition);
    }

    public function getRowsModel($sql){
        return $this->db->getRows($sql);
    }

    public function insertIdModel(){
        return $this->db->insertId();
    }
    public function getFooter(){
        $sql = "SELECT opt_value FROM options WHERE opt_key = 'general_footer'";
        return $this->getFirstRaw($sql);
    }
}