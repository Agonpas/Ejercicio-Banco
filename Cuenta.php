<?php
/*Creamos clase Cuenta*/
class Cuenta {
    private int $numCuenta;
    private float $saldo;

    /*constructor*/
    public function __construct (int $numCuenta, float $saldo){
        $this->numCuenta = $numCuenta;
        $this->saldo = $saldo;
    }
    /*setters*/
    public function setNumCuenta (int $numCuenta){
        $this->numCuenta = $numCuenta;
    }
    public function setSaldo (float $saldo) {
        $this->saldo = $saldo;
    }
    /*getters*/
    public function getNumCuenta (): int {
        return $this-> numCuenta;
    }
    public function getSaldo (): float {
        return $this-> saldo;
    }
    /*creamos metodo para ingresar*/
    public function ingresarDinero (float $cantidad): float { // la función ingresar recibe la variable $cantidad
        $this->saldo = $this->saldo + $cantidad; // la suma a saldo
        return $this->saldo; // y retornamos el saldo acutalizado
    }
    public function retirarDinero (float $cantidad): float { // el metodo retirar recibe la variable $cantidad
        if ($cantidad <= $this->saldo){ // mediante if verificamos que el saldo sea igual o superior a la cantidad a retirar
            $this->saldo = $this->saldo - $cantidad; // en caso de que se cumpla la condición realizamos la operación 
        } else {
            echo "Saldo insuficiente, no puede retirar una cantidad superior a " . $this->saldo. " euros." . PHP_EOL; // si el saldo no es suficiente lo comunicamos
        }
        return $this->saldo; // retornamos el saldo actualizado
    }
}

?>
