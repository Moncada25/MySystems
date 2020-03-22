-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2019 a las 23:31:41
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mysystems`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldetalleventa`
--

CREATE TABLE `tbldetalleventa` (
  `ID` int(11) NOT NULL,
  `IDVENTA` int(11) NOT NULL,
  `IDPRODUCTO` int(11) NOT NULL,
  `PRECIOUNITARIO` decimal(20,2) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `DESCARGADO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductos`
--

CREATE TABLE `tblproductos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Precio` decimal(20,2) NOT NULL,
  `Descripcion` text NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblproductos`
--

INSERT INTO `tblproductos` (`ID`, `Nombre`, `Precio`, `Descripcion`, `Type`) VALUES
(1, 'National Geographic', '0.00', 'El interés por transmitir un mensaje de forma que su significado quede oculto a\r\nlos ojos de todo lector que no sea el destinatario o destinatarios es, posiblemente,\r\ntan antiguo com o la propia escritura.', 'BookP'),
(2, 'Física Cuántica', '0.00', 'Las auroras boreales son luminiscencias que se presentan en los cielos\r\nnocturnos. Son muy frecuentes cerca de los polos de la Tierra. Además, se llaman\r\nde maneras distintas dependiendo del hemisferio en el que aparecen: aurora boreal en el norte y aurora austral en el sur.', 'BookC'),
(3, 'Java', '0.00', 'En 1991, la empresa Sun Microsystems crea el lenguaje Oak (de la mano del llamado\r\nproyecto Green). En 1995 pasa a llamarse Java y se da a conocer al público y adquiere notoriedad\r\nrápidamente. Java pasa a ser un lenguaje totalmente independiente de la plataforma y a la\r\nvez potente y orientado a objetos. Esa filosofía y su facilidad para crear aplicaciones para\r\nredes TCP/IP ha hecho que sea uno de los lenguajes más utilizados en la actualidad. ', 'BookP'),
(4, 'PackApps', '9.99', 'Aplicación para escritorio desarrollada en Java (MVC) integrada con múltiples juegos, herramientas, sistema de compraventa con gestión de usuarios, productos, registros, etc. Con la posibilidad de encriptar y desencriptar texto, cambiar la UI, exportar datos en diferentes formatos ¡y más!', 'App'),
(5, 'Carl Sagan', '0.00', 'Es mucho lo que la ciencia no entiende, quedan muchos misterios\r\ntodavía por resolver. En un universo que abarca decenas de miles de millones\r\nde años luz y de unos diez o quince miles de millones de años de antigüedad,\r\nquizá siempre será así. Tropezamos constantemente con sorpresas. Sin\r\nembargo, algunos escritores y religiosos de la «Nueva Era» afirman que los\r\ncientíficos creen que «lo que ellos encuentran es todo lo que existe».', 'BookC'),
(6, 'Carl Sagan', '0.00', 'Llegará una época en la que una investigación diligente y prolongada sacará a la luz cosas que hoy están ocultas. La vida de una sola persona, aunque estuviera toda ella dedicada al cielo, sería insuficiente para investigar una materia tan vasta... Por lo tanto este conocimiento sólo se podrá desarrollar a lo largo de sucesivas edades.', 'BookC'),
(7, 'Stephen Hawking', '0.00', 'Si se mira el cielo en una clara noche sin luna, los objetos más brillantes que uno ve\r\nson los planetas Venus, Marte, Júpiter y Saturno. También se ve un gran número de\r\nestrellas, que son como nuestro Sol, pero situadas a mucha más distancia de\r\nnosotros. Algunas de estas estrellas llamadas fijas cambian, de hecho, muy\r\nligeramente sus posiciones con respecto a las otras estrellas, cuando la Tierra gira\r\nalrededor del Sol: ¡pero no están fijas en absoluto!', 'BookC'),
(8, 'Albert Einstein', '0.00', 'El presente librito pretende dar una idea lo más exacta posible de la teoría de la\r\nrelatividad, pensando en aquellos que, sin dominar el aparato matemático de la\r\nfísica teórica, tienen interés en la teoría desde el punto de vista científico o filosófico\r\ngeneral. La lectura exige una formación de bachillerato aproximadamente y -pese a\r\nla brevedad del librito- no poca paciencia y voluntad por parte del lector.', 'BookC'),
(9, 'HTML', '0.00', 'HTML significa HyperText Markup Language. Es el lenguaje en que se escriben\r\nlos millones de documentos que hoy existen en el World Wide Web. Cuando accedemos a uno de estos documentos, el cliente (Netscape, IE, Mosaic, Lynx, IBrowse) los interpreta y los despliega. Existen clientes gráficos como Netscape, y otros como el Lynx que solo despliegan texto.', 'BookP'),
(10, 'Angular 4', '0.00', 'A lo largo de todo el libro aprenderemos las técnicas Angular para crear los\r\ndiferentes componentes de un proyecto y para ponerlo en práctica, vamos a crear una aplicación partiendo desde cero para llegar a su despliegue en la\r\nnube.', 'BookP'),
(11, 'PHP', '0.00', 'Lo que distingue a PHP de algo del lado del cliente como Javascript es que el código es ejecutado en el servidor, generando HTML y enviándolo al cliente. El cliente recibirá el resultado de ejecutar el script, aunque no se sabrá el código subyacente que era. El servidor web puede ser configurado incluso para que procese todos los ficheros HTML con PHP, por lo que no hay manera de que los usuarios puedan saber qué se tiene debajo de la manga.', 'BookP'),
(12, 'CSS', '0.00', 'CSS es un lenguaje de hojas de estilos creado para controlar el aspecto o presentación de los documentos electrónicos definidos con HTML y XHTML. CSS es la mejor forma de separar los contenidos y su presentación y es imprescindible para crear páginas web\r\ncomplejas.\r\n', 'BookP'),
(13, 'CSS3', '0.00', 'Después de HTML5, CSS3 es el segundo lenguaje que deberías aprender si piensas dedicarte al diseño y desarrollo web. Aunque HTML5 sirve para definir la estructura, CSS3 te permite darle un aspecto único a tu sitio. Al finalizar de leer este artículo no te quedará duda alguna sobre el por qué debes aprenderlo.', 'BookP'),
(14, 'Boostrap 4', '0.00', 'Bootstrap 4 es la versión más nueva de Bootstrap, que es el marco de HTML, CSS y\r\nJavaScript más popular para desarrollar sitios web responsivos y con prioridad para\r\ndispositivos móviles.\r\n¡Bootstrap 4 se puede descargar y usar completamente gratis!', 'BookP'),
(15, 'JavaScript', '0.00', 'JavaScript (JS) es un lenguaje de programación cuyo uso principal ha venido siendo dotar de dinamismo, rapidez y efectos atractivos a las páginas web, mediante su uso combinado junto a HTML, CSS y otros lenguajes. Este curso permite aprender los fundamentos de JavaScript, imprescindible para trabajar con páginas web hoy día. ', 'BookP'),
(16, 'Stephen Hawking', '0.00', 'No había esperado que mi libro de divulgación, Historia del tiempo, tuviera tanto éxito. Se mantuvo durante cuatro años en la lista de superventas del London\r\nSunday Times, un período más largo que cualquier otro libro, lo cual resulta\r\nespecialmente notable para una obra científica que no era fácil. Desde entonces, la gente me estuvo preguntando cuándo escribiría una continuación. ', 'BookC'),
(17, 'Carl Sagan', '0.00', 'Fuimos nómadas desde los comienzos. Conocíamos la posición de cada árbol en\r\ncien millas a la redonda. Cuando sus frutos o nueces habían madurado, estábamos\r\nallí. Seguíamos a los rebaños en sus migraciones anuales. Disfrutábamos con la\r\ncarne fresca, con sigilo, haciendo amagos, organizando emboscadas y asaltos a\r\nfuerza viva, cooperando unos cuantos conseguíamos lo que muchos de nosotros,\r\ncazando por separado, nunca habríamos logrado. Dependíamos los unos de los\r\notros.', 'BookC'),
(18, 'Albert Einstein', '0.00', '¡Qué mala suerte la de nosotros los mortales! Estamos aquí por un breve período, no sabemos con qué propósito, aunque a veces creemos percibirlo. Pero no hace falta reflexionar mucho para saber, en contacto con la realidad cotidiana, que uno existe para otras personas: en primer lugar para aquellos de cuyas sonrisas\r\ny de cuyo bienestar depende totalmente nuestra propia felicidad, y luego para los muchos, para nuestros desconocidos, a cuyos destinos estamos ligados por lazos de afinidad. ', 'BookC'),
(20, 'Laravel', '0.00', 'Laravel es un framework de código abierto para desarrollar aplicaciones y servicios web con PHP 5 y PHP 7. Su filosofía es desarrollar código PHP de forma elegante y simple, evitando el código espagueti. Fue creado en 2011 y tiene una gran influencia de frameworks como Ruby on Rails, Sinatra y ASP.NET MVC.', 'BookP'),
(21, 'Vue.js', '0.00', 'Vue (en inglés, como view) es un framework progresivo para construir interfaces de usuario. A diferencia de otros frameworks monolíticos, Vue está diseñado desde el inicio para ser adoptado incrementalmente. La biblioteca principal se enfoca solo en la capa de la vista, y es muy simple de utilizar e integrar con otros proyectos o bibliotecas existentes. Por otro lado, Vue también es perfectamente capaz de soportar aplicaciones sofisticadas de una sola página (en inglés single-page-application o SPA) cuando se utiliza en combinación con herramientas modernas y librerías compatibles.\r\n', 'BookP'),
(22, 'Python', '0.00', 'Python es un lenguaje de programación creado por Guido van Rossum a principios de los años 90 cuyo nombre está inspirado en el grupo de cómicos ingleses “Monty Python”. Es un lenguaje similar a Perl, pero con una sintaxis muy limpia y que favorece un código legible. Se trata de un lenguaje interpretado o de script, con tipado dinámico, fuertemente tipado, multiplataforma y orientado a objetos.', 'BookP'),
(23, 'Android', '0.00', 'Antes de empezar con este proyecto reflexioné acerca de la manera de obtener el conocimiento desde los inicios de la escritura hasta nuestra manera actual de enfocar el aprendizaje. Me hizo pensar en cómo enfocábamos las cosas, la poca motivación que había al estudiar tecnicismos, y que el método tradicional estaba rotundamente desfasado.  No soy un experto en psicología, pero todos somos buenos conocedores de todo cuanto nos ocurre y tenemos perspectiva. Pronto me di cuenta que lo que más me interesaba, me\r\nmotivaba, me apasionaba, era aquello que podía entender desde la base y podía llevar al mundo real.', 'BookP'),
(24, 'React Native', '0.00', 'Para los que no sepan qué es React Native, os diré que es una de las mejores plataformas de desarrollo de aplicaciones móviles multiplataforma que existen en la actualidad junto con NativeScript. Se trata de un software de desarrollo multiplataforma donde podemos compilar con el mismo código fuente las respectivas aplicaciones para iOs, Android y Windows Phone. El lenguaje de programación que utiliza es el tan querido por todos JavaScript junto con la librería ReactJS, también desarrollada con anterioridad por los chicos de Facebook para el desarrollo web.', 'BookP'),
(25, 'TypeScript', '0.00', 'TypeScript es un lenguaje de programación moderno que permite crear aplicaciones web\r\nrobustas en JavaScript. TypeScript no requiere de ningún tipo de plugin, puesto que lo que hace es generar código JavaScript que se ejecuta en cualquier navegador, plataforma o sistema operativo.', 'BookP'),
(26, 'Angular.js', '0.00', 'AngularJs paso a paso cubre el desarrollo de aplicaciones con el framework AngularJs. En este libro se tratarán temas esenciales para el desarrollo de aplicaciones web del lado del cliente. Además, trabajaremos con peticiones al servidor, consumiendo servicios\r\nREST y haciendo que nuestro sistema funcione en tiempo real sin tener que recargar la página de nuestro navegador.', 'BookP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblventas`
--

CREATE TABLE `tblventas` (
  `ID` int(11) NOT NULL,
  `ClaveTransaccion` varchar(250) NOT NULL,
  `PaypalDatos` text NOT NULL,
  `Fecha` datetime NOT NULL,
  `Correo` varchar(5000) NOT NULL,
  `Total` decimal(60,2) NOT NULL,
  `Status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbldetalleventa`
--
ALTER TABLE `tbldetalleventa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDVENTA` (`IDVENTA`),
  ADD KEY `IDPRODUCTO` (`IDPRODUCTO`);

--
-- Indices de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tblventas`
--
ALTER TABLE `tblventas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbldetalleventa`
--
ALTER TABLE `tbldetalleventa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tblventas`
--
ALTER TABLE `tblventas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbldetalleventa`
--
ALTER TABLE `tbldetalleventa`
  ADD CONSTRAINT `tbldetalleventa_ibfk_1` FOREIGN KEY (`IDVENTA`) REFERENCES `tblventas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbldetalleventa_ibfk_2` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `tblproductos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
