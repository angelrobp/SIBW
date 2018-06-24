<?php
session_start();


require("views/View.php");
require("models/db.php");

$database = new db();
$database->conexion();

require("models/Usuario.php");
require_once("controllers/controladorDatos.php");

function comprobar_string($string, $db)
{
    $state = FALSE;
    $resultado = $db->query("SELECT palabra FROM bad_word", array(), array());
    if ($resultado != null && $resultado->num_rows > 0) {
        while ($palabra = $resultado->fetch_assoc()) {
            if (strpos($string, $palabra['palabra']) !== FALSE) {
                $state = TRUE;
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

if (isset($_GET['logout'])) {
    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin']) {
            if ($_GET['logout']) {
                unset ($_SESSION['nombreusuario']);
                unset ($_SESSION['email']);
                unset ($_SESSION['nombre']);
                unset ($_SESSION['permiso']);
                unset($_SESSION['loggedin']);
                unset($_GET['logout']);
                session_destroy();
            }
        }
    }
}

$usuario = new Usuario();

//Conexión de Usuario
if (isset($_POST['send-signin'])) {
    if (isset($_POST['usuarioSingIn']) && isset($_POST['pswSingIn'])) {

        $nombreUsuario = $_POST['usuarioSingIn'];
        $password = $_POST['pswSingIn'];
        $resultado = $database->query("SELECT nombre_usuario, id_permiso, password, email, nombre FROM usuario WHERE nombre_usuario=?", array("s"), array($nombreUsuario));
        if ($resultado != FALSE) {
            $resultado = $resultado->fetch_assoc();

            if (password_verify($password, $resultado['password'])) {
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['nombreusuario'] = $nombreUsuario;
                $_SESSION['email'] = $resultado['email'];
                $_SESSION['nombre'] = $resultado['nombre'];
                $resultado = $database->query("SELECT tipo FROM permiso WHERE id=?", array("i"), array($resultado['id_permiso']));
                if ($resultado != FALSE) {
                    $resultado = $resultado->fetch_assoc();
                    $_SESSION['permiso'] = $resultado['tipo'];
                } else {
                    $_SESSION['loggedin'] = FALSE;
                }
            }
        } else {
            $_SESSION['loggedin'] = FALSE;
        }


    }
}

//Registro de nuevo usaurio
if (isset($_POST['send-signup'])) {

    if (isset($_POST['usuarioSingUp']) && isset($_POST['pswSingUp']) && isset($_POST['emailSingUp']) && isset($_POST['nombreSingUp'])) {
        if (empty($_POST["emailSingUp"]) || empty($_POST["nombreSingUp"])) {
            $emailErr = "Se necesita un email";
        } else {
            $email = $_POST["emailSingUp"];
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Formato de email invalido";
            } else {
                $password = password_hash($_POST['pswSingUp'], PASSWORD_DEFAULT);
                $ip = get_client_ip();
                $state = $database->query('INSERT INTO usuario (id_permiso, nombre_usuario, password, email, nombre) VALUES (?,?,?,?,?)', array("i", "s", "s", "s", "s"), array(4, $_POST["usuarioSingUp"], $password, $_POST["emailSingUp"], $_POST["nombreSingUp"]));

                if ($database->affected_rows() > 0) {
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['nombreusuario'] = $_POST['usuarioSingUp'];
                    $_SESSION['email'] = $email;
                    $_SESSION['permiso'] = "registrado";
                    $_SESSION['nombre'] = $_POST["nombreSingUp"];
                } else {
                    $_SESSION['loggedin'] = FALSE;
                }


            }
        }
    }
}

//Modificación datos de usuario
if (isset($_POST['send-edit'])) {

    if (isset($_POST['nombreEdit']) && isset($_POST['pswEdit']) && isset($_POST['emailEdit'])) {
        if (empty($_POST["emailEdit"]) || empty($_POST["nombreEdit"])) {
            $emailErr = "Se necesita un email";
        } else {
            $email = $_POST["emailEdit"];
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Formato de email invalido";
            } else {
                $password = password_hash($_POST['pswEdit'], PASSWORD_DEFAULT);
                $ip = get_client_ip();
                $state = $database->query('UPDATE usuario SET password=?, email=?, nombre=? WHERE nombre_usuario=?', array("s", "s", "s", "s"), array($password, $email, $_POST["nombreEdit"], $_SESSION['nombreusuario']));

                if ($database->affected_rows() !== 0) {
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['email'] = $email;
                    $_SESSION['nombre'] = $_POST["nombreEdit"];
                }
            }
        }
    }
}


if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['loggedin']) {
        $usuario->setNombreUsuario($_SESSION['nombreusuario']);
        $usuario->setPermiso($_SESSION['permiso']);
        $usuario->setNombre($_SESSION['nombre']);
        $usuario->setEmail($_SESSION['email']);
        $usuario->setConectado(TRUE);
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    }
}

//Agregar comentario
if (isset($_POST['sendForm']) && isset($_GET['obra'])) {

    if (comprobar_string($_POST["comentario"], $database)) {

        $comentarioErr = "Palabras prohibidas";
    } else {

        $ip = get_client_ip();
        $state = $database->query('INSERT INTO comentario (id_obra, ip, usuario, comentario) VALUES (?,?,?,?)', array("i", "s", "s", "s"), array($_GET['obra'], $ip, $usuario->getNombreUsuario(), $_POST["comentario"]));
    }
}

$view = new View($usuario, $database);

$selected_section = "index";
if (isset($_GET['page'])) {
    $selected_section = $_GET['page'];
    if ($selected_section == "perfil") {
        if (isset($_SESSION['loggedin'])) {
            if (!$_SESSION['loggedin']) {
                $selected_section = "index";
            }
        } else {
            $selected_section = "index";
        }
    }
}
switch ($selected_section) {
    case "index":
        $view->getIndexView();
        break;
    case "listacolecciones":
        $view->getListaColeccionesView();
        break;
    case "coleccion":
        if (isset($_GET['coleccion'])) {
            $selected_coleccion = $_GET['coleccion'];
            $view->getColeccionView($selected_coleccion);
        }

        break;
    case "obra":
        if (isset($_GET['obra'])) {
            $selected_obra = $_GET['obra'];
            $view->getObraView($selected_obra);
        }
        break;
    case "imprimir":
        if (isset($_GET['obra'])) {
            $selected_obra = $_GET['obra'];
            $view->getImprimirView($selected_obra);
        }
        break;
    case "contacto":
        $view->getContactoView();
        break;
    case "perfil":
        $view->getPerfilView();
        break;
    default:
        $view->getIndexView();
        break;

}


$database->desconectar();
