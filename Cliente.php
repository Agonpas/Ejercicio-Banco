<?php
include_once 'Cuenta.php';
/*creamos clase cliente*/
class Cliente {
    private $nombre;
    private $apellido;
    private $cuentas = array (); // en los atributos añadimos un array para contener las cuentas (pueden ser varias) de cada clientes
    /*constructor de la clase, no contiene el array cuentas, esto será accesible desde una funcion especifica para ello.*/
    public function __construct ($nombre, $apellido)  {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    /* setters*/
    public function setNombre ($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellido ($apellido) {
        $this->apellido = $apellido;
    }
      /* función para añadir cuentas*/
    public function agregarCuenta (Cuenta $cuentas) { // cada vez que se usa se crea un objeto de la clase Cuenta y se añade al array list de cuentas del cliente
        $this->cuentas[] = $cuentas;
    }
    /*getters*/
    public function getNombre () {
        return $this->nombre;
    }
    public function getApellido () {
        return $this->apellido;
    }
    public function getCuentas (){
        return $this->cuentas;
    }
    /*función para mostrar todos los datos*/
    public function mostrarDatos () {
        if (empty($this->cuentas)) { // en el caso que no tenga cuentas nos lo comunica
            echo PHP_EOL . "+ El cliente " . $this->getNombre() . " ". $this->getApellido() . " No tiene cuentas.". PHP_EOL;
        } else { // en caso contrario 
            echo PHP_EOL . "+ El cliente " . $this->getNombre() . " ". $this->getApellido() . " Dispone de las siguientes cuentas: ". PHP_EOL;
        foreach ($this->getCuentas() as $cuenta) {
            echo "La cuenta " . $cuenta->getNumCuenta() . " con un saldo de " . $cuenta->getSaldo(). " euros." . PHP_EOL;
        }
        
        }
    }
  
}
?>
