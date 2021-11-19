<?php
session_start();

/*
$msg = " Operación realizada.";
header("Location: minibanco.php?msg=".urlencode($msg));
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_SESSION['saldo'])) {
        $_SESSION['saldo'] = $_POST['importe'];
    } else {
        $_SESSION['saldo'];
    }
}

switch($_POST['Orden']) {
    case ($_POST['Orden'] == "Ingreso"):
        ingreso();
        break;
    case ($_POST['Orden'] == "Reintegro"):
        reintegro();
        break;
    case ($_POST['Orden'] == "Ver saldo"):
        echo verSaldo();
        break;
    case ($_POST['Orden'] == "Terminar");
        session_destroy();
        break;
}


function ingreso() {

    if ($_POST['importe'] <= 0) {
        echo "Importe Erróneo o importe menor de 0";
    } else {
        $_SESSION['saldo'] = $_SESSION['saldo'] + $_POST['importe'];
        echo "Tu saldo ahora es " . $_SESSION['saldo'];
    }
}

function reintegro() {

    if ($_POST['importe'] <= 0) {
        echo "Importe Erróneo o importe menor de 0";
    } else if ($_POST['importe'] > $_SESSION['saldo']){
        echo "No dispones de suficiente saldo";
    } else {
        $_SESSION['saldo'] = $_SESSION['saldo'] - $_POST['importe'];
        echo "Tu saldo ahora es " . $_SESSION['saldo'];
    }
}

function verSaldo() {

    $msg = "";
    if ($_SESSION['saldo'] > 0) {
        $msg .= "Su saldo es " . $_SESSION['saldo'];
    } else {
        $msg .= "Su saldo es 0";  
    }

    return $msg;
}

?>