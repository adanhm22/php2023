<?php
    $conexion = mysqli_connect("localhost","root","root","usuarios");
    $consulta = mysqli_query($conexion,"SELECT email FROM usuarios WHERE email = '" . $_POST["email"] . "'");
    $resultado = mysqli_fetch_all($consulta,MYSQLI_NUM);

    if (sizeof($resultado) > 0) 
    {
        echo "Error, el email ya está en uso";
    }else
    {
        if ($_POST["contrasennia"] == "" or $_POST["dni"] == "") {
            echo "Error, la contraseña o el dni están vacios";
        } else {
            $contrasennia = hash("sha256",$_POST["contrasennia"]);
            try{
            mysqli_query($conexion,"INSERT INTO usuarios(nombre,apellidos,dni,email,contrasennia) VALUES 
            ('".$_POST["nombre"]."', '".$_POST["apellidos"] ."', '".$_POST["dni"] ."', '".$_POST["email"] ."' , '$contrasennia')");

            echo "usuario añadido<br>";
            }catch(Exception $e){
                echo "error en la consulta";
            }
        }
        
    }
?>