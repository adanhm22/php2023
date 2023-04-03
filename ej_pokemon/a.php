<?php
//$json = file_get_contents('https://pokeapi.co/api/v2/pokemon/shakalaka');
$url = 'https://pokeapi.co/api/v2/pokemon/shakalaka';
$file = get_headers($url);
var_dump($file);

?>