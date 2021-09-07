/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.6.17 : Database - db_master_bbh
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `accesregister` */

CREATE TABLE `accesregister` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `acceso` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `accesregister` */

LOCK TABLES `accesregister` WRITE;

insert  into `accesregister`(`id`,`idUser`,`acceso`) values (1,2,'Null'),(2,3,'QkXtEdt3UzY5xezWiJZN');

UNLOCK TABLES;

/*Table structure for table `asignacion` */

CREATE TABLE `asignacion` (
  `idAsignacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_Tecnico` int(11) DEFAULT NULL,
  `id_Incidencia` int(11) DEFAULT NULL,
  `Fecha_Asignacion` date DEFAULT NULL,
  `Hora_Asignacion` time DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `RCB` char(1) DEFAULT NULL,
  PRIMARY KEY (`idAsignacion`),
  KEY `FK_asignacion` (`id_Incidencia`),
  KEY `FK_asignacion1` (`id_Tecnico`),
  CONSTRAINT `FK_asignacion` FOREIGN KEY (`id_Incidencia`) REFERENCES `incidencia` (`idIncidencia`),
  CONSTRAINT `FK_asignacion1` FOREIGN KEY (`id_Tecnico`) REFERENCES `tecnico` (`idTecnico`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `asignacion` */

LOCK TABLES `asignacion` WRITE;

insert  into `asignacion`(`idAsignacion`,`id_Tecnico`,`id_Incidencia`,`Fecha_Asignacion`,`Hora_Asignacion`,`Estado`,`RCB`) values (9,2,1,'2016-01-28','15:14:00','0','1'),(10,2,2,'2016-01-28','15:15:00','0','1'),(11,2,3,'2016-01-29','12:12:00','0','1'),(12,2,4,'2016-01-29','12:20:00','0','1');

UNLOCK TABLES;

/*Table structure for table `calificaciontecnico` */

CREATE TABLE `calificaciontecnico` (
  `idCalificacion` int(11) NOT NULL AUTO_INCREMENT,
  `Calificacion` char(4) DEFAULT NULL,
  `id_Usuario` int(11) DEFAULT NULL,
  `id_incidencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCalificacion`),
  KEY `FK_calificaciontecnico` (`id_Usuario`),
  KEY `FK_calificaciontecnico1` (`id_incidencia`),
  CONSTRAINT `FK_calificaciontecnico` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `FK_calificaciontecnico1` FOREIGN KEY (`id_incidencia`) REFERENCES `incidencia` (`idIncidencia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `calificaciontecnico` */

LOCK TABLES `calificaciontecnico` WRITE;

insert  into `calificaciontecnico`(`idCalificacion`,`Calificacion`,`id_Usuario`,`id_incidencia`) values (1,'4',1,1);

UNLOCK TABLES;

/*Table structure for table `cargo` */

CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `Cargo` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `id_Departamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCargo`),
  KEY `FK_cargo` (`id_Departamento`),
  CONSTRAINT `FK_cargo5` FOREIGN KEY (`id_Departamento`) REFERENCES `departamento` (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `cargo` */

LOCK TABLES `cargo` WRITE;

insert  into `cargo`(`idCargo`,`Cargo`,`Descripcion`,`id_Departamento`) values (1,'Auxiliar de sistemas',NULL,1),(2,'jefe departamental',NULL,1),(3,'Director',NULL,1),(4,'Coordinador',NULL,1),(5,'Secretaria(o)',NULL,1),(6,'Asistente',NULL,1);

UNLOCK TABLES;

/*Table structure for table `departamento` */

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `Departamento` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `departamento` */

LOCK TABLES `departamento` WRITE;

insert  into `departamento`(`idDepartamento`,`Departamento`,`Descripcion`) values (1,'Tecnogia De La Informacion y Com',NULL);

UNLOCK TABLES;

/*Table structure for table `documentos` */

CREATE TABLE `documentos` (
  `id_documentos` int(11) NOT NULL AUTO_INCREMENT,
  `num_seguimiento` varchar(15) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `asunto` varchar(500) DEFAULT NULL,
  `remitente` varchar(50) DEFAULT NULL,
  `id_tipo_doc` int(11) DEFAULT NULL,
  `estado_doc` char(2) DEFAULT NULL,
  `img` blob,
  `tipo` varchar(10) DEFAULT NULL,
  `documento_ident` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_documentos`),
  KEY `FK_documentos` (`id_tipo_doc`),
  CONSTRAINT `FK_documentos` FOREIGN KEY (`id_tipo_doc`) REFERENCES `tipo_doc` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `documentos` */

LOCK TABLES `documentos` WRITE;

insert  into `documentos`(`id_documentos`,`num_seguimiento`,`titulo`,`asunto`,`remitente`,`id_tipo_doc`,`estado_doc`,`img`,`tipo`,`documento_ident`) values (11,'DC0000000000006','sdcsd','sfsd','khlk',1,'0','','',NULL);

UNLOCK TABLES;

/*Table structure for table `envio_doc` */

CREATE TABLE `envio_doc` (
  `id_envio_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) DEFAULT NULL,
  `id_user_recp` int(11) DEFAULT NULL,
  `id_user_env` int(11) DEFAULT NULL,
  `fecha_env` date DEFAULT NULL,
  `hora_env` time DEFAULT NULL,
  PRIMARY KEY (`id_envio_doc`),
  KEY `FK_envio_doc` (`id_doc`),
  CONSTRAINT `FK_envio_doc` FOREIGN KEY (`id_doc`) REFERENCES `documentos` (`id_documentos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `envio_doc` */

LOCK TABLES `envio_doc` WRITE;

UNLOCK TABLES;

/*Table structure for table `incidencia` */

CREATE TABLE `incidencia` (
  `idIncidencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_Tipo_incidencia` int(11) DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  `Hora_Ingreso` time DEFAULT NULL,
  `Prioridad` char(1) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `RCB` char(1) DEFAULT NULL COMMENT '0 si no ah sido recibido, 1 si ya fue recibido',
  `estado` char(1) DEFAULT NULL COMMENT '0 sin atender, 2 en proceso, 3 resuelto',
  `obcervacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idIncidencia`),
  KEY `FK_incidencia` (`Id_Usuario`),
  KEY `FK_incidencia0` (`id_Tipo_incidencia`),
  CONSTRAINT `FK_incidencia` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `FK_incidencia0` FOREIGN KEY (`id_Tipo_incidencia`) REFERENCES `tipoinicidencia` (`id_incidencia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `incidencia` */

LOCK TABLES `incidencia` WRITE;

insert  into `incidencia`(`idIncidencia`,`id_Tipo_incidencia`,`Fecha_Ingreso`,`Hora_Ingreso`,`Prioridad`,`Id_Usuario`,`RCB`,`estado`,`obcervacion`) values (1,2,'2016-01-28','09:25:00','2',1,'1','1','Problemas de Impresion '),(2,3,'2016-01-28','12:37:00','3',1,'1','1','hcgfv b'),(3,4,'2016-01-29','12:11:00','2',1,'1','1','sdfghjk'),(4,1,'2016-01-29','12:11:00','2',1,'1','1','sdrtfyghjkl;'),(5,6,'2016-01-29','12:11:00','1',1,'1','0','asdfghjkl;');

UNLOCK TABLES;

/*Table structure for table `ipregistro` */

CREATE TABLE `ipregistro` (
  `id_ip` int(11) NOT NULL AUTO_INCREMENT,
  `pc` varchar(300) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `caracteristicas` varchar(5000) DEFAULT NULL,
  `IP` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ipregistro` */

LOCK TABLES `ipregistro` WRITE;

UNLOCK TABLES;

/*Table structure for table `logs` */

CREATE TABLE `logs` (
  `idLogs` int(11) NOT NULL AUTO_INCREMENT,
  `Hora_Inicio` time DEFAULT NULL,
  `Hora_Fin` time DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Ip` varchar(20) DEFAULT NULL,
  `id_Usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idLogs`),
  KEY `FK_logs` (`id_Usuario`),
  CONSTRAINT `FK_logs` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `logs` */

LOCK TABLES `logs` WRITE;

UNLOCK TABLES;

/*Table structure for table `mensajes` */

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(100) NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `mensajes` */

LOCK TABLES `mensajes` WRITE;

insert  into `mensajes`(`id`,`mensaje`,`timestamp`,`status`,`tipo`) values (1,'Hola mar','2014-05-05 02:22:38',1,1),(2,'Como te v Fernando','2014-05-05 02:22:53',1,2),(3,'Quee haces Laura','2014-05-05 02:23:01',1,3),(4,'Adios Adios Cesar','2014-05-05 02:23:18',1,4),(5,'Bye','2014-05-05 02:23:29',1,4),(16,'buenas noches. como esta.','2014-05-05 03:07:29',1,1),(17,'que tal fernanda','2014-05-05 03:07:49',1,2),(18,'buenas noches laura','2014-05-05 03:07:58',1,3),(19,'cesar estas ahi???','2014-05-05 03:10:52',1,4),(20,'hola 123','2014-05-05 03:16:13',1,1),(21,'send email','2014-05-05 03:16:42',1,1),(22,'tipo, mensaje','2014-05-05 03:23:13',1,2),(23,'aaaaa','2014-05-05 03:24:10',1,1),(24,'asasas','2014-05-05 03:25:17',1,1),(25,'ffff','2014-05-05 03:25:25',1,1),(26,'','2014-05-05 03:25:31',1,1),(27,'sdasdasd','2014-05-05 03:26:05',1,1),(28,'aaaaaaa','2014-05-05 03:26:44',1,2),(29,'aaaaaaa','2014-05-05 03:27:28',1,3),(30,'aaaaaaa','2014-05-05 03:27:55',1,1),(31,'aaaaaaa','2014-05-05 03:28:11',1,4),(32,'aaaaaa','2014-05-05 03:28:23',1,4);

UNLOCK TABLES;

/*Table structure for table `persona` */

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `Cedula` varchar(10) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Foto` mediumblob,
  `id_Cargo` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `iddepartamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPersona`),
  KEY `FK_persona` (`id_Cargo`),
  CONSTRAINT `FK_persona` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo` (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `persona` */

LOCK TABLES `persona` WRITE;

insert  into `persona`(`idPersona`,`Cedula`,`Nombres`,`Apellidos`,`Telefono`,`Email`,`Foto`,`id_Cargo`,`type`,`iddepartamento`) values (1,'1207340472','Angel Humberto','Mosquera Coronel','0997660892','angel.mosquera@babahoyo.gob.ec',NULL,1,NULL,NULL),(2,'1205847872','Pedro Julio ','Navarrete','0979777626','pejunavi-2484@hotmail.com','',1,'',NULL),(3,'1207340470','angel humberto','mosquera coronel','099660892','angelmoz1992@gmail.com','',1,'',NULL);

UNLOCK TABLES;

/*Table structure for table `proceso` */

CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `preceso` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `proceso` */

LOCK TABLES `proceso` WRITE;

insert  into `proceso`(`id_proceso`,`preceso`) values (1,'CERTIFICADO DE NO SER DEUDOR'),(2,'REBAJA POR 3ERA EDAD'),(3,'CERTIFICADO DE AVALUO'),(4,'CATASTRO DE ESCRITURA'),(5,'MEDICION DE SOLAR'),(6,'LINEA DE FABRICA'),(7,'PERMISO HIGIENE AMBIENTAL'),(8,'CERTIFICADO DE BIEN RAIZ'),(9,'PERMISO DE PATENTE'),(10,'CIERRE DE PATENTE'),(11,'PERMISO DE CONSTRUCCION'),(12,'PERMISO DE VIA PUBLICA'),(13,'PRESCRIPCION'),(14,'PLAN REGULADOR'),(15,'CERTIFICADO DE NO POSEER BIENES INMUEBLES'),(16,'CERTIFICADOS E INSCRIPCIONES'),(17,'REGISTRO INQUILINATO'),(18,'REGISTRO DE LA PROPIEDAD'),(19,'CERTIFICADO DE GRAVAMEN'),(20,'REIMPRESIONES'),(21,'COMPRA DE SOLAR'),(22,'COMPRA DE EXCEDENTE'),(23,'REBAJA POR DISCAPACIDAD'),(24,'CONTRATO DE ARRIENDO PARA MERCADO'),(25,'PERMISO DE OCUPACION DE MERCADO'),(26,'CERTIFICADO USO DE SUELO'),(27,'RECLAMO ADMINISTRATIVO'),(28,'INSPECCION PARA CLAVE'),(29,'INSPECCION PARA REAVALUO');

UNLOCK TABLES;

/*Table structure for table `recep_documeto` */

CREATE TABLE `recep_documeto` (
  `id_recep_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `fecha_recp` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id_recep_doc`),
  KEY `FK_recep_documeto` (`id_doc`),
  KEY `FK_recep_documeto0` (`id_user`),
  CONSTRAINT `FK_recep_documeto` FOREIGN KEY (`id_doc`) REFERENCES `documentos` (`id_documentos`),
  CONSTRAINT `FK_recep_documeto0` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `recep_documeto` */

LOCK TABLES `recep_documeto` WRITE;

insert  into `recep_documeto`(`id_recep_doc`,`id_doc`,`id_user`,`fecha_recp`,`hora`) values (1,11,1,'2016-02-05','03:01:00');

UNLOCK TABLES;

/*Table structure for table `reporte` */

CREATE TABLE `reporte` (
  `idReporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_Asignacion` int(11) DEFAULT NULL,
  `Titulo` varchar(200) DEFAULT NULL,
  `Reperte` varchar(2000) DEFAULT NULL,
  `Documento` longblob,
  `tipo` varchar(10) DEFAULT NULL,
  `progreso` int(11) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `RCB` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReporte`),
  KEY `FK_reporte` (`id_Asignacion`),
  CONSTRAINT `FK_reporte` FOREIGN KEY (`id_Asignacion`) REFERENCES `asignacion` (`idAsignacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `reporte` */

LOCK TABLES `reporte` WRITE;

UNLOCK TABLES;

/*Table structure for table `rol` */

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `TipoRol` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `rol` */

LOCK TABLES `rol` WRITE;

insert  into `rol`(`idRol`,`TipoRol`) values (1,'Root'),(2,'Admin'),(3,'Tecnico'),(4,'Usuario'),(5,'81dc9bdb52d04dc20036dbd8313ed055');

UNLOCK TABLES;

/*Table structure for table `tecnico` */

CREATE TABLE `tecnico` (
  `idTecnico` int(11) NOT NULL AUTO_INCREMENT,
  `id_Usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTecnico`),
  KEY `FK_tecnico` (`id_Usuario`),
  CONSTRAINT `FK_tecnico` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tecnico` */

LOCK TABLES `tecnico` WRITE;

insert  into `tecnico`(`idTecnico`,`id_Usuario`) values (1,1),(2,2);

UNLOCK TABLES;

/*Table structure for table `tipo_doc` */

CREATE TABLE `tipo_doc` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tipo` varchar(50) DEFAULT NULL,
  `descripcion_tipo` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tipo_doc` */

LOCK TABLES `tipo_doc` WRITE;

insert  into `tipo_doc`(`id_tipo`,`nom_tipo`,`descripcion_tipo`) values (1,'Memo',NULL);

UNLOCK TABLES;

/*Table structure for table `tipoinicidencia` */

CREATE TABLE `tipoinicidencia` (
  `id_incidencia` int(11) NOT NULL AUTO_INCREMENT,
  `incidencia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_incidencia`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tipoinicidencia` */

LOCK TABLES `tipoinicidencia` WRITE;

insert  into `tipoinicidencia`(`id_incidencia`,`incidencia`) values (1,'El ordenador no enciende '),(2,'La impresora no enciende '),(3,'Problemas de software '),(4,'Problemas con el internet'),(5,'Problemas con el ordenador '),(6,'Problemas para imprimir'),(7,'Necesito asesoría'),(8,'Problemas con el teléfono');

UNLOCK TABLES;

/*Table structure for table `tramite` */

CREATE TABLE `tramite` (
  `id_tramite` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) DEFAULT NULL,
  `nombres` varchar(150) DEFAULT NULL,
  `ruc` varchar(13) DEFAULT NULL,
  `claves_municipales` varchar(100) DEFAULT NULL,
  `fecha` varchar(40) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_preceso` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `estado` char(1) DEFAULT '0',
  `representante` varchar(200) DEFAULT NULL,
  `solciClaves` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tramite`),
  KEY `FK_tramite` (`id_preceso`),
  KEY `FK_tramite0` (`id_usuario`),
  CONSTRAINT `FK_tramite` FOREIGN KEY (`id_preceso`) REFERENCES `proceso` (`id_proceso`),
  CONSTRAINT `FK_tramite0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tramite` */

LOCK TABLES `tramite` WRITE;

insert  into `tramite`(`id_tramite`,`cedula`,`nombres`,`ruc`,`claves_municipales`,`fecha`,`hora`,`id_preceso`,`id_usuario`,`descripcion`,`estado`,`representante`,`solciClaves`) values (00000001,'1207340470','ANGEL HUMBERTO MOSQUERA CORONEL','asasd','asc','Martes 23 de Febrero del 2016','14:28:50',1,1,'asdasdas','e','asx','as'),(00000002,'1207340470','ANGEL MOSQUERA CORONEL','1200000000001','011121211','Martes 23 de Febrero del 2016','14:28:50',11,1,'zsfgf','e','asx','012215415'),(00000003,'1207340470','ANGEL MOSQUERA CORONEL','1200000000001','011121211','Martes 23 de Febrero del 2016','14:28:50',11,1,'zsfgf','e','asx','012215415'),(00000004,'1207340470','ANGEL MOSQUERA CORONEL','1200000000001','011121211','Martes 23 de Febrero del 2016','14:28:50',11,1,'zsfgf','e','asx','012215415'),(00000005,'1207340470','ANGEL MOSQUERA CORONEL','1200000000001','011121211','Martes 23 de Febrero del 2016','14:28:50',11,1,'zsfgf','e','asx','012215415'),(00000006,'1207340470','ANGEL MOSQUERA CORONEL','1200000000001','011121211','Martes 23 de Febrero del 2016','14:28:50',11,1,'zsfgf','e','asx','012215415'),(00000007,'1234','aaa','$222','222','22222222','00:22:00',1,1,'ddd','0','dd','33');

UNLOCK TABLES;

/*Table structure for table `usuario` */

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_Persona` int(11) DEFAULT NULL,
  `Usuario` varchar(20) DEFAULT NULL,
  `Pass` varchar(250) DEFAULT NULL,
  `id_Rol` int(11) DEFAULT NULL,
  `Estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FK_usuario` (`id_Rol`),
  KEY `FK_usuario1` (`id_Persona`),
  CONSTRAINT `FK_usuario` FOREIGN KEY (`id_Rol`) REFERENCES `rol` (`idRol`),
  CONSTRAINT `FK_usuario1` FOREIGN KEY (`id_Persona`) REFERENCES `persona` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

LOCK TABLES `usuario` WRITE;

insert  into `usuario`(`idUsuario`,`id_Persona`,`Usuario`,`Pass`,`id_Rol`,`Estado`) values (1,1,'Amosquera','827ccb0eea8a706c4c34a16891f84e7b',4,'A'),(2,2,'PNavarrete','37d729b945a5c834c90977d2d0291a92',3,'A'),(3,3,'amosquera','506a5a0543d47193b5aedde26eb34190',4,'I');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;