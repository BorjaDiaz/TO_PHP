<?php
    include "../db/usuario.php";

    $result = '';
    $user = new usuario();

    if(isset($_POST["register"])){

        if(empty($_POST["user"]) == FALSE && empty($_POST["pass"] == FALSE) && empty($_POST["email"] == FALSE)){

            $_user = $user->register($_POST["user"],$_POST["pass"],$_POST["email"]);
            if($_user === TRUE){
                $result = '*Usuario registrado';
                $user->email($_POST["user"],$_POST["pass"],$_POST["email"]);
            }
            else{
                $result = '*El usuario repetido, pruebe con otro';
            }
        }
        else{
            $result = '*Rellene todos los campos';
        }
    }
    
    $user->close();

    if(isset($_POST["back"])){
        header("Location:../index.php");
    }

?>

<html lang="ES">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <title>Register</title>
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
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" name="register" id="register" class="btn btn-primary" value="Registrarse"/>
                    <button type="submit" name="back" class="btn btn-primary">Volver</button>
                </div>
                <div class="mb-3 text-center">
                <?php echo '<p style="color:red;">'.$result.'</p>'; ?>
                </div>
            </form>
        </div>
    </body>
</html>

