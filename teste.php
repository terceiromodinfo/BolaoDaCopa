<?php
include './FuncoesBDL.php';
session_start();
$apostador = getInfoTabela("apostadores");
$jogadores = getInfoTabela("jogadores");
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

    <body>

        <table class="table">
            <?php
            for ($i = 0; $i < count($apostador); $i++) {
                ?>
                <tr>
                    <td><?php print $apostador[$i]['id'] ?></td>
                    <td><?php print $apostador[$i]['nome'] ?></td>
                    <td><?php print $apostador[$i]['pontos'] ?></td>
                    <td><?php print $apostador[$i]['joUm'] ?></td>
                    <td><?php print $apostador[$i]['joDois'] ?></td>
                    <td><?php print $apostador[$i]['joTres'] ?></td>
                    <td><?php print $apostador[$i]['joQuatro'] ?></td>
                    <td><?php print $apostador[$i]['joCinco'] ?></td>
                    <td><?php print $apostador[$i]['joSeis'] ?></td>
                    <td><?php print $apostador[$i]['joSetimo'] ?></td>
                    <td><?php print $apostador[$i]['joOitavo'] ?></td>
                    <td><?php print $apostador[$i]['joNono'] ?></td>
                    <td><?php print $apostador[$i]['joDecimo'] ?></td>
                    <td><?php print $apostador[$i]['joDePrimeiro'] ?></td>
                    <td><?php print $apostador[$i]['joDeSegundo'] ?></td>
                    <td><?php print $apostador[$i]['joDeTerceiro'] ?></td>
                    <td><?php print $apostador[$i]['joDeQuarto'] ?></td>
                    <td><?php print $apostador[$i]['joDeQuinto'] ?></td>
                    <td><?php print $apostador[$i]['joDeSexto'] ?></td>
                    <td><?php print $apostador[$i]['capitao'] ?></td>
                    <td><?php print $apostador[$i]['capitao2'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <h1>Jogadores</h1>
        <table class="table">
            <?php
            for ($a = 0; $a < count($jogadores); $a++) {
                ?>
                <tr>
                    <td><?php print $jogadores[$a]['id'] ?></td>
                    <td><?php print $jogadores[$a]['nome'] ?></td>
                    <td><?php print $jogadores[$a]['gols'] ?></td>
                    <td><?php print $jogadores[$a]['grupo'] ?></td>
                </tr>
                <?php
            }
            
            ?>
        </table>
        <?php
            print_r(getGols("A2"));
        ?>
    </body>
</html>
