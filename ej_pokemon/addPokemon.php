<?php
    include "addPokemonbbdd.php";
    
    //conseguir 10 pokemon en una posicion aleatoria en la pokedex
    $json = file_get_contents('https://pokeapi.co/api/v2/pokemon/?limit=10&offset='. 10 * rand(1,100));
    $decoded_json = json_decode($json, true);
    $results = $decoded_json["results"];
    $pokemon = new PokemonHandler();
    $pokemon->connectBbdd();
    

    //recorremos el array de resultados
    for ($i=0; $i < sizeof($results); $i++) 
    { 
        $pokemon->addPokemon($results[$i]["name"],true);
    }
    $pokemon->closeBbdd();
    echo "FINALIZACIÓN";
?>