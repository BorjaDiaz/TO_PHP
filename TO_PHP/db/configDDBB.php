<?php 
require_once "db.php";

class configDDBB extends db{
   
    /*public function createDDBB(){
        $connect = mysqli("localhost","root","");
        $sql = "CREATE DATABASE to_php";
        mysqli_query($link,$sql);
    }*/

    public function createTableUsuarios(){
        $link = $this->_db;

        $sql = "SHOW FULL TABLES FROM to_php LIKE 'usuarios'";
        if(mysqli_query($link,$sql)->num_rows < 1){
            
            $sql = "CREATE TABLE usuarios(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                nombre VARCHAR(30) NOT NULL UNIQUE,
                contraseña VARCHAR(70) NOT NULL,
                email VARCHAR(70) NOT NULL
            )";
            mysqli_query($link,$sql);
        }
    }

    

    public function createTableTemas(){
        $link = $this->_db;

        $sql = "SHOW FULL TABLES FROM to_php LIKE 'temas'";
        if(mysqli_query($link,$sql)->num_rows < 1){
            
            $sql = "CREATE TABLE temas(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                tema VARCHAR(70) NOT NULL,
                idUsuario INT NOT NULL,
                FOREIGN KEY (idUsuario) REFERENCES usuarios(id)
            )";
            mysqli_query($link,$sql);
        }
    }

    public function createTableMensajes(){
        $link = $this->_db;

        $sql = "SHOW FULL TABLES FROM to_php LIKE 'mensajes'";
        if(mysqli_query($link,$sql)->num_rows < 1){
            
            $sql = "CREATE TABLE mensajes(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                mensaje VARCHAR(255) NOT NULL,
                idTema INT NOT NULL,
                idUsuario INT NOT NULL,
                FOREIGN KEY (idUsuario) REFERENCES usuarios(id),
                FOREIGN KEY (idTema) REFERENCES temas(id)
            )";
            mysqli_query($link,$sql);
        }
    }

    public function close(){
        $this->_db->close();
    }

}   

?>