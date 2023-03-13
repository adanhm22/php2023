<?php
    /* 
    La función date() con el parametro 'D' nos devuelve las 
    tres primeras letras del día de la semana en inglés:
     Mon, Tue, Wed, Thu, Fri, Sat, Sun. Con este pequeño código 
     $dia_ingles = date('D'); tendremos el día en la variable 
     $dia_ingles. Mostrar el día en español por pantalla.
     ej 2: Primero usando IF-ELSE.
    */

    $dia_ingles = date ('D');
    echo "ej 2: <br>";
    if ($dia_ingles == "Mon"){
        echo "Lunes";
    }elseif ($dia_ingles == "Tue"){
        echo "Martes";
    }elseif ($dia_ingles == "Wed"){
        echo "Miércoles";
    }elseif ($dia_ingles == "Thu"){
        echo "Jueves";
    }elseif ($dia_ingles == "Fri"){
        echo "Viernes";
    }elseif ($dia_ingles == "Sat"){
        echo "Sábado";
    }else {
        echo "Domingo";
    }
    echo "<br><br>";

    //ej 3: Después usando SWITCH.
    echo "ej 3: <br>";
    switch ($dia_ingles){
        case "Mon" :
            echo "Lunes";
            break;
        case "Tue" :
            echo "Martes";
            break;
        case "Wed" :
            echo "Miercoles";
            break;
        case "Thu" :
            echo "Jueves";
            break;
        case "Fri" :
            echo "Viernes";
            break;
        case "Sat" :
            echo "Sabado";
            break;
        default :
        echo "Domingo";     
    }
    echo "<br><br>";

    //Realizar el ejercicio anterior pero mostrando el día de la semana
    // de lunes a viernes, y para sábado y domingo mostrar el mensaje: 
    //Fin de semana.
    echo "ej 4: <br>";
    switch ($dia_ingles){
        case "Mon" :
            echo "Lunes";
            break;
        case "Tue" :
            echo "Martes";
            break;
        case "Wed" :
            echo "Miercoles";
            break;
        case "Thu" :
            echo "Jueves";
            break;
        case "Fri" :
            echo "Viernes";
            break;
        default :
        echo "Fin de semana";     
    }
    echo "<br><br>";

    /*
    Una tienda online quiere realizar una mejora en el código de su web.
    Necesita que la web, según el importe de la cesta, muestre un 
    mensaje u otro al usuario. En concreto quiere que:

    Si la compra es inferior a 30 euros se le muestre un mensaje en 
    negrita diciendo: 'Compra más o te cobraremos los abusivos 30 euros
    de gastos de envío'.

    Si la compra es superior a 30 euros pero inferior a 90 deberemos 
    mostrar un número indicando cuanto le falta para llegar a 90 euros
    y tener gastos de envío gratuitos. 
    Ejemplo: '¡¡¡Con solo 33.50€ más podrás tener gastos de envío
    gratis!!!'

    Si la compra alcanza los 90€ indicaremos un mensaje en negrita:
    'Gastos de envío incluidos'.
    */
    echo "ej 5: <br>";
    $valorCompra = 12;
    if ($valorCompra < 30){
        echo "<b>Compra más o te cobraremos los abusivos 30 euros de gastos de envío</b>";
    }
    if ($valorCompra >= 30 && $valorCompra < 90){
        $falta = 90 - $valorCompra;
        echo "¡¡¡Con solo $falta € más podrás tener gastos de envío gratis!!!";
    }
    if ($valorCompra >= 90 ){
        echo "Gastos de envío incluidos";
    }
    echo "<br><br>";


?>