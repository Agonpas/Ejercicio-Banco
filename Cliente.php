<?php
include_once 'Cuenta.php';
/*creamos clase cliente*/
class Cliente {
    private string $nombre;
    private string $apellido;
    private array $cuentas = array (); // en los atributos añadimos un array para contener las cuentas (pueden ser varias) de cada cliente
    /*constructor de la clase, no contiene el array cuentas, esto será accesible desde una funcion especifica para ello.*/
    public function __construct (string $nombre, string $apellido)  {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    /* setters*/
    public function setNombre (string $nombre) {
        $this->nombre = $nombre;
    }
    public function setApellido (string $apellido) {
        $this->apellido = $apellido;
    }
      /* función para añadir cuentas*/
    public function agregarCuenta (Cuenta $cuenta) { // cada vez que se usa se crea un objeto de la clase Cuenta y se añade al array list de cuentas del cliente
        $this->cuentas[] = $cuenta;
    }
    /*getters*/
    public function getNombre (): string {
        return $this->nombre;
    }
    public function getApellido (): string {
        return $this->apellido;
    }
    public function getCuentas (): array{
        return $this->cuentas;
    }
    /*función para mostrar todos los datos*/
    public function mostrarDatos () {
        if (empty($this->cuentas)) { // en el caso que no tenga cuentas nos lo comunica
            echo PHP_EOL . "+ El cliente " . $this->getNombre() . " ". $this->getApellido() . " No tiene cuentas.". PHP_EOL;
        } else { // en caso contrario accede a los datos y los muestra
            echo PHP_EOL . "+ El cliente " . $this->getNombre() . " ". $this->getApellido() . " Dispone de las siguientes cuentas: ". PHP_EOL; // mostramos atributos nombre y apellido
        foreach ($this->cuentas as $cuenta) { // recorremos el array cuentas
            echo "La cuenta " . $cuenta->getNumCuenta() . " con un saldo de " . $cuenta->getSaldo(). " euros." . PHP_EOL; // mostramos cada cuenta y los valores de sus atributos
        }
        
        }
    }
  
}
?>
