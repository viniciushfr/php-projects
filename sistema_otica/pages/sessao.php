<?php
include_once("../controllers/AcessoController.php")
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Ótica</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <!--check box bunito-->
    <link href="../css/material-design-switch.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!--date e time picker-->
    <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/ >
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet"> 
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <link href="../css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!--select 2-->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />-->
    <link href="../css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="../css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
     <!--jQuery-->
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>
    <script src="../js/metisMenu.min.js"></script>
    <!--select 2-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../js/select2.mim.js"></script>
    <script src="../js/select2.full.mim.js"></script>
    <!-- mascara dos formularios-->
    <script src="../js/jquery.maskedinput.min.js"></script>
    <!--date e time picker-->
    <script src="../js/jquery.datetimepicker.full.min.js"></script>

</head>

<body>

    <div id="wrapper">
        <!--inicio do layout-->
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="sessao.php?page=inicio.php"><span class='label label-primary '><i class="glyphicon glyphicon-sunglasses  "></i>     Sistema otica</span></a>
            </div>
            <!-- /.navbh3r-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" >
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Usuario</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuraçoes</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../controllers/LogoutController.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="sessao.php?page=inicio.php"><i class="fa fa-home fa-fw"></i>  Home</a>
                        </li>
                        <li>
                            <a href="sessao.php?page=caixa/index.php"><i class="fa fa-inbox fa-fw"></i>  Caixa</a>
                        </li>
                        <li>
                            <a href="sessao.php?page=historico/index.php"><i class="fa fa-history fa-fw"></i>  Historico</a>
                        </li>
                        <li>
                        <!--nav bar second level-->
                        <a href="#"><i class="fa fa-money fa-fw"></i>   Finanças<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="sessao.php?page=contas/entrada-vencidos.php">  Contas a receber vencidas</a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=contas/saida-vencidos.php">  Contas a pagar vencidas</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <!--nav bar second level-->
                         <li>
                            <!--nav bar second level-->
                            <a href="#"><i class="fa fa-book fa-fw"></i> Cadastros<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="sessao.php?page=cadastro/cliente.php"> Cliente </a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=cadastro/funcionario.php"> Funcionario </a>
                  
                                </li>
                                <li>
                                    <a href="sessao.php?page=cadastro/fornecedor.php"> Fornecedor</a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=cadastro/produto.php"> Produto</a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=cadastro/servico.php">Serviço</a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=cadastro/prescricao.php">Prescrição</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                        <!--nav bar second level-->
                        <a href="#"><i class="fa fa-user fa-fw"></i>Consultas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="sessao.php?page=consulta/cliente.php"> Cliente </a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=consulta/prescricao.php"> Prescrições </a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=consulta/funcionario.php"> Funcionario </a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=consulta/fornecedor.php"> Fornecedor</a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=consulta/produto.php"> Estoque</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                        <li>
                        <!--nav bar second level-->
                        <a href="#"><i class="fa fa-dollar fa-fw"></i>   Operações<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="sessao.php?page=compra/compra.php"> Nova Compra</a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=venda/venda.php">  Nova Venda</a>
                                </li>
                                <li>
                                    <a href="sessao.php?page=orden_servico/index.php">  Novo Serviço</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!--fim do layout-->
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <?php include_once("../setUrl.php")?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
           <!--conteudo da pagina-->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
   
     <footer style="background-color:black">
        <div class="container" >
            <div class="row">
                <div class="col-lg-12 text-center" style="padding: 35px 0px 25px 0px;">
                   
                    <p>COPYRIGHT &copy; SISTEMA ÓTICA - 2016.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
