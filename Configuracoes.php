<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha'])) {
?>
<?php
include './FuncoesBDL.php';
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
        <link href="estilo.css" rel="stylesheet">
    </head>
    <body class="fundo4">
        <!--Começo do cabeçario-->
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
                        <li><a href="#pageTop"></a></li>
                        <li>
                            <a class="" href="index.php">Pagina Inicial</a>
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
        <div>
            <br> <br> <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            
                            <div class="col-md-6 thumbnail">
                                <div class="col-md-8">
                                    <h4>Fim da Copa</h4>
                                </div>
                                <div class="col-md-2">
                                    <form class="form-group" method="POST" action="LogicasPrincipal.php">
                                        <input class="btn butao" type="submit" name="sim" value="Sim"/>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <form class="form-group" method="POST" action="LogicasPrincipal.php">
                                        <input class="btn butao" type="submit" name="nao" value="Não"/>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <?php
                                    if (getColExpecifica("campeaoCopa", "campeaoc")[0]["campeaoCopa"] == "sim") {
                                        ?>

                                        <form method="POST" action="LogicasPrincipal.php">
                                            <input class="form-control" type="text" name="time"  placeholder="nome do time"><br>
                                            <input class="btn butao" type="submit" name="cadastraTime" value="Cadastra time Campeão"/>
                                        </form> 

                                        <?php
                                    } else {
                                        print "<h3>Não</h3>";
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="col-md-6 thumbnail">

                                <h4>Liberar Edição</h4>
                                <form method='POST' action='LogicasPrincipal.php'>
                                    <?php
                                    if (getColExpecifica("edicao", "admin")[0]["edicao"]) {
                                        print "<h6></h6>";
                                        print "<input class='butao' type='submit' name='liberar' value='Fechar edição para admin'/>";                                    
                                    } else {
                                        print "<h6></h6>";
                                        print "<input class='butao' type='submit' name='liberar' value='Abrir edição para admin'/>";
                                    }
                                    ?>
                                </form>
                                
                                <form method='POST' action='LogicasPrincipal.php'>
                                    <?php
                                    if (getColExpecificaAbrir("edicao", "admin")["edicao"] == 1) {
                                        print "<h6></h6>";
                                        print "<input class='butao' type='submit' name='liberarParaTodos' value='Fechar edição para todos'/>";                                    
                                    } else {
                                        print "<h6></h6>";
                                        print "<input class='butao' type='submit' name='liberarParaTodos' value='Abrir edição para todos'/>";
                                    }                                   
                                    ?>
                                </form>
                                <h4>informações de jogadores sem uso</h4>
                                <a class="btn butao" href="jogadoresSemfuncao.php">Obter</a>
                            </div>
                            <div class="col-md-6 thumbnail">

                                <h4>Apagar jogador expecifico</h4>

                                <form method="POST" action="LogicasPrincipal.php">
                                    <select class="form-control" name="apagaJogadorExpecifico">
                                        <?php
                                        $NumerosDeLinhas = getQuantLinhasTabela("jogadores");
                                        $dados = getInfoTabela("jogadores");
                                        for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                    <input class="butao" name="ApagaJogadorExpecifico" type="submit" value="Apagar"/>
                                </form>
                            </div>
                            <div class="col-md-6 thumbnail">
                                
                                <h4>Apagar apostador expecifico</h4>
                               
                                <form method="POST" action="LogicasPrincipal.php">
                                    <select class="form-control" name="apagaApostadorExpecifico">
                                        <?php
                                        $NumerosDeLinhas = getQuantLinhasTabela("apostadores");
                                        $dados = getInfoTabela("apostadores");
                                        for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    
                                    <input class="butao" name="ApagaApostadorExpecifico" type="submit" value="Apagar"/>
                                </form>
                            </div>
                            <div class="col-md-6 thumbnail">                                
                                <h4>Apagar todos apostador</h4>
                                <form class="form-group" method="POST" action="LogicasPrincipal.php">
                                    <input  class="btn butao" type="submit" name="apagarApostadores" value="Apagar"/>
                                </form>
                                <h4>Apagar todos jogador</h4>
                                <form class="form-group" method="POST" action="LogicasPrincipal.php">
                                    <input class="btn butao" type="submit" name="apagarJogadores" value="Apagar Jogadores"/>
                                </form>
                            </div>
                            
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="col-md-12">

                    </div>
                    <div class="col-md-12">

                    </div>
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
