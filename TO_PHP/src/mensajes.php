<?php
   try{
        include "../db/mensaje.php";
       
        session_start();

        $mensaje = new mensaje();

        if(isset($_GET["idTema"])){

            $idTema = $_GET["idTema"];
            $idUsuario = $_SESSION['id'];
            $_mensajes = $mensaje->getAll($idTema);

            if(isset($_POST["add"])){
                if(!empty($_POST["text"])){
                    $text = $_POST["text"];
                    $mensaje->add($text,$idTema,$idUsuario);
                    header("Refresh:0");
                }
            }
        }

        if(empty($_SESSION['username']) == true){
           header("Location:../index.php");
        }
   }
   catch(Exception $e){
       error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
   }
  
?>

<?php $title = 'Mensajes'; include('../includes/header.php');?>



<main>
    <form method="POST">
        <div class="container border rounded mt-3 pt-3">
            <textarea class="form-control" rows="5" id="text" name="text"></textarea>
            <button  class="btn btn-primary btn-sm mt-2 mb-2" name="add" type="submit">Nuevo Mensaje</button>
        </div>
    </form>

<?php 
    for($i = 0; $i < count($_mensajes); $i++){
        echo '<div class="container border rounded mt-3 pt-3 pb-3">';
        echo '<p>'.$_mensajes[$i]['nombre'].' :<p>';
        echo '<p>'.$_mensajes[$i]['mensaje'].'</p>';
        if($_SESSION['id'] == $_mensajes[$i]['idUsuario']){
            $idMensaje = $_mensajes[$i]['id'];
            echo '<button class="btn btn-primary btn-sm" onclick="deleteTema('.$idMensaje.')" name="delete" type="submit">Eliminar Mensaje</button>';
        }
        echo '</div>';
    };
?>


<script type="text/javascript">

    function deleteTema(id){

        console.log(id);
        $.ajax({
            method: "POST",
            url: "../db/mensaje.php",
            data: {"delete": id},
            success: function(response) { console.log(response); }
        })
        location.reload();
    }
</script>
</main>

<?php  include('../includes/footer.php');?>
