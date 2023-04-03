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
        include "../bbdd.php";
        $bbdd = new Bbdd("root","root","pokemon");
        $pokemon = "shuckle";

        $resultado = $bbdd->consulta("SELECT * FROM pokemon WHERE nombre = '$pokemon'",MYSQLI_ASSOC)[0];

        echo "<h1> Shuckle </h1>";

        echo "
            <table>
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
    ?>
</body>
</html>