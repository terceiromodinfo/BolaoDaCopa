<?php

//Esta session foi startada para que consiga receber do usuario
session_start();
include './FuncoesBDL.php';
$post = post();
$get = get();

/*
 *  Entrar como administrador 
 */

if (isset($post['logar'])) {
    $nome = $post['login'];
    $senha = $post['senha'];

    $sql = "SELECT * FROM admin WHERE usernome='$nome' AND usersenha='$senha'";
    $linhas = 0;
    $res_administrador = buscaRegistro($sql);


    $linhas = mysqli_num_rows($res_administrador);


    if ($linhas > 0) {

        session_start();

        $_SESSION['login'] = $nome;
        $_SESSION['senha'] = $senha;
        header("location:homer.php");
    } else {
        print "<label>
	       <p><strong>senha ou login incorretos!</p>
	       <p><strong> Clica <a href = login.php> Aqui</a> para tentar novamente </strong></p>
	       </label>";
    }
    unset($post['logar']);
}

/*
 * Cadastrar os dados dos apostadores
 */

if (isset($post['cadastraDadosUsuarios'])) {

    $nome = $post["nome"];
    $time = $post["time"];
    $primeiro = $post["primeiro"];
    $segundo = $post["segundo"];
    $terceiro = $post["terceiro"];
    $quarto = $post["quarto"];
    $quinto = $post["quinto"];
    $sexto = $post["sexto"];
    $setimo = $post["setimo"];
    $oitavo = $post["oitavo"];
    $nono = $post["nono"];
    $decimo = $post["decimo"];
    $dePrimeiro = $post["dePrimeiro"];
    $deSegundo = $post["deSegundo"];
    $deTerceiro = $post["deTerceiro"];
    $deQuarto = $post["deQuarto"];
    $deQuinto = $post["deQuinto"];
    $deSexto = $post["deSexto"];
    $capitao1 = $post["capitao1"];
    $capitao2 = $post["capitao2"];
    

    setDadosDoUsuario($nome, $time, $primeiro, $segundo, $terceiro, $quarto, $quinto, $sexto, $setimo, $oitavo, $nono, $decimo, $dePrimeiro, $deSegundo, $deTerceiro, $deQuarto, $deQuinto, $deSexto, $capitao1, $capitao2);
    $_SESSION['apostadores'] = getInfoTabelaAbrir("apostadores");
    unset($post);
    header("location:Cadastra.php");
}


/*
 * Atualizar os pontos dos apostadores
 */

if (isset($post['atualizarPontuacao'])) {
    
    atualizarPontuacao();
    unset($post);
    header("location:homer.php");
}

/*
 * Apaga todos os dados dos apostadores
 */

if (isset($post['apagarApostadores'])) {

    apagaDados("apostadores");
    $_SESSION['apostadores'] = getInfoTabelaAbrir("apostadores");
    unset($post);
    header("location:Configuracoes.php");
}

/*
 * Apaga todos os dados dos jogadores
 */

if (isset($post['apagarJogadores'])) {

    apagaDados("jogadores");
    $_SESSION['jogadores'] = getInfoTabelaAbrir("jogadores");
    unset($post);
    header("location:Configuracoes.php");
}

/*
 * Cadastrar jogador
 */

if (isset($post['cadastraJogador'])) {

    $nome = $post['nomeJogador'];
    $grupo = $post['nomeGrupo'];

    setJogador($nome, $grupo);
    $_SESSION['jogadores'] = getInfoTabelaAbrir("jogadores");
    unset($post);
    header("location:Cadastra.php");
}

/*
 * Apaga jogadores do id que for passado
 */

if (isset($post['ApagaJogadorExpecifico'])) {
    $nome = $post ['apagaJogadorExpecifico'];
    $sql = "DELETE FROM jogadores WHERE jogadores.nome = '$nome'";
    excluir($sql);
    $_SESSION['jogadores'] = getInfoTabelaAbrir("jogadores");
    unset($post);
    header("location:Configuracoes.php");
}

/*
 * Apaga apostadores do id que for passado
 */

if (isset($post['ApagaApostadorExpecifico'])) {

    $nome = $post ['apagaApostadorExpecifico'];
    $sql = "DELETE FROM apostadores WHERE apostadores.nome = '$nome'";

    print $nome;
    excluir($sql);
    $_SESSION['apostadores'] = getInfoTabelaAbrir("apostadores");
    unset($post);
    header("location:Configuracoes.php");
}


/*
 * Libera a edição somente para o administrador
 */
if (isset($post['liberar'])) {
    $tabela2 = $_SESSION["admin"]; 
    if (getColExpecifica("edicao", "admin")[0]["edicao"] == 1) {
        $tabela2[0]["edicao"] = 0;
    } else {
        $tabela2[0]["edicao"] = 1;
    }
    $_SESSION["admin"] = $tabela2;
    unset($post);
    header("location:Configuracoes.php");
}

/*
 * Libera a edição para todos
 */
if (isset($post['liberarParaTodos'])) {
    if (getColExpecificaAbrir("edicao", "admin")["edicao"] == 1) {
        $sql = "UPDATE admin SET edicao = 0";
    } else {
        $sql = "UPDATE admin SET edicao = 1";
    }
    atualizarRegistro($sql);
    $_SESSION['admin'] = getInfoTabelaAbrir("admin");
    print_r(getColExpecificaAbrir("edicao", "admin")["edicao"]);
    unset($post);
    header("location:Configuracoes.php");
}

/*
 *  Cadastra jogador se o jogador que o apostador quiser não estiver cadastrado
 */

if (isset($post['cadastraJogadorEmEscalacao'])) {

    $nome = $post['nomeJogador'];
    $grupo = $post['nomeGrupo'];
    $tabela2 = $_SESSION["jogadores"];  
    
    $novoid = $tabela2[count($tabela2)-1]['id']+1;
    
    $tabela2[count($tabela2)]['id'] = $novoid;
    $tabela2[count($tabela2)-1]['nome'] = $nome;
    $tabela2[count($tabela2)-1]['gols'] = 0;
    $tabela2[count($tabela2)-1]['grupo'] = $grupo;
    $_SESSION["jogadores"] = $tabela2;
    print_r($_SESSION["jogadores"]);
    //setJogador($nome, $grupo);
    unset($post);
    header("location:EscalarNovo.php");
}



/*
 * Afirma que a copa do mundo ja terminou
 */

if (isset($post['sim'])) {
    $sql = "UPDATE campeaoc SET campeaoCopa = 'sim'";
    if (atualizarRegistro($sql)) {
        $Resut = "1";
    } else {
        $Resut = "0";
    }
    if ($Resut == 1) {
        print "<script>alert(' atualizado com Sucesso!');</script>";
    } else {
        print "<script>alert('Falha em atualizado!');</script>";
    }
    $_SESSION['campeaoc'] = getInfoTabelaAbrir("campeaoc");
    unset($post);
    header("location:Configuracoes.php");
}

/*
 * Afirma que a copa do mundo não terminou
 */

if (isset($post['nao'])) {
    $sql = "UPDATE campeaoc SET campeaoCopa = 'nao'";
    if (atualizarRegistro($sql)) {
        $Resut = "1";
    } else {
        $Resut = "0";
    }
    if ($Resut == 1) {
        print "<script>alert(' atualizado com Sucesso!');</script>";
    } else {
        print "<script>alert('Falha em atualizado!');</script>";
    }
    $_SESSION['campeaoc'] = getInfoTabelaAbrir("campeaoc");
    unset($post);
    header("location:Configuracoes.php");
}

/*
 * Atualiza o nome do capeão da copa
 */

if (isset($post['cadastraTime'])) {
    $nome = $post['time'];
    $sql = "UPDATE campeaoc SET nome = '$nome'";
    if (atualizarRegistro($sql)) {
        $Resut = "1";
    } else {
        $Resut = "0";
    }
    if ($Resut == 1) {
        print "<script>alert(' atualizado com Sucesso!');</script>";
    } else {
        print "<script>alert('Falha em atualizado!');</script>";
    }
    $_SESSION['campeaoc'] = getInfoTabelaAbrir("campeaoc");
    unset($post);
    header("location:Configuracoes.php");
}

/*
 *  Volta atraz na sua escolhas de capitão
 */

if (isset($get['dezfaserCapitao'])) {
    $id = $_SESSION['id'];
    $nome = $get['dezfaserCapitao'];
    nullCapitao2($id, $nome);
    
    unset($get);
    header("location:Apostador.php");
}

/*
 *  Apagar jogadores inutil
 */

if (isset($get['ApagarJogadoresInutil'])) {
    $jogadores = $_SESSION['jogadoresSaoInutil'];
    
    for ($i = 0; $i < count($jogadores); $i++) {
        apagaPorNome($jogadores[$i]['nome'], "jogadores");
    }
    $_SESSION['jogadores'] = getInfoTabelaAbrir("jogadores");
    unset($get);
    header("location:Configuracoes.php");
}

/*
 *  Cadastra o capitão escolhido
 */

if (isset($get['nomeCapitao'])) {
    $nome = $get['nomeCapitao'];
    $id = $_SESSION['id'];

    setCapitao($nome, $id);
    unset($get);
    header("location:Apostador.php");
}

if (isset($get['mudarGrupo'])) {
    $grupo = $get['mudarGrupo'];
    $tabela2 = $_SESSION["admin"]; 
    $tabela2[0]['grupo'] = $grupo;
    $_SESSION["admin"] = $tabela2;
    unset($get);
    header("location:Gols.php");
}

/*
 *  apaga o jogador da coluna indicada
 */

if (isset($get['liberarJogador'])) {
    $nomeColuna = $get['liberarJogador'];
    $id = $_SESSION['id'];
    $nome = getInfoLinha("apostadores", $id)[$nomeColuna];
    $nomeCapitao = getInfoLinha("apostadores", $id);
    if (($nome == $nomeCapitao['capitao']) || ($nome == $nomeCapitao['capitao2'])) {
        nullCapitao2($id, $nome);       
    }    
    $tabela2 = $_SESSION["apostadores"];    
    for ($i = 0; $i < count($tabela2); $i++) {
        if ($tabela2[$i]['id'] == $id) {            
                $tabela2[$i][$nomeColuna] = "";              
        }
    }
    $_SESSION["apostadores"] = $tabela2;
    unset($get);
    header("location:Apostador.php");
}

/*
 *  Apagar o nome do time 
 */

if (isset($get['trocarTime'])) {
    $id = $_SESSION['id'];
    $tabela2 = $_SESSION["apostadores"];    
    for ($i = 0; $i < count($tabela2); $i++) {
        if ($tabela2[$i]['id'] == $id) {            
                $tabela2[$i]["time"] = "";              
        }
    }
    $_SESSION["apostadores"] = $tabela2;
    unset($get);
    header("location:Apostador.php");
}

/*
 * Cadastrando o novo time 
 */

if (isset($post['escolherNovoTime'])) {
    $id = $_SESSION['id'];
    $nome = $post['novoTime'];
    
    $tabela2 = $_SESSION["apostadores"];    
    for ($i = 0; $i < count($tabela2); $i++) {
        if ($tabela2[$i]['id'] == $id) {            
                $tabela2[$i]["time"] = $nome;              
        }
    }
    $_SESSION["apostadores"] = $tabela2;
    unset($get);
    header("location:Apostador.php");
}

if (isset($get['novoJogador'])) {
    $nome = $get['novoJogador'];
    $id = $_SESSION['id'];
    $nomeColuna = $_SESSION['coluna'];
    
    $tabela2 = $_SESSION["apostadores"];    
    for ($i = 0; $i < count($tabela2); $i++) {
        if ($tabela2[$i]['id'] == $id) {            
                $tabela2[$i][$nomeColuna] = $nome;              
        }
    }
    $_SESSION["apostadores"] = $tabela2;
    unset($get);
    header("location:Apostador.php");
}
/*
 * Aomenta os gols dos jogadores ou mesmo diminuir
 */

$jogadores = getInfoTabela("jogadores");
for ($a = 0; $a < getQuantLinhasTabela("jogadores"); $a++) {
    if (isset($post[$a . "1"])) {
        setAlmentaGols($jogadores[$a]["id"]);
        unset($post);
        header("location:Gols.php");
    }
    if (isset($post[$a . "0"])) {
        setDiminuirGols($jogadores[$a]["id"]);
        unset($post);
        header("location:Gols.php");
    }
}


/*
 * 
 */


