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

?>