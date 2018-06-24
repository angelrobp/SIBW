<?php

class View
{
    private $usuario;
    private $db;

    public function View($aUsuario = "anonimo", $aDb = "")
    {
        $this->usuario = $aUsuario;
        $this->db = $aDb;
    }

    public function getHeadView()
    {
        ?>
        <head>
            <meta charset='UTF-8'>
            <title>Museo del Fútbol</title>
            <link rel='shortcut icon' href='img/favicon.ico'>

            <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <link href='https://fonts.googleapis.com/css?family=Molengo' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css?family=Graduate' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css?family=Hammersmith One' rel='stylesheet'>

            <link href='styles/style.css'
                  rel='stylesheet' type='text/css'>
        </head>
        <?php
    }

    public function getHeaderView($opcion = "index")
    {
        ?>
        <!--CABECERA-->
        <div class='header-container'>
            <div class='fit-icon'>
                <div class='header-icon'>
                    <a href='index.php?page=index'>
                        <img class='logo'
                             src='<?php echo $logo = $this->db->query("SELECT ruta FROM imagen WHERE tipo='logo'", array(), array())->fetch_assoc()["ruta"]; ?>'>
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
                        }
                        if ($this->usuario->isConectado() === FALSE) {

                            ?>
                            <a class='header-menu myBtn' onclick="singInUp()">Entrar</a>
                            <?php
                        } else {
                            ?>
                            <div class="dropdown">
                                <button class="dropbtn" onclick="myFunction()">Perfil
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-content" id="myDropdown">
                                    <a href="index.php?page=perfil">Mi Perfil</a>
                                    <a href="index.php?page=index&logout=TRUE">Cerrar Sesión</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </nav>
                </div>
            </div>

        </div>
        <script type='text/javascript' src='js/dropdown.js'></script>
        <script type='text/javascript' src='js/windowSingInUp.js'></script>


        <?php
        if ($this->usuario->getPermiso() === "superusuario" || $this->usuario->getPermiso() === "moderador" || $this->usuario->getPermiso() === "gestor") {
            $this->getControlPanel();
        }

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

    public function getFooterView($id_obra)
    {
        ?>
        <!--PIE DE PAGINA-->
        <div class='footer-container'>
            <div class='footer-redes'>
                <?php
                $facebook = $this->db->query("SELECT ruta FROM imagen WHERE tipo='facebook'", array(), array())->fetch_assoc()['ruta'];

                $twitter = $this->db->query("SELECT ruta FROM imagen WHERE tipo='twitter'", array(), array())->fetch_assoc()['ruta'];

                $google = $this->db->query("SELECT ruta FROM imagen WHERE tipo='google'", array(), array())->fetch_assoc()['ruta'];

                if ($id_obra < 0) {
                    ?>
                    <a href='http://www.facebook.com'><img class='icon-redes' src='<?php echo $facebook; ?>'></a>
                    <a href='http://www.twitter.com'><img class='icon-redes' src='<?php echo $twitter; ?>'></a>
                    <a href='http://plus.google.com'><img class='icon-redes' src='<?php echo $google; ?>'></a>
                <?php
                } else {
                ?>
                    <a class="myBtn" onclick='share("Facebook")'><img class='icon-redes' src='<?php echo $facebook; ?>'></a>
                    <a class="myBtn" onclick='share("Twitter")'><img class='icon-redes'
                                                                     src='<?php echo $twitter; ?>'></a>
                    <a class="myBtn" onclick='share("Google")'><img class='icon-redes' src='<?php echo $google; ?>'></a>
                    <script type='text/javascript' src='js/windowNetwork.js'></script>
                    <?php
                }
                ?>
            </div>
            <p> Copyright &copy; 2018 Ángel Robledillo Perea & Jorge Juan Ñíguez Fernandez </p>
        </div>
        <script type='text/javascript' src='js/script-general.js'></script>
        <?php
    }

    public function generateEnlacesObras()
    {

        $resultado = $this->db->query("SELECT id, nombre FROM obra ORDER BY nombre", array(), array());
        if ($resultado != FALSE && $resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i += 3) {
                echo "<div class='fila'>";
                $j = 0;
                while ($j < 3 && ($obra = $resultado->fetch_assoc())) {

                    $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
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

    public function getIndexView()
    {
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php
        $this->getWindowLogIn();
        $this->getHeaderView("index"); ?>
        <div class='cuerpo-container'>
            <?php $this->getLinkContainerView(); ?>
            <!--OBRAS-->
            <div class='pictures-container'>

                <div class='pictures-title'>
                    <h2>Obras</h2>
                </div>
                <?php $this->generateEnlacesObras(); ?>
            </div>
        </div>
        <?php $this->getFooterView(-1); ?>
        </body>
        </html>
        <?php
    }

    public function getComentariosView($id_obra)
    {

        $resultado = $this->db->query("SELECT * FROM comentario WHERE id_obra=? ORDER BY fecha DESC", array("i"), array($id_obra));
        $chat = $this->db->query("SELECT ruta FROM imagen WHERE tipo='chat'", array(), array())->fetch_assoc()['ruta'];
        $back = $this->db->query("SELECT ruta FROM imagen WHERE tipo='back'", array(), array())->fetch_assoc()['ruta'];
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
                    if ($resultado == TRUE) {
                    $i = 0;
                    while ($comentario = $resultado->fetch_assoc()) {
                    if ($i % 2 === 0) {
                        echo "<div class='comentario-usuario par'>";
                    } else {
                        echo "<div class='comentario-usuario impar'>";
                    }
                    ?>
                    <div class='mensaje-user'>
                        <div class='user-img'>
                            <div class='nombre-usuario'><?php echo $comentario['usuario']; ?></div>
                            <img src='img/user.png'>
                        </div>
                        <div class='texto-user'>
                            <p>
                                <?php if ($comentario['modificado']) {
                                    echo $comentario['comentario']."<p>(Modificado por el moderador)</p>";
                                }
                                else {
                                    echo $comentario['comentario'];
                                }?>
                            </p>
                        </div>
                    </div>

                    <span class='time-right'> <?php echo $comentario['fecha']; ?> </span>
                </div>
                <?php

                $i += 1;
                }
                }
                ?>

            </div>

            <div class='send-message comentario-usuario'>
                <?php
                if ($this->usuario->getPermiso() == "registrado") {
                    ?>
                    <form id='form-messages' method="post"
                          action="index.php?page=obra&obra=<?php echo $id_obra; ?>">
                        <!--

                            <input id='input-email' type='email' name='email' placeholder='Email..' required/>
                            <spam id='error-message-email' class="error-message"></spam>
                            <input type='hidden' name='firstname' value="<?php echo $this->usuario->getNombreUsuario(); ?>"/>-->
                        <textarea id='input-comentario' name='comentario'
                                  placeholder='Escriba su comentario aqui...'
                                  onkeyup='reviser(false)' onfocus='clearError()'></textarea>
                        <spam id='error-message-comentario' class="error-message"></spam>
                        <!--<input id='input-send' type='submit' value='Enviar'/> -->
                        <input id='input-send' type='submit' value='Enviar' name="sendForm"/>
                    </form>
                    <script type='text/javascript' src='js/script-comments.js'></script>
                <?php
                }
                else {
                ?>
                    <p>Debes ser un usuario registrado para poder comentar</p>

                    <?php
                }
                ?>
            </div>
        </div>
        </div>
        <script type='text/javascript' src='js/window-comments.js'></script>
        <?php
    }

    public function getWindowNetworkView($nombre_obra, $imagen)
    {
        ?>
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

    public function getWindowLogIn()
    {
        ?>
        <div id="id01" class="modal-sing">
            <span class="close-sign" title="Close Modal">&times;</span>
            <div class="tab modal-sign-content">
                <button class="tablinks" onclick="openTab(event, 'formSingIn')" id="defaultOpen">Iniciar Sesión</button>
                <button class="tablinks" onclick="openTab(event, 'formSingUp')">Registrarse</button>

                <form id="formSingIn" class="tabcontent" method="post" action="index.php">
                    <div class="container-sign">
                        <h1>Iniciar Sesión</h1>
                        <p>Indique sus datos de inicio de sesión</p>
                        <hr>

                        <label for="usuario"><b>Usuario</b></label>
                        <input type="text" placeholder="Introduce Usuario" name="usuarioSingIn" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="pswSingIn" required>

                        <label>
                            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
                            Remember me
                        </label>

                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                    class="cancelbtn-sign">Cancel
                            </button>
                            <button type="submit" class="send-signin" name="send-signin">Conectar</button>
                        </div>
                    </div>
                </form>
                <form id="formSingUp" class="tabcontent" method="post" action="index.php">
                    <div class="container-sign">
                        <h1>Registrarse</h1>
                        <p>Por favor, rellene las siguientes casillas para registrarse</p>
                        <hr>

                        <label for="nombre"><b>Nombre Real</b></label>
                        <input type="text" placeholder="Introduce Nombre" name="nombreSingUp" required>

                        <label for="usuario"><b>Usuario</b></label>
                        <input type="text" placeholder="Introduce Usuario" name="usuarioSingUp" required>

                        <label for="email"><b>Email</b></label>
                        <input id="input-email" type="text" placeholder="Introduce Email" name="emailSingUp" required>
                        <spam id='error-message-email' class="error-message"></spam>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="pswSingUp" required>

                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

                        <label>
                            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
                            Remember me
                        </label>

                        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms &
                                Privacy</a>.</p>

                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                    class="cancelbtn-sign">Cancel
                            </button>
                            <button type="submit" class="send-signup" name="send-signup">Registrarse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type='text/javascript' src='js/tabs.js'></script>
        <script type='text/javascript' src='js/filter-form-sign.js'></script>
        <?php

    }

    public function getObraView($id_obra)
    {
        $resultado = $this->db->query("SELECT * FROM obra WHERE id=?", array("i"), array($id_obra));
        if ($resultado != FALSE) {
            $obra = $resultado->fetch_assoc();
            $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
            $escudo = $imagen_obra->fetch_assoc();
            $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='palmares'", array("i"), array($obra['id']));
            $palmares = $imagen_obra->fetch_assoc();
            $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadisticas'", array("i"), array($obra['id']));
            $estadisticas = $imagen_obra->fetch_assoc();
            $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadio'", array("i"), array($obra['id']));
            $estadio = $imagen_obra->fetch_assoc();
            $contenido_obra = $this->db->query("SELECT * FROM contenido WHERE id_obra=?", array("i"), array($obra['id']));
            $contenido = $contenido_obra->fetch_assoc();
            ?>
            <!DOCTYPE html>
            <html lang='en'>
            <?php $this->getHeadView(); ?>
            <body>
            <?php
            $this->getWindowLogIn();
            $this->getWindowNetworkView($contenido['nombre_obra'], $escudo['ruta']);
            $this->getHeaderView("index"); ?>
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
                                            src="<?php echo $this->db->query("SELECT ruta FROM imagen WHERE tipo='imprimir'", array(), array())->fetch_assoc()['ruta']; ?>"
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
                <?php $this->getComentariosView($id_obra);
                $this->getFooterView($id_obra); ?>
            </body>
            </html>
            <?php
        }
    }

    public function generateEnlacesObrasColeccion($selected_coleccion)
    {

        $resultado = $this->db->query("SELECT id, nombre FROM obra WHERE id_coleccion=? ORDER BY nombre", array("i"), array($selected_coleccion));
        if ($resultado != FALSE && $resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i += 3) {
                echo "<div class='fila'>";
                $j = 0;
                while ($j < 3 && ($obra = $resultado->fetch_assoc())) {

                    $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
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

    public function getColeccionView($selected_coleccion)
    {
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php
        $this->getWindowLogIn();
        $this->getHeaderView("colecciones"); ?>
        <div class='cuerpo-container'>
            <?php $this->getLinkContainerView(); ?>
            <!--OBRAS-->
            <div class='pictures-container'>

                <div class='pictures-title'>
                    <h2>Secciones</h2>
                </div>
                <?php $this->generateEnlacesObrasColeccion($selected_coleccion); ?>
            </div>
        </div>
        <?php $this->getFooterView(-1); ?>
        </body>
        </html>
        <?php
    }

    public function generateEnlacesColecciones()
    {
        $resultado = $this->db->query("SELECT id, id_imagen, comunidad FROM coleccion ORDER BY comunidad", array(), array());
        if ($resultado != FALSE && $resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i += 3) {
                echo "<div class='fila'>";
                $j = 0;
                while ($j < 3 && ($coleccion = $resultado->fetch_assoc())) {

                    $imagen_coleccion = $this->db->query("SELECT ruta FROM imagen WHERE id=? AND tipo='coleccion'", array("i"), array($coleccion['id_imagen']));
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

    public function getListaColeccionesView()
    {
        ?>

        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php
        $this->getWindowLogIn();
        $this->getHeaderView("colecciones"); ?>
        <div class='cuerpo-container'>
            <?php $this->getLinkContainerView(); ?>
            <!--OBRAS-->
            <div class='pictures-container'>

                <div class='pictures-title'>
                    <h2>Colecciones</h2>
                </div>
                <?php $this->generateEnlacesColecciones(); ?>
            </div>
        </div>
        <?php $this->getFooterView(-1); ?>
        </body>
        </html>
        <?php
    }

public function getImprimirView($id_obra)
{
    $resultado = $this->db->query("SELECT * FROM obra WHERE id=?", array("i"), array($id_obra));
if ($resultado != FALSE)
{
    $obra = $resultado->fetch_assoc();
    $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($obra['id']));
    $escudo = $imagen_obra->fetch_assoc();
    $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='palmares'", array("i"), array($obra['id']));
    $palmares = $imagen_obra->fetch_assoc();
    $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadisticas'", array("i"), array($obra['id']));
    $estadisticas = $imagen_obra->fetch_assoc();
    $imagen_obra = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='estadio'", array("i"), array($obra['id']));
    $estadio = $imagen_obra->fetch_assoc();
    $contenido_obra = $this->db->query("SELECT * FROM contenido WHERE id_obra=?", array("i"), array($obra['id']));
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

    public function getContactoView()
    {
        $resultado = $this->db->query("SELECT correo, direccion, telefono FROM informacion", array(), array());
        $resultado = $resultado->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php
        $this->getWindowLogIn();
        $this->getHeaderView("contacto"); ?>
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
        <?php $this->getFooterView(-1); ?>
        </body>
        </html>
        <?php
    }

    public function getPerfilView()
    {
        $resultado = $this->db->query("SELECT correo, direccion, telefono FROM informacion", array(), array());
        $resultado = $resultado->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <?php $this->getHeadView(); ?>
        <body>
        <?php
        $this->getWindowLogIn();
        $this->getHeaderView("contacto"); ?>
        <div class='cuerpo-container'>
            <?php $this->getLinkContainerView(); ?>
            <!--OBRAS-->
            <div class='pictures-container'>

                <div class='pictures-title'>
                    <h2>Datos Personales</h2>
                </div>
                <div>
                    <form id='form-edit' method="post" action="index.php?page=perfil">
                        <label for="nombre"><b>Nombre</b></label>
                        <input type="text" value="<?php echo $this->usuario->getNombre(); ?>" name="nombreEdit"
                               required>
                        <label for="email"><b>Email</b></label>
                        <input type="text" value="<?php echo $this->usuario->getEmail(); ?>" name="emailEdit" required>
                        <label for="psw"><b>Contraseña</b></label>
                        <input type="password" placeholder="Introduce nueva contraseña" name="pswEdit" required>

                        <button type="submit" class="send-edit" name="send-edit">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->getFooterView(-1); ?>
        </body>
        </html>
        <?php
    }

    public function getControlPanel()
    {

    $chat = $this->db->query("SELECT ruta FROM imagen WHERE tipo='controlpanel'", array(), array())->fetch_assoc()['ruta'];
    $back = $this->db->query("SELECT ruta FROM imagen WHERE tipo='back'", array(), array())->fetch_assoc()['ruta'];
    ?>

    <div id='contenedor-controlpanel'>
        <div class='imagen-controlpanel'>
            <img id='icono-controlpanel' src='<?php echo $chat ?>'>
        </div>
        <div id='controlpanel'>
            <div class='elements-title'>
                <div id='back-controlpanel'>
                    <img onclick='hasClickedPanelControl()' id='back-icon-controlpanel' src='<?php echo $back; ?>'>
                </div>
                <h2>Panel de Control</h2>
            </div>
            <div class="tab modal-sign-content">
                <?php
                if ($this->usuario->getPermiso() === "superusuario") {
                    ?>
                    <button class="tablinks" onclick="openTabControlPanel(event, 'asignarEliminarPermiso')"
                            id="defaultOpenControlPanel">Asignar/Eliminar Permisos
                    </button>
                    <button class="tablinks" onclick="openTabControlPanel(event, 'editarObras')">Editar Obras</button>
                    <button class="tablinks" onclick="openTabControlPanel(event, 'aniadirObras')">Añadir Obras</button>
                    <button class="tablinks" onclick="openTabControlPanel(event, 'editarComentarios')">Editar
                        Comentarios
                    </button>
                    <?php
                } else if ($this->usuario->getPermiso() === "gestor") {
                    ?>
                    <button class="tablinks" onclick="openTabControlPanel(event, 'editarObras')"
                            id="defaultOpenControlPanel">Editar Obras
                    </button>
                    <button class="tablinks" onclick="openTabControlPanel(event, 'aniadirObras')">Añadir Obras</button>
                    <?php
                } else if ($this->usuario->getPermiso() === "moderador") {
                    ?>
                    <button class="tablinks" onclick="openTabControlPanel(event, 'editarComentarios')"
                            id="defaultOpenControlPanel">Editar
                        Comentarios
                    </button>
                    <?php
                }
                ?>
                <!--ASIGNAR ELIMINAR PERMISO-->
                <div id="asignarEliminarPermiso" class="opcion tabcontent">
                    <div>
                        <table>
                            <tr class="tituloTabla">
                                <th>Usuarios</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tablaUsuarios">
                                        <table>
                                            <?php
                                            $resultado = $this->db->query('SELECT nombre_usuario, id_permiso FROM usuario', array(), array());

                                            if ($resultado != FALSE && $resultado->num_rows > 0) {

                                                for ($i = 0; $i < $resultado->num_rows; $i += 1) {
                                                    $nombresDeUsuarios = $resultado->fetch_assoc();
                                                    $permiso = $this->db->query('SELECT tipo FROM permiso WHERE id=?', array("i"), array($nombresDeUsuarios['id_permiso']));
                                                    if ($permiso != FALSE && $permiso->num_rows > 0) {
                                                        $permisoUsuario = $permiso->fetch_assoc();
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <a onclick="setOpcionesPermisos('<?php echo $permisoUsuario['tipo']; ?>|<?php echo $nombresDeUsuarios['nombre_usuario']; ?>')"><?php echo $nombresDeUsuarios['nombre_usuario']; ?></a>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="panelDerecha">
                        <form name="addremovepermiso" method="post">
                            <select id="selectPermiso" name="selectPermiso">
                                <?php
                                $resultado = $this->db->query('SELECT tipo FROM permiso', array(), array());

                                if ($resultado != FALSE && $resultado->num_rows > 0) {

                                    for ($i = 0; $i < $resultado->num_rows; $i += 1) {
                                        $permisoUsuario = $resultado->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $permisoUsuario['tipo']; ?>"><?php echo $permisoUsuario['tipo']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" id="usuarioPermiso" name="usuarioPermiso" value=""/>
                            <div class="clearfix">
                                <button type="submit" class="send-signup" name="send-Permiso">Modificar</button>
                            </div>
                        </form>

                    </div>
                </div>

                <!--EDITAR ELIMINAR OBRAS-->
                <div id="editarObras" class="opcion tabcontent">
                    <div style="padding:1%;">
                        <table>
                            <tr class="tituloTabla">
                                <th>Obras</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tablaUsuarios">
                                        <table>
                                            <?php
                                            $resultado = $this->db->query('SELECT id FROM obra', array(), array());

                                            if ($resultado != FALSE && $resultado->num_rows > 0) {

                                                for ($i = 0; $i < $resultado->num_rows; $i += 1) {
                                                    $nombresDeObras = $resultado->fetch_assoc();
                                                    $contenido = $this->db->query('SELECT nombre_obra, historia_1, historia_2, historia_3, estadio_1, estadio_2, estadio_3 FROM contenido WHERE id_obra=?', array("i"), array($nombresDeObras['id']));

                                                    if ($contenido != FALSE && $contenido->num_rows > 0) {
                                                        $contenidoObra = $contenido->fetch_assoc();
                                                        $imagen = $this->db->query("SELECT ruta FROM imagen WHERE id_obra=? AND tipo='escudo'", array("i"), array($nombresDeObras['id']));

                                                        if ($imagen != FALSE && $imagen->num_rows > 0) {
                                                            $imagenObra = $imagen->fetch_assoc();
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a onclick="setOpcionesObras('informacionObraSeleccionada<?php echo $nombresDeObras['id']; ?>')">
                                                                        <?php echo $contenidoObra['nombre_obra']; ?>
                                                                    </a>
                                                                    <textarea
                                                                            id='informacionObraSeleccionada<?php echo $nombresDeObras['id']; ?>'
                                                                            style="display:none;"><?php echo $nombresDeObras['id']; ?>
                                                                        |<?php echo $imagenObra['ruta']; ?>
                                                                        |<?php echo $contenidoObra['nombre_obra']; ?>
                                                                        |<?php echo $contenidoObra['historia_1']; ?>
                                                                        |<?php echo $contenidoObra['historia_2']; ?>
                                                                        |<?php echo $contenidoObra['historia_3']; ?>
                                                                        |<?php echo $contenidoObra['estadio_1']; ?>
                                                                        |<?php echo $contenidoObra['estadio_2']; ?>
                                                                        |<?php echo $contenidoObra['estadio_3']; ?></textarea>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="panelDerecha">
                        <form name="editarObra" method="post">
                            <label for="obra"><b>Nombre Obra</b></label>
                            <input id="input-nombre" type="text" value="" name="input-nombre" required>
                            <label for="obra"><b>Imagen Obra</b></label>
                            <input id="input-imagen" type="text" value="" name="input-imagen" required>
                            <label for="obra"><b>Sección 1: Historia</b></label>
                            <textarea id='input-historia1' name='input-historia1' required></textarea>
                            <label for="obra"><b>Sección 2: Historia</b></label>
                            <textarea id='input-historia2' name='input-historia2' required></textarea>
                            <label for="obra"><b>Sección 3: Historia</b></label>
                            <textarea id='input-historia3' name='input-historia3' required></textarea>
                            <label for="obra"><b>Sección 1: Información Estadio</b></label>
                            <textarea id='input-estadio1' name='input-estadio1' required></textarea>
                            <label for="obra"><b>Sección 2: Información Estadio</b></label>
                            <textarea id='input-estadio2' name='input-estadio2' required></textarea>
                            <label for="obra"><b>Sección 3: Información Estadio</b></label>
                            <textarea id='input-estadio3' name='input-estadio3' required></textarea>
                            <input type="hidden" id="idObra" name="idObra" value=""/>
                            <div class="clearfix">
                                <button type="submit" class="cancelbtn-sign" name="send-EliminarObra">Eliminar</button>
                                <button type="submit" class="send-signup" name="send-EditarObra">Modificar</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!--AÑADIR OBRAS-->
                <div id="aniadirObras" class="opcion tabcontent">

                    <div>
                        <form name="editarObra" method="post">
                            <label for="obra"><b>Nombre Obra</b></label>
                            <input type="text" value="" name="input-nombre" required>
                            <label for="obra"><b>Imagen Obra</b></label>
                            <input type="text" value="" name="input-imagen" required>
                            <label for="obra"><b>Sección 1: Historia</b></label>
                            <textarea name='input-historia1' required></textarea>
                            <label for="obra"><b>Sección 2: Historia</b></label>
                            <textarea name='input-historia2' required></textarea>
                            <label for="obra"><b>Sección 3: Historia</b></label>
                            <textarea name='input-historia3' required></textarea>
                            <label for="obra"><b>Sección 1: Información Estadio</b></label>
                            <textarea name='input-estadio1' required></textarea>
                            <label for="obra"><b>Sección 2: Información Estadio</b></label>
                            <textarea name='input-estadio2' required></textarea>
                            <label for="obra"><b>Sección 3: Información Estadio</b></label>
                            <textarea name='input-estadio3' required></textarea>
                            <div class="clearfix">
                                <button type="submit" class="send-signup" name="send-AniadirObra">Agregar</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!--EDITAR ELIMINAR COMENTARIOS-->
                <div id="editarComentarios" class="opcion tabcontent">
                    <div style="padding:1%;">
                        <table>
                            <tr class="tituloTabla">
                                <th>Obras</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tablaUsuarios">
                                        <table>
                                            <?php
                                            $resultado = $this->db->query('SELECT * FROM comentario', array(), array());

                                            if ($resultado != FALSE && $resultado->num_rows > 0) {

                                                for ($i = 0; $i < $resultado->num_rows; $i += 1) {
                                                    $comentariosDeObras = $resultado->fetch_assoc();
                                                    $obra = $this->db->query('SELECT nombre FROM obra WHERE id=?', array("i"), array($comentariosDeObras["id_obra"]));

                                                    if ($obra != FALSE && $obra->num_rows > 0) {
                                                        $nombreObra = $obra->fetch_assoc();

                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <a onclick="setOpcionesComentarios('informacionComentarioSeleccionado<?php echo $comentariosDeObras['id']; ?>')">
                                                                    <?php echo $comentariosDeObras['id']; ?>
                                                                    .- <?php echo $nombreObra['nombre']; ?>
                                                                </a>
                                                                <textarea
                                                                        id='informacionComentarioSeleccionado<?php echo $comentariosDeObras['id']; ?>'
                                                                        style="display:none;"><?php echo $comentariosDeObras['id']; ?>
                                                                    |<?php echo $comentariosDeObras['comentario']; ?>
                                                                </textarea>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="panelDerecha">
                        <form name="editarObra" method="post">
                            <label for="comentario"><b>Contenido Comentario:</b></label>
                            <textarea id='input-comentario' name='input-comentario' required></textarea>
                            <input type="hidden" id="idComentario" name="idComentario" value=""/>
                            <div class="clearfix">
                                <button type="submit" class="cancelbtn-sign" name="send-EliminarComentario">Eliminar
                                </button>
                                <button type="submit" class="send-signup" name="send-EditarComentario">Modificar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='js/window-controlpanel.js'></script>
    <?php
}
}