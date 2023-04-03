<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
     th {
    border: 1px solid black;
    }
    table {
    border-collapse: collapse;
    width: 100%;
    }
    </style>
    <?php
        include "bbdd.php";
        $bbdd = new Bbdd("root","root","pokemon");

        $pokemon = "shuckle";
        if (array_key_exists("pokemon",$_GET)) $pokemon = $_GET["pokemon"];

        $resultado = $bbdd->consulta("SELECT * FROM pokemon WHERE nombre = '$pokemon'",MYSQLI_ASSOC)[0];

        echo "<h1> $pokemon </h1>";

        echo "
            <table style = 'text-align: left'>
                <tr>
                    <th> tipos </th>
                    <th> sprite </th>
                    <th> sprite shiny </th>
                    <th> stats </th>
                </tr><th><ul>";
        echo "<li>tipo 1: " . $resultado["tipo1"] . "</li>";
        echo "<li>tipo 2: " . $resultado["tipo2"] . "</li>";
        echo "</ul></th>";
        echo "<th><img src = " . $resultado["sprite"] . "></th>";
        echo "<th><img src = " . $resultado["sprite_shiny"] . "></th>";

        $stats = $bbdd->consulta("SELECT * FROM stats WHERE id = " . $resultado["id"], MYSQLI_ASSOC)[0];
        echo "<th><ul>";
        echo "<li>hp: " . $stats["hp"] . "</li>";
        echo "<li>atk: " . $stats["atk"] . "</li>";
        echo "<li>def: " . $stats["def"] . "</li>";
        echo "<li>spAtk: " . $stats["sp_atk"] . "</li>";
        echo "<li>spDef: " . $stats["sp_def"] . "</li>";
        echo "<li>speed: " . $stats["speed"] . "</li>";
        echo "</ul></th>";
        echo "</table>";

        echo "
            <table style = 'text-align: left'>
                <tr>
                    <th>        </th>
                    <th> nombre </th>
                    <th> descripción </th>
                </tr>";
        $habilidad1 = $bbdd->consulta("SELECT * FROM Habilidades WHERE id = " . $resultado["habilidad1"], MYSQLI_ASSOC)[0];
        $habilidad2 = $bbdd->consulta("SELECT * FROM Habilidades WHERE id = " . $resultado["habilidad2"], MYSQLI_ASSOC)[0];
        $habilidad_oculta = $bbdd->consulta("SELECT * FROM Habilidades WHERE id = " . $resultado["habilidad_oculta"], MYSQLI_ASSOC)[0];

        echo "<tr>";
        echo "<th>Habilidad 1</th>";
        echo "<th>".$habilidad1["nombre"]."</th>";
        echo "<th>".$habilidad1["efecto"]."</th>";
        echo "</tr>";

        if ($habilidad1["id"] != $habilidad2["id"])
        {
            echo "<tr>";
            echo "<th>Habilidad 2</th>";
            echo "<th>".$habilidad2["nombre"]."</th>";
            echo "<th>".$habilidad2["efecto"]."</th>";
            echo "</tr>";
        }

        echo "<tr>";
        echo "<th>Habilidad oculta</th>";
        echo "<th>".$habilidad_oculta["nombre"]."</th>";
        echo "<th>".$habilidad_oculta["efecto"]."</th>";
        echo "</tr>";

        echo "<br><br>";
        echo "<form action='main.php'> <input type='submit' value='Volver'></form>";

    ?>
</body>
</html>