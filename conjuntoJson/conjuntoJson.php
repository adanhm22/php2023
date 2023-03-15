<?php

    $people_json = file_get_contents('https://opentdb.com/api.php?amount=10');
    $decoded_json = json_decode($people_json, true);
    //var_dump($decoded_json);

    $response_code = $decoded_json["response_code"];

    if ($response_code == 0)
    {
    $resultados = $decoded_json["results"];
    foreach ($resultados as $pregunta) {
        echo $pregunta["question"] . "<br>";
        echo "<b>" . $pregunta["correct_answer"] . "</b><br>";
        foreach ($pregunta["incorrect_answers"] as $respuestaIncorrecta) {
            echo $respuestaIncorrecta . "<br>";
        }
        echo "<br>";
    }
    } else 
    {
         echo "fallo en el response_code";
    }
?>
