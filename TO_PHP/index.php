<html lang="ES">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <title>Index</title>
    </head>
    </head>
        <body>
            <div style="width: 300px;" class="container border  rounded bg-dark text-white pt-3 mt-5">
                <form method="POST" class="d-flex justify-content-between">
                        <div>
                            <input style="width: 90px;" type="submit" name="login" class="btn btn-primary" value="Login"/>
                        </div>
                        <div>
                            <input style="width: 90px;" type="submit" name="register" class="btn btn-primary" value="Registrar"/>
                        </div>
                </form>
            </div>
        </body>
</html>

<?php
    include "db/configDDBB.php";

    $ddbb = new configDDBB();
    //$ddbb->createDDBB();
    $ddbb->createTableUsuarios();
    $ddbb->createTableTemas();
    $ddbb->createTableMensajes();
    $ddbb->close();

    if(isset($_POST["register"])){
        header("Location:src/register.php");
    }
    if(isset($_POST["login"])){
        header("Location:src/login.php");
    }


?>
