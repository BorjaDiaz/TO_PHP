<?php
require_once 'config.php';

class db{

    protected $_db;

    public function __construct(){
        $this->_db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if($this->_db->connect_errno){
            echo "Error al conectar a MySQL: (".$_db->connect_errno.")".$_db->connect_error;
        }
        $this->_db->set_charset(DB_CHARSET);
    }
    
}
?>