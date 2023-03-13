<?php
    function salto(){echo "<br><br>";}
    /**
     * Una función que devuelva el número de cifras de un entero pasado como parámetro.
     */
    echo "ej 1: <br>";
    function ej1($numero)
    {
        $cifras = 0; $numero2= 1;
        do {
            $numero2 = $numero2 * 10;
            $cifras++;
        }while($numero>$numero2);
        return $cifras;
    }
    echo ej1(456);
    salto();

    /**
     *  Una función que muestre al usuario una secuencia de *
     * (se debe construir la cadena de uno en uno), la cantidad de * se pasará cómo parámetro de la función.
     */
    echo "ej2: <br>";
    function ej2($numero)
    {
        $resultado = "";
        for ($i=0; $i < $numero; $i++) { 
            $resultado = $resultado . "*";
        }
        return $resultado;
    }
    echo ej2(22);
    salto();
    /**
     * Una función que permita mostrar la secuencia (se debe construir la cadena de uno en uno):
     */
    echo "ej3: <br>";
    function ej3($numero)
    {
        $resultado = "";
        for ($i=0; $i < $numero; $i++) { 
            if ($i % 3 == 0) $resultado = $resultado . "*";
            if ($i % 3 == 1) $resultado = $resultado . "+";
            if ($i % 3 == 2) $resultado = $resultado . "_";
        }
        return $resultado;
    }
    echo ej3(5);
    salto();

    /**
     * Una función que permita mostrar un triángulo como el siguiente:
     */
    echo "ej4: <br>";
    function ej4($numero)
    {
        $resultado = "";
        for ($i=2; $i < $numero +2; $i++) { 
            for ($y=0; $y < $i ; $y++) { 
                $resultado = $resultado . "*";
            }
            $resultado = $resultado . "<br>";
        }
        return $resultado;
    }
    echo ej4(5);
    salto();

    /**
     * Una función que devuelva la diferencia en días entre dos fechas del mismo año (sólo tenemos en cuenta dia y mes).
     */
    echo "ej5:<br>";
    function sumaMes ($mes){
        $meses31 = [1,3,5,7,8,10,12];
        if (in_Array($mes,$meses31)){
           return 31;
        }elseif ($mes == 2){
            return 28;
        }else{
            return 30;
        }
    }
    function ej5($dia,$mes,$dia2,$mes2)
    {
        
        $diasEntre = 0;
        $mesesEntre = $mes2 - $mes;
        for ($i=0; $i < $mesesEntre; $i++) { 
            $diasEntre += sumaMes($mes);
            $mes ++;
        }
        if ($dia < $dia2){
            $diasEntre += sumaMes($mes2 -1) - $dia2 - $dia;
        }else{
            $diasEntre += $dia2 - $dia;
        }

        return $diasEntre;
    }
    echo ej5(2,3,15,5);
?>