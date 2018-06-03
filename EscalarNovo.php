<?php
session_start();
include './FuncoesBDL.php';
$post = post();
$get = get();
?>
<?php
if ($get['escalarNovoJogador']) {
    $coluna = $get['escalarNovoJogador'];
    $_SESSION['escalarNovoJogador'] = $coluna;
} else {
    $coluna = $_SESSION['escalarNovoJogador'];
}

$id = $_SESSION['id'];
$_SESSION['coluna'] = $coluna;
$grupo = "";
// MODIFICAR ---------------------
if ($coluna == "joUm") {
    $grupo = "A";
} elseif ($coluna == "joDois") {
    $grupo = "A";
} elseif ($coluna == "joTres") {
    $grupo = "B";
} elseif ($coluna == "joQuatro") {
    $grupo = "B";
} elseif ($coluna == "joCinco") {
    $grupo = "C";
} elseif ($coluna == "joSeis") {
    $grupo = "C";
} elseif ($coluna == "joSetimo") {
    $grupo = "D";
} elseif ($coluna == "joOitavo") {
    $grupo = "D";
} elseif ($coluna == "joNono") {
    $grupo = "E";
} elseif ($coluna == "joDecimo") {
    $grupo = "E";
} elseif ($coluna == "joDePrimeiro") {
    $grupo = "F";
} elseif ($coluna == "joDeSegundo") {
    $grupo = "F";
} elseif ($coluna == "joDeTerceiro") {
    $grupo = "G";
} elseif ($coluna == "joDeQuarto") {
    $grupo = "G";
} elseif ($coluna == "joDeQuinto") {
    $grupo = "H";
} elseif ($coluna == "joDeSexto") {
    $grupo = "H";
}



$jogadores = getInfoTabela("jogadores");
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
    <body>
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
                        <li><a href="#page-top"></a></li>
                        <li>
                            <a class="" href="homer.php">Pagina Inicial</a>
                        </li>
                        <?php
                            if (isset($_SESSION['login']) && isset($_SESSION['senha'])) {
                        ?>
                        <li>
                            <a class="" href="Cadastra.php">Cadastra</a>
                        </li>
                        
                        <li>
                            <a class="" href="Configuracoes.php">Configurações</a>
                        </li>
                        <?php
                            if (getColExpecifica("edicao", "admin")[0]["edicao"] == 1) {
                        ?>
                        <li>
                            <a class="" href="Gols.php">Iserir gols</a>

                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            }
                        ?>
                        <li>
                            <a class="" href="Sair.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h3 class="centralizar letraswhite">Jogadores</h3>
                    <form class='form-group' method='POST' action='LogicasPrincipal.php'>
                        <table class="tabelas table table-hover"> 


                            <?php
                            $jogadorNaoRepetido = getInfoLinha("apostadores", $id);
                            $colunasNaoRepetida = getFieldColuna("apostadores");
                            $jogadorNaoRepeir = "";
                            $colunasNaoRepetir = "";
                            
                            for ($voltas = 0; $voltas < getQuantLinhasTabela("jogadores"); $voltas++) {
                                for ($a = 4; $a < count($colunasNaoRepetida) - 2; $a++) {
                                    if ($jogadorNaoRepetido[$colunasNaoRepetida[$a]] == $jogadores[$voltas]['nome']) {
                                        $jogadorNaoRepeir = $jogadores[$voltas]['nome'];
                                        $colunasNaoRepetir = $colunasNaoRepetida[$a];
                                    }
                                }                               
                                print "<tr>";
                                
                                if ($grupo == $jogadores[$voltas]['grupo']) {
                                    if ($jogadorNaoRepeir == $jogadores[$voltas]['nome'] || !($jogadorNaoRepetido[$coluna] == "")) {
                                       print "<td class='letraswhite'>" . $jogadores[$voltas]['nome'] . "</td>";
                                       print "<td><a class='btn butaoCinza'>Liberar<a/></td>";
                                    } else {
                                        print "<td class='letraswhite'>" . $jogadores[$voltas]['nome'] . "</td>";
                                        print "<td><a class='btn butaoVerde' href='LogicasPrincipal.php?novoJogador=" . $jogadores[$voltas]['nome'] . "'>Escalar<a/></td>";
                                    }
                                }
                                print "</tr>";
                            }
                            ?>


                        </table>
                    </form>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h4 class="letraswhite">O jogador que você procura não esta na lista de escalação adicione um novo </h4>
                        <form class="form-group" method="POST" action="LogicasPrincipal.php">


                            <div class="col-md-10">
                                <input class="form-control" type="text" name="nomeJogador" placeholder="Nome do jogador"/>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="nomeGrupo">
                                    <?php
                                    // MODIFICAR ---------------------
                                    if ($coluna == "joUm") {
                                        print "<option>A</option>";
                                    } elseif ($coluna == "joDois") {
                                        print "<option>A</option>";
                                    } elseif ($coluna == "joTres") {
                                        print "<option>B</option>";
                                    } elseif ($coluna == "joQuatro") {
                                        print "<option>B</option>";
                                    } elseif ($coluna == "joCinco") {
                                        print "<option>C</option>";
                                    } elseif ($coluna == "joSeis") {
                                        print "<option>C</option>";
                                    } elseif ($coluna == "joSetimo") {
                                        print "<option>D</option>";
                                    } elseif ($coluna == "joOitavo") {
                                        print "<option>D</option>";
                                    } elseif ($coluna == "joNono") {
                                        print "<option>E</option>";
                                    } elseif ($coluna == "joDecimo") {
                                        print "<option>E</option>";
                                    } elseif ($coluna == "joDePrimeiro") {
                                        print "<option>F</option>";
                                    } elseif ($coluna == "joDeSegundo") {
                                        print "<option>F</option>";
                                    } elseif ($coluna == "joDeTerceiro") {
                                        print "<option>G</option>";
                                    } elseif ($coluna == "joDeQuarto") {
                                        print "<option>G</option>";
                                    } elseif ($coluna == "joDeQuinto") {
                                        print "<option>H</option>";
                                    } elseif ($coluna == "joDeSexto") {
                                        print "<option>H</option>";
                                    }
                                    ?>
                                </select><br>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <input class="btn butao" type="submit" name="cadastraJogadorEmEscalacao" value="Guardar"/>
                                </div>
                                <div class="col-md-5"></div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
        <!--Fim do cabeçario-->


        <!-- jQuery (obrigatório para plugins Java do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
