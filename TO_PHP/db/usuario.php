<?php

require_once 'db.php';

class usuario extends db{

    private $nombre;
    private $pass;
    private $email;


    /* REGISTRAR USUARIO */
    public function register($nomb,$psw,$mail){  
        try{
            
            $_nombre = $this->_db->real_escape_string($nomb);
            $_pass = $this->_db->real_escape_string($psw);
            $_email = $this->_db->real_escape_string($mail);

            $_hash = md5($_pass);

            $sql = "INSERT INTO usuarios(nombre,contraseña,email) VALUES(?,?,?);";

            $stmt = $this->_db->prepare($sql);
            $stmt->bind_param('sss',$_nombre,$_hash,$_email);
            if($stmt->execute() === FALSE){
                error_log("ERROR: ".mysqli_error($this->_db)."\r\n",3,LOG);
                return FALSE;
            }
            else{
                error_log("Usuario registrado \r\n USUARIO: ".$_nombre."\r\n PASSWORD: ".$_hash."\r\n EMAIL: ".$_email."\r\n",3,LOG);
                return TRUE;
            }
           
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
        $stmt->close();
        
    
    }

    /* LOGEAR USUARIO */
    public function login($nomb){
        try{
            $sql = "SELECT id , nombre , contraseña, email FROM usuarios WHERE nombre = ?;";
            $stmt = $this->_db->prepare($sql);
            $stmt->bind_param('s',$nomb);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = mysqli_fetch_assoc($result);
            if($usuario){
                return $usuario;
            }
            else{
                return FALSE;
            }
            
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
    }

    /* ENVIAR EMAIL */
    public function email($nomb,$psw,$mail){
        try{
            $para = $mail;
            $titulo = 'Cuenta';
            $mensaje = 'La cuenta se a creado correctamente.'.'\r\n'.
            'Usuario: '.$nomb.'\r\n'.
            'Contraseña: '.$psw.'\r\n'.
            'Email: '.$mail.'\r\n';
            $cabecera = '';
            //mail($para,$titulo,$mensaje,$cabecera);
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }  
    }

    /* VERIFICAR CONTRASEÑA CODIFICADA */
    public function verifyPass($pass,$hash){
        $pass = md5($pass);
        if ($pass == $hash) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function changePassword($id,$pass){
        try{
            
            $_id = $this->_db->real_escape_string($id);
            $_pass = $this->_db->real_escape_string($pass);

            $_hash = md5($_pass);

            $sql = "UPDATE usuarios SET contraseña = ? WHERE id = ?";

            $stmt = $this->_db->prepare($sql);
            $stmt->bind_param('ss',$_hash,$_id);
            if($stmt->execute() === FALSE){
                error_log("ERROR: ".mysqli_error($this->_db)."\r\n",3,LOG);
                return FALSE;
            }
            else{
                error_log("Contraseña cambiada \r\n USUARIO: ".$id."\r\n PASSWORD: ".$_hash."\r\n",3,LOG);
                return TRUE;
            }
           
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
        $stmt->close();
    }

    public function close(){
        $this->_db->close();
    }

}

?>