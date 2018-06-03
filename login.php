<?php
include './FuncoesBDL.php';
$get = get();
session_start();
if (isset($get['abrirDados'])) {
    abrirDados();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
        <title>Bolão</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">

        <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
        <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="fundo1">

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <font>

        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-3 thumbnail">
                    <div class="form-login">
                        <form method ="POST" action ="LogicasPrincipal.php" align="center" bgcolor= "blue">
                            <h4 class="letraswhite">Login do Administrador</h4>
                            <input type="text" class="form-control input-sm chat-input" placeholder="username"  name="login" required/>
                            <br>
                            <input type="password" class="form-control input-sm chat-input" placeholder="usersenha" name="senha"/>
                            <br>
                            <input type = "submit" class="btn butao" name = "logar" value = "fazer login"/>
                            <br><br>
                            <a class="btn butaoAmarelo" href="index.php">Voltar</a>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
