<?php
$row = 1;
$json = ["debilidades" => []];
$header = [
    "Nombre",
    "Estados" => [
        "Estado",
         "Zonas" => [
            "zona",
            "Corte",
            "Impacto",
            "Fuego",
            "Agua",
            "Trueno",
            "Dragon",
            "Hielo",
            "Stagger",
            "Notas"
                ]
            ]
        ];
if (($handle = fopen("debilidades.csv", "r")) !== FALSE) {
    $nombre = "";
    $estado = "";$nEstado = 0;
    $separacion = ";";
    $array = [];
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < $num; $c++) {
            $line = explode($separacion,$data[$c]);
            if ($line[0]!= "")
            {
                if ($array != []) array_push($json["debilidades"],$array);
                $array = [];
                $array = ["Nombre" => $line[0]];
                $nombre = $line[0];
            }else if ($line[1]!= "")
            {
                if (!array_key_exists("Estados",$array))
                { 
                    $array["Estados"] = [];
                    $nEstado = 0;
                } else $nEstado++;
                array_push($array["Estados"],["Estado" => $line[1]]);
                $estado = $line[1];
            } else 
            {
                if (!array_key_exists("Zonas",$array["Estados"][$nEstado])) $array["Estados"][$nEstado]["Zonas"] = [];

                array_push($array["Estados"][$nEstado]["Zonas"],
                    [
                        "zona" => $line[2],
                        "Corte" => $line[3],
                        "Impacto" => $line[4],
                        "Fuego" => $line[5],
                        "Agua" => $line[6],
                        "Trueno" => $line[7],
                        "Dragon" => $line[8],
                        "Hielo" => $line[9],
                        "Stagger" => $line[10],
                        "Notas" => $line[11]
                    ]
                );
            }

        }
        $row++;
    }
    array_push($json["debilidades"],$array);
    file_put_contents('debilidades.json', json_encode($json));
    var_dump($json);
    fclose($handle);
}
?>