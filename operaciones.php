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

 /* funcion para buscar clientes*/
 function buscarCliente(&$clientes, &$idCliente) { //la función recibe los arrays de clientes (donde se almacena los clientes) y el array idCliente (usamos para compartir datos de busqueda)
    $posicion = -1; // la variable posición es la que nos identifica el cliente dentro del array clientes en caso que exista y nos dirá en que posición se encuntra. En caso de no existir el valor será -1
    $i = 0; //inicimaos la variable i a 0. Nos sirve para controlar el bucle while
    /* solicitamos los datos del cleinte a buscar*/
    echo "Introduce nombre de cliente:" . PHP_EOL;
    $nombreCliente = trim(fgets(STDIN));
    echo "Introduce apellido de cliente:" . PHP_EOL;
    $apellidoCliente = trim(fgets(STDIN));
    /* almacenamos los datos de nombre y apellido en las posiciones 0 y 1 para compartir dichos datos con otras funciones*/
    $idCliente [0] = $nombreCliente;
    $idCliente [1] = $apellidoCliente;
    /* inciamos la busqueda propiamente dicha*/
    while ($posicion == -1 && $i < sizeof($clientes)) { // bucle while que se ejecuta mientras posicion sea -1 y el numero de iteraciones sea menor que el tamaño del array $clientes
        foreach ($clientes as $i => $cliente) {// Recorremos el array clientes almacenando los valores dentro de cliente en cada iteración
            if ($cliente->getNombre() == $nombreCliente && $cliente->getApellido() == $apellidoCliente) { // obtenemos nombre y apellido y los comparamos con los datos del cliente buscado en caso de ser iguales
                $posicion = $i; // igualamos la posición al número de iteración i. Esto nos sacará del bucle while y nos identificará la posición del cliente que hemos encontrado. Tiene la ventaja que no necesita recorrer todo el array en caso de un exito en la busqueda
            }
            $i++; // en caso de no haber coincidencia sumaremos 1 a i para seguir con el bucle
        }
        
    }
    return $posicion; // una vez que ya no se complen las condiciones para mantenernos en el bucle while devolvemos la variable $pasicion que puede tener el valor -1 o un valor correspondiente a una posición dentro del array

 }
/* función para la creación de un cliente*/
 function crearCliente(&$clientes, &$idCliente, $posicion) { //recibe el array donde almacenamos los clientes, otro array dónde almacenamos el nombre y apellido del cliente y por último la posición encontrada a través del método Busqueda
    if ($posicion == -1) { // en el caso de que la posición sea -1 sabemos que no existe el cliente y pasamos a registrarlo
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no estaba registrado" . PHP_EOL;
        $cliente = new Cliente($idCliente[0], $idCliente[1]); // creamos un nuevo cliente al array clientes dando como nombre y apellido de las posiciones 0 y 1 del array idCliente
        array_push ($clientes, $cliente); //añado el cliente de la clase Cliente a nuestro Array de clientes
        echo "y se  ha añadido a nuestros clientes." . PHP_EOL; // comunicamos que el cliente se ha añadido con éxito
    } else {
        echo "El clienta ya estaba registrado" . PHP_EOL; // en el caso que la posición difiera de -1 sabemos que ya se encuentra registradd y lo comunicamos
    }
    
 }
/* eliminar cliente*/
 function borrarCliente(&$clientes, &$idCliente, $posicion){ //recibe el array donde almacenamos los clientes, otro array dónde almacenamos el nombre y apellido del cliente y por último la posición encontrada a través del método Busqueda
    if ($posicion != -1) { // en el caso de que la posición sea diferente -1 sabemos que si existe el cliente y pasamos a borrarlo
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " está registrado y será borrado." . PHP_EOL; // comunico que se va a borrar
        unset($clientes[$posicion]); // borramos el cliente del array clientes indicando la posición que nos ha devuelto la busqueda
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " se ha borrado correctamente." . PHP_EOL; // indicamos que se ha borrado
    } else { // en el caso que el resultado sea -1 sabemos que el cliente no está en el array
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado." . PHP_EOL; // comunicamos que no se ha encontrado
    }
 }
/* nuestra función para buscar cuentas*/
 function buscarCuenta(&$clientes, &$idCliente, &$numCuentas, $posicion) { //recibe el array donde almacenamos los clientes, otro array dónde almacenamos el nombre y apellido del cliente, otro para almacenar las cuentas que buscamos y por último la posición encontrada a través del método Busqueda
    $i = 0; //creamos variable contador
    $posicionCuenta = -1; //creamos variable para posicionar cuenta
    if ($posicion != -1) { // si elcliente existe pasmos a:
        $cliente = $clientes[$posicion]; // almacenamos en $cliente el Cliente buscado a través de la posición.
        echo "Inrtroduce un mumero de cuenta para el cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL; // Solicitmaos al usuario la cuenta para crear.
        $numCuentaNuevo = trim(fgets(STDIN));; // recogemos el numero de cuenta a crear.
        $numCuentas[0] =$numCuentaNuevo; // almacenamos dicho numero en la posición 0 del array $numCuentas para poder pasar el número a otras funciones
        $cuentas = $cliente->getCuentas(); // extraemos el Array de cuentas del cliente a través de la función get cuentas y almacenamos en $cuentas
        while ($posicionCuenta == -1 && $i < sizeof($cuentas)){ // este bucle while es similar al de busqueda de clentes aplicado a cuentas. Mientras la posicion se -1 y el contador sea menor que el tamaño del array cunetas
            foreach ($cuentas as $i=> $cuenta) { //recorremos el array cuentas
                if ($cuenta->getNumCuenta() == $numCuentaNuevo) { // en cada iteracion comapramos el numero de cuenta a crear con los existentes en caso de que esto se cumpla
                    $posicionCuenta = $i; // damos a posicionCuenta el valor de $i
                } 
                $i++; // en caso que no hayamos encontrado la cuenta sumamos 1 a $i
            }
        }  
    }
    return $posicionCuenta; // la función devuelve la posición de la cuenta o -1 en caso de que no se haya encontrado dicha cuenta
 }
/* función crear cuenta*/
 function crearCuenta(&$clientes, &$idCliente, $posicion, $posicionCuenta, $numCuentas){ //recibe el array donde almacenamos los clientes, otro array dónde almacenamos el nombre y apellido del cliente, el array que guarda los clientes, otro para almacenar las cuentas que buscamos, la posción del clientre y de las cuentas y el array del número de cunenta buscado
    if ($posicion != -1 && $posicionCuenta == -1) { // si el cliente existe y la cuenta no
        $cliente = $clientes [$posicion]; // extrameos el cliente encontrado (a través de la posción) del array clientes
        $cliente -> agregarCuenta(new Cuenta ($numCuentas[0], 0)); // le agregamos a ese cliente la cuenta almacenada en $numCuenta y de saldo la inicamos con 0 euros
        echo "La cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . " ha sido creada correctamente" . PHP_EOL; // comunicamos la creación de la cuneta

    } elseif ($posicion != -1 && $posicionCuenta != -1) { // en el caso de que exista el cliente y la cuenta
        echo "La cuenta " . $numCuentas[0] . " ya estaba registrada" . PHP_EOL; // indicamos que la cuenta ya existía
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado" . PHP_EOL; // la terecera posibilidad es que el clinte no esté registrado y así lo comunicamos
    }
 }
/* función para ingresar dinero*/
 function ingresarDinero(&$clientes, &$idCliente, $posicion, $posicionCuenta, $numCuentas){ //recibe el array donde almacenamos los clientes, otro array dónde almacenamos el nombre y apellido del cliente, el array que guarda los clientes, otro para almacenar las cuentas que buscamos, la posción del clientre y de las cuentas y el array del número de cunenta buscado
    if ($posicion != -1 && $posicionCuenta != -1) { // si tanto el cliente como la cuenta exiten
        $cliente = $clientes [$posicion]; // extrameos el cliente encontrado (a través de la posción) del array clientes
        echo "Introduce la cantidad a ingresar en la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL; // solicitamos la cantidad a ingresar
        $cantidadIngresar = trim(fgets(STDIN)); // almacenamos la cantidad en la variable $cantidadIngresar
        $cliente -> getCuentas()[$posicionCuenta] -> ingresarDinero($cantidadIngresar); // accedemos a la cuenta buscada del cliente e ingresamos el dinero usando la función de clase ingresarDinero
        echo "En la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . " se ha ingresado la cantidad de " . $cantidadIngresar . " euros." . PHP_EOL; // comunicamos que la operación se ha realizado
        $saldoActual = $cliente -> getCuentas()[$posicionCuenta] -> getSaldo(); // almacenamos el saldo acutalizado de la cuneta en cuestión
        echo "El saldo actualizado es de " . $saldoActual . " euros." . PHP_EOL; // mostramos el saldo de dicha cuenta

    } elseif ($posicion != -1 && $posicionCuenta == -1) { // si elcliente existe pero la cuenta no
        echo "La cuenta no existe " . PHP_EOL; // lo comunicamos
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado" . PHP_EOL; //el último caso es que el cliente no existe y así lo hacemos saber
    }
 }
 /* pasamos a pillar dinero de la cuenta*/
 function retirarDinero(&$clientes, &$idCliente, $posicion, $posicionCuenta, $numCuentas) { //recibe el array donde almacenamos los clientes, otro array dónde almacenamos el nombre y apellido del cliente, el array que guarda los clientes, otro para almacenar las cuentas que buscamos, la posción del clientre y de las cuentas y el array del número de cunenta buscado
    if ($posicion != -1 && $posicionCuenta != -1) { // si tanto el cliente como la cuenta existen
        $cliente = $clientes [$posicion]; // extrameos el cliente encontrado (a través de la posción) del array clientes
        echo "Introduce la cantidad a retirar en la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL; // solicitamos el dinero que quiere retirar el cliente
        $cantidadRetirar = trim(fgets(STDIN)); // almacenamos la cantidad a retirar
        $saldoPrevio = $cliente -> getCuentas()[$posicionCuenta] -> getSaldo(); // almaceno el dinero que tenemos antes de realizar la operación
        $cliente -> getCuentas()[$posicionCuenta] -> retirarDinero($cantidadRetirar);// accedemos a la cuenta buscada del cliente y retiramos el dinero usando la función de clase retirarDinero 
        $saldoActual = $cliente -> getCuentas()[$posicionCuenta] -> getSaldo(); // almacenamos el saldo acutalizado de la cuneta en cuestión
        if ($saldoPrevio == $saldoActual) { // en el caso de que el saldo no haya variado es que el saldo es insuficiente y de esta manera ahorramos mensajes duplicados (la función retirarDinero incluye mensaje de saldo insufiente)
            echo "El saldo actualizado es de " . $saldoActual . " euros." . PHP_EOL; // nos limitamos a dar el salo acutal
        } else { // en caso de que si que se haya realizado la operación
            echo "Se ha retirado la cantidad de " . $cantidadRetirar . " euros de la cuenta " . $numCuentas[0] . " del cliente " . $idCliente[0] . " " . $idCliente[1] . PHP_EOL; // resumimos el resultado de la operación
            echo "El saldo actualizado es de " . $saldoActual . " euros." . PHP_EOL; // y damos el saldo acutalizado
        }
               
    } elseif ($posicion != -1 && $posicionCuenta == -1) { // si elcliente existe pero la cuenta no
        echo "La cuenta no existe " . PHP_EOL; // lo comunicamos
    } else {
        echo "El cliente " . $idCliente[0] . " " . $idCliente[1] . " no está registrado" . PHP_EOL; // por último damos el mensaje de que el cliente no existe
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
