<?php
/*Creamos clase Cuenta*/
class Cuenta {
    private int $numCuenta;
    private int $saldo;

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
    public function ingresarDinero ($cantidad) { // la función ingresar recibe la variable $cantidad
        $this->saldo = $this->saldo + $cantidad; // la suma a saldo
        return $this->saldo; // y retornamos el saldo acutalizado
    }
    public function retirarDinero ($cantidad) { // el metodo retirar recibe la variable $cantidad
        if ($cantidad <= $this->saldo){ // mediante if verificamos que el saldo sea igual o superior a la cantidad a retirar
            $this->saldo = $this->saldo - $cantidad; // en caso de que se cumpla la condición realizamos la operación 
        } else {
            echo "Saldo insuficiente, no puede retirar una cantidad superior a " . $this->saldo. " euros." . PHP_EOL; // si el saldo no es suficiente lo comunicamos
        }
        return $this->saldo; // retornamos el saldo actualizado
    }
}

?>
