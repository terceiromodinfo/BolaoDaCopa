<?php
session_start();
include './FuncoesBDL.php';
atualizarPontuacao();
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
    <?php
    /*
     * Condição para quando o usuario clicar no seu nome ele virar para cá, mas quando faser qualquer outra
     * operação for solicitada e retornar aqui não avera nada no get()['id'] então o $_SESSION['id'] = $id;
     * receberar o id para que possa ser usado aqui e em outras operações. 
     */
    

if (get()['id']) {
        $id = get()['id'];
        $_SESSION['id'] = $id;
    } else {
        $id = $_SESSION['id'];
    }


    $colunas = getFieldColuna("apostadores");
    $apostador = getUserId($id);
    ?>
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

                            <li>
                                <a class="" href="Gols.php">Iserir gols</a>

                            </li>                           
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

        <!--Fim do cabeçario-->
        <div class="fundo2">
            <br><br><br>
            <div class="container">
                <div class="row">                   
                    
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-6">
                        <?php
                        print "<h3 class='letraswhite'>" . $apostador[0]["nome"] . "</h3>";
                        ?>
                        <form method="POST" action="LogicasPrincipal.php">
                            <table class="tabelas table table-hover">
                                <?php
                                if (getColExpecifica("edicao", "admin")[0]["edicao"] == 0) {                                                    
                                ?>
                                <tr>
                                    <th></th>
                                    <th>Gols</th>
                                    <th>Pontos</th>
                                </tr>
                                <?php
                                }                                                 
                                ?>
                                <?php
                                /*
                                 * Este FOR rodará a quantidade de coluna que o usuario tiver em seu banco de dados
                                 * Será feitas as condições necessárias para que a exibição saia de maneira que os 
                                 * capitães sejam escolhidos 
                                 */
                                $quantColunas = getQuantColunas("apostadores");
                                for ($i = 0; $i < $quantColunas; $i++) {
                                    //Condição para que não seja exibido o id nem o capitão no frontyend
                                    if (!(($colunas[$i] == "pontos") || ($colunas[$i] == "nome") || ($colunas[$i] == "id") || ($colunas[$i] == "capitao") || ($colunas[$i] == "capitao2") || ($colunas[$i] == "time"))) {
                                        print "<tr>";
                                        /*
                                         * Condição para que seja exibido os nomes dos jogadores amarelo e com bolinhas 
                                         * caso contrario sera apenas exibidos apenas os nomes dos jogadores
                                         */
                                        if (($apostador[0][$colunas[$i]] == $apostador[0]["capitao"]) || ($apostador[0][$colunas[$i]] == $apostador[0]["capitao2"])) {
                                            // Condição para que não exiba bolinha de capitão nos campos vazios
                                            if (!(($apostador[0][$colunas[$i]] == "") || ($apostador[0][$colunas[$i]] == ""))) {
                                                print "<td style='color: orangered'>" . $apostador[0][$colunas[$i]] . " <a class='capitao'>C</a></td>";
                                            } else {
                                                print "<td></td>";
                                            }
                                        } else {
                                            // Condição para que exiba um campo para digitar o nome do novo time
                                            print "<td>" . $apostador[0][$colunas[$i]] . "</td>";
                                        }

                                        // Condição para que so exiba opções de edição se tiver liberado pelo administrador
                                        if (getColExpecifica("edicao", "admin")[0]["edicao"] == 1) {



                                            // Condição para que seja exibido o butão de escolher o capitão apenas nos jogadores
                                            if (($colunas[$i] == "nome") || ($colunas[$i] == "pontos")) {
                                                print "<td></td>";
                                            } else {
                                                // Condição para que quando os capitões ja estiveram sido escolhido não possa marcar outros
                                                if (!($apostador[0]['capitao'] & $apostador[0]['capitao2'])) {
                                                    // Condição para que não escolha o mesmo artilheiro duas vezes e desfazer o capitão
                                                    if ($apostador[0]['capitao'] == $apostador[0][$colunas[$i]] || $apostador[0]['capitao2'] == $apostador[0][$colunas[$i]]) {
                                                        //Condição para que o botão vermelho não apareça nos campos de jogadores que estão em branco
                                                        if (!(($apostador[0][$colunas[$i]] == "") || ($apostador[0][$colunas[$i]] == ""))) {
                                                            print "<td><a class='btn butaoVermelho' href='LogicasPrincipal.php?dezfaserCapitao=" . $apostador[0][$colunas[$i]] . " '>X</a></td>";
                                                        } else {
                                                            print "<td><a class='btn butaoCinza' >C<a/></td>";
                                                        }
                                                    } else {
                                                        print "<td><a class='btn butaoAmarelo' href='LogicasPrincipal.php?nomeCapitao=" . $apostador[0][$colunas[$i]] . "'>C<a/></td>";
                                                    }
                                                } else {
                                                    // Condição para desfazer o capitão, e saber qual dos nomes deverá aparecer os butões
                                                    if ($apostador[0]['capitao'] == $apostador[0][$colunas[$i]] || $apostador[0]['capitao2'] == $apostador[0][$colunas[$i]]) {
                                                        print "<td><a class='btn butaoVermelho' href='LogicasPrincipal.php?dezfaserCapitao=" . $apostador[0][$colunas[$i]] . " '>X<a/></td>";
                                                    } else {
                                                        print "<td><a class='btn butaoCinza' >C<a/></td>";
                                                    }
                                                }
                                            }

                                            // Condição para que exiba os butoes de escalar apenas em jogadores
                                            if (!(($colunas[$i] == "nome") || ($colunas[$i] == "pontos"))) {
                                                // Condição para escalar se estiver vazia
                                                if (!$apostador[0][$colunas[$i]] == "") {
                                                    print "<td><a class='btn butaoVermelho2' href='LogicasPrincipal.php?liberarJogador=" . $colunas[$i] . "'>Liberar<a/></td>";
                                                } else {
                                                    print "<td><a class='btn butaoVerde' href='EscalarNovo.php?escalarNovoJogador=" . $colunas[$i] . "'>Escalar<a/></td>";
                                                }
                                            } else {
                                                
                                            }
                                        } else {
                                            // Condição para que exiba a pontuação apenas nos jogadores
                                            if (!(($colunas[$i] == "nome") || ($colunas[$i] == "pontos"))) {
                                                print "<td class='letrasBrancas'>" . getGols($apostador[0][$colunas[$i]]) . "</td>";
                                                $pontos = 10 * getGols($apostador[0][$colunas[$i]]);
                                                if ($apostador[0]['capitao'] == $apostador[0][$colunas[$i]] || $apostador[0]['capitao2'] == $apostador[0][$colunas[$i]]) {
                                                    $pontos = $pontos + 10 * getGols($apostador[0][$colunas[$i]]);
                                                }
                                                print "<td class='letrasLaranja'>" . $pontos . "</td>";
                                            }
                                        }
                                        print "</tr>";
                                    }
                                }
                                ?>
                                <tr>
                                    <th></th>
                                    <th class='letraswhite'><h4>Pontos</h4></th>
                                    <th> <?php
                                print "<h4 class='letraswhite'>" . $apostador[0]["pontos"] . "</h4>";
                                ?></th>
                                </tr>
                            </table>
                        </form>
                        <form method="POST" action="LogicasPrincipal.php">
                        <table class="tabelas table table-hover">
                            <tr>
                                <td><h3>Campeão</h3></td>
                                
                                <td>
                                    <?php
                                    if (getColExpecifica("edicao", "admin")[0]["edicao"] == 1) {
                                        if ($colunas[3] == "time" & $apostador[0]["time"] == "") {
                                            print "</tr><tr>";
                                            print "<td><input class='form-control' type='text' name='novoTime' placeholder='Digite o nome do time'/></td>";
                                        } else {
                                            print "<h3>" . $apostador[0]["time"] . "</h3>";
                                        }
                                        //Condição para trocar seu time capeão
                                        if ($colunas[3] == "time") {
                                            print "</tr><tr>";
                                            if (!$apostador[0][$colunas[3]] == "") {
                                                print "<td><a class='btn butaoVermelho2' href='LogicasPrincipal.php?trocarTime=" . $colunas[4] . "'>Trocar Time<a/></td>";
                                            } else {
                                                print "<td><input class='btn butaoVerde' type='submit' name='escolherNovoTime' value='Confirmar'/></td>";
                                            }
                                        }
                                    } else {
                                        print "<h3>" . $apostador[0]["time"] . "</h3>";
                                        if ($colunas[4] == "time") {
                                            $campeao = getColExpecifica("nome", "campeaoc");
                                            // Condição para ver se já existe um campeão e se ele e igual a do apostador
                                            if (campeao() & $campeao[0]["nome"] == $apostador[0]['time']) {
                                                print "<td class='letrasLaranja'>100</td>";
                                            } else {
                                                print "<td class='letrasLaranja'>0</td>";
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        </form>
                        <?php
                        //----------
                        if ($colunas[4] == "time" & $apostador[0]["time"] == "") {
                            print "<td><input class='form-control' type='text' name='novoTime' placeholder='Digite o nome do time'/></td>";
                        }

                        // Condição para exibir a pontuação do time
                                               
                        //=---------
                        ?>
                    </div>
                    <div class="col-md-3"></div>
                    <?php                    
                    if (getColExpecifica("edicao", "admin")[0]["edicao"] == 1) {
                        /*
                        if (!(isset($_SESSION['login']) && isset($_SESSION['senha']))) {
                            $_SESSION['admin'] = getInfoTabelaAbrir("admin");
                        }
                         * 
                         */
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-5"></div>
                            <div class="col-md-2">
                                <a class="btn butao2" href="Salvar.php?idDoUseer">Salvar</a>                    
                            </div>
                            <div class="col-md-5"></div>
                            <br>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        



        <!-- jQuery (obrigatório para plugins Java do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
