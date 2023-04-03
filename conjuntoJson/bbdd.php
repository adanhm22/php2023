<?php
    class Bbdd 
    {
        private $conexion = null;
        public function __construct(private string $user, private string $password, private string $db, private string $hostname = 'localhost')
        {
            self::conectar($user,$password,$db,$hostname);
        }

        public function conectar (string $user, string $password, string $db, string $hostname = 'localhost') : bool
        {
            try {
                $this ->conexion = mysqli_connect($hostname , $user , $password);
                mysqli_select_db ($this ->conexion, $db);
                return true;
                }catch (Exception  $e){
                    $this->conexion = null;
                    return false;
                }
        }

        private function getResult (string $consulta) : mysqli_result|bool
        {
            $resultado = mysqli_query($this->conexion, $consulta);
            if ($resultado) return $resultado;
            return null;

        }

        public function ejecutar (string $consulta) : void
        {
            self::getResult($consulta);
        }

        public function consulta (string $consulta) : array
        {
            if (!str_contains($consulta, 'SELECT')) return [];
            $result = self::getResult($consulta);
            $resultado = mysqli_fetch_all($result, MYSQLI_NUM);
            return $resultado;
        }

        public function cerrar ()
        {
            if ($this->conexion)
            {
                mysqli_close($this->conexion);
                $this->conexion = null;
            }
        }

        public function __destruct()
        {
            if ($this->conexion)
            {
                mysqli_close($this->conexion);
            }
        }
    }
?>