<?php
    include "../db/usuario.php";

    $user = new usuario();
    $result = '';
    if(isset($_POST["login"])){

        if(empty($_POST["user"]) == FALSE && empty($_POST["pass"] == FALSE)){

            $_user = $user->login($_POST["user"]);

            if($_user !== FALSE){
                if($user->verifyPass($_POST["pass"],$_user["contraseña"]) === TRUE){
                    session_start();
                    $_SESSION['id'] = $_user["id"];
                    $_SESSION['username'] = $_user["nombre"];
                    $_SESSION['password'] = $_POST["pass"];
                    $_SESSION['email'] =$_user["email"];
                    header("Location:temas.php");                
                }
                else{
                    $result = '*contraseña erronea';
                }
            }
            else{
                $result = '*Usuario no encontrado';
            }
        }
        else{
            $result = '*Rellene todos los campos';
        }
        
    }

    if(isset($_POST["back"])){
        header("Location:../index.php");
    }

    $user->close();
?>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <title>Login</title>
    </head>

    <body>
        <div style="width: 300px;" class="container border  rounded bg-dark text-white pt-3 mt-5">
            <form method="POST" class="align">
                <div class="mb-3">
                    <label class="form-label" >Nombre Usuario</label>
                    <input type="text" name="user" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="pass" class="form-control">
                </div>
                <button type="submit" name="login" class="btn btn-primary">Iniciar sesión</button>
                <button type="submit" name="back" class="btn btn-primary">Volver</button>
                <?php echo '<p style="color:red;">'.$result.'</p>'; ?>
            </form>
        </div>
    </body>
</html>

