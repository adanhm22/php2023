<?php
    include "../bbdd.php";
    function getElements (array $decoded_json) : array
    {
        $array = [];
        $array["habilidades"] = $decoded_json["abilities"];
        $array["stats"] = $decoded_json["stats"];
        //$stats[0]["base_stat"] van en orden
        $array["sprite"] = $decoded_json["sprites"]["front_default"];
        $array["sprite_shiny"] = $decoded_json["sprites"]["front_shiny"];
        $array["nombre"] = $decoded_json["name"];
        $array["altura"] = $decoded_json["height"];
        $array["tipo1"] = $decoded_json["types"][0]["type"]["name"];
        $array["tipo2"] = sizeof($decoded_json["types"]) == 2 ? $decoded_json["types"][1]["type"]["name"] : "none";

        return $array;
    }
    #INICIALIZACION
    $json = file_get_contents('https://pokeapi.co/api/v2/pokemon/shuckle');
    $decoded_json = json_decode($json, true);

    $elementos = getElements($decoded_json);
    
    $bbdd = new Bbdd("root","root","pokemon");

    //declaracion de id
    $idHabilidad1 = 0;$idHabilidad2 = 0;$idHabilidad_oculta = 0; $idStats = 0;
    $habilidades = $elementos ["habilidades"];

    #HABILIDADES
    $json_habilidad1 = json_decode(file_get_contents($habilidades[0]["ability"]["url"]),true);

    $bbdd->ejecutar("INSERT INTO Habilidades (nombre,efecto) VALUES ('" . $habilidades[0]['ability'] ["name"] ."','" .$json_habilidad1['effect_entries'][1]['short_effect']. "')");
    $idHabilidad1 = $bbdd->getLastId();
    if (sizeof($habilidades) < 2 )
    {
        $idHabilidad2 = $idHabilidad1;
        $idHabilidad_oculta = $idHabilidad1;
    } else 
    {
        if (sizeof($habilidades) > 2 )
        {
            echo "añadiendo habilidad 2: " . $habilidades[1]['ability'] ["name"] ."<br>";
            $json_habilidad2 = json_decode(file_get_contents($habilidades[1]["ability"]["url"]),true);
            $bbdd->ejecutar("INSERT INTO Habilidades (nombre,efecto) VALUES ('" . $habilidades[1]['ability'] ["name"]. "','" . $json_habilidad2['effect_entries'][1]['short_effect']. "')");
            $idHabilidad2 = $bbdd->getLastId();
        } else $idHabilidad2 = $idHabilidad1; 
        
        $lastEntry = sizeof($habilidades) -1;
        echo "añadiendo habilidad oculta: " . $habilidades[$lastEntry]['ability'] ["name"] ."<br>";
        $json_habilidad_oculta = json_decode(file_get_contents($habilidades[$lastEntry]["ability"]["url"]),true);
        $bbdd->ejecutar("INSERT INTO Habilidades (nombre,efecto) VALUES ('" . $habilidades[$lastEntry]['ability'] ["name"] . "','" . $json_habilidad_oculta['effect_entries'][1]['short_effect']."')");
        $idHabilidad_oculta = $bbdd->getLastId();
    }
    

    #STATS
    $atk = 0; $def = 0; $hp = 0;$spDef = 0; $spAtk = 0; $speed = 0;
    foreach ($elementos["stats"] as $stat) 
    {
        switch($stat["stat"]["name"]) 
        {
            case "hp":
                $hp = $stat["base_stat"];
                break;
            case "attack":
                $atk = $stat["base_stat"];
                break;
            case "defense":
                $def = $stat["base_stat"];
                break;
            case "special-defense":
                $spDef = $stat["base_stat"];
                break;
            case "special-attack":
                $spAtk = $stat["base_stat"];
                break;
            case "speed":
                $speed = $stat["base_stat"];
        }
    }

    $bbdd->ejecutar ("INSERT INTO stats (hp,atk,def,sp_atk,sp_def,speed) VALUES ($hp,$atk,$def,$spAtk,$spDef,$speed)");
    $idStats = $bbdd->getLastId();

    #POKEMON
    $bbdd->ejecutar( "INSERT INTO pokemon (nombre,altura,sprite,sprite_shiny,tipo1,tipo2,habilidad1,habilidad2,habilidad_oculta,stats)
    VALUES ('" . $elementos['nombre'] . "'," . $elementos['altura'] . ",'" . $elementos['sprite'] . "','" . $elementos['sprite_shiny'] .
    "','" . $elementos['tipo1'] . "','" . $elementos['tipo2'] . "',$idHabilidad1,$idHabilidad2,$idHabilidad_oculta,$idStats)");

    echo "FINALIZACIÓN";
?>