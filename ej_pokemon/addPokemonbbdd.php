<?php
    require "bbdd.php";
    class PokemonHandler 
    {
        public $lastId = 0;
        private Bbdd $bbdd;
        private function getElements (array $decoded_json) : array
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
        public function connectBbdd (string $user = "root", string $pass = "root", string $database = "pokemon")
        {
            $this->bbdd = new Bbdd($user,$pass,$database);
        }

        private function quitarCaracterRaro (string $ability) : string
        {
            $cadena = "";
            for ($i=0; $i < strlen($ability); $i++) { 
                if ($ability[$i] != "'") $cadena .= $ability[$i];
            }
            return $cadena;
        }

        private function devolverHabilidadIngles (array $habilidades) : string
        {
            foreach ($habilidades as $value) {
                if($value["language"]["name"] == "en") return self::quitarCaracterRaro($value['effect']);
            }
            return "";
        }

        public function addPokemon (string $pokemon,bool $messages = false)
        {
            //comprobacion de que el pokemon existe en la base de datos
            $url = 'https://pokeapi.co/api/v2/pokemon/' . $pokemon;
            $headers = get_headers($url);
            if ($headers[0] == "HTTP/1.1 404 Not Found") //no se ve muy guapo pero funciona
            {
                echo "Error, no existe el pokemon";
                return;
            }

            $json = file_get_contents($url);
            $decoded_json = json_decode($json, true);

            self::addPokemonJson($decoded_json,$messages);
        }

        public function addPokemonJson (array $json, bool $messages = false)
        {
            if ($this->bbdd == null) self::connectBbdd();
            //declaracion de id
            $idHabilidad1 = 0;$idHabilidad2 = 0;$idHabilidad_oculta = 0; $idStats = 0;
            $elementos = self::getElements($json);
            $habilidades = $elementos ["habilidades"];

            if ($messages) "AÑADIENDO POKEMON " . $json["name"] . "<br>"; 
            #HABILIDADES
            $json_habilidad1 = json_decode(file_get_contents($habilidades[0]["ability"]["url"]),true);
            $descripcionHabilidad1 = self::devolverHabilidadIngles($json_habilidad1['effect_entries']);

            if ($messages) echo "AÑADIENDO PRIMERA HABILIDAD ".  $habilidades[0]['ability'] ["name"] ."<br>";
            //insert primera habilidad
            $this->bbdd->ejecutar("INSERT INTO Habilidades (nombre,efecto) VALUES ('" . $habilidades[0]['ability'] ["name"] ."','" .$descripcionHabilidad1. "')");
            $idHabilidad1 = $this->bbdd->getLastId();

            if (sizeof($habilidades) < 2 ) //pokemon con solo una unica habilidad, ej solgaleo
            {
                $idHabilidad2 = $idHabilidad1;
                $idHabilidad_oculta = $idHabilidad1;
            } else {
                if (sizeof($habilidades) > 2 ) //pokemon con habilidad doble
                {
                    if ($messages) echo "AÑADIENDO HABILIDAD 2: " . $habilidades[1]['ability'] ["name"] ."<br>";
                    $json_habilidad2 = json_decode(file_get_contents($habilidades[1]["ability"]["url"]),true);
                    $descripcionHabilidad2 = self::devolverHabilidadIngles($json_habilidad2['effect_entries']);

                    //insert segunda habilidad
                    $this->bbdd->ejecutar("INSERT INTO Habilidades (nombre,efecto) VALUES ('" . $habilidades[1]['ability'] ["name"]. "','" . $descripcionHabilidad2. "')");
                    $idHabilidad2 = $this->bbdd->getLastId();
                } else $idHabilidad2 = $idHabilidad1; 

                $lastEntry = sizeof($habilidades) -1;
                if ($messages) echo "AÑADIENDO HABILIDAD OCULTA: " . $habilidades[$lastEntry]['ability'] ["name"] ."<br>";
                $json_habilidad_oculta = json_decode(file_get_contents($habilidades[$lastEntry]["ability"]["url"]),true);
                $descripcionHabilidadOculta = self::devolverHabilidadIngles($json_habilidad_oculta['effect_entries']);
                //insert habilidad oculta
                $this->bbdd->ejecutar("INSERT INTO Habilidades (nombre,efecto) VALUES ('" . $habilidades[$lastEntry]['ability'] ["name"] . "','" . $descripcionHabilidadOculta."')");
                $idHabilidad_oculta = $this->bbdd->getLastId();
            }

            #STATS
            if ($messages) echo "AÑADIENDO STATS<br>";
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

            $this->bbdd->ejecutar ("INSERT INTO stats (hp,atk,def,sp_atk,sp_def,speed) VALUES ($hp,$atk,$def,$spAtk,$spDef,$speed)");
            $idStats = $this->bbdd->getLastId();

            #POKEMON
            $this->bbdd->ejecutar( "INSERT INTO pokemon (nombre,altura,sprite,sprite_shiny,tipo1,tipo2,habilidad1,habilidad2,habilidad_oculta,stats)
            VALUES ('" . $elementos['nombre'] . "'," . $elementos['altura'] . ",'" . $elementos['sprite'] . "','" . $elementos['sprite_shiny'] .
            "','" . $elementos['tipo1'] . "','" . $elementos['tipo2'] . "',$idHabilidad1,$idHabilidad2,$idHabilidad_oculta,$idStats)");
            if ($messages) echo $json["name"] . " FINALIZADO<br><br>";
        }

        public function closeBbdd ()
        {
            if ($this->bbdd != null) $this->bbdd->cerrar();
        }
        
    }
?>