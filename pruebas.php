<?php
    class Persona {
        public $nombre;
        public $apellido;
        public function __construct($nombre = "Adán",$apellido = "Heredia")
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        }
        
    }

    var_dump(new Persona());
    var_dump(new Persona("Rodrigo","Perez"));
?>