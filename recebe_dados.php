<?php
session_start();
ob_start();
/*
*@author Raul Ferreira da Rocha https://github.com/raulferreiradarocha/game-rock-paper-scissors
*Criação 09/06/2020
*Licença: MIT, Citar o Autor, manter este bloco de código.
*
*Pedra vai ser 1
*Papel vai ser 2
*Tesoura vai ser 3
*
*Jogadas
*
*Papel x Pedra (2 x 1) Papel ganha
*Pedra x Tesoura (1 x 3) Pedra ganha
*Papel x Tesoura (2 x 3) Tesoura ganha
*Jogadas iguais = empate.
*/
if(isset($_GET)){
	if(isset($_SESSION['em_jogo'])){
	}else{
	$session = mt_rand(1, 1000);
	$_SESSION['em_jogo'] = $session;
	}
if(isset($_GET['jogador'])){
	$jogador = $_GET['jogador'];
	if($jogador == 1){
		$_SESSION['jogador1'] = 1;
		$jogada = $_GET['jogada'];
		$_SESSION['jogada1'] = str_replace("drag","",$jogada);
		
	}else{
		$_SESSION['jogador2'] = 2;
		$jogada = $_GET['jogada'];
		$_SESSION['jogada2'] = str_replace("drag","",$jogada);
		
		
	}//final do if($jogador1)
}//final do if $_GET['jogador']
	if(isset($_GET['resultado'])){
		
	if(($_SESSION['jogada1'] == 2 && $_SESSION['jogada2']== 1) || ($_SESSION['jogada1'] == 1 && $_SESSION['jogada2']== 3) || ($_SESSION['jogada1'] == 3 && $_SESSION['jogada2']== 2)){
		echo "Jogador 1 Venceu!";
		$_SESSION = array();
		unset($_SESSION);
	}elseif(($_SESSION['jogada1'] == 1 && $_SESSION['jogada2']== 2) || ($_SESSION['jogada1'] == 3 && $_SESSION['jogada2']== 1) || ($_SESSION['jogada1'] == 2 && $_SESSION['jogada2']== 3)){
		echo "Jogador 2 Venceu!";
		$_SESSION = array();
		unset($_SESSION);
	}else{
		echo "Empatou! jog1=".$_SESSION['jogada1']."&jog2=".$_SESSION['jogada2'];
		$_SESSION = array();
		unset($_SESSION);
	}
	}//final do $_GET['resultado']
}
