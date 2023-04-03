<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

        include "bbdd.php";

        $bbdd = new Bbdd("root","root","pokemon");
        $pokemon = $bbdd->consulta("SELECT nombre FROM pokemon");
        

        echo "<h1> selecciona pokemon </h1>";
        echo "<form action='verPokemonUrl.php' method='GET'>";
        echo "<select id='pokemon' name='pokemon'>";
        for ($i=0; $i < sizeof($pokemon); $i++) 
        { 
            echo "<option value ='" . $pokemon[$i][0] . "'> " . $pokemon[$i][0] . "</option>";
        }
        echo "</select>";

        echo "<br><br> <input type='submit' value='Ver pokemon'>";
        echo "</form>";

        echo "<h1> Añadir pokemon</h1><br>";
        echo "<form action = 'addPokemonUrl.php' method='GET'>";
        echo "<input name='pokemon' type='text'><br><br>";
        echo "<input type='submit' value='Añadir pokemon'>";
        echo "</form>";

    ?>
</body>
</html>