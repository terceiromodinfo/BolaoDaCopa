<?php
/*
 * Funcões Banco de Dados e Logicas
 */
?>

<?php

/*
 * ------------------------ ESTAS FUNCÕES ESTÃO DESTINADAS AO BANCO DE DADOS E CONEXÕES COM A TABELAS --------------------------
 */

/**
 * Esta função faz a conexão com servidor e o banco de dados
 */
function getConnection() {
    $usuario = 'b69664ac88356f';
    $senha = '648a2e6f';
    $host = 'us-cdbr-iron-east-04.cleardb.net';
    $conn = mysqli_connect($host, $usuario, $senha);

    if (!$conn) {
        die("NÃ£o foi possÃ­vel conectar" . mysqli_error());
    }

    mysqli_query($conn, "SET NAMES 'utf8'");
    mysqli_query($conn, 'SET character_set_connection=utf8');
    mysqli_query($conn, 'SET character_set_client=utf8');
    mysqli_query($conn, 'SET character_set_results=utf8');

    $bd = mysqli_select_db($conn, 'heroku_fadaa65e37559e1');
    if (!$bd) {
        die("NÃ£o foi possÃ­vel selecionar o banco de dados" . mysqli_error());
    }

    return $conn;
}
//mysql://:@/?reconnect=true
/**
 * Buscar registros nas tabelas
 */
function buscaRegistro($sql) {
    return mysqli_query(getConnection(), $sql);
}

/**
 * Atualizar dados na tabelas
 */
function atualizarRegistro($sql) {
    if (mysqli_query(getConnection(), $sql)) {
        return true;
    } else {
        return false;
    }
}

/**
 * inserir dados nas tabelas
 */
function inserir($sql) {

    if (mysqli_query(getConnection(), $sql)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Excluir dados nas tabelas
 */
function excluir($sql) {
    if (mysqli_query(getConnection(), $sql)) {
        return true;
    } else {
        return false;
    }
}

/**
 * retorna a quantidade de linhas que existe em uma tabela
 */
function getQuantLinhasTabela($tabela) {
    $consulta = mysqli_query(getConnection(), "SELECT * FROM " . $tabela . "");
    return mysqli_num_rows($consulta);
}

/**
 * Retorna dados de apenas uma linha da tabela conforme o id passado 
 */
function getInfoLinha($tabela, $id) {
    if (getQuantLinhasTabela($tabela) > 0) {

        $sqlPesquisaId = "SELECT * FROM " . $tabela . " WHERE id = $id";
        $resPesquisaId = buscaRegistro($sqlPesquisaId);
        $registro = mysqli_fetch_assoc($resPesquisaId);

        return $registro;
    }
}

/**
 * Retorna todos os dados de uma tabela 
 */
function getInfoTabela($tabela) {
    if (getQuantLinhasTabela($tabela) > 0) {
        $idUsuario = getId($tabela);
        for ($giros = 0; $giros < count($idUsuario); $giros++) {

            $id = $idUsuario[$giros];
            $sqlPesquisaId = "SELECT * FROM " . $tabela . " WHERE id = $id";
            $resPesquisaId = buscaRegistro($sqlPesquisaId);
            $registro = mysqli_fetch_assoc($resPesquisaId);
            $ResultFinal[$giros] = $registro;
        }

        return $ResultFinal;
    }
}

/**
 * retorna todos os id de uma tabela
 */
function getId($tabela) {
    if (getQuantLinhasTabela($tabela) > 0) {
        $sqlId = "SELECT id FROM " . $tabela . "";
        $resId = buscaRegistro($sqlId);

        $contador = 0;
        while ($registro = mysqli_fetch_assoc($resId)) {
            $idUsuario[$contador] = $registro['id'];
            $contador = $contador + 1;
        }
        return $idUsuario;
    }
}

/**
 *  Retorna apenas os dados de uma coluna que for expecificada
 */
function getColExpecifica($coluna, $tabela) {
    if (getQuantLinhasTabela($tabela) > 0) {
        $idUsuario = getId($tabela);
        for ($giros = 0; $giros < count($idUsuario); $giros++) {

            $id = $idUsuario[$giros];
            $sqlPesquisaId = "SELECT " . $coluna . " FROM " . $tabela . " WHERE id = $id";
            $resPesquisaId = buscaRegistro($sqlPesquisaId);
            $registro = mysqli_fetch_assoc($resPesquisaId);
            $ResultFinal[$giros] = $registro;
        }
        return $ResultFinal;
    }
}

/**
 *  Retorna apenas os dados do id que for expecificado
 */
function getUserId($id) {
    if (getQuantLinhasTabela("apostadores") > 0) {
        $sqlPesquisaId = "SELECT * FROM apostadores WHERE id = $id";
        $resPesquisaId = buscaRegistro($sqlPesquisaId);
        $registro = mysqli_fetch_assoc($resPesquisaId);
        $ResultFinal[0] = $registro;

        return $ResultFinal;
    }
}

/**
 * Cadastra todos os dados dos usuario ou apostadores
 */
function setDadosDoUsuario($nome, $time, $primeiro, $segundo, $terceiro, $quarto, $quinto, $sexto, $setimo, $oitavo, $nono, $decimo, $dePrimeiro, $deSegundo, $deTerceiro, $deQuarto, $deQuinto, $deSexto) {
    $sql = "INSERT INTO apostadores (nome,time,joUm,joDois,joTres,joQuatro,joCinco,joSeis,joSetimo,joOitavo,joNono,joDecimo,joDePrimeiro,joDeSegundo,joDeTerceiro,joDeQuarto,joDeQuinto,joDeSexto)"
            . " VALUES ('$nome','$time','$primeiro','$segundo','$terceiro','$quarto','$quinto','$sexto','$setimo','$oitavo','$nono','$decimo','$dePrimeiro','$deSegundo','$deTerceiro','$deQuarto','$deQuinto','$deSexto')";
    if (inserir($sql)) {
        print "<script>alert(' enviado com Sucesso!');</script>";
    } else {
        print "<script>alert('Falha no envio!');</script>";
    }
}

/**
 * Cadastra os jogadores e qual gupos estão
 */
function setJogador($nome, $grupo) {
    print $nome . $grupo;
    $sql = "INSERT INTO jogadores (nome,grupo) VALUES ('$nome','$grupo')";
    if (inserir($sql)) {
        print "<script>alert(' enviado com Sucesso!');</script>";
    } else {
        print "<script>alert('Falha no envio!');</script>";
    }
}

/**
 * Retorna os nomes dos jogadores escolhido pelo apostador
 */
function getApostas($id) {

    $apostadores = getInfoTabela("apostadores");
    $nomescolunas = getFieldColuna("apostadores");
    $quantidadeColuna = getQuantColunas("apostadores");
    $cont = 0;
    for ($i = 4; $i < $quantidadeColuna - 2; $i++) {
        $resultado[$cont] = $apostadores[$id][$nomescolunas[$i]];
        $cont++;
    }
    return $resultado;
}

/**
 * Inserir os pontos dos apostadores quando for chamada
 */
function setPontuacaoDB($id, $pontos) {
    $sql = "UPDATE apostadores SET pontos = '$pontos' WHERE id = " . $id . "";
    atualizarRegistro($sql);
}

/**
 * Inserir o capitão dos apostadores quando for chamada
 */
function setCapitao($nome, $id) {
    $apostador = getInfoLinha("apostadores", $id);
    if ($apostador["capitao"] == "") {
        $sql = "UPDATE apostadores SET capitao = '$nome' WHERE id = " . $id . "";
    } else {
        $sql = "UPDATE apostadores SET capitao2 = '$nome' WHERE id = " . $id . "";
    }
    atualizarRegistro($sql);
}

/**
 * apaga o capitão dos apostadores para enserir um novo
 */
function nullCapitao($id) {

    $sql = $sql = "UPDATE apostadores SET capitao = '' WHERE id = " . $id . "";
    excluir($sql);

    $sql = $sql = "UPDATE apostadores SET capitao2 = '' WHERE id = " . $id . "";
    excluir($sql);
}

/**
 * apaga o capitão dos apostadores para enserir um novo
 */
function nullCapitao2($id, $nome) {
    $apostador = getInfoLinha("apostadores", $id);
    if ($apostador["capitao"] == $nome) {
        $sql = $sql = "UPDATE apostadores SET capitao = '' WHERE id = " . $id . "";
    }
    if ($apostador["capitao2"] == $nome) {
        $sql = $sql = "UPDATE apostadores SET capitao2 = '' WHERE id = " . $id . "";
    }
    excluir($sql);
}

/**
 * Zera os pontos dos usuarios 
 */
function zerarPontos() {
    $sql = "UPDATE apostadores SET pontos = 0";
    atualizarRegistro($sql);
}

/**
 * Verifica se a Copa ja terminou
 */
function campeao() {
    $campeao = getColExpecifica("campeaoCopa", "campeaoc");
    if ($campeao[0]["campeaoCopa"] == "sim") {
        return TRUE;
    } else {
        return FALSE;
    }
}

function apagaDados($nome) {
    for ($i = 0; $i < getQuantLinhasTabela($nome); $i++) {

        $sql = "DELETE FROM " . $nome . "";
        excluir($sql);
    }
}

/*
 * ---------------  ESTAS FUNÇÕES ESTÃO DESTINADAS AS LOGICAS DE FUNCINAMENTO DO CODIGOS PARA A EXIBIÇÃO  ----------------------
 */

/**
     *  Faz os calculos dos pontos de cada apostador e cadastra
     * 
     *  Zerar os dados servirá para não haver acúmulos de pontuação.
     * 
     *  O primeiro FOR rodará a quantidade de apostadores que há na tabela do banco.
     * 
     *  O segundo FOR  rodará apenas para identificar os jogadores que foram escolhido pelo apostador chamando uma função 
     *  para saber quantos gols aquele jogador fez.
     * 
     *  A condição e para identificar os capitães  que o apostador fez.
     * 
     *  A segunda condição servira para saber se já terminou a copa, há uma segunda condição que ira identificar o 
     *  nome que o apostador escolheu se a copa estiver terminada.
     * 
     *  Finalizando as condições da pontuação serão atualizados os pontos do apostador segundo o id dele. 
     */
function atualizarPontuacao() {zerarPontos();$apostadores = getInfoTabela("apostadores");$id = getId("apostadores");$auntidadeLinhas = getQuantLinhasTabela("apostadores");for ($i = 0; $i < $auntidadeLinhas; $i++) {$getAposta = getApostas($i);for ($a = 0; $a < count($getAposta); $a++) {$aposta = $getAposta[$a];$apostadores[$i]["pontos"] = $apostadores[$i]["pontos"] + 10 * getGols($aposta);if (($aposta == $apostadores[$i]["capitao"]) || ($aposta == $apostadores[$i]["capitao2"])) {$apostadores[$i]["pontos"] = $apostadores[$i]["pontos"] + 10 * getGols($aposta);}}if (campeao()) {$timeEscolhido = getColExpecifica("time", "apostadores");$campeao = getColExpecifica("nome", "campeaoc");if ($campeao[0]["nome"] == $timeEscolhido[$i]["time"]) {$apostadores[$i]["pontos"] = $apostadores[$i]["pontos"] + 100;}}setPontuacaoDB($id[$i], $apostadores[$i]["pontos"]);}}

/**
 * Retorna a quantidade de Gols de um jogador
 */
function getGols($nome) {
    $sql = "SELECT gols FROM `jogadores` WHERE nome = '$nome'";

    $resPesquisaId = buscaRegistro($sql);
    $registro = mysqli_fetch_assoc($resPesquisaId);

    return $registro['gols'];
}

/**
 * Funcão para usar o metodo post
 */
function post() {
    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    return $post;
}

/**
 * Funcão para usar o metodo get
 */
function get() {
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    return $get;
}

/**
 * Funcão para usar o metodo session

  function sessiom() {
  $session = filter_input_array(INPUT_SESSION, FILTER_DEFAULT);
  return $session;
  }
 */

/**
 * Ordena em forma decrescente todos os usuarios por pontos 
 */
function getOrdenaUsuarioPorPontos() {
    $apostadores = getInfoTabela("apostadores");

    function cmp($a, $b) {
        return $a["pontos"] < $b["pontos"];
    }

    if (getQuantLinhasTabela("apostadores") > 1) {
        usort($apostadores, 'cmp');
    }
    return $apostadores;
}

/**
 * Ordena em forma decrescente todos os jogadores por gols 
 */
function getOrdenaJogadorPorGols() {
    $jogadores = getInfoTabela("jogadores");

    function cmpa($a, $b) {
        return $a["gols"] < $b["gols"];
    }

    if (getQuantLinhasTabela("jogadores") > 1) {
        usort($jogadores, 'cmpa');
    }
    return $jogadores;
}


/**
 * Retorna os nomes das colunas das tabelas
 */
function getFieldColuna($tabela) {
    $sqlPesquisaId = "SHOW COLUMNS FROM " . $tabela . "";
    $resPesquisaId = buscaRegistro($sqlPesquisaId);
    $i = 0;

    while ($row = mysqli_fetch_assoc($resPesquisaId)) {
        $a[$i] = $row['Field'];
        $i = $i + 1;
    }
    return $a;
}

/**
 * Retorna a quantidade das colunas das tabelas
 */
function getQuantColunas($tabela) {
    $sqlPesquisaId = "SHOW COLUMNS FROM " . $tabela . "";
    $resPesquisaId = buscaRegistro($sqlPesquisaId);
    return mysqli_num_rows($resPesquisaId);
}

/**
 * Esta função é excluziva para o almentos de gols
 * que será feito acaso a API não funcionar a soma de gols
 */
function setAlmentaGols($id) {
    $jogadores = getInfoTabela("jogadores");
    for ($i = 0; $i < getQuantLinhasTabela("jogadores"); $i++) {
        if ($jogadores[$i]["id"] == $id) {
            $gols = $jogadores[$i]["gols"];
            $gols = $gols + 1;
        }
    }
    $sql = "UPDATE jogadores SET gols = '$gols' WHERE id = " . $id . "";
    atualizarRegistro($sql);
}

/**
 * Esta função é excluziva para o diminuição de gols
 * que será feito acaso a API não funcionar a soma de gols
 */
function setDiminuirGols($id) {
    $jogadores = getInfoTabela("jogadores");
    for ($i = 0; $i < getQuantLinhasTabela("jogadores"); $i++) {
        if ($jogadores[$i]["id"] == $id) {
            $gols = $jogadores[$i]["gols"];
            $gols = $gols - 1;
        }
    }
    $sql = "UPDATE jogadores SET gols = '$gols' WHERE id = " . $id . "";
    atualizarRegistro($sql);
}
