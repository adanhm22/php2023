<?php
     $conexion = mysqli_connect("localhost","root","root","usuarios");
     $consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE email = '" . $_POST["email"] . "'");
     $resultado = mysqli_fetch_all($consulta,MYSQLI_ASSOC);

     if (sizeof($resultado) < 1) 
    {
        echo "Error, el email no existe";
    }else
    {
        $contrasenniaCifrada = hash("sha256",$_POST["contrasennia"]);
        if ($contrasenniaCifrada == $resultado[0]["contrasennia"])
        {
            echo "login correcto<br>";
            echo "datos: <br>";
            echo "nombre: ". $resultado[0]["nombre"]." <br>";
            echo "apellidos: ". $resultado[0]["apellidos"]."<br>";
            echo "dni: ". $resultado[0]["dni"]." <br>";
            echo "email: ". $resultado[0]["email"]."<br>";
        } else {
            echo "error en la contraseña";
        }
    }

?>