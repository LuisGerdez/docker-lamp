-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2023 a las 22:28:47
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `merge`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualizaciones`
--

CREATE TABLE `actualizaciones` (
  `actualizaId` int(11) NOT NULL,
  `oldParameters` mediumtext DEFAULT NULL,
  `newParameters` mediumtext DEFAULT NULL,
  `TransactionId` mediumtext DEFAULT NULL,
  `actualizaFecha` datetime NOT NULL DEFAULT current_timestamp(),
  `observacion` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ado_records`
--

CREATE TABLE `ado_records` (
  `Record` int(11) NOT NULL,
  `Uid` varchar(50) DEFAULT NULL,
  `StartingDate` datetime DEFAULT NULL,
  `CreationDate` datetime DEFAULT NULL,
  `CreationIP` varchar(30) DEFAULT NULL,
  `DocumentType` int(11) DEFAULT NULL,
  `IdNumber` varchar(20) DEFAULT NULL,
  `FirstName` varchar(30) DEFAULT NULL,
  `SecondName` varchar(30) DEFAULT NULL,
  `FirstSurname` varchar(30) DEFAULT NULL,
  `SecondSurname` varchar(30) DEFAULT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `Street` varchar(30) DEFAULT NULL,
  `CedulateCondition` varchar(30) DEFAULT NULL,
  `Spouse` varchar(30) DEFAULT NULL,
  `Home` varchar(30) DEFAULT NULL,
  `MaritalStatus` varchar(30) DEFAULT NULL,
  `DateOfIdentification` datetime DEFAULT NULL,
  `DateOfDeath` datetime DEFAULT NULL,
  `MarriageDate` datetime DEFAULT NULL,
  `Instruction` varchar(30) DEFAULT NULL,
  `PlaceBirth` varchar(30) DEFAULT NULL,
  `Nationality` varchar(30) DEFAULT NULL,
  `MotherName` varchar(30) DEFAULT NULL,
  `FatherName` varchar(30) DEFAULT NULL,
  `HouseNumber` varchar(30) DEFAULT NULL,
  `Profession` varchar(30) DEFAULT NULL,
  `ExpeditionCity` varchar(30) DEFAULT NULL,
  `ExpeditionDepartment` varchar(30) DEFAULT NULL,
  `BirthCity` varchar(30) DEFAULT NULL,
  `BirthDepartment` varchar(30) DEFAULT NULL,
  `TransactionType` int(11) DEFAULT NULL,
  `TransactionTypeName` varchar(30) DEFAULT NULL,
  `IssueDate` datetime DEFAULT NULL,
  `BarcodeText` varchar(30) DEFAULT NULL,
  `OcrTextSideOne` varchar(30) DEFAULT NULL,
  `OcrTextSideTwo` varchar(30) DEFAULT NULL,
  `SideOneWrongAttempts` int(11) DEFAULT NULL,
  `SideTwoWrongAttempts` int(11) DEFAULT NULL,
  `FoundOnAdoAlert` varchar(5) DEFAULT 'false',
  `AdoProjectId` varchar(30) DEFAULT NULL,
  `TransactionId` varchar(30) DEFAULT NULL,
  `ProductId` varchar(30) DEFAULT NULL,
  `ComparationFacesSuccesful` varchar(5) DEFAULT 'false',
  `FaceFound` varchar(5) DEFAULT 'false',
  `FaceDocumentFrontFound` varchar(5) DEFAULT 'false',
  `BarcodeFound` varchar(5) DEFAULT 'false',
  `ResultComparationFaces` varchar(30) DEFAULT NULL,
  `ResultCompareDocumentFaces` varchar(30) DEFAULT NULL,
  `ComparationFacesAproved` varchar(5) DEFAULT 'false',
  `ThresholdCompareDocumentFaces` varchar(30) DEFAULT NULL,
  `CompareFacesDocumentResult` varchar(30) DEFAULT NULL,
  `Extras` varchar(1000) DEFAULT NULL,
  `NumberPhone` varchar(30) DEFAULT NULL,
  `CodFingerprint` varchar(30) DEFAULT NULL,
  `ResultQRCode` varchar(30) DEFAULT NULL,
  `DactilarCode` varchar(30) DEFAULT NULL,
  `ReponseControlList` varchar(30) DEFAULT NULL,
  `Latitude` varchar(250) DEFAULT NULL,
  `Longitude` varchar(200) DEFAULT NULL,
  `Images` text DEFAULT NULL,
  `SignedDocuments` varchar(30) DEFAULT NULL,
  `Scores` varchar(30) DEFAULT NULL,
  `Response_ANI` text DEFAULT NULL,
  `Parameters` varchar(30) DEFAULT NULL,
  `StateSignatureDocument` varchar(30) DEFAULT NULL,
  `JSON_Response` mediumtext DEFAULT NULL,
  `VerifyUpdate` int(11) DEFAULT 0,
  `EstadoReg` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsas`
--

CREATE TABLE `bolsas` (
  `bolsaid` int(11) NOT NULL,
  `clienteid` varchar(30) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `CreationFecha` datetime DEFAULT NULL,
  `EnrollCount` int(11) NOT NULL,
  `VerifyCount` int(11) NOT NULL,
  `ActualizacionFecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos_plantillas`
--

CREATE TABLE `campos_plantillas` (
  `id_campos_plantillas` int(11) NOT NULL,
  `id_plantilla` int(11) NOT NULL,
  `campo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carpetas`
--

CREATE TABLE `carpetas` (
  `id_carpeta` int(11) NOT NULL,
  `carp_nombre` varchar(30) NOT NULL,
  `carp_fecha` date NOT NULL,
  `carp_hora` time NOT NULL,
  `carp_contador` int(11) DEFAULT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_validacion`
--

CREATE TABLE `codigo_validacion` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `codigo_verificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalledocumento`
--

CREATE TABLE `detalledocumento` (
  `det_id` int(11) NOT NULL,
  `det_docume` int(11) DEFAULT NULL COMMENT 'Llave foranea del documento',
  `det_firma` tinyint(1) DEFAULT NULL COMMENT 'estado de la firma destinatario',
  `det_observ` varchar(300) DEFAULT NULL COMMENT 'observacion del documento',
  `det_nomdes` varchar(150) DEFAULT NULL COMMENT 'nombre del destinatario',
  `det_cordes` varchar(100) DEFAULT NULL COMMENT 'correo del destinatario',
  `link_firma` varchar(1000) DEFAULT NULL,
  `det_rutafi` varchar(300) DEFAULT NULL,
  `det_fechaf` date DEFAULT NULL COMMENT 'fecha de firma destinatario',
  `det_horaf` time DEFAULT NULL COMMENT 'hora de firma destinatario',
  `det_ip` varchar(20) DEFAULT NULL COMMENT 'ip del destinatario',
  `det_usuari` int(11) DEFAULT NULL COMMENT 'id del usuario remitente',
  `codigo_verificacion` int(11) NOT NULL,
  `TransactionId` varchar(30) DEFAULT NULL COMMENT 'Transaccion Biometria',
  `IdNumber` varchar(20) DEFAULT NULL COMMENT 'Cedula Biometria',
  `estado_firma_destinatario_modal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Registro de detalles de documentos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `doc_id` int(11) NOT NULL,
  `doc_nombre` varchar(200) DEFAULT NULL COMMENT 'nombre del documento',
  `doc_ruta` varchar(200) DEFAULT NULL COMMENT 'ruta del documento',
  `doc_estado` varchar(25) DEFAULT NULL COMMENT 'estado del documento',
  `doc_usuari` int(11) DEFAULT NULL COMMENT 'id del usuario',
  `doc_fechac` date DEFAULT NULL COMMENT 'fecha de creacion del documento',
  `doc_horac` time DEFAULT NULL COMMENT 'hora de creacion del documento',
  `doc_fecha_e` date DEFAULT NULL COMMENT 'fecha de eliminacion de documento',
  `doc_fecha_r` date DEFAULT NULL COMMENT 'fecha de restauracion de documento',
  `doc_hash` varchar(256) DEFAULT NULL COMMENT 'hash de validacion del documento',
  `doc_fecha_f` date DEFAULT NULL COMMENT 'fecha de firma de documento definitivo',
  `doc_hora_f` time DEFAULT NULL COMMENT 'hora de firma de documento definitivo',
  `doc_md5` varchar(256) DEFAULT NULL COMMENT 'md5 para la integridad del documento',
  `id_carpeta` int(11) DEFAULT NULL,
  `certificadofirma_hash` varchar(256) DEFAULT NULL COMMENT 'hash de certificado de firma del documento',
  `certificadofirma_md5` varchar(256) DEFAULT NULL COMMENT 'md5 para la integridad del certificado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Registro de documentos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juridico_usuario`
--

CREATE TABLE `juridico_usuario` (
  `id_juridico` int(11) NOT NULL,
  `id_persona_juridica` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `codigo_invitacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `scope` varchar(4000) DEFAULT NULL,
  `id_token` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL,
  `client_secret` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `grant_types` varchar(80) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `scope` varchar(80) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_users`
--

CREATE TABLE `oauth_users` (
  `username` varchar(80) NOT NULL DEFAULT '',
  `password` varchar(80) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `given_name` varchar(80) DEFAULT NULL,
  `family_name` varchar(80) DEFAULT NULL,
  `Uid` varchar(80) DEFAULT NULL,
  `TransactionId` int(11) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `idparametro` varchar(12) NOT NULL,
  `valor` varchar(300) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_juridica`
--

CREATE TABLE `persona_juridica` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(50) DEFAULT NULL,
  `nit` bigint(20) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE `plantilla` (
  `id_plantilla` int(11) NOT NULL,
  `nombre_plantilla` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `total_firmas` int(11) NOT NULL,
  `cantidad_firmas` int(11) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `hora_compra` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `queue_fetch`
--

CREATE TABLE `queue_fetch` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) DEFAULT NULL COMMENT 'hash de validacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para almacenar los queue fetch a procesar';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_usuario`
--

CREATE TABLE `roles_usuario` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(100) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_estado` varchar(10) DEFAULT NULL,
  `usu_passwo` varchar(100) DEFAULT NULL,
  `rol_usuario` int(11) DEFAULT NULL,
  `usu_nombre` varchar(100) DEFAULT NULL,
  `usu_apelli` varchar(100) DEFAULT NULL,
  `usu_tipo_documento` varchar(100) DEFAULT NULL COMMENT 'Tipo de identificacion',
  `usu_docume` varchar(30) DEFAULT NULL COMMENT 'Numero de documento usuario',
  `usu_email` varchar(100) DEFAULT NULL,
  `usu_celula` varchar(30) DEFAULT NULL COMMENT 'Numero de celular usuario',
  `usu_terminos` varchar(2) DEFAULT NULL COMMENT 'Terminos y condiciones',
  `usu_fechac` date DEFAULT NULL COMMENT 'Fecha de creacion usuario',
  `usu_horac` time DEFAULT NULL COMMENT 'Hora de creacion usuario',
  `usu_token` varchar(256) DEFAULT NULL COMMENT 'Token para comprobar el registro',
  `usu_codigo` int(11) DEFAULT NULL COMMENT 'Codigo para verificar el registro',
  `usu_codigo_vivo` tinyint(1) DEFAULT NULL COMMENT 'Tiempo valido para el codigo',
  `usu_fecham` date DEFAULT NULL COMMENT 'Fecha de modificacion usuario',
  `usu_horam` time DEFAULT NULL COMMENT 'Hora de modificacion usuario',
  `usu_detm` varchar(250) DEFAULT NULL COMMENT 'Detalle de la modificacion',
  `usu_rutafi` varchar(50) DEFAULT NULL,
  `usu_rutafidi` varchar(50) DEFAULT NULL COMMENT 'Firma digital',
  `id_api` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Registro de usuarios';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_apis`
--

CREATE TABLE `usuarios_apis` (
  `id_api_usuarios` int(11) NOT NULL,
  `callback_url` varchar(400) NOT NULL,
  `descripcion` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores_plantilla`
--

CREATE TABLE `valores_plantilla` (
  `id_valor_plantilla` int(11) NOT NULL,
  `id_plantilla` int(11) NOT NULL,
  `id_campos_plantillas` int(11) NOT NULL,
  `valores` varchar(300) DEFAULT NULL,
  `usu_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  ADD PRIMARY KEY (`actualizaId`);

--
-- Indices de la tabla `ado_records`
--
ALTER TABLE `ado_records`
  ADD PRIMARY KEY (`Record`);

--
-- Indices de la tabla `bolsas`
--
ALTER TABLE `bolsas`
  ADD PRIMARY KEY (`bolsaid`);

--
-- Indices de la tabla `campos_plantillas`
--
ALTER TABLE `campos_plantillas`
  ADD PRIMARY KEY (`id_campos_plantillas`),
  ADD KEY `id_plantilla` (`id_plantilla`);

--
-- Indices de la tabla `carpetas`
--
ALTER TABLE `carpetas`
  ADD PRIMARY KEY (`id_carpeta`);

--
-- Indices de la tabla `codigo_validacion`
--
ALTER TABLE `codigo_validacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalledocumento`
--
ALTER TABLE `detalledocumento`
  ADD PRIMARY KEY (`det_id`),
  ADD KEY `det_docume` (`det_docume`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `id_carpeta` (`id_carpeta`);

--
-- Indices de la tabla `juridico_usuario`
--
ALTER TABLE `juridico_usuario`
  ADD PRIMARY KEY (`id_juridico`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_persona_juridica` (`id_persona_juridica`) USING BTREE;

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`);

--
-- Indices de la tabla `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indices de la tabla `oauth_scopes`
--
ALTER TABLE `oauth_scopes`
  ADD PRIMARY KEY (`scope`);

--
-- Indices de la tabla `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`idparametro`);

--
-- Indices de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  ADD PRIMARY KEY (`id_plantilla`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `queue_fetch`
--
ALTER TABLE `queue_fetch`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles_usuario`
--
ALTER TABLE `roles_usuario`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `tipos_roles` (`rol_usuario`),
  ADD KEY `id_api` (`id_api`);

--
-- Indices de la tabla `usuarios_apis`
--
ALTER TABLE `usuarios_apis`
  ADD PRIMARY KEY (`id_api_usuarios`);

--
-- Indices de la tabla `valores_plantilla`
--
ALTER TABLE `valores_plantilla`
  ADD PRIMARY KEY (`id_valor_plantilla`),
  ADD KEY `id_valor_plantilla` (`id_valor_plantilla`),
  ADD KEY `id_campos_plantillas` (`id_campos_plantillas`),
  ADD KEY `id_plantilla` (`id_plantilla`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  MODIFY `actualizaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ado_records`
--
ALTER TABLE `ado_records`
  MODIFY `Record` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campos_plantillas`
--
ALTER TABLE `campos_plantillas`
  MODIFY `id_campos_plantillas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carpetas`
--
ALTER TABLE `carpetas`
  MODIFY `id_carpeta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigo_validacion`
--
ALTER TABLE `codigo_validacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalledocumento`
--
ALTER TABLE `detalledocumento`
  MODIFY `det_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `juridico_usuario`
--
ALTER TABLE `juridico_usuario`
  MODIFY `id_juridico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  MODIFY `id_plantilla` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `queue_fetch`
--
ALTER TABLE `queue_fetch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles_usuario`
--
ALTER TABLE `roles_usuario`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_apis`
--
ALTER TABLE `usuarios_apis`
  MODIFY `id_api_usuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `valores_plantilla`
--
ALTER TABLE `valores_plantilla`
  MODIFY `id_valor_plantilla` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campos_plantillas`
--
ALTER TABLE `campos_plantillas`
  ADD CONSTRAINT `campos_plantillas_ibfk_1` FOREIGN KEY (`id_plantilla`) REFERENCES `plantilla` (`id_plantilla`);

--
-- Filtros para la tabla `detalledocumento`
--
ALTER TABLE `detalledocumento`
  ADD CONSTRAINT `detalledocumento_ibfk_1` FOREIGN KEY (`det_docume`) REFERENCES `documento` (`doc_id`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_carpeta`) REFERENCES `carpetas` (`id_carpeta`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_usuario`) REFERENCES `roles_usuario` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_apis`
--
ALTER TABLE `usuarios_apis`
  ADD CONSTRAINT `usuarios_apis_ibfk_1` FOREIGN KEY (`id_api_usuarios`) REFERENCES `usuario` (`id_api`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valores_plantilla`
--
ALTER TABLE `valores_plantilla`
  ADD CONSTRAINT `valores_plantilla_ibfk_1` FOREIGN KEY (`id_campos_plantillas`) REFERENCES `campos_plantillas` (`id_campos_plantillas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valores_plantilla_ibfk_2` FOREIGN KEY (`id_plantilla`) REFERENCES `plantilla` (`id_plantilla`),
  ADD CONSTRAINT `valores_plantilla_ibfk_3` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valores_plantilla_ibfk_4` FOREIGN KEY (`doc_id`) REFERENCES `documento` (`doc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
