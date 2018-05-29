<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha'])) {
?>
<?php include './FuncoesBDL.php'; 
$get = get();
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
        <title>Bolão da Copa</title>
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
        <div class="fundo1">
            <div class="container">
                <div class="row">
                    <br><br><br>
                    <div class="letrasClaras">
                        <h1 style="text-align: center">Cadastre aqui as aposta</h1>
                        <br>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div style="text-align: center" class="thumbnail">
                            <p>
                                O jogador que não estiver na lista, deve ser adicionado no
                                final da pagina
                            </p><br>
                        </div>
                        <div style="text-align: center" class="thumbnail">
                            <p>
                                Apenas o nome do apostador e obrigatorio, os outros campos não são obrigatorio, podem ser feitas 
                                alterações na pagina do usuarios
                            </p>
                        </div>
                    </div>
                    <div class="col-md-1"></div>



                </div>
            </div>
        </div>
        <br>
        <div class="fundo2">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1 style="text-align: center">Formulario dos apostadores</h1>
                        <br>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            
                            <form method="POST" class="form-group-lg" action="LogicasPrincipal.php">
                                <input class="form-control" type="text" name="nome" placeholder="Seu nome"><br>
                                <input class="form-control" type="text" name="time" placeholder="Time campeão"><br>
                                <h5>1° Grupo A</h5>
                                <select class="form-control" name="primeiro">
                                    <option></option>
                                    <?php
                                    $NumerosDeLinhas = getQuantLinhasTabela("jogadores");
                                    $dados = getInfoTabela("jogadores");
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "A") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>2° Grupo A</h5>
                                <select name="segundo" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "A") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>3° Grupo B</h5>
                                <select name="terceiro" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "B") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select ><br>
                                <h5>4° Grupo B</h5>
                                <select name="quarto" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "B") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>5° Grupo C</h5>
                                <select name="quinto" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "C") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>6° Grupo C</h5>
                                <select name="sexto" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "C") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>7° Grupo D</h5>
                                <select name="setimo" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "D") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>8° Grupo D</h5>
                                <select name="oitavo" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "D") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>9° Grupo E</h5>
                                <select name="nono" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "E") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>10° Grupo E</h5>
                                <select name="decimo" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "E") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>11° Grupo F</h5>
                                <select name="dePrimeiro" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "F") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>12° Grupo F</h5>
                                <select name="deSegundo" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "F") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>13° Grupo G</h5>
                                <select name="deTerceiro" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "G") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>14° Grupo G</h5>
                                <select name="deQuarto" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "G") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>15° Grupo H</h5>
                                <select name="deQuinto" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "H") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br>
                                <h5>16° Grupo H</h5>
                                <select name="deSexto" class="form-control">
                                    <option></option>
                                    <?php
                                    for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                                        if ($dados[$i]["grupo"] == "H") {
                                            print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select><br><br>

                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <input class="butao" type="submit" name="cadastraDadosUsuarios" value="Guardar"/>
                                </div>
                                <div class="col-md-5"></div>
                                
                            </form>

                        </div>
                        <div class="col-md-3"></div>
                    </div>

                </div>
            </div>
            <br>    
        </div>
        <div class="fundo3 letrasClaras">
            <div class="container">
                <div class="row">
                    <h1 style="text-align: center">Formulario de cadastro dos jogadores</h1><br>
                    <div class="col-md-12">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 thumbnail">
                            <form method="POST" action="LogicasPrincipal.php">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="nomeJogador" placeholder="Nome do jogador"/><br>  
                                </div> 
                                <div class="col-md-2">
                                    <select class="form-control" name="nomeGrupo">
                                        <?php
                                        // MODIFICAR ---------------------@@@@@@@
                                        ?>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
                                        <option>F</option>
                                        <option>G</option>
                                        <option>H</option>
                                    </select>
                                </div>

                                <br><br>
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <input class="butao btn" type="submit" name="cadastraJogador" value="Guardar"/>
                                </div>
                                <div class="col-md-5"></div>
                                
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                         

                    </div>
                    <div class="col-md-12">                        
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table class="letraswhite tabelas table table-hover">
                            <tr>
                                <th>Nome</th>
                                <th>Gols</th>
                            </tr>


                            <?php
                            /*
                             * Este FOR rodará de acordo a quantidade de jogadpres que ouver na tabela do banco de dados
                             * para a exibição dos jogadores e a sua quantidade de gols.
                             */
                            $jogadores = getInfoTabela("jogadores");
                            for ($i = 0; $i < getQuantLinhasTabela("jogadores"); $i++) {
                                print "<tr>";

                                print "<td>" . $jogadores[$i]["nome"] . "</td>";
                                print "<td>" . $jogadores[$i]["gols"] . "</td>";
                                print "<td>" . $jogadores[$i]["grupo"] . "</td>";

                                print "</tr>";
                            }
                            ?>

                        </table>
                        </div>
                        <div class="col-md-2"></div>
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
