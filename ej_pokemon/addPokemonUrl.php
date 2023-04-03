<?php
    include "addPokemonbbdd.php";

    $nombre = $_GET["pokemon"];
    $pokemon = new PokemonHandler();
    $pokemon->connectBbdd();

    $pokemon->addPokemon($nombre,true);
    $pokemon->closeBbdd();
    
    //header("Location: main.php", TRUE, 301);
    //exit();
    echo "<form action='main.php'> <input type='submit' value='Volver'></form>";
?>