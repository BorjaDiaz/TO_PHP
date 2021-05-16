
<header>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <title>
        <?php
            if(isset($title)){
                echo $title;
            }else{
                echo "TO_PHP"; 
            }
        ?>
        </title>
    </head>
<body>

    <nav class="navbar navbar-dark bg-dark" style="height: 60px;">
        <form method="POST">
            <div class="container-fluid">
                <button class="btn btn-outline-success" name="temas" type="submit">Temas</button>
                <button class="btn btn-outline-success" name="password" type="submit">Cambiar contraseña</button>
                <button class="btn btn-outline-success" name="logout" type="submit">Cerrar Sesión</button>
            </div>
        </form>
    </nav>

    <?php
        if(isset($_POST["temas"])){
            header("Location:temas.php");
        }

        if(isset($_POST["password"])){
            header("Location:../src/changePassword.php");
        }

        if(isset($_POST["logout"])){
            session_destroy();
            header("Location:../index.php");
        }
    ?>

</header>