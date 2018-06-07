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
    <body class="fundo2">
            <?php
            $apostador = getInfoTabela("apostadores");
            $jogadores = getInfoTabela("jogadores");
            $cont2 = 0;
            $jogadoresInutil;
            $existente = 0;

            
                for ($i = 0; $i < count($jogadores); $i++) {
                    $existe2 = "nao";
                    $a = 0;
                    while ($existe2 == "nao") {
                        $existe = "nao";
                        $cont = 0;
                        $apostas = getApostas($a);
                        while ($existe == "nao") {
                            if ($jogadores[$i]['nome'] == $apostas[$cont]) {
                                $existe = "sim";
                            } elseif ($cont == count($apostas) - 1) {
                                $existe = "fim";
                            } else {
                                $existe = "nao";
                            }
                            $cont++;
                        }
                        if ($existe == "sim") {
                            $existe2 = "sim";
                        } elseif ($a == count($apostador) - 1) {
                            $existe2 = "fim";
                        } else {
                            $existe2 = "nao";
                        }
                        $a++;
                    }
                    if ($existe == "fim") {
                        $existente = 1;
                        $jogadoresInutil[$cont2] = $jogadores[$i];
                        $cont2++;
                    }
                }
            
            ?>
            <table class="table table-hover">
                <tr>
                    <th class="letraswhite">Estes jogadores não foram escalados</th>
                </tr>

                    <?php
                    if ($existente > 0) {
                        for ($b = 0; $b < count($jogadoresInutil); $b++) {
                            print "<tr>";
                            print "<td>" . $jogadoresInutil[$b]['nome'] . "</td>";
                            print "</tr>";
                        }
                    }
                    ?>
            </table>
            <?php
                if ($existente > 0) {
                $_SESSION['jogadoresSaoInutil'] = $jogadoresInutil;
                print "<a class='btn butao' href='LogicasPrincipal.php?ApagarJogadoresInutil'>Apagar todos</a>";
            
                }
            ?>
    </body>
</html>
<?php
    } else {
            header("location:index.php");
    }
?>