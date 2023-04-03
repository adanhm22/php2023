<?php

function repetirString ($palabra,$numero){
        $retorno = "";
        for ($i=0; $i < $numero; $i++) $retorno .= $palabra;
        return $retorno;
    }

    echo repetirString("hola", 5);

    
?>