<?php
session_start();
include './FuncoesBDL.php';
$get = get();
$apostadoresModificados = $_SESSION['apostadores'];
$apostadoresInicial = $_SESSION['apostadoresCompare'];
$jogadorModificado = $_SESSION['jogadores'];
$jogadorInicial = $_SESSION['jogadoresCompare'];

if (isset($get['idDoUseer'])) {
    $id = $_SESSION['id'];
    $colunaApostador = getFieldColuna("apostadores");

    for ($i = 0; $i < count($apostadoresModificados); $i++) {
        if ($apostadoresModificados[$i]['id'] == $id) {
            for ($b = 0; $b < count($colunaApostador); $b++) {
                if (!($colunaApostador[$b] == 'id' || $colunaApostador[$b] == 'nome' || $colunaApostador[$b] == 'pontos')) {                  
                   if (!($apostadoresInicial[$i][$colunaApostador[$b]] == $apostadoresModificados[$i][$colunaApostador[$b]])) {
                       $apostadoresModificados[$i][$colunaApostador[$b]]." ".$colunaApostador[$b];
                       setAtualizarMudancas($colunaApostador[$b], $apostadoresModificados[$i][$colunaApostador[$b]], $id);
                   }
                }                
            }
        }
    }
    print_r($jogadorModificado);
    
    // Verifica se ha jogador enserido no array para cadastra no banco
    print count($jogadorInicial)." ".count($jogadorModificado);
    if (count($jogadorInicial) < count($jogadorModificado) || count($jogadorInicial) == 0) {
        print "Foi";
        for ($a = count($jogadorInicial); $a < count($jogadorModificado); $a++) {
            $nome = $jogadorModificado[$a]['nome'];
            $gols = $jogadorModificado[$a]['gols'];
            $grupo = $jogadorModificado[$a]['grupo'];            
            setJogador($nome, $grupo);
        }
        $_SESSION['jogadores'] = getInfoTabelaAbrir("jogadores");
        $_SESSION['jogadoresCompare'] = $_SESSION['jogadores'];
    }
    $_SESSION['apostadores'] = getInfoTabelaAbrir("apostadores");
    
    $_SESSION['apostadoresCompare'] = $_SESSION['apostadores'];
    header("location:Apostador.php");
}
if (isset($get['salvarDadosJogador'])) {
    $jogadoresAtualizados;
    $a=0;
    for ($i = 0; $i < count($jogadorModificado); $i++) {
        if (!($jogadorInicial[$i]['gols'] == $jogadorModificado[$i]['gols'])) {               
            $jogadoresAtualizados[$a] = $jogadorModificado[$i];
            $a++;
        }        
    }
    atualizaJogadores($jogadoresAtualizados); 
    
    $_SESSION['jogadores'] = getInfoTabelaAbrir("jogadores");  
    $_SESSION['jogadoresCompare'] = $_SESSION['jogadores'];
    header("location:Gols.php");
}




//$_SESSION['login']= null;
//$_SESSION['senha']= null;


//header("location:Configuracoes.php");