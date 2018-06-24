<?php

//Asignar roles
if (isset($_POST['usuarioPermiso'])) {

    if (isset($_POST['selectPermiso']) && isset($_POST['usuarioPermiso'])) {
        if (!empty($_POST["selectPermiso"]) && !empty($_POST["usuarioPermiso"])) {
            if ($_POST["selectPermiso"] != "superusuario") {

                $state = $database->query("SELECT id FROM permiso WHERE tipo='superusuario'", array(), array());
                if ($state != FALSE && $database->affected_rows() > 0) {
                    $permiso = $state->fetch_assoc();
                    $permisoSuperusuario = $permiso['id'];
                    $state = $database->query('SELECT id FROM usuario WHERE id_permiso=?', array("s"), array($permiso['id']));

                    if ($state != FALSE && $database->affected_rows() > 1) {
                        $state = $database->query('SELECT id FROM permiso WHERE tipo=?', array("s"), array($_POST["selectPermiso"]));
                        if ($state) {
                            $permiso = $state->fetch_assoc();
                            $state = $database->query('UPDATE usuario SET id_permiso=? WHERE nombre_usuario=?', array("i", "s"), array($permiso["id"], $_POST["usuarioPermiso"]));
                        }
                    } else if ($state != FALSE && $database->affected_rows() === 1) {

                        $state = $database->query('SELECT id_permiso FROM usuario WHERE nombre_usuario=?', array("s"), array($_POST['usuarioPermiso']));

                        if ($state != FALSE && $database->affected_rows() > 0) {

                            $permisoActualUsuario = $state->fetch_assoc();
                            $permisoActualUsuario = $permisoActualUsuario['id_permiso'];
                            if ($permisoActualUsuario != $permisoSuperusuario) {
                                $state = $database->query('SELECT id FROM permiso WHERE tipo=?', array("s"), array($_POST["selectPermiso"]));
                                if ($state != FALSE && $database->affected_rows() > 0) {
                                    $permiso = $state->fetch_assoc();
                                    $state = $database->query('UPDATE usuario SET id_permiso=? WHERE nombre_usuario=?', array("i", "s"), array($permiso["id"], $_POST["usuarioPermiso"]));
                                }
                            }
                        }


                    }
                }


            } else {
                $state = $database->query('SELECT id FROM permiso WHERE tipo=?', array("s"), array($_POST["selectPermiso"]));
                if ($state) {
                    $permiso = $state->fetch_assoc();
                    $state = $database->query('UPDATE usuario SET id_permiso=? WHERE nombre_usuario=?', array("i", "s"), array($permiso["id"], $_POST["usuarioPermiso"]));
                }
            }
        }
    }
}

//Modificar Obra

if (isset($_POST['send-EditarObra'])) {

    if (isset($_POST['idObra']) && isset($_POST['input-nombre']) && isset($_POST['input-imagen']) && isset($_POST['input-historia1']) && isset($_POST['input-historia2'])
        && isset($_POST['input-historia3']) && isset($_POST['input-estadio1']) && isset($_POST['input-estadio2']) && isset($_POST['input-estadio3'])) {
        if (!empty($_POST['idObra']) && !empty($_POST['input-nombre']) && !empty($_POST['input-imagen']) && !empty($_POST['input-historia1']) && !empty($_POST['input-historia2'])
            && !empty($_POST['input-historia3']) && !empty($_POST['input-estadio1']) && !empty($_POST['input-estadio2']) && !empty($_POST['input-estadio3'])) {

            $state = $database->query('UPDATE obra SET nombre=? WHERE id=?', array("s", "i"), array($_POST['input-nombre'], $_POST['idObra']));
            $timestamp = date('Y-m-d G:i:s');
            $state = $database->query('UPDATE contenido SET nombre_obra=?, historia_1=?, historia_2=?, historia_3=?, estadio_1=?, estadio_2=?, estadio_3=?, fecha_modificacion=? WHERE id_obra=?', array("s", "s", "s", "s", "s", "s", "s", "s", "i"), array($_POST['input-nombre'], $_POST['input-historia1'], $_POST['input-historia2'], $_POST['input-historia3'], $_POST['input-estadio1'], $_POST['input-estadio2'], $_POST['input-estadio3'], $timestamp, $_POST['idObra']));
            $state = $database->query("UPDATE imagen SET ruta=? WHERE id_obra=? AND tipo='escudo'", array("s", "i"), array($_POST['input-imagen'], $_POST['idObra']));
        }
    }
}

//Añadir una obra

if (isset($_POST['send-AniadirObra'])) {

    if (isset($_POST['input-nombre']) && isset($_POST['input-imagen']) && isset($_POST['input-historia1']) && isset($_POST['input-historia2'])
        && isset($_POST['input-historia3']) && isset($_POST['input-estadio1']) && isset($_POST['input-estadio2']) && isset($_POST['input-estadio3'])) {
        if (!empty($_POST['input-nombre']) && !empty($_POST['input-imagen']) && !empty($_POST['input-historia1']) && !empty($_POST['input-historia2'])
            && !empty($_POST['input-historia3']) && !empty($_POST['input-estadio1']) && !empty($_POST['input-estadio2']) && !empty($_POST['input-estadio3'])) {

            $state = $database->query('INSERT INTO obra (nombre) VALUES (?)', array("s"), array($_POST['input-nombre']));

            $state = $database->query('SELECT id FROM obra WHERE nombre=?', array("s"), array($_POST['input-nombre']));


            if ($state != FALSE && $database->affected_rows() > 0) {
                $id_obra = $state->fetch_assoc();
                $timestamp = date('Y-m-d G:i:s');
                $state = $database->query('INSERT INTO contenido (id_obra, nombre_obra, historia_1, historia_2, historia_3, estadio_1, estadio_2, estadio_3, fecha_modificacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', array("i", "s", "s", "s", "s", "s", "s", "s", "s"), array($id_obra['id'], $_POST['input-nombre'], $_POST['input-historia1'], $_POST['input-historia2'], $_POST['input-historia3'], $_POST['input-estadio1'], $_POST['input-estadio2'], $_POST['input-estadio3'], $timestamp));


                $state = $database->query("INSERT INTO imagen (id_obra, ruta, tipo) VALUES (?, ?, 'escudo')", array("i", "s"), array($id_obra['id'], $_POST['input-imagen']));

            }
        }
    }
}

//Eliminar Obra

if (isset($_POST['send-EliminarObra'])) {

    if (isset($_POST['idObra'])) {
        if (!empty($_POST['idObra'])) {

            $state = $database->query('DELETE FROM contenido WHERE id_obra=?', array("i"), array($_POST['idObra']));
            $state = $database->query('DELETE FROM imagen WHERE id_obra=?', array("i"), array($_POST['idObra']));
            $state = $database->query('DELETE FROM obra WHERE id=?', array("i"), array($_POST['idObra']));
        }
    }
}

//Modificar Comentario

if (isset($_POST['send-EditarComentario'])) {

    if (isset($_POST['idComentario']) && isset($_POST['input-comentario'])) {
        if (!empty($_POST['idComentario']) && !empty($_POST['input-comentario'])) {

            $comentario = $_POST['input-comentario'];
            $state = $database->query('UPDATE comentario SET comentario=?, modificado=? WHERE id=?', array("s", "i", "i"), array($comentario, TRUE, $_POST['idComentario']));
        }
    }
}

//Eliminar Comentario

if (isset($_POST['send-EliminarComentario'])) {

    if (isset($_POST['idComentario'])) {
        if (!empty($_POST['idComentario'])) {

            $state = $database->query('DELETE FROM comentario WHERE id=?', array("i"), array($_POST['idComentario']));
        }
    }
}