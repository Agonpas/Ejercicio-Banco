<?php
include_once 'Cliente.php';
include_once 'Cuenta.php';
/*pruebas previas para verificar el funcionaminto correcto de las clases*/
/*creamos clientes*/
$cliente1 = new Cliente("Alberto", "Gonzalez");
$cliente2 = new Cliente("Irene", "Alvarez");
$cliente2->setApellido("Alvarez de Eulate");
$cliente3 = new Cliente("Carlos", "Pascual");
/*mostramos los datos creados de los clientes*/
echo $cliente1->getNombre() . " " . $cliente1->getApellido() . PHP_EOL;
echo $cliente2->getNombre() . " " . $cliente2->getApellido() . PHP_EOL;
/*creamos cuentas a los clientes*/
$cliente1->agregarCuenta(new Cuenta (1, 50));
$cliente1->agregarCuenta(new Cuenta (2, 0));
$cliente2->agregarCuenta(new Cuenta (1, 0));
/* usamos la función mostrar datos sobre los clientes creados*/
$cliente1-> mostrarDatos();
$cliente2-> mostrarDatos();
/* añadimos dinero a una cuenta de un cliente */
$cliente1->getCuentas()[1]->ingresarDinero(100); // añadimos dinero a la cuenta 2 (Posicion [1]) del cliente1
/* cremos un array para volcar las cuentas del cliente1*/
$cuentas = $cliente1->getCuentas();
/*recorremos la cuentas y mostramos los número de estas*/
foreach ($cuentas as $cuenta) {
    echo $cuenta->getNumCuenta() . PHP_EOL;
}
/*usamos el metodo mostrarDatos sobre el $cliente1*/
$cliente1-> mostrarDatos();
echo PHP_EOL;

/*inicio código para creación aplicación*/
$clientes = array(); /*creamos array para almacenar clientes*/
$numCuentas = array();/*creamos array para almacenar numeros de cuenta buscados y pasarlos entre las distintas funciones*/
$idCliente = array();/*creamos array para almacenar nombres de los clientes y pasarlos entre las distintas funciones*/
/*Creamos clientes y los añadimos al array clientes para hacer pruebas y no tener que introducirlos cada inicio del programa*/
$cliente = new Cliente("Alberto", "Gonzalez"); // creamos cliente
$cliente->agregarCuenta(new Cuenta (1, 50)); // creamos cuenta 1 con 50 euros
$cliente->agregarCuenta(new Cuenta (2, 0)); // creamos cuenta 2 con 0 euros
array_push($clientes, $cliente); // añadimos el cliente al Array

$cliente = new Cliente("Irene", "Alvarez"); // creamos cliente
$cliente->agregarCuenta(new Cuenta (1, 0)); // creamos cuenta 1 con 0 euros
$cliente->agregarCuenta(new Cuenta (2, 80)); // creamos cuenta 2 con 80 euros
array_push($clientes, $cliente); // añadimos el cliente al Array

$cliente = new Cliente("Carlos", "Pascual"); // creamos cliente
$cliente->agregarCuenta(new Cuenta (1, 50)); // creamos cuenta 1 con 50 euros
$cliente->agregarCuenta(new Cuenta (2, 150)); // creamos cuenta 2 con 150 euros
$cliente->agregarCuenta(new Cuenta (3, 0)); // creamos cuenta 3 con 0 euros
array_push($clientes, $cliente); // añadimos el cliente al Array

/*delcaramos una función que contiene el texto  de menú de la plicación*/
function menu() {
    echo "APLICACIÓN CUENTAS BANCARIAS" . PHP_EOL;
    echo "----------------------------" . PHP_EOL;
    echo "Escoge una opción: " . PHP_EOL . "0. Salir de la aplicación" . PHP_EOL . "1. Crear cliente" . PHP_EOL . "2. Dar de baja un cliente" . PHP_EOL . "3. Crear cuenta a un cliente" . PHP_EOL . "4. Hacer ingresos" . PHP_EOL . "5. Retirar dinero" . PHP_EOL . "6. Mostrar datos de un cliente" . PHP_EOL. "7. Mostrar lista de clientes" . PHP_EOL;
}
/* generamos el menú para la aplicacion*/
 do { // lo contenmos dentro de un do while que nos mantine dentro de la applicacion simpre que no escogamos 0
    menu(); // llamamos al menú
    $opcion = trim(fgets(STDIN)); // pedimos la elección al usuario
    /* switch con las diferentes opciones de nuestra app*/
    switch ($opcion) {
        case 0: //nos saca de la app y damos un mensaje de agradecimento por su uso
            echo "Gracias por usar la aplicación" . PHP_EOL;
            break;
        case 1: // para crear el cliente
            $posicion = buscarCliente($clientes, $idCliente); // llamanda a la función buscar que recibe el Array $clientes e $idCliente cliente nos devuelve una posición del array $clientes
            crearCliente($clientes, $idCliente, $posicion); // llammos a la función crearCliente que recibe recibe el Array $clientes e $idCliente y la posición creada por la busqueda
            break;
        case 2: // para borrar cliente
            $posicion = buscarCliente($clientes, $idCliente);// reutilizamos la busqueda de Cliente
            borrarCliente($clientes, $idCliente, $posicion);// llammos a la función borrarCliente que recibe recibe el Array $clientes e $idCliente y la posición creada por la busqueda
            break;
        case 3: // para crear cuentas a un cliente
            $posicion = buscarCliente($clientes, $idCliente);// reutilizamos la busqueda de Cliente
            $posicionCuenta = buscarCuenta($clientes, $idCliente, $numCuentas, $posicion);// llamanda a la función buscarCuenta que recibe el Array $clientes, $idCliente y  cliente nos devuelve una posición del array $cuentas del cliente buscado anteriomente
            crearCuenta($clientes, $idCliente, $posicion, $posicionCuenta, $numCuentas);// llamadaa al metodo crearCuenta  que recibe los Array $clientes e $idCliente, $numCuentas y las posciones de clente $posicion y de cuentas $posiconCuenta
            break;
        case 4: // hacer ingresos en una de las cuentas de un cliente
            $posicion = buscarCliente($clientes, $idCliente);// reutilizamos la busqueda de Cliente
            $posicionCuenta = buscarCuenta($clientes, $idCliente, $numCuentas, $posicion); // reutilizamos buscarCuenta
            ingresarDinero($clientes, $idCliente, $posicion, $posicionCuenta, $numCuentas); // Llamada al metodo ingreasrDinero que recibe los Array $clientes e $idCliente, $numCuentas y las posciones de clente $posicion y de cuentas $posiconCuenta
            break;
        case 5: // retirar dinero de una de las cuentas de un cliente
            $posicion = buscarCliente($clientes, $idCliente);// reutilizamos la busqueda de Cliente
            $posicionCuenta = buscarCuenta($clientes, $idCliente, $numCuentas, $posicion); // reutilizamos buscarCuenta
            retirarDinero($clientes, $idCliente, $posicion, $posicionCuenta, $numCuentas);// Llamada al metodo retirarrDinero que recibe los Array $clientes e $idCliente, $numCuentas y las posciones de clente $posicion y de cuentas $posiconCuenta
            break;
        case 6: // mostrar los datos de un cliente
            $posicion = buscarCliente($clientes, $idCliente);// reutilizamos la busqueda de Cliente
            mostrarDatos($clientes, $posicion, $idCliente); //llmada a la función mostrarDatos recibe $clientes $posicion $idCliente
            break;
        case 7: // mostrar lista de clientes
            listarClientes($clientes); // llamada al metodo listarClientes
            break;
        default:
            echo "Opción no válida"; //en caso de no seleccionar un número correcto nos lo indica
    }
 }while ($opcion != 0); // while que nos mantiene en el swich mientras no selecionemos 0

 function buscarCliente(&$clientes, &$idCliente) {
    $posicion = -1;
    $i = 0;
   
    echo "Introduce nombre de cliente:" . PHP_EOL;
    $nombreCliente = trim(fgets(STDIN));
    echo "Introduce apellido de cliente:" . PHP_EOL;
    $apellidoCliente = trim(fgets(STDIN));

    $idCliente [0] = $nombreCliente;
    $idCliente [1] = $apellidoCliente;
    
    while ($posicion == -1 && $i < sizeof($clientes)) {
        foreach ($clientes as $i => $cliente) {
            if ($cliente->getNombre() == $nombreCliente && $cliente->getApellido() == $apellidoCliente) {
                $posicion = $i;
            }
            $i++;
        }
        
    }
    return $posicion; 

 }

 function crearCliente(&$clientes, &$idCliente, $posicion) {
    if ($posicion == -1) {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no estaba registrado" . PHP_EOL;
        $cliente = new Cliente($idCliente[0], $idCliente[1]);
        array_push ($clientes, $cliente);
        echo "y se  ha añadido a nuestros clientes." . PHP_EOL;
    } else {
        echo "El clienta ya estaba registrado" . PHP_EOL;
    }
    
 }

 function borrarCliente(&$clientes, &$idCliente, $posicion){
    if ($posicion != -1) {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " está registrado y será borrado." . PHP_EOL;
        unset($clientes[$posicion]);
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " se ha borrado correctamente." . PHP_EOL;
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado." . PHP_EOL;
    }
 }

 function buscarCuenta(&$clientes, &$idCliente, &$numCuentas, $posicion) {
    $i = 0; //creamos variable contador
    $posicionCuenta = -1; //creamos variable para posicionar cuenta
    if ($posicion != -1) { // si elcliente existe pasmos a:
        $cliente = $clientes[$posicion]; // almacenamos en $cliente el Cliente buscado a través de la posición.
        echo "Inrtroduce un mumero de cuenta para el cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL; // Solicitmaos al usuario la cuenta para crear.
        $numCuentaNuevo = trim(fgets(STDIN));; // recogemos el numero de cuenta a crear.
        $numCuentas[0] =$numCuentaNuevo; // almacenamos dicho numero en la posición 0 del array $numCuentas para poder pasar el número a otras funciones
        $cuentas = $cliente->getCuentas();
        while ($posicionCuenta == -1 && $i < sizeof($cuentas)){
            foreach ($cuentas as $i=> $cuenta) {
                if ($cuenta->getNumCuenta() == $numCuentaNuevo) {
                    $posicionCuenta = $i;
                } 
                $i++;
            }
        }  
    }
    return $posicionCuenta;
 }

 function crearCuenta(&$clientes, &$idCliente, $posicion, $posicionCuenta, $numCuentas){
    if ($posicion != -1 && $posicionCuenta == -1) {
        $cliente = $clientes [$posicion];
        $cliente -> agregarCuenta(new Cuenta ($numCuentas[0], 0));
        echo "La cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . " ha sido creada correctamente" . PHP_EOL;

    } elseif ($posicion != -1 && $posicionCuenta != -1) {
        echo "La cuenta " . $numCuentas[0] . " ya estaba registrada" . PHP_EOL;
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado" . PHP_EOL;
    }
 }

 function ingresarDinero(&$clientes, &$idCliente, $posicion, $posicionCuenta, $numCuentas){
    if ($posicion != -1 && $posicionCuenta != -1) {
        $cliente = $clientes [$posicion];
        echo "Introduce la cantidad a ingresar en la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL;
        $cantidadIngresar = trim(fgets(STDIN));
        $cliente -> getCuentas()[$posicionCuenta] -> ingresarDinero($cantidadIngresar);
        echo "En la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . " se ha ingresado la cantidad de " . $cantidadIngresar . " euros." . PHP_EOL;
        $saldoActual = $cliente -> getCuentas()[$posicionCuenta] -> getSaldo();
        echo "El saldo actualizado es de " . $saldoActual . " euros." . PHP_EOL;

    } elseif ($posicionCuenta == -1) {
        echo "La cuenta no existe " . PHP_EOL;
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado" . PHP_EOL;
    }
 }
 function retirarDinero(&$clientes, &$idCliente, $posicion, $posicionCuenta, $numCuentas) {
    if ($posicion != -1 && $posicionCuenta != -1) {
        $cliente = $clientes [$posicion];
        echo "Introduce la cantidad a retirar en la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL;
        $cantidadRetirar = trim(fgets(STDIN));
        $saldoPrevio = $cliente -> getCuentas()[$posicionCuenta] -> getSaldo();
        $cliente -> getCuentas()[$posicionCuenta] -> retirarDinero($cantidadRetirar);
        $saldoActual = $cliente -> getCuentas()[$posicionCuenta] -> getSaldo();
        if ($saldoPrevio == $saldoActual) {
            echo "El saldo actualizado es de " . $saldoActual . " euros." . PHP_EOL;
        } else {
            echo "Se ha retirado la cantidad de " . $cantidadRetirar . " euros de la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL;
            echo "El saldo actualizado es de " . $saldoActual . " euros." . PHP_EOL;
        }
               

    } elseif ($posicionCuenta == -1) {
        echo "La cuenta no existe " . PHP_EOL;
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado" . PHP_EOL;
    }
 }

 function mostrarDatos(&$clientes, $posicion, &$idCliente) {
    if ($posicion != -1) {
        $cliente = $clientes [$posicion];
        $cliente -> mostrarDatos();
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado" . PHP_EOL;
    }
 }

 function listarClientes(&$clientes){
    foreach ($clientes as $cliente){
        echo $cliente->getNombre() . " " . $cliente->getApellido() . PHP_EOL;
    }
 }

print_r ($clientes);

?>
