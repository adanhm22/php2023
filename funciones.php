<?php
/**
 * Solicita al usuario tres números enteros e indícale cuál es el menor.
 */
function salto(){echo "<br><br>";}
echo "ej 1:<br>";
function numeroMenor ($num1,$num2,$num3){
    if ($num1 < $num2){
        if($num1<$num3){
            return $num1;
        } else{
            return $num3;
        }
    }else{
        if($num2<$num3){
            return $num2;
        }else{
            return $num3;
        }
    }
}
$num1 = 4;$num2 = 7;$num3 = 5; 

$menor = numeroMenor($num1,$num2,$num3);
echo "el menor de los 3 es $menor";
salto();
/**
 * Solicita al usuario una frase y una letra y muestra la cantidad de veces que aparece la letra en la frase.
 */
echo "ej 2;<br>";
function contador ($frase,$letra){
    $i = 0;
    $numero = 0;
    while ($i < strlen($frase)){
        if ($frase[$i] == $letra) $numero++;
        $i++;
    }
    return $numero;
}
$frase = "hola muy buenas a todos";$letra = 'a';
$numeroLetras = contador($frase,$letra);
echo "en la frase \"$frase\" hay un total de $numeroLetras $letra"."es";
salto();

/**
 * Suma o resta (según elija el usuario) dos números reales
 */
"echo ej3: <br>";
function operacion ($num1,$num2, $tipo){
    if ($tipo == "resta") return $num1 - $num2;
    if ($tipo == "suma") return $num1 + $num2;
    return -1;
}
$numero1 = 12;$numero2 = 24;
$tipoOperacion = "resta";
$resultado = operacion ($numero1,$numero2,$tipoOperacion);
echo "la $tipoOperacion de $numero1 y $numero2 es $resultado";
salto();

/**
 * Almacena en dos variables datos de validación (usuario y contraseña) correctos y permite que el usuario valide (dispone de 3 intentos)
 */
echo "ej 4: <br>";
?>