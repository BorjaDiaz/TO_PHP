<?php 
require_once 'db.php';


class tema extends db{

    private $tema;
    private $idUsuario;

    public function getAll(){
        try{
            $sql = "SELECT temas.id,tema,idUsuario,nombre FROM temas INNER JOIN usuarios ON temas.idUsuario = usuarios.id";
            $result = $this->_db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
        
    }

    public function addTema($tema,$idUsuario){  
        try{
            
            $_tema = $this->_db->real_escape_string($tema);

            $sql = "INSERT INTO temas(tema,idUsuario) VALUES(?,?);";

            $stmt = $this->_db->prepare($sql);
            $stmt->bind_param('ss',$_tema,$idUsuario);
            if($stmt->execute() === FALSE){
                error_log("ERROR: ".mysqli_error($this->_db)."\r\n",3,LOG);
            }
            else{
                error_log("Tema registrado \r\n Tema: ".$tema."\r\n",3,LOG);
            }
           
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
        $stmt->close();
        
    
    }

    public function delete($id){
        try{
            $sql = "DELETE FROM mensajes WHERE idTema=".$id;
            $stmt = $this->_db->prepare($sql);

            if($stmt->execute() === TRUE){
                $sql = "DELETE FROM temas WHERE id=".$id;

                $stmt = $this->_db->prepare($sql);
                if($stmt->execute() === FALSE){
                    error_log("ERROR: ".mysqli_error($this->_db)."\r\n",3,LOG);
                }
                else{
                    error_log("Se ha borrado el tema con el id: ".$id."\r\n",3,LOG);
                }
            }
            else{
                error_log("Se ha borrado el tema con el id: ".$id."\r\n",3,LOG);
            }
           
        }
        catch (Exception $e) {
            error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
        }
        $stmt->close();
    }

 
    
    public function countMessages($id){
        try{
            $sql = "SELECT count(*) as total FROM mensajes WHERE idTema=".$id;
            $result = $this->_db->query($sql);
            $result = $result->fetch_all(MYSQLI_ASSOC);
            return $result;
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



if(isset($_POST['delete'])) {
    $_temas = new tema();
    echo $_temas->delete($_POST['delete']);
};

if(isset($_POST['text'])) {;
    $_temas = new tema();
    echo $_temas->addTema($_POST['text'],$_POST['id']);

};

?>