<?php
    //class partida
    require_once "../model/partida.php";

    //colect info
    $jogador = $_GET["jogador"];
    $acertos = $_GET["acertos"];
    $erros = $_GET["erros"];
    $data_horaOBJ = new DateTime();
    $data_hora = $data_horaOBJ->format("d/m/Y - H:i:s");

    //create and save obj partida
    $partida = new Partida();
    $partida->setJogador($jogador);
    $partida->setAcertos($acertos);
    $partida->setErros($erros);
    $partida->setData_hora($data_hora);

    $partida->save();

    header("Location:http://localhost:8081/index.php");

    

