<?php
    /* 
    Una tienda online nos ha pedido una mejora para su web.
    Necesita un tratamiento de la información de la cesta de los 
    clientes que cumpla los siguientes requisitos:

    Si la compra del cliente es inferior a 19 euros podrán 
    requerir 2 cosas:

    Si los productos son de mascotas se mostrará un mensaje: 
    "No se puede realizar el envío".

    Si los productos son de ropa se le mostrará el siguiente mensaje:
    "Los gastos de envío son 9 euros".

    Si la compra tiene un importe entre 19 y 40 euros se le indicará 
    el mensaje: "Los gastos de envío son 9 euros".

    Si la compra supera los 40 euros deberemos indicar un mensaje 
    de que los portes de envío son gratis.

    Si la compra supera los 200 euros deberemos mostrar un mensaje 
    con un código de descuento: CODIGODESC33.
    */
    $tipoProducto = "mascotas";
    $valorCompra = 200;
    echo "ej 1: <br>";

    if ($valorCompra < 19){
        if ($tipoProducto == "mascotas"){
            echo "No se puede realizar el envío";
        }elseif  ($tipoProducto == "ropa"){
            echo "Los gastos de envío son 9 euros";
        }else {
            echo "error en el tipo de producto";
        }
    }
    if ($valorCompra >= 19 && $valorCompra < 40){
        echo "Los gastos de envío son 9 euros";
    }
    if ($valorCompra >= 40){
        echo "los portes de envío son gratis<br>";
        if ($valorCompra >= 200) echo "tienes un codigo de descuento: \" CODIGODESC33\"";
    }

    echo "<br><br>";
    


?>