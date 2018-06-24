<?php

require("models/db.php");

$database = new db();
$database->conexion();


$html = "dddasdfdddasdffff";
$needle = "asdf";



$hint = "";
if (isset($_GET['str']) && isset($_GET['permiso'])) {
    if ($_GET['permiso'] === "gestor") {

        $cadena = $_GET['str'];

        $resultado = $database->query("SELECT * FROM obra", array(), array());

        if ($resultado == TRUE) {
            if (strlen($cadena) > 0) {

                $i = 0;
                while ($obra = $resultado->fetch_assoc()) {
                    if (stristr($obra['nombre'], $cadena)) {
                        $lastPos = 0;
                        $positions = array();
                        while (($lastPos = stripos($obra['nombre'], $cadena, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos = $lastPos + strlen($cadena);
                        }

                        $j = 0;
                        $titulo='';
                        for ($j; $j < strlen($obra['nombre']); $j++) {
                            $k = 0;
                            $resaltar=false;
                            for ($k; $k < count($positions); $k++) {
                                if ($positions[$k] === $j) {
                                    $resaltar=true;
                                }
                            }
                            if ($resaltar) {

                                $subcadena = '';
                                $k=0;
                                for ($k=$j; $k < $j+strlen($cadena); $k++) {
                                    $subcadena = $subcadena.''.$obra['nombre'][$k];
                                }
                                $titulo = $titulo."<spam class='highlight'>". $subcadena ."</spam>";
                                $j = $j + strlen($cadena) - 1;
                            }
                            else {
                                $titulo = $titulo."".$obra['nombre'][$j];
                            }
                        }

                        if ($hint == "") {
                            $hint = "<a href='index.php?page=obra&obra=" . $obra['id'] . "'>" .
                                $titulo . "</a>";
                        } else {
                            $hint = $hint . "<br /><a href='index.php?page=obra&obra=" . $obra['id'] . "'>" .
                                $titulo . "</a>";
                        }
                    }
                    $i += 1;
                }
            }


        }
    } else {
        $cadena = $_GET['str'];

        $resultado = $database->query("SELECT * FROM obra WHERE publicado=?", array("i"), array(1));

        if ($resultado == TRUE) {
            if (strlen($cadena) > 0) {

                $i = 0;
                while ($obra = $resultado->fetch_assoc()) {
                    if (stristr($obra['nombre'], $cadena)) {
                        $lastPos = 0;
                        $positions = array();
                        while (($lastPos = stripos($obra['nombre'], $cadena, $lastPos)) !== false) {
                            $positions[] = $lastPos;
                            $lastPos = $lastPos + strlen($cadena);
                        }

                        $j = 0;
                        $titulo='';
                        for ($j; $j < strlen($obra['nombre']); $j++) {
                            $k = 0;
                            $resaltar=false;
                            for ($k; $k < count($positions); $k++) {
                                if ($positions[$k] === $j) {
                                    $resaltar=true;
                                }
                            }
                            if ($resaltar) {

                                $subcadena = '';
                                $k=0;
                                for ($k=$j; $k < $j+strlen($cadena); $k++) {
                                    $subcadena = $subcadena.''.$obra['nombre'][$k];
                                }
                                $titulo = $titulo."<spam class='highlight'>". $subcadena ."</spam>";
                                $j = $j + strlen($cadena) - 1;
                            }
                            else {
                                $titulo = $titulo."".$obra['nombre'][$j];
                            }
                        }

                        if ($hint == "") {
                            $hint = "<a href='index.php?page=obra&obra=" . $obra['id'] . "'>" .
                                $titulo . "</a>";
                        } else {
                            $hint = $hint . "<br /><a href='index.php?page=obra&obra=" . $obra['id'] . "'>" .
                                $titulo . "</a>";
                        }
                    }
                    $i += 1;
                }
            }


        }
    }
}

if ($hint == "") {
    $response = "no suggestion";
} else {
    $response = $hint;
}

echo $response;
