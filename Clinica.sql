CREATE DATABASE clinica

CREATE TABLE public.permisos (
	id_permiso serial4 NOT NULL,
	descripcion varchar(150) NOT NULL,
	CONSTRAINT permisos_pkey PRIMARY KEY (id_permiso)
);

CREATE TABLE public.roles (
	id_rol serial4 NOT NULL,
	descripcion varchar NOT NULL,
	CONSTRAINT roles_pkey PRIMARY KEY (id_rol)
);
CREATE TABLE public.roles_permisos (
	id_rol int4 NULL,
	id_permiso int4 NULL
);



ALTER TABLE public.roles_permisos ADD CONSTRAINT roles_permisos_id_permiso_fkey FOREIGN KEY (id_permiso) REFERENCES public.permisos(id_permiso);
ALTER TABLE public.roles_permisos ADD CONSTRAINT roles_permisos_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.roles(id_rol);

CREATE TABLE public.usuarios
 (
	id_usuario serial4 NOT NULL,
	nombrecompleto varchar(150) NULL,
	idrol int4 NULL,
	acccion varchar(255) NULL,
	fechacreacion date NULL,
	usuariocreacion varchar(150) NULL,
	fechamodificacion date NULL,
	estado bool NULL,
	usuario varchar(150) NULL,
	contrasenia varchar(200) NULL,
	cambiocontrasenia bool null,
	medico bool null,
	CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario),
    FOREIGN KEY(idrol)
    REFERENCES public.roles(id_rol)
);




INSERT INTO public.roles
(descripcion)
VALUES('doctor'),('Secretaria'),('Reportes'),('admin');





INSERT INTO public.permisos
(descripcion)
VALUES('doctor');
INSERT INTO public.permisos
(descripcion)
VALUES('Secretaria');
INSERT INTO public.permisos
(descripcion)
VALUES('Reporte_general');
INSERT INTO public.permisos
(descripcion)
VALUES('Reporte_mes');
INSERT INTO public.permisos
(descripcion)
VALUES('Reporte_Normal');


INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(1, 1);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(1, 2);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(2, 2);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(3, 3);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(3, 4);

INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(4, 1);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(4, 2);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(4, 3);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(4, 4);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(4, 5);


INSERT INTO public.usuarios
(nombrecompleto, idrol, acccion, fechacreacion, usuariocreacion, fechamodificacion, estado, usuario, contrasenia, cambiocontrasenia,medico)
VALUES('Sandra Isabel Coello Posas', 1, 'medico', '2023-07-31', 'admin', '2022-11-14', true, 'tmzapata', 'V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09',false,true);
INSERT INTO public.usuarios
(nombrecompleto, idrol, acccion, fechacreacion, usuariocreacion, fechamodificacion, estado, usuario, contrasenia, cambiocontrasenia,medico)
VALUES('Ddenis Mauricio Lopez', 4, 'medico', '2023-07-31', 'admin', '2022-11-14', true, 'dmlopez', 'V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09',false,true);
INSERT INTO public.usuarios
(nombrecompleto, idrol, acccion, fechacreacion, usuariocreacion, fechamodificacion, estado, usuario, contrasenia, cambiocontrasenia,medico)
VALUES('Tania Melissa Zapata Pineda', 1, 'Secretaria', '2023-07-31', 'admin', '2023-07-31', true, 'sicouello', 'V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09',true,false);




-------------- 
create table tb_persona (
	pIdPersona serial primary KEY,
	pIdenticacion VARCHAR(150),
    pCodigo VARCHAR(150) null,
    pNombre VARCHAR(150) null,
    pApellido VARCHAR(150) null,
    pFechaNAcimiento timestamp null,
    pEdad int null,
    pSexo VARCHAR(2),
    pEstadoCivil VARCHAR(150) NULL,
    pOcupacion VARCHAR(150) NULL,
    pDependencia VARCHAR(150) NULL,
    pReligion VARCHAR(150) NULL,
    pRazan VARCHAR(150) NULL,
    pTipoSanguineo VARCHAR(150) NULL,
    pResidenciaActual VARCHAR(250) null,
    pFechaCreacion timestamp null,
    pusuarioCreacion VARCHAR(50),
    pultimaMdoficacion timestamp,
    usuarioModificacion VARCHAR(50)
    
);

create table tb_signosVitales (
	pId serial primary KEY,
	tb_persona VARCHAR(10),
	PresionArterial VARCHAR(10),
    FrecuenciaCardiaca VARCHAR(10),
    Pulso VARCHAR(10),
    FrecuenciaRespiratoria VARCHAR(10),
    TerperaturaCorporal VARCHAR(10),
    SaturacionOxigeno VARCHAR(10),
    Glucosa VARCHAR(10),
    Peso VARCHAR(10),
    Talla VARCHAR(10),
    IMC VARCHAR(10),
	motivo VARCHAR(255),
	Estado int,
	Observacion VARCHAR(255),
    FechaCreacion timestamp,
    UsuarioCreacion VARCHAR(15)
    
);
create table tb_Catalogos (
	cId serial primary KEY,
	cNombre VARCHAR(150),
	ctipo VARCHAR(150),
    estado boolean,
    FechaIngreso timestamp,
    usuarioIngreso VARCHAR(15)
    
);

INSERT INTO public.tb_Catalogos (cnombre,ctipo,estado,fechaingreso,usuarioingreso) 
VALUES('Soltero (a)','Estado-Civil',true,NOW(),'sistema'),
('Casado (a)','Estado-Civil',true,NOW(),'sistema'),
('No Aplica','Estado-Civil',true,NOW(),'sistema'),
('Viudo (a)','Estado-Civil',true,NOW(),'sistema'),
('Unión de Hecho','Estado-Civil',true,NOW(),'sistema'),
('Divorciado (a)','Estado-Civil',true,NOW(),'sistema');


INSERT INTO public.tb_Catalogos (cnombre,ctipo,estado,fechaingreso,usuarioingreso) 
VALUES('A+','Tipo-Sangre',true,NOW(),'sistema'),
('O+','Tipo-Sangre',true,NOW(),'sistema'),
('B+','Tipo-Sangre',true,NOW(),'sistema'),
('AB+','Tipo-Sangre',true,NOW(),'sistema'),
('A-','Tipo-Sangre',true,NOW(),'sistema'),
('O-','Tipo-Sangre',true,NOW(),'sistema'),
('B-','Tipo-Sangre',true,NOW(),'sistema'),
('AB-','Tipo-Sangre',true,NOW(),'sistema');



create table tb_Expediente_traslado (
    pId_SignosViatles serial primary KEY,
    pId_Expediente INT NULL,
	Usuario_emisor varchar(25) null,
	responsable int null,
    estado int null,
    Fecha_traslado timestamp,

      CONSTRAINT pk_relacion_traslado
      FOREIGN KEY(pId_SignosViatles) 
	  REFERENCES tb_signosVitales(pId)
    
);

create table tb_Expediente (
    Id_Expediente serial primary KEY,
    Nombre VARCHAR (255) NOT NULL,
    Id_Responsable INT NOT NULL,
	FechaCreacion timestamp,
    UsuarioCreacion int,
    Estado INT NOT NULL,
    sp varchar(255) NULL,
    hea varchar(255) NULL,
    fog varchar(255) NULL,
      CONSTRAINT pk_relacion_Responsable
      FOREIGN KEY(Id_Responsable) 
	  REFERENCES usuarios(id_usuario)
    
    
);



create table tb_Expediente_Preclinicas (
    Id_Expediente INT NOT NULL,
    pId_Signos INT NOT NULL,
    Id_Persona varchar(150) NOT NULL,
	FechaCreacion timestamp,

      CONSTRAINT pk_Expediente_id
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

       CONSTRAINT pk_Signos_id
      FOREIGN KEY(pId_Signos) 
	  REFERENCES tb_signosVitales(pId)

      
    
    
);
create table tb_Expediente_Antecedentes (
    id_Antecedente serial primary KEY, 
    Id_Expediente INT NOT NULL,
    pId_Signos INT NOT NULL,
    APP VARCHAR(255) null,
    AF VARCHAR(255) null,
    AHQT VARCHAR(255) null,
    Alergias VARCHAR(255) null,
    Vacunas VARCHAR(255) null,
    AE VARCHAR(255) null,
    Habitos_Toxicos VARCHAR(255) null,
    Habitos_no_Toxicos VARCHAR(255) null,
    Habitos_saludables VARCHAR(255) null,
    Antecedentes_Go VARCHAR(255) null,
	FechaCreacion timestamp,
    estado boolean,


      CONSTRAINT pk_Expediente_id
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

      CONSTRAINT pk_Signos_id
      FOREIGN KEY(pId_Signos) 
	  REFERENCES tb_signosVitales(pId)
);

create table tb_Expediente_Examen_Fisico (
    id_examen serial primary KEY, 
    Id_Expediente INT NOT NULL,
    pId_Signos INT NOT NULL,
    AparienciaGeneral varchar(255) NOT NULL,
    Cabeza varchar(255) NULL,
    Cuello varchar(255) NULL,
    Torax varchar(255) NULL,
    Corazon varchar(255) NULL,
    Pulmones varchar(255) NULL,
    Mamas varchar(255) NULL,
    Abdomen varchar(255) NULL,
    Genitales varchar(255) NULL,
    OsteoMuscular varchar(255) NULL,
    Exremidades varchar(255) NULL,
    Piel varchar(255) NULL,
    Neurologicos varchar(255) NULL,
	FechaCreacion timestamp,
    UsuarioCreacion int NULL,
    estado boolean,

      CONSTRAINT pk_Expediente_id
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

      CONSTRAINT pk_Signos_id
      FOREIGN KEY(pId_Signos) 
	  REFERENCES tb_signosVitales(pId)   
);
create table tb_Expediente_Examen_laboratorial (
    id_laboratorial serial primary KEY, 
    Id_Expediente INT NOT NULL,
    pId_Signos INT NOT NULL,
    Hemograma varchar(255) NOT NULL,
    Quimica_General varchar(255) NULL,
    EGO varchar(255) NULL,
    EGH varchar(255) NULL,
    covid varchar(255) NULL,
    otros varchar(255) NULL,
	FechaCreacion timestamp,
    UsuarioCreacion int NULL,
    estado boolean,

      CONSTRAINT pk_Expediente_id
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

      CONSTRAINT pk_Signos_id
      FOREIGN KEY(pId_Signos) 
	  REFERENCES tb_signosVitales(pId)    
);



ALTER TABLE public.tb_expediente_preclinicas ADD persona_id int;

ALTER TABLE public.tb_Expediente ADD Finalizado varchar(25) NULL;
ALTER TABLE public.tb_Expediente ADD Diagnostico varchar(500) NULL;
ALTER TABLE public.tb_Expediente ADD Tratamiento varchar(500) NULL;
ALTER TABLE public.tb_Expediente ADD Incapacidad varchar(500) NULL;
ALTER TABLE public.tb_signosVitales ADD Fecha_Inicio varchar(50) NULL;
ALTER TABLE public.tb_signosVitales ADD Fecha_Fin varchar(50) NULL;
ALTER TABLE public.tb_signosVitales ADD Finalizado varchar(50) NULL;
ALTER TABLE public.tb_signosVitales ADD TipodeAtencion int NULL;

ALTER TABLE public.tb_persona ADD telefono VARCHAR(25);
ALTER TABLE public.tb_Expediente ADD Incapacidad_Inicio timestamp NULL;
ALTER TABLE public.tb_Expediente ADD Incapacidad_FIn timestamp NULL;
ALTER TABLE public.tb_Expediente ADD Cant_dias_Incapacidad int NULL;

INSERT INTO public.tb_catalogos(cnombre,ctipo,estado,fechaingreso,usuarioingreso)
values('Administracion de Medicamentos','Tipo-Atencion',true,now(),'sistema'),
('Nebulizacines','Tipo-Atencion',true,now(),'sistema'),
('Toma de PA','Tipo-Atencion',true,now(),'sistema'),
('Control de Peso','Tipo-Atencion',true,now(),'sistema'),
('Toma de GLC','Tipo-Atencion',true,now(),'sistema'),
('Toma de Temperatura','Tipo-Atencion',true,now(),'sistema'),
('Limpieza de Heridas','Tipo-Atencion',true,now(),'sistema'),
('Lavado de Oidos','Tipo-Atencion',true,now(),'sistema'),
('Consulta medica','Tipo-Atencion',true,now(),'sistema');


ALTER TABLE public.tb_persona ADD habilitado boolean;
ALTER TABLE public.tb_signosVitales ADD anulado boolean;
ALTER TABLE public.tb_signosVitales ADD esnuevo boolean;

create table tb_Expediente_Datos_Generales (
    id_general serial primary KEY, 
    Id_Expediente INT NOT NULL,
pId_Signos INT NOT NULL,
    Sintoma_Principal varchar(255) NOT NULL,
    Historial_Enfer varchar(255) NULL,
    Fun_organ_gen varchar(255) NULL,
	FechaCreacion timestamp,
    UsuarioCreacion int NULL,
    estado boolean,

      CONSTRAINT pk_Expediente_id
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

      CONSTRAINT pk_Signos_id
      FOREIGN KEY(pId_Signos) 
	  REFERENCES tb_signosVitales(pId)  
);
create table tb_Expediente_Empleado (
    id_Expediente INT NOT NULL, 
    Id_persona INT NOT NULL,
	FechaCreacion timestamp,

      CONSTRAINT pk_Expediente_Exp
      FOREIGN KEY(id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),    

       CONSTRAINT pk_Persona_Per
      FOREIGN KEY(Id_persona) 
	  REFERENCES tb_persona(pidpersona)   
);

create table tb_Expediente_Diagnostico (
    id_Diagnostico serial primary KEY, 
    Id_Expediente INT NOT NULL,
    pId_Signos INT NOT NULL,
    Descripcion varchar(255) NOT NULL,
	FechaCreacion timestamp,
    UsuarioCreacion int NULL,
    estado boolean,

      CONSTRAINT pk_Expediente_Diag
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

      CONSTRAINT pk_Signos_id
      FOREIGN KEY(pId_Signos) 
	  REFERENCES tb_signosVitales(pId)  
);
create table tb_Expediente_Tratamiento (
    id_Tratamiento serial primary KEY, 
    Id_Diagnostico INT NOT NULL,
    Id_Expediente INT NOT NULL,
    Descripcion varchar(255) NOT NULL,
	FechaCreacion timestamp,
    UsuarioCreacion int NULL,
    estado boolean,

      CONSTRAINT pk_Expediente_Trat
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

       CONSTRAINT pk_Expediente_Diag
      FOREIGN KEY(Id_Diagnostico) 
	  REFERENCES tb_Expediente_Diagnostico(id_Diagnostico)   

);

create table tb_Expediente_Incapacidades (
    id_Incapacidad serial primary KEY, 
    Id_Expediente INT NOT NULL,
    pId_Signos INT NOT NULL,
    FechaInicio timestamp,
    FechaFin timestamp,
    Dias INT NOT NULL,
    Descripcion varchar(255) NOT NULL,
	FechaCreacion timestamp,
    UsuarioCreacion int NULL,
    estado boolean,

      CONSTRAINT pk_Expediente_Trat
      FOREIGN KEY(Id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),

       CONSTRAINT pk_Signos_id
      FOREIGN KEY(pId_Signos) 
	  REFERENCES tb_signosVitales(pId)  

);


---------------------------------------------------------------
select * from tb_persona 
select * from tb_signosVitales where pid >22
SELECT * FROM tb_catalogos where ctipo='Tipo-Sangre'
select * from tb_Expediente_Diagnostico

delete from tb_signosVitales
delete from tb_Expediente_traslado
----------------------------------------------------------------------


create table tb_Expediente_Empleado (
    id_Expediente INT NOT NULL, 
    Id_persona INT NOT NULL,
	FechaCreacion timestamp,

      CONSTRAINT pk_Expediente_Exp
      FOREIGN KEY(id_Expediente) 
	  REFERENCES tb_Expediente(Id_Expediente),    

       CONSTRAINT pk_Persona_Per
      FOREIGN KEY(Id_persona) 
	  REFERENCES tb_persona(pidpersona)   
);

drop database clinica
create database clinica
SELECT  * FROM pg_stat_activity WHERE datname='clinica';
SELECT pg_terminate_backend(106269);
SELECT pg_terminate_backend(54904);
---------------------------------------------------------------
select max(pid_signos) from tb_Expediente_Preclinicas where id_Expediente=1

select TO_CHAR (fechainicio:: DATE, 'dd/mm/YYYY') as fechaInicio,TO_CHAR (fechafin:: DATE, 'dd/mm/YYYY') as 
fechaFin,dias,descripcion,fechacreacion from tb_Expediente_Incapacidades where id_Expediente=:id

select * from public.permisos

SELECT ed.id_diagnostico,ed.pid_signos,ed.id_expediente,ed.descripcion,TO_CHAR(ed.fechacreacion, 'DD/MM/YYYY') AS fechacreacion,ed.usuariocreacion,ed.estado from
 tb_expediente_diagnostico ed where ed.id_expediente=2 and ed.pid_signos=2  order by ed.id_diagnostico desc