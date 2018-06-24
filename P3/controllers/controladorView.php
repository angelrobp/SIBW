<?php

require("views/View.php");
require("models/db.php");

function comprobar_string($string, $db)
{
    $state = false;
    $resultado = $db->query("SELECT palabra FROM bad_word", array(), array());
    if ($resultado != null && $resultado->num_rows > 0) {
        while ($palabra = $resultado->fetch_assoc()) {
            if (strpos($string, $palabra['palabra']) !== false) {
                $state = true;
            }
        }
    }
    return $state;
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$view = new View();
$database = new db();
$database->conexion();

$selected_section = "index";
if (isset($_GET['page'])) {
    $selected_section = $_GET['page'];
}
switch ($selected_section) {
    case "index":
        $view->getIndexView($database);
        break;
    case "listacolecciones":
        $view->getListaColeccionesView($database);
        break;
    case "coleccion":
        if (isset($_GET['coleccion'])) {
            $selected_coleccion = $_GET['coleccion'];
            $view->getColeccionView($selected_coleccion, $database);
        }

        break;
    case "obra":
        if (isset($_GET['obra'])) {
            $selected_obra = $_GET['obra'];
            if (isset($_POST['sendForm'])) {
                if (empty($_POST["email"])) {
                    $emailErr = "Se necesita un email";
                } else {
                    $email = $_POST["email"];
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Formato de email invalido";
                    } else {
                        if (comprobar_string($_POST["comentario"], $database)) {
                            $comentarioErr = "Palabras prohibidas";
                        } else {
                            $ip = get_client_ip();
                            $state = $database->query('INSERT INTO comentario (id_obra, ip, usuario, correo, comentario) VALUES (?,?,?,?,?)', array("i", "s", "s", "s", "s"), array($selected_obra, $ip, $_POST["firstname"], $_POST["email"], $_POST["comentario"]));
                        }
                    }
                }
            }
            $view->getObraView($selected_obra, $database);
        }
        break;
    case "imprimir":
        if (isset($_GET['obra'])) {
            $selected_obra = $_GET['obra'];
            $view->getImprimirView($selected_obra, $database);
        }
        break;
    case "contacto":
        $view->getContactoView($database);
        break;
    default:
        $view->getIndexView($database);
        break;

}


$database->desconectar();
