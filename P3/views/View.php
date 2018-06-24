<?php

class View
{
    public function getHeadView()
    {
        ?>
        <head>
            <meta charset='UTF-8'>
            <title>Museo del Fútbol</title>
            <link rel='shortcut icon' href='img/favicon.ico'>

            <link href='https://fonts.googleapis.com/css?family=Molengo' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css?family=Graduate' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css?family=Hammersmith One' rel='stylesheet'>

            <link href='styles/style.css'
                  rel='stylesheet' type='text/css'>
        </head>
        <?php
    }

    public function getHeaderView($opcion = "index", $db)
    {
        ?>
        <!--CABECERA-->
        <div class='header-container'>
            <div class='fit-icon'>
                <div class='header-icon'>
                    <a href='index.php?page=index'>
                        <img class='logo' src='<?php echo $logo = $db->query("SELECT ruta FROM imagen WHERE tipo='logo'", array(), array())->fetch_assoc()["ruta"]; ?>'>
                    </a>
                </div>
            </div>
            <div class='header-title'>
                <div class='title'>
                    <h1>Museo del Futbol Español</h1>
                </div>
                <!--MENU-->
                <div class='header-menu'>
                    <nav>
                        <?php switch ($opcion) {
                            case "index":
                                ?>
                                <a href='index.php?page=index' class='header-menu active'>Inicio</a>
                                <a href='index.php?page=listacolecciones' class='header-menu'>Colecciones</a>
                                <a href='index.php?page=contacto' class='header-menu'>Contacto</a>
                                <?php
                                break;
                            case "colecciones":
                                ?>
                                <a href='index.php?page=index' class='header-menu'>Inicio</a>
                                <a href='index.php?page=listacolecciones' class='header-menu active'>Colecciones</a>
                                <a href='index.php?page=contacto' class='header-menu'>Contacto</a>
                                <?php
                                break;
                            case "contacto":
                                ?>
                                <a href='index.php?page=index' class='header-menu'>Inicio</a>
                                <a href='index.php?page=listacolecciones' class='header-menu'>Colecciones</a>
                                <a href='index.php?page=contacto' class='header-menu active'>Contacto</a>
                                <?php
                                break;
                            default:
                                ?>
                                <a href='index.php?page=index' class='header-menu active'>Inicio</a>
                                <a href='index.php?page=listacolecciones' class='header-menu'>Colecciones</a>
                                <a href='index.php?page=contacto' class='header-menu'>Contacto</a>
                                <?php
                                break;
                        } ?>
                    </nav>
                </div>
            </div>

        </div>
        <?php
    }

    public function getLinkContainerView()
    {
        echo "<!--ENLACES DE INTERES-->
            <div class='elements-container'>
                <div class='elements-menu'>
                    <div class='elements-title'>
                        <h2>Enlaces de Interés</h2>
                    </div>
            
                    <nav>
                        <ul>
                            <li><a href='http://www.laliga.es'>La Liga</a></li>
                            <li><a href='http://www.rfef.es'>RFEF</a></li>
                            <li><a href='https://es.uefa.com/index.html'>UEFA</a></li>
                            <li><a href='http://es.fifa.com/'>FIFA</a></li>
                        </ul>
            
                    </nav>
                </div>
            </div>";
    }

    public function getFooterView($id_obra, $db)
    {
        ?>
        <!--PIE DE PAGINA-->
        <div class='footer-container'>
            <div class='footer-redes'>
                <?php
                $facebook = $db->query("SELECT ruta FROM imagen WHERE tipo='facebook'", array(), array())->fetch_assoc()['ruta'];

                $twitter = $db->query("SELECT ruta FROM imagen WHERE tipo='twitter'", array(), array())->fetch_assoc()['ruta'];

                $google = $db->query("SELECT ruta FROM imagen WHERE tipo='google'", array(), array())->fetch_assoc()['ruta'];

                if ($id_obra < 0) {
                    ?>
                    <a href='http://www.facebook.com'><img class='icon-redes' src='<?php echo $facebook; ?>'></a>
                    <a href='http://www.twitter.com'><img class='icon-redes' src='<?php echo $twitter; ?>'></a>
                    <a href='http://plus.google.com'><img class='icon-redes' src='<?php echo $google; ?>'></a>
                <?php
                } else {
                ?>
                    <a class="myBtn" onclick='share("Facebook")'><img class='icon-redes' src='<?php echo $facebook; ?>'></a>
                    <a class="myBtn" onclick='share("Twitter")'><img class='icon-redes' src='<?php echo $twitter; ?>'></a>
                    <a class="myBtn" onclick='share("Google")'><img class='icon-redes' src='<?php echo $google; ?>'></a>
                    <script type='text/javascript' src='js/windowNetwork.js'></script>
                    <?php
                }
                ?>
            </div>
            <p> Copyright &copy; 2018 Ángel Robledillo Perea & Jorge Juan Ñíguez Fernandez </p>
        </div>
        <?php
    }

    public function generateEnlacesObras($db)
    {

        $resultado = $db->query("SELECT id, nombre FROM obra ORDER BY nombre", array(), array());
        if ($resultado != null && $resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i += 3) {
                echo "<div class='fila'>";
                $j = 0;
                while ($j < 3 && ($obra = $resultado->fetch_assoc())) {

                    $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
                    $imagen_obra = $imagen_obra->fetch_assoc();
                    echo "<div class='elemento-box'>
                        <div class='elemento'>
                            <div class='imagen-elemento'>
                                <a href='index.php?page=obra&obra=" . $obra['id'] . "'><img class='escudo-elemento' src='" . $imagen_obra['ruta'] . "'></a>
                            </div>
                            <div class='nombre-elemento'>
                                <p><a href='index.php?page=obra&obra=" . $obra['id'] . "'>" . $obra['nombre'] . "</a></p>
                            </div>
                        </div>
                    </div>";
                    $j++;
                }
                echo "</div>";
            }
        }
    }

    public function getIndexView($db)
    {
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php $this->getHeaderView("index", $db); ?>
        <div class='cuerpo-container'>
            <?php $this->getLinkContainerView(); ?>
            <!--OBRAS-->
            <div class='pictures-container'>

                <div class='pictures-title'>
                    <h2>Obras</h2>
                </div>
                <?php $this->generateEnlacesObras($db); ?>
            </div>
        </div>
        <?php $this->getFooterView(-1, $db); ?>
        </body>
        </html>
        <?php
    }

    public function getComentariosView($id_obra, $db)
    {

        $resultado = $db->query("SELECT * FROM comentario WHERE id_obra=? ORDER BY fecha DESC", array("i"), array($id_obra));
        $chat = $db->query("SELECT ruta FROM imagen WHERE tipo='chat'", array(), array())->fetch_assoc()['ruta'];
        $back = $db->query("SELECT ruta FROM imagen WHERE tipo='back'", array(), array())->fetch_assoc()['ruta'];
        ?>
        <!-- Sección de comentarios -->
        <div id='contenedor-comentarios'>
            <div class='imagen-comentarios'>
                <img id='icono-comentarios' src='<?php echo $chat ?>'>
            </div>
            <div id='comentarios'>
                <div class='elements-title'>
                    <div id='back-comentarios'>
                        <img onclick='hasClicked()' id='back-icon' src='<?php echo $back; ?>'>
                    </div>
                    <h2>Comentarios</h2>
                </div>
                <div id='comentarios-anteriores'>
                    <?php
                    if ($resultado == true) {
                        $i = 0;
                        while ($comentario = $resultado->fetch_assoc()) {
                            if ($i % 2 === 0) {
                                echo "<div class='comentario-usuario par'>";
                            } else {
                                echo "<div class='comentario-usuario impar'>";
                            }
                            echo "<div class='mensaje-user'>
                            <div class='user-img'>
                                <div class='nombre-usuario'>" . $comentario['Usuario'] . "</div>
                                <img src='img/user.png'>
                            </div>
                            <div class='texto-user'>
                                <p>
                                    " . $comentario['comentario'] . "
                                </p>
                            </div>
                        </div>

                        <span class='time-right'>" . $comentario['fecha'] . "</span>
                    </div>";

                            $i += 1;
                        }
                    }
                    ?>

                </div>
                <div class='send-message comentario-usuario'>
                    <form id='form-messages' method="post" action="index.php?page=obra&obra=<?php echo $id_obra; ?>">
                        <input id='input-nombre' type='text' name='firstname' placeholder='Nombre..' required/>
                        <input id='input-email' type='email' name='email' placeholder='Email..' required/>
                        <spam id='error-message-email' class="error-message"></spam>
                        <textarea id='input-comentario' name='comentario' placeholder='Escriba su comentario aqui...'
                                  onkeyup='reviser(false)' onfocus='clearError()'></textarea>
                        <spam id='error-message-comentario' class="error-message"></spam>
                        <!--<input id='input-send' type='submit' value='Enviar'/> -->
                        <input id='input-send' type='submit' value='Enviar' name="sendForm"/>
                    </form>

                </div>

            </div>
        </div>
        <script type='text/javascript' src='js/script-comments.js'></script>
        <?php
    }

    public function getWindowNetworkView($nombre_obra, $imagen)
    {
        ?>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Compartir...</h2>
                </div>
                <div class="modal-body">
                    <p>Se publicará en <span id="type_network"></span> el siguiente mensaje:</p>
                    <p>Obra: <?php echo $nombre_obra; ?></p>
                    <img src="<?php echo $imagen; ?>">
                    <p>Via @museodelfutbolespañol</p>
                    <input id='input-accept' type='submit' value='Aceptar'/>
                </div>
            </div>

        </div>

        <?php

    }

    public function getObraView($id_obra, $db)
    {
        $resultado = $db->query("SELECT * FROM obra WHERE id=?", array("i"), array($id_obra));
        if ($resultado != false) {
            $obra = $resultado->fetch_assoc();
            $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
            $escudo = $imagen_obra->fetch_assoc();
            $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='palmares'", array("i"), array($obra['id']));
            $palmares = $imagen_obra->fetch_assoc();
            $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadisticas'", array("i"), array($obra['id']));
            $estadisticas = $imagen_obra->fetch_assoc();
            $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadio'", array("i"), array($obra['id']));
            $estadio = $imagen_obra->fetch_assoc();
            $contenido_obra = $db->query("SELECT * FROM contenido WHERE id_obra=?", array("i"), array($obra['id']));
            $contenido = $contenido_obra->fetch_assoc();
            ?>
            <!DOCTYPE html>
            <html lang='en'>
            <?php $this->getHeadView(); ?>
            <body>
            <?php $this->getWindowNetworkView($contenido['nombre_obra'], $escudo['ruta']);
            $this->getHeaderView("index", $db); ?>
            <div class='cuerpo-container'>
                <?php $this->getLinkContainerView(); ?>
                <!--OBRA-->
                <div id='informacion'>
                    <div class='texto'>
                        <div class="cabecera">
                            <div class="titulo-articulo">
                                <p> <?php echo $contenido['nombre_obra']; ?> </p>
                                <p class="fecha"> Fecha Creación: <?php echo $contenido['fecha_creacion']; ?> </p>
                                <p class="fecha"> Fecha
                                    Modificación: <?php echo $contenido['fecha_modificacion']; ?> </p>
                            </div>
                            <div class="imprimir">
                                <a href="index.php?page=imprimir&obra=<?php echo $obra["id"]; ?>"><img
                                            src="<?php echo $db->query("SELECT ruta FROM imagen WHERE tipo='imprimir'", array(), array())->fetch_assoc()['ruta']; ?>"
                                            class="imprimir-boton"></a>
                            </div>
                        </div>

                        <div class="subtitulo-articulo">
                            <p>Historia</p>
                        </div>

                        <div class="cuerpo-articulo">
                            <p>
                            <div class="escudo-articulo">
                                <img class="imagen-articulo" src="<?php echo $escudo['ruta'] ?>">
                            </div>
                            <?php echo $contenido['historia_1']; ?>
                            </p>
                            <p>
                                <?php echo $contenido['historia_2']; ?>
                            </p>
                            <p>
                                <?php echo $contenido['historia_3']; ?>
                            </p>
                        </div>

                        <div class="subtitulo-articulo">
                            <p> <?php echo $contenido['estadio_1']; ?> </p>
                        </div>

                        <div class="cuerpo-articulo">
                            <p>
                                <?php echo $contenido['estadio_2']; ?>
                            </p>

                            <div class="imagen-info">
                                <img class="imagen-articulo" src="<?php echo $estadio['ruta'] ?>">
                            </div>

                            <p>
                                <?php echo $contenido['estadio_3']; ?>
                            </p>
                        </div>

                        <div class="subtitulo-articulo">
                            <p> Palmarés </p>
                        </div>
                        <div class="imagen-info">
                            <img class="imagen-articulo" src="<?php echo $palmares['ruta'] ?>">
                        </div>

                        <div class="subtitulo-articulo">
                            <p> Estadísticas </p>
                        </div>

                        <div class="imagen-info">
                            <img class="imagen-articulo" src="<?php echo $estadisticas['ruta'] ?>">
                        </div>
                    </div>
                </div>
                <?php $this->getComentariosView($id_obra, $db);
                $this->getFooterView($id_obra, $db); ?>
            </body>
            </html>
            <?php
        }
    }

    public function generateEnlacesObrasColeccion($selected_coleccion, $db)
    {

        $resultado = $db->query("SELECT id, nombre FROM obra WHERE id_coleccion=? ORDER BY nombre", array("i"), array($selected_coleccion));
        if ($resultado != null && $resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i += 3) {
                echo "<div class='fila'>";
                $j = 0;
                while ($j < 3 && ($obra = $resultado->fetch_assoc())) {

                    $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
                    $imagen_obra = $imagen_obra->fetch_assoc();
                    echo "<div class='elemento-box'>
                        <div class='elemento'>
                            <div class='imagen-elemento'>
                                <a href='index.php?page=obra&obra=" . $obra['id'] . "'><img class='escudo-elemento' src='" . $imagen_obra['ruta'] . "'></a>
                            </div>
                            <div class='nombre-elemento'>
                                <p><a href='index.php?page=obra&obra=" . $obra['id'] . "'>" . $obra['nombre'] . "</a></p>
                            </div>
                        </div>
                    </div>";
                    $j++;
                }
                echo "</div>";
            }
        }
    }

    public function getColeccionView($selected_coleccion, $db)
    {
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php $this->getHeaderView("colecciones", $db); ?>
        <div class='cuerpo-container'>
            <?php $this->getLinkContainerView(); ?>
            <!--OBRAS-->
            <div class='pictures-container'>

                <div class='pictures-title'>
                    <h2>Secciones</h2>
                </div>
                <?php $this->generateEnlacesObrasColeccion($selected_coleccion, $db); ?>
            </div>
        </div>
        <?php $this->getFooterView(-1, $db); ?>
        </body>
        </html>
        <?php
    }

    public function generateEnlacesColecciones($db)
    {
        $resultado = $db->query("SELECT id, id_imagen, comunidad FROM coleccion ORDER BY comunidad", array(), array());
        if ($resultado != null && $resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i += 3) {
                echo "<div class='fila'>";
                $j = 0;
                while ($j < 3 && ($coleccion = $resultado->fetch_assoc())) {

                    $imagen_coleccion = $db->query("SELECT ruta FROM imagen WHERE id=? AND tipo='coleccion'", array("i"), array($coleccion['id_imagen']));
                    $imagen_coleccion = $imagen_coleccion->fetch_assoc();
                    echo "<div class='elemento-box'>
                        <div class='elemento'>
                            <div class='imagen-elemento'>
                                <a href='index.php?page=coleccion&coleccion=" . $coleccion['id'] . "'><img class='escudo-elemento' src='" . $imagen_coleccion['ruta'] . "'></a>
                            </div>
                            <div class='nombre-elemento'>
                                <p><a href='index.php?page=coleccion&coleccion=" . $coleccion['id'] . "'>" . $coleccion['comunidad'] . "</a></p>
                            </div>
                        </div>
                    </div>";
                    $j++;
                }
                echo "</div>";
            }
        }
    }

    public function getListaColeccionesView($db)
    {
        ?>

        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php $this->getHeaderView("colecciones", $db); ?>
        <div class='cuerpo-container'>
            <?php $this->getLinkContainerView(); ?>
            <!--OBRAS-->
            <div class='pictures-container'>

                <div class='pictures-title'>
                    <h2>Colecciones</h2>
                </div>
                <?php $this->generateEnlacesColecciones($db); ?>
            </div>
        </div>
        <?php $this->getFooterView(-1, $db); ?>
        </body>
        </html>
        <?php
    }

public
function getImprimirView($id_obra, $db)
{
    $resultado = $db->query("SELECT * FROM obra WHERE id=?", array("i"), array($id_obra));
if ($resultado != false)
{
    $obra = $resultado->fetch_assoc();
    $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
    $escudo = $imagen_obra->fetch_assoc();
    $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='palmares'", array("i"), array($obra['id']));
    $palmares = $imagen_obra->fetch_assoc();
    $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadisticas'", array("i"), array($obra['id']));
    $estadisticas = $imagen_obra->fetch_assoc();
    $imagen_obra = $db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadio'", array("i"), array($obra['id']));
    $estadio = $imagen_obra->fetch_assoc();
    $contenido_obra = $db->query("SELECT * FROM contenido WHERE id_obra=?", array("i"), array($obra['id']));
    $contenido = $contenido_obra->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang='en'>
    <?php $this->getHeadView(); ?>
    <body>
    <div class="texto-imprimir">
        <div class="header-imprimir">
            <div class="header-icon">
                <img class="logo" src="img/RFEF_logo.png">
            </div>
            <div class="title-imprimir">
                <h1>Museo del Futbol Español</h1>
            </div>
        </div>
        <div class="titulo-articulo-imprimir">
            <p> <?php echo $contenido['nombre_obra'] ?> </p>
            <p class="fecha-imprimir"> Fecha Creación: <?php echo $contenido['fecha_creacion']; ?> </p>
            <p class="fecha-imprimir"> Fecha Modificación: <?php echo $contenido['fecha_modificacion']; ?> </p>
        </div>

        <div class="escudo-imprimir">
            <img class="imagen-articulo" src="<?php echo $escudo['ruta'] ?>">
        </div>

        <div class="subtitulo-articulo-imprimir">
            <p> Historia </p>
        </div>

        <div class="cuerpo-articulo-imprimir">
            <p>
                <?php echo $contenido['historia_1'] ?>
            </p>
            <p>
                <?php echo $contenido['historia_2'] ?>
            </p>
            <p>
                <?php echo $contenido['historia_3'] ?>
            </p>
        </div>

        <div class="subtitulo-articulo-imprimir">
            <p> <?php echo $contenido['estadio_1'] ?> </p>
        </div>

        <div class="cuerpo-articulo-imprimir">
            <p>
                <?php echo $contenido['estadio_2'] ?>
            </p>

            <div class="imagen-info">
                <img class="imagen-articulo" src="<?php echo $estadio['ruta'] ?>">
            </div>

            <p>
                <?php echo $contenido['estadio_3'] ?>
            </p>
        </div>

        <div class="subtitulo-articulo-imprimir">
            <p> Palmarés </p>
        </div>
        <div class="imagen-info">
            <img class="imagen-articulo" src="<?php echo $palmares['ruta'] ?>">
        </div>

        <div class="subtitulo-articulo-imprimir">
            <p> Estadísticas </p>
        </div>

        <div class="imagen-info">
            <img class="imagen-articulo" src="<?php echo $estadisticas['ruta'] ?>">
        </div>
    </div>
    </body>
    <?php
    }
    }

    public function getContactoView($db) {
    $resultado = $db->query("SELECT correo, direccion, telefono FROM informacion", array(), array());
    $resultado = $resultado->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang='en'>
    <?php $this->getHeadView(); ?>
    <body>
    <?php $this->getHeaderView("contacto", $db); ?>
    <div class='cuerpo-container'>
        <?php $this->getLinkContainerView(); ?>
        <!--OBRAS-->
        <div class='pictures-container'>

            <div class='pictures-title'>
                <h2>Contacto</h2>
            </div>
            <div class="contacto">
                <h2>Direccion</h2>
                <p> <?php echo $resultado["direccion"]; ?></p>
                <h2>Correo</h2>
                <?php echo $resultado["correo"]; ?>
                <h2>Telefono</h2>
                <?php echo $resultado["telefono"]; ?>
            </div>
        </div>
    </div>
    <?php $this->getFooterView(-1, $db); ?>
    </body>
    </html>
    <?php
}
}