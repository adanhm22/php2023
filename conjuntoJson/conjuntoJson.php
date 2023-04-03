<?php

    include 'bbdd.php';

    $people_json = file_get_contents('https://opentdb.com/api.php?amount=10');
    $decoded_json = json_decode($people_json, true);
    //var_dump($decoded_json);

    $response_code = $decoded_json["response_code"];

    if ($response_code == 0)
    {
        $resultados = $decoded_json["results"];
        $bbdd = new Bbdd('root','root','quiz');
        foreach ($resultados as $pregunta) {
            //echo $pregunta["question"] . "<br>";
            //echo "<b>" . $pregunta["correct_answer"] . "</b><br>";

            //se inserta pregunta con sus valores
            echo "insertando pregunta:".  $pregunta['question'] ."<br>";
            $bbdd->ejecutar("INSERT INTO questions (content, category, difficulty, question_type) VALUES 
            ('".$pregunta["question"] ."','". $pregunta["category"] ."', '". $pregunta["difficulty"] ."', '".$pregunta["type"] ."')");
            //conseguir el id del ultimo insert
            $id = $bbdd->consulta("SELECT LAST_INSERT_ID()")[0][0];


            //var_dump($id);
            //añadir respuesta correcta
            echo "insertando respuesta correcta:" . $pregunta ["correct_answer"]. "<br>";
            $bbdd->ejecutar("INSERT INTO answers (content,correct,fk_id_question) VALUES ('". $pregunta ["correct_answer"]."',1, $id)");
            foreach ($pregunta["incorrect_answers"] as $respuestaIncorrecta) {
                //   echo $respuestaIncorrecta . "<br>";
                //añadimos las incorrectas
                echo "insertando respuesta:" . $respuestaIncorrecta. "<br>";
                $bbdd->ejecutar("INSERT INTO answers (content,correct,fk_id_question) VALUES ('$respuestaIncorrecta',0, $id)");
            }
            echo "<br>";
        }

        echo "inserciones hechas";
        $bbdd->cerrar();
    } else 
    {
         echo "fallo en el response_code";
    }
?>
