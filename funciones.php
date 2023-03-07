<?php
/**
 * Solicita al usuario tres números enteros e indícale cuál es el menor.
 */
function salto(){echo "<br><br>";}
echo "ej 1:<br>";
function ej1 ($num1,$num2,$num3){
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

$menor = ej1($num1,$num2,$num3);
echo "el menor de los 3 es $menor";
salto();
/**
 * Solicita al usuario una frase y una letra y muestra la cantidad de veces que aparece la letra en la frase.
 */
echo "ej 2;<br>";
function ej2 ($frase,$letra){
    $i = 0;
    $numero = 0;
    while ($i < strlen($frase)){
        if ($frase[$i] == $letra) $numero++;
        $i++;
    }
    return $numero;
}
$frase = "hola muy buenas a todos";$letra = 'a';
$numeroLetras = ej2($frase,$letra);
echo "en la frase \"$frase\" hay un total de $numeroLetras $letra"."es";
salto();

/**
 * Suma o resta (según elija el usuario) dos números reales
 */
"echo ej3: <br>";
function ej3 ($num1,$num2, $tipo){
    if ($tipo == "resta") return $num1 - $num2;
    if ($tipo == "suma") return $num1 + $num2;
    return -1;
}
$numero1 = 12;$numero2 = 24;
$tipoOperacion = "resta";
$resultado = ej3 ($numero1,$numero2,$tipoOperacion);
echo "la $tipoOperacion de $numero1 y $numero2 es $resultado";
salto();

/**
 * Almacena en dos variables datos de validación (usuario y contraseña) correctos y permite que el usuario valide (dispone de 3 intentos)
 */
echo "ej 4: <br>";
$usuario = "Adan";$contrasennia = "prueba";
$usuarios = ["Adan"=> "prueba"];
$intentos = 3;

function ej4($usuario,$contrasennia)
{
    //esto hace paso por referencia como pensaba
    global $usuarios, $intentos;
    if ($intentos <= 0) return "no hay más intentos";
    if (!array_key_exists($usuario,$usuarios)) {
        $intentos --;
        return "no existe el usuario, número de intentos $intentos";
    }else{
        if ($usuarios[$usuario]==$contrasennia){
            return "login hecho";
        }else{
            $intentos --;
            return "error en el login, número de intentos $intentos";
        }
    }
}
$respuesta = ej4($usuario,$contrasennia);
echo $respuesta . "<br>";
$respuesta = ej4($usuario,$contrasennia);
echo $respuesta . "<br>";
salto();

/**
 * Solicita al usuario una letra, si inserta una a muestra el número 7,
 * si es una b, el 9, si es una c el 101 y si no es ninguno de los tres, indícale que se ha equivocado de letra
 */
    echo "ej 5: <br>";
    $letra = 'l';
    function ej5($letra){
        if ($letra == 'a'){
            return 7;
        } elseif ($letra == 'b'){
            return 9;
        }elseif ($letra == 'c'){
            return 101;
        }else{
            return "error en la letra";
        }
    }

    echo "el programa ha devuelto: " . ej5($letra);
    salto();

    /**
     * Ordena alfabéticamente un array con 7 palabras puedes usar el algoritmo de la burbuja
     */
    echo "ej 6 :<br>";
    $palabras = ["algo","todo","nada","mucho","poco","bastante","entero"];

    function ej6($palabras)
    {
        $longitud = count ($palabras);
        $completado = false;
        $contador = 0;
        $x = 0; $y = 1;
        while (!$completado){
            if (strnatcmp($palabras[$x],$palabras[$y]) > 0 ){

                $temporal = $palabras[$x];
                $palabras[$x] = $palabras[$y];
                $palabras[$y] = $temporal;
                $x++; $y++;
                $contador = 0;
            }else{
                $x++; $y++;
                $contador++;
            }
            if ($y >= $longitud){
                $x = 0; $y = 1;
                if ($contador +1 >= $longitud) $completado = true;
                $contador = 0;
            }
        }
        return $palabras;
    }

    var_dump(ej6($palabras));
    salto();



?>