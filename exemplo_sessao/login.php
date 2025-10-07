<?php
session_start();
$oCon = new PDO('mysql:host=localhost; dbname=BANCOCOMUM', 'Aluno2DS', 'SenhaBD2');

$cNome = $_GET['txtNome'];
$cSenha = $_GET['txtSenha'];

$cSQL = "SELECT 0 FROM USUARIOS WHERE USRLOGIN = '$cNome' AND USRSENHA = MD5('$cSenha')";
if($vReg = $oCon->query($cSQL)->fetch())
{
    $_SESSION['ACESSO'] = true;
    header('location: pag_inicial.php');
}
else
    header('location: login.htm');
?>