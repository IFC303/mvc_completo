
DROP SCHEMA IF EXISTS tragv2;
CREATE SCHEMA tragv2;
use tragv2;



/****** TABLA ROLES ******/
CREATE TABLE v2rol(
  id_rol int primary key,
  nombre varchar(30) not null
);

INSERT INTO v2rol (`id_rol`, `nombre`) VALUES (1, 'Administradores'), (2, 'Entrenadores'), (3, 'Socios');



/***** TABLA SOLCITUD SOCIO *****/

CREATE TABLE v2soli_socio(
    id_solicitud_soc int primary key AUTO_INCREMENT,
    fecha date not null,
    dni varchar (11),
    nombre varchar(50) not null,
    apellidos varchar(50) not null,
    cuenta varchar(25) not null,
    talla varchar(5) not null,
    fecha_nacimiento date not null,
    email varchar(50) not null,
    telefono int not null,
    direccion varchar(100) not null,
    ha_sido boolean not null,
    nom_pa varchar (50),
    ape_pa varchar (50),
    dni_pa varchar (11)
  );
  
-- INSERT INTO v2soli_socio (`id_solicitud_soc`, `fecha`, `dni`, `nombre`, `apellidos`, `cuenta`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `ha_sido`,`nom_pa`,`ape_pa`,`dni_pa`)
-- VALUES
-- (1, CURDATE(), '16220103C', 'Michael', 'Phelps', '01885542161558896338', 'L', '2001-07-06', 'MichaelPhelps@gmail.com', 640236578, 'Calle Belmonte San Jose 11', 0,'wwwwwww','wwww','77777'),
-- (2, CURDATE(), '55433788Q', 'Usain', 'Bolt', '20808970552360850257', 'L', '1995-07-15', 'UsainBolt@gmail.com', 634266578, 'Calle Caldereros 4', 0,'sssss','ddddd','87'),
-- (3, CURDATE(), '95198519R', 'Eliud', 'Kipchoge', '02164966847214050030', 'S', '1999-06-25', 'EliudKipchoge@gmail.com', 672645713, 'Avenida Huesca', 0,'xxxx','rrrr','8966'),
-- (4, CURDATE(), '77900901Q', 'Cris', 'Froome', '14901780288828069875', 'L', '2000-11-08', 'CrisFroome@gmail.com', 672645713, 'Avenida Huesca', 0,'wwww','gggg','1111');



/****** TABLA USUARIO ******/
CREATE TABLE v2usuario(
    id_usuario int AUTO_INCREMENT,
    fecha_acep date not null,
    dni varchar(11),
    nombre varchar(50) not null,
    apellidos varchar(50) not null,
    email varchar(50) not null,
    direccion varchar(150) not null,
    fecha_nacimiento date not null,
    telefono int not null,
    cuenta varchar(25) not null,
    passw varchar(50) not null,
    talla varchar(5) not null,
    foto varchar(800),
    gir varchar(20),
    ha_sido boolean not null,
    activado boolean not null,
    id_rol int not null,
    nom_pa varchar (20),
    ape_pa varchar (50),
    dni_pa varchar (11),
    primary key (id_usuario),
    constraint FK_id_rol_usu foreign key(id_rol) references v2rol (id_rol) on delete cascade on update cascade
  );


INSERT INTO v2usuario (`id_usuario`,`fecha_acep`, `dni`,`nombre`,`apellidos`,`email`,`direccion`,`fecha_nacimiento`,`telefono`,
`cuenta`,`passw`,`talla`,`foto`,`gir`,`ha_sido`,`activado`,`id_rol`,`nom_pa`,`ape_pa`,`dni_pa`) VALUES 
(11,CURDATE(),'11','admin','admin','admin@admin.com','dire','2000-1-1',11,'12345678989','21232f297a57a5a743894a0e4a801fc3','xl','foto','gir',1,1,1,'sssss','ddddd','87'),
(22,CURDATE(),'22','entrenador','entrenador','entrenador@entrenador.com','dire','2000-1-1',22,'','a990ba8861d2b344810851e7e6b49104','m','','',0,1,2,'wwwwwww','wwww','77777'),
(33,CURDATE(),'33','socio','socio','socio@socio.com','dire','2000-1-1',33,'','1b1844daa452df42c6f9123857ca686c','s','','',0,1,3,'wwwwwww','wwww','77777');



/**********TABLA TEMPORADA ********/
CREATE TABLE v2temporada(
    id_temp int primary key AUTO_INCREMENT,
    nombre varchar (100) not null,
    fecha_inicio date not null,
    fecha_fin date not null,
    estado tinyint,
    observaciones varchar (500)
  );


-- CREATE TABLE v2usuario_temporada(
--     id_temp int,
--     id_usuario int,
--     primary key (id_temp, id_usuario),
--     constraint FK_id_temp_usu_temp foreign key (id_temp) references v2temporada (id_temp) on delete cascade on update cascade,
--     constraint FK_id_usuario_usu_temp foreign key (id_usuario) references v2usuario (id_usuario) on delete cascade on update cascade
--   );
  

/**********TABLA ENTRENADOR ********/
CREATE TABLE v2entrenador(
    id_usuario int,
    sueldo int,
    constraint PK_id_usuario_entrena primary key (id_usuario),
    constraint FK_id_usuario_entrena foreign key (id_usuario) references v2usuario (id_usuario) on delete cascade on update cascade
  );



/********** TABLAS GRUPO ********/
CREATE TABLE v2grupo(
    id_grupo int primary key AUTO_INCREMENT,
    nombre varchar (50) not null,
    cuota varchar (5) not null,
    fecha_ini date not null,
    fecha_fin date not null,
    observaciones varchar(500)
  );

INSERT INTO v2grupo(`id_grupo`,`nombre`,`cuota`,`fecha_ini`,`fecha_fin`,`observaciones`) VALUES 
('1','ATLETISMO_GENERAL_BENJAMINES','20','2022/09/01','2022/09/30',''),
('2','ATLETISMO_GENERAL_ALEVINES','20','2022/09/01','2022/09/30',''),
('3','ATLETISMO_GENERAL_INFANTILES','20','2022/09/01','2022/09/30',''),
('4','PRUEBAS-VELOCIDAD','20','2022/09/01','2022/09/30',''),
('5','FONDO_Y_MEDIOFONDO','20','2022/09/01','2022/09/30',''),
('6','DIA_ENTRENAMIENTO','20','2022/09/01','2022/09/30',''),
('7','ESCUELA_TRIATLON','20','2022/09/01','2022/09/30','');



CREATE TABLE v2entrenador_grupo(
    fecha date,
    id_grupo int,
    id_usuario int,
    primary key (fecha, id_grupo, id_usuario),
    constraint FK_id_grupo_entrena_grupo foreign key (id_grupo) references v2grupo(id_grupo) on delete cascade on update cascade,
    constraint FK_id_usuario_entrena_grupo foreign key (id_usuario) references v2entrenador (id_usuario) on delete cascade on update cascade
  );


CREATE TABLE v2horario(
    id_horario int primary key AUTO_INCREMENT,
    dia_sem varchar(20),
    hora_ini varchar(20),
    hora_fin varchar(20)
  );


CREATE TABLE v2horario_grupo(
    id_horario int,
    id_grupo int,
    primary key (id_horario, id_grupo),
    constraint FK_id_horario_horario_grupo foreign key (id_horario) references v2horario (id_horario) on delete cascade on update cascade,
    constraint FK_id_grupo_horario_grupo foreign key (id_grupo) references v2grupo (id_grupo) on delete cascade on update cascade
  );




/***** TABLAS SOCIO *****/

CREATE TABLE v2socio(
    id_socio int primary key,
    familiar int,
    constraint FK_id_socio_socio foreign key (id_socio) references v2usuario (id_usuario) on delete cascade on update cascade,
    constraint FK_familiar_socio foreign key (familiar) references v2socio (id_socio) on delete cascade on update cascade
  );

  INSERT INTO v2socio (id_socio,familiar) values ('11',null),('22',null),('33',null);



/***** TABLAS TEST Y PRUEBAS *****/

CREATE TABLE v2test(
    id_test int primary key AUTO_INCREMENT,
    nombreTest varchar (30) not null,
    fecha_alta date not null,
    descripcion varchar(500)
);


CREATE TABLE v2prueba(
    id_prueba int primary key AUTO_INCREMENT,
    nombrePrueba varchar(50) not null,
    tipo varchar(50) not null
);


INSERT INTO v2prueba (`id_prueba`, `nombrePrueba`, `tipo`) VALUES
  (1, '60 m', 'Velocidad'),(2, '80 m', 'Velocidad'),(3, '100 m', 'Velocidad'),
  (4, '200 m', 'Velocidad'),(5, '400 m', 'Velocidad'),(6, '600 m', 'Medio fondo'),
  (7, '800 m ', 'Medio fondo'),(8, '1500 m ', 'Medio fondo'),(9, 'Milla', 'Medio fondo'),
  (10, '5000 m ', 'Fondo'),(11, '10000 m', 'Fondo'),(12, 'Media maraton', 'Fondo'),
  (13, 'Maraton', 'Fondo'),(14, '60', 'Obstaculos'),(15, '80', 'Obstaculos'),
  (16, '110', 'Obstaculos'),(17, '3000', 'Obstaculos'),(18, 'Longitud', 'Concursos'),
  (19, 'Altura', 'Concursos'),(20, 'Triple salto', 'Concursos'),(21, 'Pertiga', 'Concursos'),
  (22, 'Peso', 'Concursos'),(23, 'Martillo', 'Concursos'),(24, 'Jabalina', 'Concursos');


CREATE TABLE v2test_prueba(
    id_test int,
    id_prueba int,
    primary key (id_test, id_prueba),
    constraint FK_id_test_test_prueba foreign key (id_test) references v2test (id_test) on delete cascade on update cascade,
    constraint FK_id_prueba_test_prueba foreign key (id_prueba) references v2prueba (id_prueba) on delete cascade on update cascade
  );


CREATE TABLE v2prueba_socio(
	  id int auto_increment,
    id_prueba int,
    id_socio int,
    id_test int,
    fecha date not null,
    marca varchar (50) not null,
    velocidad varchar (20),
    observaciones varchar (500),
    primary key (id,id_prueba, id_socio, id_test),
    constraint FK_id_prueba_prueba_socio foreign key (id_prueba) references v2prueba(id_prueba) on delete cascade on update cascade,
    constraint FK_id_socio_prueba_socio foreign key (id_socio) references v2socio (id_socio) on delete cascade on update cascade,
	  constraint FK_id_test_prueba_socio foreign key (id_test) references v2test (id_test) on delete cascade on update cascade
  );



/***** TABLAS REFERENTES A CATEGORIA *****/

CREATE TABLE v2categoria(
    id_categoria int primary key,
    nombre_categoria varchar (40) not null,
    edad_min int not null,
    edad_max int not null
  );

INSERT INTO v2categoria (`id_categoria`,`nombre_categoria`,`edad_min`,`edad_max`)
VALUES  ('1', 'Benjamin', '8', '9'),('2', 'Alevin', '10', '11'),('3', 'Infantil', '12', '13'),('4', 'Adulto', '14', '99');


CREATE TABLE v2categoria_socio(
    id_categoria int,
    id_usuario int,
    fecha date,
    primary key (id_categoria, id_usuario, fecha),
    constraint FK_id_categoria_categoria_socio foreign key (id_categoria) references v2categoria (id_categoria) on delete cascade on update cascade,
    constraint FK_id_usuario_categoria_socio foreign key (id_usuario) references v2socio (id_socio) on delete cascade on update cascade
  );

  
CREATE TABLE v2licencia(
    id_licencia int primary key AUTO_INCREMENT,
    id_usuario int not null,
    imagen_licen varchar(800),
    fecha_alta date,
    num_licencia varchar(50),
    fecha_cad date,
    id_categoria int not null,
    dorsal int,
    regional_nacional varchar (10),
    constraint FK_id_usuario_licencia foreign key (id_usuario) references v2socio (id_socio) on delete cascade on update cascade,
    constraint FK_id_categoria_licencia foreign key (id_categoria) references v2categoria (id_categoria) on delete cascade on update cascade
  );



/***** TABLA SOLICITUD ESCUELA *****/

create table v2soli_grupo(
    id_soli_grupo int primary key AUTO_INCREMENT,
    fecha_soli date,
    dni varchar (11),
    nombre varchar(50) not null,
    apellidos varchar(50) not null,
    cuenta varchar(25) not null,
    fecha_nacimiento date not null,
    email varchar(50) not null,
    telefono int not null,
    direccion varchar(150) not null,
    gir varchar(50),
    id_categoria int not null,
    id_grupo int not null,
    es_socio boolean not null,
    usuario int null,
    nom_pa varchar (50),
    ape_pa varchar (50),
    dni_pa varchar (11),
    pago varchar(100),
    foto varchar(100),
    estado varchar (5),
    constraint FK_id_categoria_solicitud_grupo foreign key (id_categoria) references v2categoria (id_categoria) on delete cascade on update cascade,
    constraint FK_id_grupo_solicitud_grupo foreign key (id_grupo) references v2grupo (id_grupo) on delete cascade on update cascade
);


CREATE TABLE v2socio_grupo(
    id_grupo int,
    id_usuario int,
    fecha_acep date not null,
    aceptado boolean not null,
    activo boolean not null,
    id_categoria int,
    primary key (id_grupo, id_usuario),
    constraint FK_id_grupo_socio_grupo foreign key (id_grupo) references v2grupo (id_grupo) on delete cascade on update cascade,
    constraint FK_id_usuario_socio_grupo foreign key (id_usuario) references v2usuario(id_usuario) on delete cascade on update cascade,
    constraint FK_id_categoria_socio_grupo foreign key (id_categoria) references v2categoria (id_categoria) on delete cascade on update cascade
  );




/********** TABLA ENTIDADES *******/

CREATE TABLE v2entidad(
    id_entidad int primary key AUTO_INCREMENT,
    cif varchar (15),
    nombre varchar (50) not null,
    direccion varchar (200) not null,
    telefono int(9) not null,
    email varchar(50) null,
    observaciones varchar (300)
  );



/********** TABLAS EVENTOS Y PARTICIPANTES *******/

CREATE TABLE v2evento(
    id_evento int primary key AUTO_INCREMENT,
    id_usuario int,
    nombre varchar (50) not null,
    tipo varchar (30) not null,
    precio int,
    descripcion varchar (400),
    fecha_ini date not null,
    fecha_fin date not null,
    fecha_ini_inscrip date not null,
    fecha_fin_inscrip date not null,
    constraint FK_id_usuario_evento foreign key (id_usuario) references v2entrenador (id_usuario) on delete cascade on update cascade
  );


-- INSERT INTO `EVENTO` (`id_evento`, `id_usuario`, `nombre`, `tipo`, `precio`, `descripcion`, `fecha_ini`, `fecha_fin`, `fecha_ini_inscrip`, `fecha_fin_inscrip`) VALUES
-- (1, NULL, '10k Alcañiz', 'carrera', 10, '0', '2022-04-10', '2022-04-11', '2022-03-15', '2022-04-04'),
-- (2, NULL, 'III Triatlón Escolar', 'triatlón', 10, '0', '2022-05-01', '2022-05-02', '2022-03-22', '2022-04-22'),
-- (3, NULL, 'Campus Atletismo', 'campus', 100, '0', '2022-04-12', '2022-04-20', '2022-03-22', '2022-04-05'),
-- (4, NULL, 'Triatlón Estanca', 'triatlón', 20, '0', '2022-06-04', '2022-06-05', '2022-03-22', '2022-05-20');



CREATE TABLE v2participante(
    id_participante int primary key AUTO_INCREMENT,
    id_evento int,
    fecha_aceptacion date,
    nombre varchar (50) not null,
    apellidos varchar (100) not null,
    dni varchar (11),
    fecha_nacimiento date not null,
    direccion varchar (200),
    email varchar (100) not null,
    telefono int (15) not null,
    dorsal int,
    marca varchar (50),
    foto_pago varchar (200),
    constraint FK_id_evento_participante foreign key (id_evento) references v2evento (id_evento) on delete cascade on update cascade
  );

-- INSERT INTO v2participante (`id_participante`, `id_evento`, `nombre`, `apellidos`, `dni`, `fecha_nacimiento`,`direccion` , `email`, `telefono`, `dorsal`, `marca`,`foto`) VALUES
-- (1, 1, 'Maria', 'Gracia', '73386618N', '1995-07-14','', 'MariaGracia@gamil.com', 457215485, NULL, NULL,''),
-- (2, 1, 'Jose', 'Rodriguez', '99922045V', '1997-08-14','', 'JoseRodriguez@gamil.com', 640685678, NULL, NULL,''),
-- (3, 1, 'Daniel', 'Perez', '07063289N', '2000-07-08','', 'DanielPerez@gamil.com', 640685678, NULL, NULL,''),
-- (4, 1, 'Carmen', 'Martin', '03081415J', '2001-08-11','', 'CarmenMartin@gmail.com', 640297865, NULL, NULL,'');


 CREATE TABLE v2soli_evento(
    id_solicitud int AUTO_INCREMENT,
    id_evento int,
    fecha date not null,
    nombre varchar (50) not null,
    apellidos varchar (100) not null,
    dni varchar (11),
    fecha_nacimiento date not null,
    direccion varchar (200) not null,
    email varchar (100) not null,
    telefono int (15) not null,
    foto varchar (200),
    estado int(1),
    primary key (id_solicitud,id_evento),
    constraint FK__id_evento_solicitud_evento foreign key (id_evento) references v2evento (id_evento) on delete cascade on update cascade
  );





/************ TABLA REFERENTES A FACTURACION ************/

  CREATE TABLE v2gasto(
    id_gastos int primary key AUTO_INCREMENT,
    fecha date not null,
    tipo varchar (50),
    importe int not null,
    id_usuario int,
    id_entidad int,
    observaciones varchar(500),
    constraint FK_id_usuario_gastos foreign key (id_usuario) references v2usuario (id_usuario) on delete cascade on update cascade,
    constraint FK_id_entidad_gastos foreign key (id_entidad) references v2entidad (id_entidad) on delete cascade on update cascade
  );


CREATE TABLE v2ingreso(
    id_ingreso int primary key AUTO_INCREMENT,
    fecha date not null,
    tipo varchar (50),
    importe int not null,
    id_entidad int,
    id_participante int,
    id_usuario int,
    observaciones varchar (500) not null,
    constraint FK_id_entidad foreign key (id_entidad) references v2entidad (id_entidad) on delete cascade on update cascade,
    constraint FK_id_participante foreign key (id_participante) references v2participante(id_participante) on delete cascade on update cascade,
    constraint FK_id_usuario foreign key (id_usuario) references v2usuario (id_usuario) on delete cascade on update cascade
  );



/*********** TABLAS REFRENTES A EQUIPACIONES  *********/

CREATE TABLE v2equipacion(
    id_equipacion int primary key AUTO_INCREMENT,   
    tipo varchar(100) not null,
    imagen varchar (800),
    descripcion varchar (1000),
    precio int(5) not null,
    temporada varchar(25),
    id_ingreso int,
    id_gastos int,
    constraint FK_id_ingreso_equipacion foreign key (id_ingreso) references v2ingreso (id_ingreso) on delete cascade on update cascade,
    constraint FK_id_gastos_equipacion foreign key (id_gastos) references v2gasto (id_gastos) on delete cascade on update cascade
  );


CREATE TABLE v2talla(
  id_talla int primary key AUTO_INCREMENT,
  nombre varchar(100) not null
);
insert into v2talla (id_talla,nombre) values (1,'7-8'), (2,'9-10'),(3,'11-12'),(4,'13-14'),(5,'XS'),(6,'S'),(7,'M'),(8,'L'),(9,'XL'),(10,'XXL');


  create table v2talla_equipacion(
    id_equipacion int,
    id_talla int,
    primary key(id_equipacion,id_talla),
     constraint FK_id_equipacion_talla_equipacion foreign key (id_equipacion) references v2equipacion (id_equipacion) on delete cascade on update cascade,
    constraint FK_id_talla_talla_equipacion foreign key (id_talla) references v2talla (id_talla) on delete cascade on update cascade
  );


CREATE TABLE v2soli_equipacion(
    id_soli_equi int AUTO_INCREMENT,
    id_usuario int,
    id_equipacion int, 
    fecha_peticion date not null,
    talla varchar(100) not null,
    estado int(1) not null,
    cantidad int not null,
    primary key (id_soli_equi, id_usuario, id_equipacion),
    constraint FK_id_usuario_soli_equi foreign key (id_usuario) references v2usuario (id_usuario) on delete cascade on update cascade,
    constraint FK_id_equipacion_soli_equi foreign key (id_equipacion) references v2equipacion(id_equipacion) on delete cascade on update cascade
);


/************************** TABLA MARCAS PERSONALES **************/
CREATE TABLE v2seguimiento(
    id_seguimiento int AUTO_INCREMENT,
    id_usuario int,
    fecha date, 
    kilometros varchar (10),
    metros varchar (10),
    tiempo varchar (20),
    velocidad float,
    ritmo float,
    observaciones varchar(500),
    primary key (id_seguimiento, id_usuario),
    constraint FK_id_usuario_seguimiento foreign key (id_usuario) references v2usuario (id_usuario) on delete cascade on update cascade
);


/************************** VISTAS **************/

create view v2grupos_y_horarios as
select
  v2horario_grupo.id_grupo, v2grupo.nombre, v2grupo.fecha_ini, v2grupo.fecha_fin, v2horario_grupo.id_horario,
  v2horario.dia_sem, v2horario.hora_ini, v2horario.hora_fin
from v2horario_grupo, v2grupo, v2horario
where
  v2horario_grupo.id_grupo = v2grupo.id_grupo
  and v2horario_grupo.id_horario = v2horario.id_horario;



create view v2grupos_x_entrenador as 
SELECT v2entrenador_grupo.id_grupo, v2grupo.nombre, v2socio_grupo.id_usuario as id_alumno,
  CONCAT(v2usuario.nombre,' ',v2usuario.apellidos) as alumno, email,
  v2entrenador_grupo.id_usuario as entrenador
from v2entrenador_grupo, v2usuario, v2grupo, v2socio_grupo
where v2socio_grupo.id_grupo = v2grupo.id_grupo and v2socio_grupo.id_usuario = v2usuario.id_usuario
and v2entrenador_grupo.id_grupo = v2grupo.id_grupo;


-- create view EMAIL as
-- select
--   nombre,
--   apellidos,
--   email,
--   "Administradores" as tipo
-- from
--   USUARIO
-- where
--   id_rol = 1
-- UNION
-- select
--   nombre,
--   apellidos,
--   email,
--   "Entrenadores" as tipo
-- from
--   USUARIO
-- where
--   id_rol = 2
-- union
-- select
--   nombre,
--   apellidos,
--   email,
--   "Socios" as tipo
-- from
--   USUARIO
-- where
--   id_rol = 3
-- union
-- select
--   nombre,
--   apellidos,
--   email,
--   "Tiendas" as tipo
-- from
--   USUARIO
-- where
--   id_rol = 4
-- union
-- select
--   nombre,
--   apellidos,
--   email,
--   "Participantes" as tipo
-- from
--   EXTERNO
-- union
-- select
--   nombre,
--   "" as apellidos,
--   email,
--   "Entidades" as tipo
-- from
--   OTRAS_ENTIDADES;
