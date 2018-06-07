<?php
session_start();
include './FuncoesBDL.php';
if (isset($_SESSION['login']) && isset($_SESSION['senha'])) {
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="iso-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="estilo.css" style="" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="estilo.css?version=12" rel="stylesheet">
    </head>
    <body class="fundo1">
        <a class="butao2" href="index.php">Index</a><br><br><!--Começo do cabeçario-->
        <nav class="navbar navbar-default navbar-fixed-top corFundoAzul">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-navegacao">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span>  
                    </button>
                    <a href="#pageTop" class="navbar-brand" style="font-weight: bold">Bolão</a>
                </div>
                <div class="collapse navbar-collapse menu-navegacao" id="menu-navegacao">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#page-top"></a></li>
                        <li>
                            <a class="" href="homer.php">Pagina Inicial</a>
                        </li>
                        <li>
                            <a class="" href="Cadastra.php">Cadastra</a>
                        </li>
                        <li>
                            <a class="" href="Configuracoes.php">Configurações</a>

                        </li>
                        <li>
                                <a class="" href="Gols.php">Iserir gols</a>

                        </li> 
                        <li>
                            <a class="" href="Sair.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Fim do cabeçario-->
        
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=A">A</a>
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=B">B</a>
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=C">C</a>
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=D">D</a>
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=E">E</a>
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=F">F</a>
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=G">G</a>
                        <a class="btn butaoVerde2" href="LogicasPrincipal.php?mudarGrupo=H">H</a>

                    </div>
                    <div class="col-md-4"></div>
                </div><br><br>
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <table class="tabelas table table-hover">
                        <tr>
                            <th>Jogadores</th>
                            <th>Gols</th>
                        </tr>
                        <?php
                        $jogadores = getInfoTabela("jogadores");
                        print "<form method='POST' action='LogicasPrincipal.php'>";
                        $grupo = getColExpecifica("grupo", "admin")[0]['grupo'];
                        for ($voltas = 0; $voltas < getQuantLinhasTabela("jogadores"); $voltas++) {
                            if ($jogadores[$voltas]['grupo'] == $grupo) {
                                print "<tr>";
                                print "<td>" . $jogadores[$voltas]['nome'] . "</td>";
                                print "<td>" . $jogadores[$voltas]['gols'] . "</td>";
                                print "<td><input class='btn butaoBranco' type='submit' name=" . $voltas . '1' . " value=' + '/></td>";
                                print "<td><input class='btn butaoBranco' type='submit' name=" . $voltas . '0' . " value=' - '/></td>";
                                print "</tr>";
                            }
                        }
                        print "</form>";
                        ?>
                    </table>
                </div>
                <div class="col-md-3"></div>
                
                <div class="col-md-12">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <a class="btn butao2" href="Salvar.php?salvarDadosJogador">Salvar</a>                    
                    </div>
                    <div class="col-md-5"></div>
                    <br>
                </div>
                
            </div>
        </div>

        <!-- jQuery (obrigatório para plugins Java do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
}  else {
    header("location:index.php");
}
?>