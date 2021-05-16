<?php 
    try{
        include "../db/usuario.php";
        
        session_start();

        $result = '';
        $usuario = new usuario();

        if(isset($_POST["change"])){
            $id = $_SESSION['id'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            if($pass === $pass2){
                if($usuario->changePassword($id,$pass)){
                    $result = 'Contraseña cambiada';
                }else{
                    $result = 'Ha ocurrido un error al cambiar la contraseña';
                }
            }else{
                $result = '*Las contraseñas no coinciden';
            }
            
        }
    }
    catch(Exception $e){
        error_log("Excepción capturada: ".$e->getMessage()."\r\n",3,LOG);
    }
?>

<?php $title = 'Cambio contraseña'; include('../includes/header.php');?>

<main>       
    <div style="width: 300px;" class="container border  rounded bg-dark text-white pt-3 mt-5">
        <form method="POST" class="align">
            <div class="mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Repita la contraseña</label>
                <input type="password" name="pass2" class="form-control">
            </div>
            <div class="mb-3">
                <input type="submit" name="change" id="change" class="btn btn-primary" value="Cambiar"/>
            </div>
            <div class="mb-3 text-center">
            <?php echo '<p>'.$result.'</p>'; ?>
            </div>
        </form>
    </div>


</main>


<?php include('../includes/footer.php');?>