<?php
    function salto(){echo "<br><br>";}
    /**
     * Siendo a la variable que almacena el JSON
     *Código para obtener el país de la localidad_8
     *Código que permite añadir una localidad a tu elección
     *Modifica la localidad 4, añadiendo el número de habitantes
     *Cambia la estructura del JSON de forma que sea más directo acceder a las capitales de las localidades, dado que va a ser el dato que más vamos a consultar
     */
    //conseguir el json
    $peopleJson = file_get_contents('localidades.json');
    $decodedJson = json_decode($peopleJson,true);
    var_dump($decodedJson);
    salto();

    //Código para obtener el país de la localidad_8
    echo "país de la localidad 8: " . $decodedJson['localidad_8']['País'];
    salto();

    //Código que permite añadir una localidad a tu elección
    $localidad = [
        "Continente"=> "Europa",
        "País" => "Portugal",
        "Capital" => "Lisboa"
    ];

    $decodedJson['localidad_9'] = $localidad;
    var_dump($decodedJson);
    salto();

    //Modifica la localidad 4, añadiendo el número de habitantes
    $decodedJson['localidad_4']['habitantes'] = 3015268;
    var_dump($decodedJson);
    salto();

    //Cambia la estructura del JSON de forma que sea más directo acceder a las capitales de las localidades, dado que va a ser el dato que más vamos a consultar
    $jsonRehecho = [];
    foreach ($decodedJson as $array) 
    {
        $temporal = [];
        array_push($temporal,$array['Capital']);
        array_push($temporal,$array['Continente']);
        array_push($temporal,$array['País']);
        if (key_exists('habitantes',$array)) array_push($temporal,$array['habitantes']);
        array_push($jsonRehecho,$temporal);
        echo var_dump($array) . "<br>";
    }
    echo "<br>";
    var_dump($jsonRehecho);
?>