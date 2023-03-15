<?php

    $numero = rand(1,10);
    $numero2 = 10 - $numero;
    $json1 = file_get_contents('https://opentdb.com/api.php?amount='.$numero.'&category=31');
    $json2 = file_get_contents('https://opentdb.com/api.php?amount='.$numero2.'&category=15');
    $decoded_json1 = json_decode($json1, true);
    $decoded_json2 = json_decode($json2, true);
    //var_dump($decoded_json);

    $response_code1 = $decoded_json1["response_code"];
    $response_code2 = $decoded_json2["response_code"];
    

    if ($response_code1 == 0)
    {
        $resultados = $response_code2 == 0 ? 
                        array_merge($decoded_json1["results"],$decoded_json2["results"]) : 
                        $decoded_json1["results"];

        shuffle($resultados);
        $respuestasCorrectas = [];
        foreach ($resultados as $pregunta) 
        {
            $respuestas = [];
            array_push($respuestas, $pregunta["correct_answer"]);
            array_push($respuestasCorrectas, $pregunta["correct_answer"]);
            $respuestas = array_merge($respuestas, $pregunta["incorrect_answers"]);
            shuffle($respuestas);
            echo $pregunta["question"] . "<br>";
            foreach ($respuestas as $respuesta) 
            {
                echo $respuesta . "<br>";
            }

        echo "<br>";
        
        }
        echo "<br><br>";
        for ($i=0; $i < sizeof($respuestasCorrectas); $i++) 
        { 
            echo "Respuesta #" . $i+1 .":" . $respuestasCorrectas[$i] . "<br>";
        }
    } else 
    {
         echo "fallo en el response_code";
    }
?>
