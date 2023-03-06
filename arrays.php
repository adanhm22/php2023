<?php
    //ejercicio 1:
    //Define un array con cinco frutas. Muestra por pantalla la 
    //fruta de la posición tres y la posición cinco.
    echo "ej 1:<br>";
    $frutas = ["naranja", "pomelo", "limón", "manzana", "plátano"];
    echo "fruta 3: $frutas[2], fruta 5: $frutas[4]";
    echo "<br><br>";

    //ejercicio 2
    //Busca cómo se puede saber, en PHP, la longitud de un array 
    //(es decir el número de elementos que tiene el array).
    echo "ej 2:<br>";
    echo "se usa la funcion \"count\"";
    echo "<br><br>";

    //ejercicio 3
    //Muestra por pantalla la longitud del array frutas.
    echo "ej 3:<br>";
    echo "numero de frutas en el array: " . count($frutas);
    echo "<br><br>";

    //¿Qué crees que hará este código?
    //$frase = "Hola Mundo!";
    //echo $frase[3];
    echo "ej 4:<br>";
    echo "mostrará \"Hola mundo!\" en pantalla<br>";

?>