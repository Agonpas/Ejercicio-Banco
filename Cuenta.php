<?php
class Cuenta{
    private $numCuenta;
    private $saldo;

    /*constructor*/
    public function __construct (int $numCuenta, int $saldo){
        $this->numCuenta = $numCuenta;
        $this->saldo = $saldo;
    }
    /*setters*/
    public function setNumCuenta ($numCuenta){
        $this->numCuenta = $numCuenta;
    }
    public function setSaldo ($saldo) {
        $this->saldo = $saldo;
    }
    /*getters*/
    public function getNumCuenta () {
        return $this-> numCuenta;
    }
    public function getSaldo () {
        return $this-> saldo;
    }
    /*creamos metodo para ingresar*/
    public function ingresarDinero ($cantidad) {
        $this->saldo = $this->saldo + $cantidad;
        return $this->saldo;
    }
    public function retirarDinero ($cantidad) {
        if ($cantidad <= $this->saldo){
            $this->saldo = $this->saldo - $cantidad;
        } else {
            echo "Saldo insuficiente, no puede retirar una cantidad superior a " . $this->saldo. " euros." . PHP_EOL;
        }
        return $this->saldo;
    }

}

?>
