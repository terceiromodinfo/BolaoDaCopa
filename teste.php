<?php

include './FuncoesBDL.php';
session_start();


$array['nome'] = "lucas";
$array['id'] = "2";
$array['joUm'] = "Bião";

//print_r(array_keys($array));
print "<br>";
print_r(getFieldColuna("jogadores"));

