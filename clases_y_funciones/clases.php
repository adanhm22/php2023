<?php
function salto(){echo "<br><br>";}
/**
 * Crea una clase Persona con los siguientes atributos: nombre, apellidos y edad.
 *  Crea su constructor y get y set.
 *   Crear las siguientes funciones: – mayorEdad: indica si es o no mayor de edad. – nombreCompleto: devuelve el nombre mas apellidos
 */
    echo "ej1: <br>";
    class  ej1
    {
        public function __construct(private $nombre, private $apellidos, private $edad) {}
        
        public function getNombre (){return $this->nombre;}
        public function getApellidos () {return $this->apellidos;}
        public function getEdad () {return $this->edad;}

        public function setNombre ($nombre) {$this->nombre = $nombre;}
        public function setApellidos ($apellidos) {$this->apellidos = $apellidos;}
        public function setEdad ($edad) {$this->edad = $edad;}

        public function mayorEdad ()
        {
            if ($this->edad >= 18) return true;
            return false;
        }

        public function nombreCompleto () 
        {
            return $this->nombre . " " . $this -> apellidos;
        }
    }

    $persona = new ej1 ("Adán","Heredia", 26);
    echo $persona -> nombreCompleto() . "<br>";
    var_dump( $persona -> mayorEdad());
    salto();
    
    /**
     * Realiza con POO un programa que permita pintar en pantalla lo siguiente:
     * Dimensión 1: 4
     * Dimensión 2: 10
     * 
     *    ++++
     *   ++++++
     *  ++++++++
     * ++++++++++
     *  ++++++++
     *   ++++++
     *    ++++
     */
    echo "ej 2: <br>";

    class ej2
    {
        public function __construct(private $inicio, private $ancho) {}

        public function rombo ()
        {
            $resultado = "Dimensión 1: $this->inicio <br> Dimensión 2: $this->ancho <br><br>";

            $mitad = ($this -> ancho - $this -> inicio) /2 + 1; 
            $iteraciones = $mitad * 2 - 1 ;
            $espacios = ($this->ancho - $this->inicio)/2;
            $letras = $this->inicio;


            for ($i=1; $i < $iteraciones +1; $i++) { 
                if ($i < $mitad)
                {
                    $resultado .= $this->anniadirLetras("_",$espacios);
                    $resultado .= $this->anniadirLetras("+",$letras);
                    $resultado .= $this->anniadirLetras("_",$espacios);
                    $espacios--;
                    $letras += 2;
                }elseif($i == $mitad)
                {
                    $resultado .= $this->anniadirLetras("+",$this->ancho);
                    $espacios++;
                    $letras -= 2;
                }else
                { 
                    $resultado .= $this->anniadirLetras("_",$espacios);
                    $resultado .= $this->anniadirLetras("+",$letras);
                    $resultado .= $this->anniadirLetras("_",$espacios);

                    $espacios++;
                    $letras -= 2;
                }
                $resultado .= "<br>";
            }

            return $resultado;
        }

        private function anniadirLetras ($letra,$numero)
        {
            $linea = "";
            for ($i=0; $i < $numero; $i++) { 
                $linea .= $letra;
            }
            return $linea;
        }
    }

    $rombo = new ej2(4,10);
    echo $rombo->rombo();
    salto();

    /**
     * Crea una clase llamada Cuenta que tendrá los siguientes atributos: titular y cantidad (puede tener decimales). 
     * Crea sus métodos get, set para cada atributo y los siguiente métodos:
     * ingresar: se ingresa una cantidad a la cuenta. Si la cantidad introducida es negativa, no se hará nada.
     * retirar: se retira una cantidad a la cuenta. Si restando la cantidad actual a la que nos pasan es negativa, 
     * la cantidad de la cuenta pasa a ser 0.
     */
    echo "ej3: <br>";
    class ej3
    {
        public function __construct(private $titular, private $cantidad) {}

        public function ingresar ($valor)
        {
            if($valor > 0)
            {
                $this->cantidad += $valor;
            }
        }

        public function retirar ($cantidad)
        {
            if ($this->cantidad - $cantidad < 0)
            {
                $dinero = $this->cantidad;
                $this->cantidad = 0;
                return $dinero;
            }
            $this->cantidad -= $cantidad;
            return $cantidad;
        }
    }

    $cuenta = new ej3("Adán",350);

    echo $cuenta->retirar(360);
    salto();

    /**
     * Crea una clase llamada Password que siga las siguientes condiciones:
     * Que tenga los atributos longitud y contraseña . Por defecto, la longitud sera de 8.
     * Los métodos que implementa serán:
     * esFuerte(): devuelve un booleano si es fuerte o no, para que sea fuerte debe tener mas de 2 mayúsculas, mas de 1 minúscula y mas de 5 números.
     * generarPassword(): genera la contraseña del objeto con la longitud que tenga.
     * Método get para contraseña y longitud.
     * Método set para longitud.
     */
    echo "ej4: <br>"; 

    class ej4 
    {
        private $contrasennia = "ABc12345";
        private $longitud = 8;

        public function getContrasennia() {return $this->contrasennia;}
        public function getLongitud() {return $this->longitud;}
        public function setLongitud ($longitud) {$this->longitud = $longitud;}

        public function esFuerte($contrasenia = null)
        {
            $nMayus = 0;$nMinus = 0; $nNumeros = 0;
            $letras = [];
            if ($contrasenia == null)
            {
                $letras = str_split($this->contrasennia);
            } else 
            {
                $letras = str_split($contrasenia);
            }

            foreach ($letras as $letra) {
                if (is_numeric($letra))
                {
                    $nNumeros ++;
                } elseif (ctype_upper($letra))
                {
                    $nMayus ++;
                } else
                {
                    $nMinus ++;
                }
            }

            if ($nMayus >= 2 && $nMinus >= 1 && $nNumeros >= 5) return true;
            return false;
        }

        public function generarContrasennia (bool $guardar = true, $longitud = -1)
        {
            if ($longitud < 1 ) $longitud = $this->longitud;
            $nMayus = 2;$nMinus = 1; $nNumeros = 5;
            $contrasennia = "";
            while ($longitud > 0)
            {
                if ($nMayus > 0)
                {
                    $contrasennia .= $this->genMayu();
                    $nMayus--;
                }elseif ($nMinus > 0)
                {
                    $contrasennia .= $this -> genMin();
                    $nMinus --;
                }elseif ($nNumeros > 0)
                {
                    $contrasennia .= $this -> genNum();
                    $nNumeros --;
                }else
                {
                    $contrasennia .= $this -> genRand();
                }

                $longitud --;
            }
            if ($guardar) $this -> contrasennia = $contrasennia;
            return $contrasennia;
        }

        /**
         * Crea un array de Passwords con el tamaño que tu le indiques por teclado.
         */
        public function generarContrasennias ($numero) : array
        {
            if ($numero <0) return [];
            $array = [];
            for ($i=0; $i < $numero; $i++) { 
                array_push($array,$this->generarContrasennia(false));
            }
            return $array;
        }

        /**
         * Crea un bucle que cree un objeto para cada contraseña del array y su longitud.
         */
        public function generarArrayContrasennias ($numero,$min = 8, $max = 20) : array
        {
            if ($numero <0 || $min < 0 || $max < 0) return [];
            $array = [];
            for ($i=0; $i < $numero; $i++) { 
                array_push($array,$this->generarContrasennia(false, rand($min,$max)));
            }
            return $array;
        }

        /**
         * Crea otro array de booleanos donde se almacene si el password del array de Password es o no fuerte.
         */
        public function sonFuertes (array $contrasennias)
        {
            $array = [];
            foreach ($contrasennias as $contrasenia) {
                array_push($array, $this->esFuerte($contrasenia));
            }
            return $array;
        }

        private function genMayu ()
        {
            $valores = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            return $valores[rand(0,strlen($valores) - 1)];
            //return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);
        }

        private function genMin ()
        {
            $valores = "abcdefghijklmnopqrstuvwxyz";
            return $valores[rand(0,strlen($valores) - 1)];
           // return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 1);
        }

        private function genNum ()
        {
            $valores = "0123456789";
            return $valores[rand(0,strlen($valores) - 1)];
            //return substr(str_shuffle("0123456789"), 0, 1);
        }

        private function genRand ()
        {
            $valores = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            return $valores[rand(0,strlen($valores) - 1)];
           // return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);
        }

    }

    $ej4 = new ej4();
    var_dump($ej4);

    var_dump($ej4->esFuerte());
    echo $ej4->generarContrasennia();
    echo "<br>";
    var_dump($ej4->generarContrasennias(5));
    echo "<br>";
    $arrayContrasennias = $ej4->generarArrayContrasennias(5);
    var_dump($arrayContrasennias);
    echo "<br>";
    var_dump($ej4->sonFuertes(["ASs45612","asdfghqw"]));
?>