<?php
session_start();
if($_SESSION['logado']==true){
    header("Location: pages/sessao.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema ótica - login</title>

    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <!--check box bunito-->
    <link href="css/material-design-switch.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet"> 
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!--select 2-->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />-->
    <link href="css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
     <!--jQuery-->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <!--select 2-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="js/select2.mim.js"></script>
    <script src="js/select2.full.mim.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Autenticação</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="login" type="" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Lembrar de mim
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="btnLogin" class="btn btn-lg btn-success btn-block"></a>
                            </fieldset>
                        </form>
                    </div>
                    <?php
                    include("controllers/LoginController.php");
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
