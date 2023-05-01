<?php
$row = 1;
$json = ["drops" => []];
$header = [
    "Monstruo",
    "Rangos" => [
        "Rango",
         "Drops" => [
                "material",
                "procedencia", //aqui vendría siendo poner si viene de carveo, recompensa, captura o punto brillante
                "zona", //si se rompe, que parte se ha roto, si es carveo, si es del cuerpo o la cola
                "cantidad",
                "porcentaje"
 ]]];

 if (($handle = fopen("drops.csv", "r")) !== FALSE) 
 {
    $separacion = ";";
    $array = [];
    $monstruo = "";
    $nRango = 0;$procendencia = "";$zona = "";
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    {
        $num = count($data);
        for ($c=0; $c < $num; $c++) 
        {
            $line = explode($separacion,$data[$c]);
            if ($line[0]!= "") //wyvern
            {
                if ($array != []) array_push($json["drops"],$array);
                $array = [];
                $array = ["Monstruo" => $line[0]];
                $monstruo = $line[0];
                $procendencia = "";
                $zona = "";
            }
            if ($line[1]!= "") //rango
            {
                if (!array_key_exists("Rangos",$array))
                {
                    $array["Rangos"] = [];
                    $nRango = 0;
                } else $nRango++;
                array_push($array["Rangos"],["Rango" => $line[1]]);
            }
            if ($line[2]!= "") //procedencia, cuerpo, recompensa al romper partes, etc
            {
                if (!array_key_exists("Drops",$array["Rangos"][$nRango]))
                {
                    $array["Rangos"][$nRango]["Drops"] = [];
                    $procendencia = "";
                    $zona = "";
                }
                $procendencia = $line[2];
            }
            if ($line[3]!= "") //que parte se ha roto
            {
                $zona = $line[3];
            }
            if ($line[4]!= "") //aqui irian ya los drops
            {
                $cantidad = $line[6];
                if ($cantidad == "") $cantidad = 1;
                array_push($array["Rangos"][$nRango]["Drops"],
                [
                    "material" => $line[4],
                    "procedencia"=> $procendencia,
                    "zona"=> $zona, 
                    "cantidad"=> $cantidad,
                    "porcentaje"=> $line[5]
                ]);
            }
        }
        $row++;
    }
    array_push($json["drops"],$array);
    file_put_contents('drops.json', json_encode($json));
    var_dump($json);

    fclose($handle);
 }


?>