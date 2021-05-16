<?php
    try{
        include "../db/tema.php";
        session_start();

        $tema = new tema();
        $_temas = $tema->getAll();

        if(empty($_SESSION['username']) == true){
            header("Location:../index.php");
        }   
    }
    catch(Exception $e){
        error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
    }
?>

<?php $title = 'Temas'; include('../includes/header.php');?>

<main>

<!-- Modal agregar tema-->
<button class="btn btn-outline-success m-2" name="new" type="button" data-toggle="modal" data-target="#modalTema">Nuevo tema</button>

<?php
    try{
        for($i = 0; $i < count($_temas); $i++){
            $idTema = $_temas[$i]['id'];
            $count = $tema->countMessages($idTema);
            echo '<div class="container bg-success  border mt-3 pt-3 pb-3">';
                echo '<a>Creado por: '.$_temas[$i]['nombre'].'<a>';
                echo '<h3>'.$_temas[$i]['tema'].'</h3>';
                echo '<p>Mensajes: '.$count[0]['total'].'<p>';
                echo '<div class="row">';
                    echo '<div class="col-md-2"><a class="btn btn-primary btn-sm " href="mensajes.php?idTema='.$idTema.'">Ver mensajes</a></div>';
                    if($_SESSION['id'] == $_temas[$i]['idUsuario']){
                    echo '<div class="col-md-4 "><button type="submit" class="btn btn-primary btn-sm" name="delete" onclick="deleteTema('.$idTema.')">Eliminar tema</button></div>';
                    }
                echo '</div>';
                
            echo '</div>';
        };
    }
    catch(Exception $e){
        error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
    }
?>

<!-- Modal -->
<div class="modal fade" id="modalTema"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Nuevo tema</h5>
        </div>
        <form method="POST">
            <div class="modal-body">
                <input type="text" id="tema" name="tema" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo '<button type="submit" class="btn btn-primary" name="addtema" onclick="addTema('.$_SESSION['id'].')">Crear</button>'; ?>
            </div>
        </form>
    </div>
</div>
   
<!-- Borrar y Agregar Tema-->
<script type="text/javascript">

    function deleteTema(id){
        $.ajax({
            method:"POST",
            url: "../db/tema.php",
            data: {"delete": id},
            success: function(response) { console.log(response); }
        })
        location.reload();
    }

    function addTema(id){
        console.log(id);
        var tema = document.getElementById("tema").value;
        $.ajax({
            method:"POST",
            url: "../db/tema.php",
            data: {text: tema, id: id},
            success: function(response) { console.log(response); },
            error: function(req, err){console.log(err)}
        })
        location.reload();
    }
</script>

</main>

<?php  include('../includes/footer.php');?>