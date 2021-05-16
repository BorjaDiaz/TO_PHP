<?php 

require_once 'db.php';

class mensaje extends db{
    
    private $mensaje;
    private $idTema;
    private $idUsuario;

    public function getAll($idTema){
        try{
            $sql = "SELECT mensajes.id,mensaje,idTema,idUsuario,nombre FROM mensajes INNER JOIN usuarios ON mensajes.idUsuario = usuarios.id WHERE idTema =".$idTema;
            $result = $this->_db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
        
    }

    public function add($text,$idTema,$idUsuario){
        try{
            
            $_text = $this->_db->real_escape_string($text);

            $sql = "INSERT INTO mensajes(mensaje,idTema,idUsuario) VALUES(?,".$idTema.",".$idUsuario.");";

            $stmt = $this->_db->prepare($sql);
            $stmt->bind_param('s',$_text);
            if($stmt->execute() === FALSE){
                error_log("ERROR: ".mysqli_error($this->_db)."\r\n",3,LOG);
                return FALSE;
            }
            else{
                error_log("Mensaje registrado \r\n TEXTO: ".$text."\r\n idTema: ".$idTema."\r\n idUsuario: ".$idUsuario."\r\n",3,LOG);
                return TRUE;
            }
           
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
        $stmt->close();
    }

    public function delete($id){
        try{
            $sql = "DELETE FROM mensajes WHERE id=".$id;

            $stmt = $this->_db->prepare($sql);
            if($stmt->execute() === FALSE){
                error_log("ERROR: ".mysqli_error($this->_db)."\r\n",3,LOG);
            }
            else{
                error_log("Se ha borrado el mensaje con el id: ".$id."\r\n",3,LOG);
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

if(isset($_POST['delete'])){
    $_mensaje = new mensaje();
    echo $_mensaje->delete($_POST['delete']);
};

?>