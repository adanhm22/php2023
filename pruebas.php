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

?>