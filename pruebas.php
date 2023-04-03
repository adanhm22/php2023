<?php
    abstract class Persona {
        public $nombre;
        public $apellido;
        public function __construct($nombre = "Adán",$apellido = "Heredia")
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        }

        abstract public function andar ();
        //los puntos indican argumentos variables
        public function mostrarMucho(int ...$numeros)
        {
            for ($i=0; $i < sizeof($numeros); $i++) { 
                echo "número #" . $i + 1 . ": $numeros[$i] <br>";
            }
        }
        
    }

    function correr (Persona $persona, int $bucle)
    {
        for ($i=0; $i < $bucle; $i++) { 
            $persona->andar();
        }
    }

    $alumno = new class extends Persona{
        public function andar (){echo __METHOD__ . "<br>";}
    };
    var_dump($alumno);
    $alumno->andar();

    $algo = fn($valor) => $valor * $valor;

    echo "<br> " . $algo(7);

    echo "<br>";
    correr($alumno,4);
    //los 3 puntos al principio transforman el array en argumentos
    $alumno->mostrarMucho(...[4,5,12,65,45,12,32,25]);
    echo "<br> nueva persona creada en la misma linea usando \$alumno <br>";
    (new $alumno) -> mostrarMucho(5,7);
    echo "<br> voy a probar a declararlo al msimo tiempo<br>";
    (new class extends Persona {
        public function andar () {echo "hola";}
    }) -> mostrarMucho(12,24,36,48,56);
    var_dump(...[4,5,12,65,45,12,32,25]);

?>