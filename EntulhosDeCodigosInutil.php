<?php
// Aqui foram jogados codigos que não serão apagados mas sim entulhados para algum funcionamento futuro
//------------------------------------------------------------------
/*
 
 * <select name="primeiro">
                <option>Primeiro jogador</option>
                <?php
                $NumerosDeLinhas = getQuantLinhasTabela("jogadores");
                $dados = getColExpecifica("nome", "jogadores");
                for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                    print $a = "<option>" . $dados[$i]['nome'] . "</option>";
                }
                ?>
            </select><br><br>
            <select name="segundo">
                <option>segundo jogador</option>
                <?php
                for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                    print "<option>" . $dados[$i]['nome'] . "</option>";
                }
                ?>
            </select><br><br>
            <select name="terceiro">
                <option>Terceiro jogador</option>
                <?php
                for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                    print "<option>" . $dados[$i]['nome'] . "</option>";
                }
                ?>
            </select><br><br>
            <select name="quarto">
                <option>Quarto jogador</option>
                <?php
                for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                    print "<option>" . $dados[$i]['nome'] . "</option>";
                }
                ?>
            </select><br><br>
            <select name="quinto">
                <option>Quinto jogador</option>
                <?php
                for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                    print "<option>" . $dados[$i]['nome'] . "</option>";
                }
                ?>
            </select><br><br>
            <select name="sexto">
                <option>Sexto jogador</option>
                <?php
                for ($i = 0; $i < $NumerosDeLinhas; $i++) {
                    print "<option>" . $dados[$i]['nome'] . "</option>";
                }
                ?>
            </select><br><br>
 * ---------------------------------------------------------------------------------------------
            <input type="text" name="primeiro" placeholder="Time campeão"><br><br>
            <input type="text" name="segundo" placeholder="Time campeão"><br><br>
            <input type="text" name="terceiro" placeholder="Time campeão"><br><br>
            <input type="text" name="quarto" placeholder="Time campeão"><br><br>
            <input type="text" name="quinto" placeholder="Time campeão"><br><br>
            <input type="text" name="sexto" placeholder="Time campeão"><br><br>

------ separar letra de uma estring
$pizza = "piece1|piece2|piece3|piece4|piece5|piece6";
        $pieces = explode("|", $pizza);
        print_r($pieces);
------- passar duas variaveis em metodo get 
        <a href="<?php echo "produto.php?nome=$nome;cat=$cat1";?>">
 * 


<form method="POST" action="LogicasPrincipal.php">
            <input type="text" name="nomeJogador" placeholder="Nome do jogador"/>
            <select name="nomeGrupo">
                <option>A</option>
                <option>B</option>
                <option>C</option>
            </select>
            <br><br>
            <input class="butao" type="submit" name="usuarioCadastraJogador" value="Guardar"/>
</form>
 * zerarPontos();
    $apostadores = getInfoTabela("apostadores");
    $id = getId("apostadores");
    $auntidadeLinhas = getQuantLinhasTabela("apostadores");
    for ($i = 0; $i < $auntidadeLinhas; $i++) {
        $getAposta = getApostas($i);
        for ($a = 0; $a < count($getAposta); $a++) {
            $aposta = $getAposta[$a];
            $apostadores[$i]["pontos"] = $apostadores[$i]["pontos"] + 10 * getGols($aposta);
            if (($aposta == $apostadores[$i]["capitao"]) || ($aposta == $apostadores[$i]["capitao2"])) {
                $apostadores[$i]["pontos"] = $apostadores[$i]["pontos"] + 10 * getGols($aposta);
            }
        }

        if (campeao()) {
            $timeEscolhido = getColExpecifica("time", "apostadores");
            $campeao = getColExpecifica("nome", "campeaoc");
            if ($campeao[0]["nome"] == $timeEscolhido[$i]["time"]) {
                $apostadores[$i]["pontos"] = $apostadores[$i]["pontos"] + 100;
            }
        }
        setPontuacaoDB($id[$i], $apostadores[$i]["pontos"]);
    }
 *function getConnection() {
    $usuario = 'root';
    $senha = '';
    $host = '127.0.0.1';
    $conn = mysqli_connect($host, $usuario, $senha);

    if (!$conn) {
        die("NÃ£o foi possÃ­vel conectar" . mysqli_error());
    }

    mysqli_query($conn, "SET NAMES 'utf8'");
    mysqli_query($conn, 'SET character_set_connection=utf8');
    mysqli_query($conn, 'SET character_set_client=utf8');
    mysqli_query($conn, 'SET character_set_results=utf8');

    $bd = mysqli_select_db($conn, 'bolaocopa');
    if (!$bd) {
        die("NÃ£o foi possÃ­vel selecionar o banco de dados" . mysqli_error());
    }

    return $conn;
} 
 * ALTER TABLE tabela_exemplo CHANGE id_exemplo novo_id_exemplo integer(5) unsigned;

 * 
 * 
 * 
 * 
 * <link href="main.css?version=12" />
 */

// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante pra home
if (!isset($_GET['consulta'])) {
  header("Location: /");
  exit;
}
// Conecte-se ao MySQL antes desse ponto
// Salva o que foi buscado em uma variável
$busca = mysql_real_escape_string($_GET['consulta']);
// ============================================
// Monta outra consulta MySQL para a busca
$sql = "SELECT * FROM `noticias` WHERE (`ativa` = 1) AND ((`titulo` LIKE '%".$busca."%') OR ('%".$busca."%')) ORDER BY `cadastro` DESC";
// Executa a consulta
$query = mysql_query($sql);
// ============================================
// Começa a exibição dos resultados
echo "<ul>";
while ($resultado = mysql_fetch_assoc($query)) {
  $titulo = $resultado['titulo'];
  $texto = $resultado['texto'];
  $link = '/noticia.php?id=' . $resultado['id'];
  
  echo "<li>";
    echo "<a href='{$link}'>";
      echo "<h3>{$titulo}</h3>";
      echo "<p>{$texto}</p>";
    echo "</a>";
  echo "</li>";
}
echo "</ul>";