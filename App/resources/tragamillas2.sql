DROP SCHEMA IF EXISTS tragamillas2;

CREATE SCHEMA tragamillas2;

use tragamillas2;

CREATE TABLE ROL(
  id_rol int primary key,
  nombre varchar(30) not null
);

INSERT INTO
  `ROL` (`id_rol`, `nombre`)
VALUES
  (1, 'admin');

INSERT INTO
  `ROL` (`id_rol`, `nombre`)
VALUES
  (2, 'entrenador');

INSERT INTO
  `ROL` (`id_rol`, `nombre`)
VALUES
  (3, 'socio');

INSERT INTO
  `ROL` (`id_rol`, `nombre`)
VALUES
  (4, 'tienda');

CREATE TABLE USUARIO(
  id_usuario int AUTO_INCREMENT,
  dni varchar(11) unique,
  nombre varchar(20) not null,
  apellidos varchar(30) not null,
  email varchar(40) not null,
  fecha_nacimiento varchar (20),
  telefono int not null,
  CCC varchar(25) not null,
  passw varchar(50),
  talla varchar(5) not null,
  foto varchar(800),
  activado boolean not null,
  id_rol int,
  primary key (id_usuario),
  constraint FK_id_rol_usu foreign key(id_rol) references ROL (id_rol) on delete cascade on update cascade
);

INSERT INTO
  `USUARIO` (
    `id_usuario`,
    `dni`,
    `nombre`,
    `apellidos`,
    `email`,
    `fecha_nacimiento`,
    `telefono`,
    `CCC`,
    `passw`,
    `talla`,
    `foto`,
    `activado`,
    `id_rol`
  )
VALUES
  (
    11,
    '11',
    'admin',
    'admin',
    'admin@admin.com',
    '1/1/2000',
    11,
    '',
    '21232f297a57a5a743894a0e4a801fc3',
    'l',
    '',
    1,
    1
  );

INSERT INTO
  `USUARIO` (
    `id_usuario`,
    `dni`,
    `nombre`,
    `apellidos`,
    `email`,
    `fecha_nacimiento`,
    `telefono`,
    `CCC`,
    `passw`,
    `talla`,
    `foto`,
    `activado`,
    `id_rol`
  )
VALUES
  (
    22,
    '22',
    'entrenador',
    'entrenador',
    'entrenador@entrenador.com',
    '1/1/2000',
    22,
    '',
    'a990ba8861d2b344810851e7e6b49104',
    'm',
    '',
    1,
    2
  );

INSERT INTO
  `USUARIO` (
    `id_usuario`,
    `dni`,
    `nombre`,
    `apellidos`,
    `email`,
    `fecha_nacimiento`,
    `telefono`,
    `CCC`,
    `passw`,
    `talla`,
    `foto`,
    `activado`,
    `id_rol`
  )
VALUES
  (
    33,
    '33',
    'socio',
    'socio',
    'socio@socio.com',
    '1/1/2000',
    33,
    '',
    '1b1844daa452df42c6f9123857ca686c',
    's',
    '',
    1,
    3
  );

INSERT INTO
  `USUARIO` (
    `id_usuario`,
    `dni`,
    `nombre`,
    `apellidos`,
    `email`,
    `fecha_nacimiento`,
    `telefono`,
    `CCC`,
    `passw`,
    `talla`,
    `foto`,
    `activado`,
    `id_rol`
  )
VALUES
  (
    44,
    '44',
    'tienda',
    'tienda',
    'tienda@tienda.com',
    '1/1/2000',
    44,
    '',
    '1a07afe7fc2c54d466d12569f05fb391',
    'xl',
    '',
    1,
    4
  );

CREATE TABLE TEMPORADA(
  id_temp int primary key,
  fecha_inicio date not null,
  fecha_fin date not null
);

CREATE TABLE USUARIO_x_TEMPORADA(
  id_temp int,
  id_usuario int,
  primary key (id_temp, id_usuario),
  constraint FK_id_temp_usu_temp foreign key (id_temp) references TEMPORADA (id_temp) on delete cascade on update cascade,
  constraint FK_id_usuario_usu_temp foreign key (id_usuario) references USUARIO (id_usuario) on delete cascade on update cascade
);

CREATE TABLE ENTRENADOR(
  id_usuario int,
  sueldo int,
  constraint PK_id_usuario_entrena primary key (id_usuario),
  constraint FK_id_usuario_entrena foreign key (id_usuario) references USUARIO (id_usuario) on delete cascade on update cascade
);

CREATE TABLE G_PERSONAL (
  id_gasto int primary key,
  fecha date,
  concepto varchar (500),
  importe int,
  id_usuario int,
  constraint FK_id_usuario_gpers foreign key (id_usuario) references ENTRENADOR (id_usuario) on delete cascade on update cascade
);

CREATE TABLE GRUPO(
  id_grupo int primary key,
  nombre varchar (40),
  fecha_ini date,
  fecha_fin date
);

CREATE TABLE ENTRENADOR_GRUPO(
  fecha date,
  id_grupo int,
  id_usuario int,
  primary key (fecha, id_grupo, id_usuario),
  constraint FK_id_grupo_entrena_grupo foreign key (id_grupo) references GRUPO (id_grupo) on delete cascade on update cascade,
  constraint FK_id_usuario_entrena_grupo foreign key (id_usuario) references ENTRENADOR (id_usuario) on delete cascade on update cascade
);

CREATE TABLE HORARIO(
  id_horario int primary key,
  dia_sem varchar(20),
  hora_ini varchar(20),
  hora_fin varchar(20)
);

CREATE TABLE HORARIO_GRUPO(
  id_horario int,
  id_grupo int,
  primary key (id_horario, id_grupo),
  constraint FK_id_horario_horario_grupo foreign key (id_horario) references HORARIO (id_horario) on delete cascade on update cascade,
  constraint FK_id_grupo_horario_grupo foreign key (id_grupo) references GRUPO (id_grupo) on delete cascade on update cascade
);

CREATE TABLE SOLICITUD_SOCIO(
  id_solicitud_soc int primary key,
  DNI varchar (11) unique,
  nombre varchar(20) not null,
  apellidos varchar(30) not null,
  CCC varchar(25) not null,
  talla varchar(5) not null,
  fecha_nacimiento date not null,
  email varchar(40) not null
);

CREATE TABLE SOLICITUD_EXT_SOLO_SI_SOCIO(
  id_solicitud_soc int,
  id_grupo int,
  acepatado boolean,
  fecha date,
  primary key (id_solicitud_soc, id_grupo),
  constraint FK_id_solicitud_soc_solicitud_ext_solo_si_socio foreign key (id_solicitud_soc) references SOLICITUD_SOCIO (id_solicitud_soc) on delete cascade on update cascade,
  constraint FK_id_grupo_solicitud_ext_solo_si_socio foreign key (id_grupo) references GRUPO (id_grupo) on delete cascade on update cascade
);

CREATE TABLE SOCIO(
  id_socio int primary key,
  familiar int,
  constraint FK_id_socio_socio foreign key (id_socio) references USUARIO (id_usuario) on delete cascade on update cascade,
  constraint FK_familiar_socio foreign key (familiar) references SOCIO (id_socio) on delete cascade on update cascade
);

CREATE TABLE SOCIO_GRUPO(
  id_grupo int,
  id_usuario int,
  fecha_inscripcion date not null,
  acepatado boolean not null,
  activo boolean not null,
  primary key (id_grupo, id_usuario, fecha_inscripcion),
  constraint FK_id_grupo_socio_grupo foreign key (id_grupo) references GRUPO (id_grupo) on delete cascade on update cascade,
  constraint FK_id_usuario_socio_grupo foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade
);

CREATE TABLE LICENCIA(
  id_licencia int primary key,
  id_usuario int,
  imagen varchar(800) not null,
  num_licencia int not null,
  fecha_cad date not null,
  tipo varchar (30) not null,
  dorsal int,
  regional_nacional varchar (10),
  constraint FK_id_usuario_licencia foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade
);

CREATE TABLE PRUEBA(
  id_prueba int primary key,
  nombrePrueba varchar(30) not null,
  tipo varchar(40) not null
);

INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (1,'60 m','Velocidad');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (2,'80 m','Velocidad');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (3,'100 m','Velocidad');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (4,'200 m','Velocidad');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (5,'400 m','Velocidad');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (6,'600 m','Medio fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (7,'800 m ','Medio fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (8,'1500 m ','Medio fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (9,'Milla','Medio fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (10,'5000 m ','Fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (11,'10000 m','Fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (12,'Media maraton','Fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (13,'Maraton','Fondo');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (14,'60','Obstaculos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (15,'80','Obstaculos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (16,'110','Obstaculos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (17,'3000','Obstaculos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (18,'Longitud','Concursos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (19,'Altura','Concursos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (20,'Triple salto','Concursos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (21,'Pertiga','Concursos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (22,'Peso','Concursos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (23,'Martillo','Concursos');
INSERT INTO `PRUEBA` (`id_prueba`,`nombrePrueba`,`tipo`) VALUES (24,'Jabalina','Concursos');

CREATE TABLE PRUEBA_SOCIO(
  id_prueba int,
  id_usuario int,
  fecha date,
  marca varchar (50),
  primary key (id_prueba, id_usuario, fecha),
  constraint FK_id_prueba_prueba_socio foreign key (id_prueba) references PRUEBA (id_prueba) on delete cascade on update cascade,
  constraint FK_id_usuario_prueba_socio foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade
);

CREATE TABLE TEST(
  id_test int primary key,
  nombreTest varchar (30)
  );

INSERT INTO
  `TEST` (
    `id_test`,
    `nombreTest`
  )
VALUES
  (
    1,
    'test primavera'
  );

INSERT INTO
  `TEST` (
    `id_test`,
    `nombreTest`
  )
VALUES
  (
    2,
    'test invierno'
  );


CREATE TABLE TEST_PRUEBA(
  id_test int,
  id_prueba int,
  primary key (id_test, id_prueba),
  constraint FK_id_test_test_prueba foreign key (id_test) references TEST (id_test) on delete cascade on update cascade,
  constraint FK_id_prueba_test_prueba foreign key (id_prueba) references PRUEBA (id_prueba) on delete cascade on update cascade
);

CREATE TABLE CATEGORIA(
  id_categoria int primary key,
  nombre varchar (40) not null,
  edad_min int not null,
  edad_max int not null
);

CREATE TABLE CATEGORIA_SOCIO(
  id_categoria int,
  id_usuario int,
  fecha date,
  primary key (id_categoria, id_usuario, fecha),
  constraint FK_id_categoria_categoria_socio foreign key (id_categoria) references CATEGORIA (id_categoria) on delete cascade on update cascade,
  constraint FK_id_usuario_categoria_socio foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade
);

CREATE TABLE OTRAS_ENTIDADES(
  id_entidad int primary key,
  nombre varchar (40) not null,
  tipo varchar (30)
);

CREATE TABLE I_OTROS(
  id_ingreso_otros int primary key,
  fecha date not null,
  concepto varchar (500) not null,
  importe int not null,
  id_entidad int,
  constraint FK_id_entidad_i_otros foreign key (id_entidad) references OTRAS_ENTIDADES (id_entidad) on delete cascade on update cascade
);

CREATE TABLE G_OTROS(
  id_gastos int primary key,
  fecha date not null,
  concepto varchar (500) not null,
  importe int not null,
  id_usuario int,
  id_entidad int,
  constraint FK_id_usuario_g_otros foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade,
  constraint FK_id_entidad_g_otros foreign key (id_entidad) references OTRAS_ENTIDADES (id_entidad) on delete cascade on update cascade
);

CREATE TABLE I_CUOTAS(
  id_ingreso_cuota int primary key,
  fecha date not null,
  concepto varchar (500) not null,
  importe int not null,
  tipo varchar (30),
  id_usuario int,
  constraint FK_id_usuario_i_cuotas foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade
);

CREATE TABLE EQUIPACION(
  id_equipacion int primary key,
  talla varchar(5) not null,
  fecha_peticion date not null,
  id_usuario int,
  id_ingreso_cuota int,
  id_gastos int,
  constraint FK_id_usuario_equipacion foreign key (id_usuario) references USUARIO (id_usuario) on delete cascade on update cascade,
  constraint FK_id_ingreso_cuota_equipacion foreign key (id_ingreso_cuota) references I_CUOTAS (id_ingreso_cuota) on delete cascade on update cascade,
  constraint FK_id_gastos_equipacion foreign key (id_gastos) references G_OTROS (id_gastos) on delete cascade on update cascade
);

CREATE TABLE EVENTO(
  id_evento int primary key,
  id_usuario int,
  nombre varchar (50) not null,
  tipo varchar (30) not null,
  precio int,
  descuento varchar (20),
  fecha_ini date not null,
  fecha_fin date not null,
  constraint FK_id_usuario_evento foreign key (id_usuario) references ENTRENADOR (id_usuario) on delete cascade on update cascade
);

CREATE TABLE SOLICITUD_EVENTO(
  id_solicitud_evento int primary key,
  fecha_ini date not null,
  fecha_fin date not null
);

CREATE TABLE SOLICITUD_SOCIO_EVENTO(
  id_usuario int,
  id_evento int,
  id_solicitud_evento int,
  fecha date,
  primary key (
    id_usuario,
    id_evento,
    id_solicitud_evento,
    fecha
  ),
  constraint FK_id_usuario_solicitud_socio_evento foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade,
  constraint FK_id_evento_solicitud_socio_evento foreign key (id_evento) references EVENTO (id_evento) on delete cascade on update cascade,
  constraint FK_id_solicitud_evento_solicitud_socio_evento foreign key (id_solicitud_evento) references SOLICITUD_EVENTO (id_solicitud_evento) on delete cascade on update cascade
);

CREATE TABLE SOCIO_EVENTO(
  id_usuario int,
  id_evento int,
  marca varchar (50),
  fecha date not null,
  dorsal int,
  primary key (id_usuario, id_evento),
  constraint FK_id_usuario_socio_evento foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade,
  constraint FK_id_evento_socio_evento foreign key (id_evento) references EVENTO (id_evento) on delete cascade on update cascade
);

CREATE TABLE EXTERNO(
  id_externo int primary key,
  id_evento int,
  nombre varchar (30) not null,
  apellidos varchar (50) not null,
  DNI varchar (11) unique,
  fecha_nacimiento date not null,
  email varchar (50) not null,
  dorasl int,
  marca varchar (50),
  constraint FK_id_evento_externo foreign key (id_evento) references EVENTO (id_evento) on delete cascade on update cascade
);

CREATE TABLE SOLICITUD_EXTER_EVENTO(
  id_externo int,
  id_evento int,
  id_solicitud_evento int,
  fecha date,
  primary key (
    id_externo,
    id_evento,
    id_solicitud_evento,
    fecha
  ),
  constraint FK_id_externo_solicitud_exter_evento foreign key (id_externo) references EXTERNO (id_externo) on delete cascade on update cascade,
  constraint FK__id_eventosolicitud_exter_evento foreign key (id_evento) references EVENTO (id_evento) on delete cascade on update cascade,
  constraint FK_id_solicitud_evento_solicitud_exter_evento foreign key (id_solicitud_evento) references SOLICITUD_EVENTO (id_solicitud_evento) on delete cascade on update cascade
);

CREATE TABLE ING_ACTIVIDADES(
  id_ingreso_actividades int primary key,
  id_externo int,
  id_usuario int,
  id_evento int,
  fecha date not null,
  concepto varchar (500) not null,
  importe int,
  constraint FK_id_externo_ing_actividades foreign key (id_externo) references EXTERNO (id_externo) on delete cascade on update cascade,
  constraint FK_id_evento_ing_actividades foreign key (id_evento) references EVENTO (id_evento) on delete cascade on update cascade,
  constraint FK_id_usuario_ing_actividades foreign key (id_usuario) references SOCIO (id_socio) on delete cascade on update cascade
);