-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2018 a las 01:43:16
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `museo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bad_word`
--

CREATE TABLE `bad_word` (
  `id` int(11) NOT NULL,
  `palabra` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bad_word`
--

INSERT INTO `bad_word` (`id`, `palabra`) VALUES
(1, 'caca'),
(2, 'feo'),
(4, 'idiota'),
(5, 'retrasado'),
(6, 'nazi'),
(7, 'marica'),
(8, 'tonto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coleccion`
--

CREATE TABLE `coleccion` (
  `id` int(11) NOT NULL,
  `id_imagen` int(11) DEFAULT NULL,
  `comunidad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coleccion`
--

INSERT INTO `coleccion` (`id`, `id_imagen`, `comunidad`) VALUES
(1, 44, 'Andalucía'),
(2, 45, 'Madrid'),
(3, 46, 'País Vasco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `id_obra` int(11) DEFAULT NULL,
  `usuario` varchar(70) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comentario` varchar(500) NOT NULL,
  `modificado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `id_obra`, `usuario`, `ip`, `fecha`, `comentario`, `modificado`) VALUES
(9, 3, 'usuario', '::1', '2018-05-20 22:59:57', 'Aupa Atletic                                                               ', 1),
(10, 2, 'usuario', '::1', '2018-05-20 23:37:37', 'Cristiano Leyenda', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` int(11) NOT NULL,
  `id_obra` int(11) DEFAULT NULL,
  `nombre_obra` varchar(500) NOT NULL,
  `historia_1` varchar(10000) NOT NULL,
  `historia_2` varchar(10000) NOT NULL,
  `historia_3` varchar(10000) NOT NULL,
  `estadio_1` varchar(500) NOT NULL,
  `estadio_2` varchar(15000) NOT NULL,
  `estadio_3` varchar(15000) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id`, `id_obra`, `nombre_obra`, `historia_1`, `historia_2`, `historia_3`, `estadio_1`, `estadio_2`, `estadio_3`, `fecha_creacion`, `fecha_modificacion`) VALUES
(9, 1, 'Deportivo Alavés SAD                                                                                                                                                ', 'El Deportivo Alavés, SAD, es un club de fútbol con sede en la ciudad de Vitoria, España. Fundado el 23 de enero de 1921\r\n                    como Sport Friend\'s Club, participa en la máxima categoría de la Liga Nacional de Fútbol Profesional, la Primera División\r\n                    de España, desde la temporada 2016-17, en la que ocupa el trigésimo puesto en su clasificación histórica.                                                                                                                                                ', 'Su mayor logro deportivo tuvo lugar en el año 2001, cuando, en su debut en competición europea, fue subcampeón de la Copa\r\n                    de la UEFA —actual Liga Europa— tras perder frente al Liverpool Football Club por un gol de oro en la prórroga por un 5-4\r\n                    final. Merced a dicha actuación se encuentra entre los veintiocho equipos españoles en haber disputado una competición\r\n                    internacional. En cuanto a títulos, ha logrado cinco campeonatos de liga en divisiones inferiores nacionales como mejores\r\n                    distinciones.                                                                                                                                                ', ' Los orígenes del fútbol en Vitoria de principio del siglo XX, influenciados por sus vecinos vizcaínos, se remontan al año\r\n                    1908 con un primitivo Deportivo Alavés, club con dilatada historia en el ámbito regional vasco pero no vinculado al actual.\r\n                    La capital alavesa, que en la época se encontraba más atraída por la práctica del ciclismo —vigente en la actualidad como una\r\n                    de las regiones más representativas de dicho deporte—, encontró en clubes como la Unión Sportiva Alavesa, o la Ciclista Vitoriana,\r\n                    lo que dieron tras una fusión con el Vitoria Foot-ball Club. El Deportivo y el Vitoria fueron los primeros protoclubes que\r\n                    impulsaron el fútbol en la zona y los que provocaron la fundación de muchos otros. Entre ellos destacó la creación en 1915 de la\r\n                    sociedad pluridisciplinar del primitivo Club Deportivo de Vitoria, la cual junto al desempeño de los equipos vascos en el Campeonato\r\n                    de España fue sin embargo insuficiente para dar un definitivo impulso al fútbol alavesista quien es incapaz de originar una asociación\r\n                    con plena dedicación futbolística con igual trascendencia a la que acontecida en otras regiones del país.\r\n\r\nSe llegó así al 1 de julio de 1920, fecha en la que José Cabezas constituyó finalmente un club remarcable en el devenir del fútbol vitoriano:\r\n                    el Sport Friend’s Club.? La asociación, formada íntegramente por estudiantes universitarios, jugó diversos encuentros en los que dio muestra\r\n                    de un gran potencial. El modesto club, de camisa y pantalón blancos, eligió nueva junta directiva el 6 de enero de 1921 con Hilario Dorao\r\n                    Íñiguez como presidente.? Ubicado en la segunda categoría del fútbol vasco, o de la Región del Norte, el 23 de enero, tras enfrentarse al\r\n                    también local Regimiento de Cuenca en el Campo de Cervantes con empate final 1-1, fue la última fecha en la que jugó bajo esa denominación.\r\n                    ?Celebraron entonces sus integrantes una reunión directiva en la que entre otros puntos se acordó el cambió de nombre por uno más\r\n                    representativo, el de Deportivo Alavés.                                                                                                                                                ', 'Estadio -  Mendizorroza                                                                                                                                                ', 'El Estadio de Mendizorroza fue inaugurado el 27 de abril de 1924. El campo ha sufrido varias remodelaciones, siendo la última la sufrida en el año\r\n                    2016, con el ascenso a Primera División del Alavés. En esa remodelación, se cambió el césped 18 años después. También se cambiaron los asientos de\r\n                    las gradas, los marcadores de ambos fondos, los banquillos y el palco.                                                                                                                                                ', ' Aun así, la remodelación más importante fue en la temporada 1998/99 tras el\r\n                    tercer ascenso del Alavés a Primera División. En el año 2014 Mendizorroza cumplió 90 años, siendo el tercer campo español más longevo, tras el\r\n                    Molinón y Mestalla.', '2018-04-20 00:31:06', '2018-05-18 08:55:53'),
(10, 2, 'Real Madrid Club de Fútbol                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ', 'El Real Madrid Club de Fútbol, fue declarada oficialmente registrada por sus socios el 6 de marzo de 1902 con el objeto\r\n                    de la práctica y desarrollo del fútbol - si bien sus orígenes datan al año 1900. Tuvo a Julián Palacios y los hermanos\r\n                    Juan y Carlos Padrós como principales valedores de su creación.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', 'Identificado por su color blanco —del que recibe el apelativo de «blancos» o «merengues»—, es uno de los cuatro clubes\r\n                    profesionales de fútbol del país cuya entidad jurídica no es la de sociedad anónima deportiva (S. A. D.),? ya que su propiedad\r\n                    recae en sus más de 99 000 socios.? Similar salvedad comparte con el Athletic Club y el Fútbol Club Barcelona al participar sin\r\n                    interrupción en la máxima categoría de la Liga Nacional de Fútbol Profesional, la Primera División de España, desde su\r\n                    establecimiento en 1929.? En ella posee los honores de haber sido el primer líder histórico de la competición,? el de club con\r\n                    más títulos, y el de la máxima puntuación en una edición.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', ' Es miembro creador, fundador y cofundador de varias de las competiciones españolas más longevas antes de la existencia de los\r\n                    pertinentes órganos rectores: el Campeonato Regional Centro, o la Copa de España.? A nivel internacional fue uno de los\r\n                    miembros fundadores de la FIFA, estamento que le concedió la Orden del Mérito de la FIFA por su especial relevancia en el fútbol\r\n                    tras colaborar en el nacimiento de algunas de las competiciones o asociaciones más prestigiosas como la Copa de Europa, la Copa\r\n                    Intercontinental, o la Asociación de Clubes Europeos.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', 'Estadio -  Santiago Bernabéu                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', 'Pese a la carencia casi absoluta de campos debidamente acondicionados para la práctica futbolística en España en el momento de la\r\n                    fundación del club, el equipo disputaba sus partidos en terrenos de los distritos más carismáticos del paisaje madrileño como Moncloa, o Salamanca.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', ' En el año 1923 el presidente del club Santiago Bernabéu adquirió unos terrenos en Chamartín de la Rosa, municipio colindante a Madrid, para construir un\r\n                    nuevo estadio que fuese exclusivamente propiedad del club. Inicialmente se barajó el nombre de «Parque de Sports del Real Madrid F. C.» como nombre para\r\n                    el nuevo recinto, finalmente se lo bautizó, oficialmente, como «Campo del Real Madrid Club de Fútbol». Sin embargo, popularmente fue siempre conocido como\r\n                    «Estadio de Chamartín», siendo el primer estadio en propiedad del club, gracias a lo cual el club vio un significativo aumento en sus arcas. Actualmente y\r\n                    desde el año 1947 disputa sus partidos como local en el Estadio Santiago Bernabéu —denominado popularmente en su fundación como Nuevo Estadio de\r\n                    Chamartín y rebautizado en memoria del antiguo presidente del club—, el cual cuenta con una capacidad de 81.044 espectadores, el tercero de mayor capacidad\r\n                    en Europa y que llegó a contar con una capacidad de 120.000 espectadores antes de verse sometido a las regulaciones de la UEFA sobre aforo,? momento en el\r\n                    que era superado únicamente por el antiguo Estadio de Wembley. Fue inaugurado el 14 de diciembre de 1947 con un partido frente al Clube de Futebol Os Belenenses\r\n                    portugués.', '2018-04-20 00:34:43', '2018-05-18 13:39:27'),
(11, 3, 'Athletic Club de Bilbao', 'El Athletic Club fue fundado en 1898 y es, junto al Real Madrid Club de Fútbol y al Fútbol Club Barcelona, el único club\r\n                    que ha disputado todas las ediciones de la Primera División de España desde su creación en 1928. A su vez, es uno de los\r\n                    cuatro únicos clubes profesionales de España que no es una sociedad anónima deportiva, de manera que la propiedad del club\r\n                    recae en sus socios.', 'Una de las particularidades más representativas y originales del club vasco es su tradición de jugar únicamente con jugadores\r\n                    nacidos o formados futbolísticamente en Euskal Herria, tradición que ha mantenido desde 1912.', 'El fútbol en Vizcaya se dio a conocer en la década de 1890, gracias a que los marineros ingleses que trabajaban en los puertos\r\n                    vizcaínos solían jugar partidillos de fútbol en sus ratos libres. Poco después, se les fueron uniendo aficionados vizcaínos. El\r\n                    interés de los vizcaínos por este novedoso deporte fue aumentando, hasta que, en 1898, unos jóvenes del gimnasio Zamacois de Bilbao\r\n                    tuvieron la idea de fundar un equipo de fútbol, como los existentes en Inglaterra; a este equipo le bautizaron con el nombre de\r\n                    Athletic Club, si bien el equipo no se constituyó legalmente hasta el 5 de abril de 1901 en una asamblea celebrada en el Café García.\n\nEn 1900, surgió el Bilbao Football Club. Ambos equipos solían disputar partidos amistosos que cada vez iban teniendo más relevancia\r\n                    entre los aficionados vizcaínos, llegando a haber bastante rivalidad entre los dos equipos. En la primavera de 1902, se celebró un\r\n                    torneo nacional de football para celebrar la mayoría de edad del rey Alfonso XIII. A este trofeo se lo bautizó con el nombre de Copa\r\n                    de la Coronación, y está considerado como el precursor de la Copa del Rey. Para disputarlo, el Athletic Club y el Bilbao F. C. crearon\r\n                    un equipo combinado con el nombre de Bizcaya, que se alzó con el título al ganar 2-1 al F. C. Barcelona en el Hipódromo de la Castellana,\r\n                    en Madrid.\r\n                    En 1903, el Bilbao Football Club acordó en Junta General disolver la sociedad, ingresando a todos sus socios en el Athletic Club. Tras\r\n                    superar una dura crisis institucional, que casi le cuesta su disolución, el Athletic debutó, ese mismo año, en la recién creada Copa del Rey,\r\n                    proclamándose campeón, título que repitió al año siguiente.? El éxito de la primera edición desembocó en la creación del Athletic Club (Sucursal\r\n                    de Madrid), un club filial con sede en la capital que décadas después terminó por desligarse pasando a ser el actual Atlético de Madrid.', 'Estadio -  San Mamés', 'El Athletic juega sus partidos en el nuevo San Mamés, este estadio fue inaugurado el 16 de septiembre de 2013. Fue diseñado por el arquitecto\r\n                    bilbaino César Azcárate. ?Desde su inauguración, ha recibido varios reconocimientos como mejor estadio del mundo.? Al igual que el anterior,\r\n                    toma su nombre del vecino asilo de San Mamés, al que pertenecían los terrenos sobre los que posteriormente se levantó el antiguo estadio. De\r\n                    este nombre proviene el apodo de «Los leones de San Mamés», o simplemente «Los leones», con el que se les conoce a los jugadores del Athletic,\r\n                    ya que según la mitología cristiana el santo Mamés (San Mamés) fue un mártir cristiano arrojado a los leones por los romanos.', ' El estadio ha sido seleccionado para acoger las finales de la Copa de Campeones Europea y la Copa Desafío Europeo de Rugby en 2018 y cuatro\r\n                    partidos de la Eurocopa 2020.', '2018-04-20 00:36:57', '2018-04-20 13:23:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL,
  `id_obra` int(11) DEFAULT NULL,
  `tipo` varchar(200) NOT NULL,
  `ruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `id_obra`, `tipo`, `ruta`) VALUES
(1, 1, 'escudo', 'img/escudos/Alaves.png                                                                                                                                                '),
(2, 3, 'escudo', 'img/escudos/Athletic.png'),
(3, 19, 'escudo', 'img/escudos/Valencia.png'),
(4, 20, 'escudo', 'img/escudos/Villareal.png'),
(5, 4, 'escudo', 'img/escudos/atleticomadrid.png'),
(6, 5, 'escudo', 'img/escudos/barcelona.png'),
(7, 6, 'escudo', 'img/escudos/betis.png'),
(8, 7, 'escudo', 'img/escudos/celta.png'),
(9, 8, 'escudo', 'img/escudos/depor.png'),
(10, 9, 'escudo', 'img/escudos/eibar.png'),
(11, 10, 'escudo', 'img/escudos/espanyol.png'),
(12, 11, 'escudo', 'img/escudos/getafe.png'),
(13, 12, 'escudo', 'img/escudos/girona.png'),
(14, 13, 'escudo', 'img/escudos/lasPalmas.png'),
(15, 14, 'escudo', 'img/escudos/leganes.png'),
(16, 15, 'escudo', 'img/escudos/levante.png'),
(17, 16, 'escudo', 'img/escudos/malaga.png'),
(18, 2, 'escudo', 'img/escudos/realmadrid.png                                                                                                                                                                              '),
(19, 17, 'escudo', 'img/escudos/realsociedad.png'),
(20, 18, 'escudo', 'img/escudos/sevilla.png'),
(21, 1, 'estadio', 'img/Mendizorrotza.jpg'),
(22, NULL, 'logo', 'img/RFEF_logo.png'),
(23, 1, 'palmares', 'img/alavespalmares.png'),
(24, 3, 'palmares', 'img/athletic-palmares.png'),
(25, NULL, 'back', 'img/back-icon.png'),
(26, NULL, 'chat', 'img/chat-ico.png'),
(28, 1, 'estadisticas', 'img/estadisticas-alaves.png'),
(29, 3, 'estadisticas', 'img/estadisticas-athletic.png'),
(30, 2, 'estadisticas', 'img/estadisticas-real-madrid.png'),
(31, NULL, 'facebook', 'img/facebook.png'),
(32, NULL, 'favicon', 'img/favicon.ico'),
(33, NULL, '', 'img/fondo-header.jpg'),
(34, NULL, 'google', 'img/google.png'),
(35, NULL, 'imprimir', 'img/imprimir.png'),
(36, NULL, '', 'img/museofondo.jpg'),
(37, 2, 'palmares', 'img/realmadridpalmares.PNG'),
(38, 3, 'estadio', 'img/sanmames.jpeg'),
(39, 2, 'estadio', 'img/santiagobernabeu.png'),
(40, NULL, 'twitter', 'img/twitter.png'),
(41, NULL, 'perfil1', 'img/user.png'),
(42, NULL, 'perfil2', 'img/user1.png'),
(43, NULL, 'perfil3', 'img/user2.png'),
(44, NULL, 'coleccion', 'img/colecciones/comunidad_andalucia.png'),
(45, NULL, 'coleccion', 'img/colecciones/comunidad_madrid.png'),
(46, NULL, 'coleccion', 'img/colecciones/comunidad_paisvasco.png'),
(47, NULL, 'controlpanel', 'img/control-panel.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE `informacion` (
  `id` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informacion`
--

INSERT INTO `informacion` (`id`, `direccion`, `telefono`, `correo`) VALUES
(1, 'Calle Ruiz de Alarcón 18', '913 40 67 23 ', 'info@museodelfutbolespanol.com ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra`
--

CREATE TABLE `obra` (
  `id` int(11) NOT NULL,
  `id_coleccion` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obra`
--

INSERT INTO `obra` (`id`, `id_coleccion`, `nombre`) VALUES
(1, 3, 'Deportivo Alavés SAD                              '),
(2, 2, 'Real Madrid Club de Fútbol                        '),
(3, 3, 'Athletic Club Bilbao'),
(4, 2, 'Atletico de Madrid'),
(5, NULL, 'FC Barcelona'),
(6, 1, 'Real Betis'),
(7, NULL, 'Celta de Vigo'),
(8, NULL, 'Deportivo de la Coruña'),
(9, 3, 'SD Eibar'),
(10, NULL, 'RCD Espanyol'),
(11, 2, 'Getafe CF'),
(12, NULL, 'Girona FC'),
(13, NULL, 'UD Las Palmas'),
(14, 2, 'CD Leganes'),
(15, NULL, 'Levante UD'),
(16, 1, 'Málaga CF'),
(17, 3, 'Real Sociedad'),
(18, 1, 'Sevilla'),
(19, NULL, 'Valencia CF'),
(20, NULL, 'Villarreal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `tipo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `tipo`) VALUES
(2, 'gestor'),
(3, 'moderador'),
(4, 'registrado'),
(1, 'superusuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `nombre_usuario` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `id_permiso`, `nombre_usuario`, `password`, `email`, `nombre`) VALUES
(2, 1, 'root', '$2y$10$F6x66Vh3yzazALghkjpZA.6phmC8ht2Wc1trqkNBgN4TcWg7HUAOi', '', ''),
(6, 4, 'usuario', '$2y$10$9wmGE4f6gpcpLhsjDWOKoOP3QO/YUfGcnsSLEWRZJk4GmjOM86eGO', 'usuario@gmail.com', 'usuario'),
(7, 2, 'gestor', '$2y$10$dSZaof0Z2w3MXeh7nVCGeOJjMtjenyx7YrwOdDKlkIU5IcOzPpBlu', 'gestor@gmail.com', 'gestor'),
(8, 3, 'moderador', '$2y$10$TPh2uBt5LWb/1Nvkxfod8Ob0VHdjpvsZcTzPcp9Vr2FY7qkkzEHhW', 'moderador@gmail.com', 'moderador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bad_word`
--
ALTER TABLE `bad_word`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coleccion`
--
ALTER TABLE `coleccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obra` (`id_obra`),
  ADD KEY `id_usuario` (`usuario`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obra` (`id_obra`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obra` (`id_obra`);

--
-- Indices de la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comunidad` (`id_coleccion`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo` (`tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`nombre_usuario`),
  ADD KEY `permiso` (`id_permiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bad_word`
--
ALTER TABLE `bad_word`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `coleccion`
--
ALTER TABLE `coleccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `informacion`
--
ALTER TABLE `informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `obra`
--
ALTER TABLE `obra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `coleccion`
--
ALTER TABLE `coleccion`
  ADD CONSTRAINT `imagen_asociada` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `obra_asignada` FOREIGN KEY (`id_obra`) REFERENCES `obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_asignado` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`nombre_usuario`);

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `obra` FOREIGN KEY (`id_obra`) REFERENCES `obra` (`id`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `obra_asociada` FOREIGN KEY (`id_obra`) REFERENCES `obra` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `obra`
--
ALTER TABLE `obra`
  ADD CONSTRAINT `coleccion_asociada` FOREIGN KEY (`id_coleccion`) REFERENCES `coleccion` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
