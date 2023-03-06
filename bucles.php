<?php
/**
 * Recorre el array $frutas = ["Manzana", "Banana", "Fresas", "Mandarinas"] utilizando un bucle for.
 */
print "ej 1: <br>";
$frutas = ["Manzana", "Banana", "Fresas", "Mandarinas"];
for ($i=0; $i < count($frutas); $i++) { 
    print $frutas[$i] . "<br>";
    
}
print "<br><br>";

/**
 * Recorre el mismo array que en el ejemplo anterior utilizando un foreach.
 */
print "ej2: <br>";
foreach ($frutas as $fruta) {
    print $fruta . "<br>";
}
print "<br><br>";

/**
 * Define una variable frase y otra letra, dales valor y muestra la cantidad de veces que aparece la letra en la frase.
 */
print "ej 3: <br>";
$frase = "hola que tal"; $letra = 'a';

$i = 0;
$numero = 0;
while ($i < strlen($frase)){
    if ($frase[$i] == $letra) $numero++;
    $i++;
}
echo "la letra '$letra' aparece $numero veces";

?>