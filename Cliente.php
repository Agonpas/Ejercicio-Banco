<?php
include_once 'Cuenta.php';
class Cliente {
    private $nombre;
    private $apellido;
    private $cuentas = array ();

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
      /* añadir cuentas*/
    public function agregarCuenta (Cuenta $cuentas) {
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
        if (empty($this->cuentas)) {
            echo PHP_EOL . "+ El cliente " . $this->getNombre() . " ". $this->getApellido() . " No tiene cuentas.". PHP_EOL;
        } else {
            echo PHP_EOL . "+ El cliente " . $this->getNombre() . " ". $this->getApellido() . " Dispone de las siguientes cuentas: ". PHP_EOL;
        foreach ($this->getCuentas() as $cuenta) {
            echo "La cuenta " . $cuenta->getNumCuenta() . " con un saldo de " . $cuenta->getSaldo(). " euros." . PHP_EOL;
        }
        
        }
    }
  
}
?>
