
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
VALUES('admin'),('Reporte'),('incapacidad'),('techo');



INSERT INTO public.permisos
(descripcion)
VALUES('Mantenimiento techo');
INSERT INTO public.permisos
(descripcion)
VALUES('Generar Incapacidad');



INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(1, 1);
INSERT INTO public.roles_permisos
(id_rol, id_permiso)
VALUES(1, 2);

INSERT INTO public.usuarios
(nombrecompleto, idrol, acccion, fechacreacion, usuariocreacion, fechamodificacion, estado, usuario, contrasenia, cambiocontrasenia,medico)
VALUES('Denis Lopez', 1, 'medico', '2022-07-26', 'toor', '2022-11-14', true, 'admin', 'V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09',false,true);
INSERT INTO public.usuarios
(nombrecompleto, idrol, acccion, fechacreacion, usuariocreacion, fechamodificacion, estado, usuario, contrasenia, cambiocontrasenia,medico)
VALUES('fernando Lopez', 1, 'Secretaria', '2022-07-26', '006352', '2022-11-14', true, 'mp', 'V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09',true,false);




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


ALTER TABLE public.tb_expediente_preclinicas ADD persona_id int
----------------------
SELECT * from public.tb_signosvitales ts 
		inner join public.tb_persona tp 
		on CAST(ts.tb_persona AS INTEGER)  = tp.pidpersona
		and ts.pid=13
select * from public.tb_signosvitales
delete from public.tb_expediente
delete from public.tb_expediente_preclinicas

SELECT * FROM tb_Expediente_Preclinicas 
SELECT MAX(id_expediente) FROM public.tb_Expediente where estado=1

SELECT id_expediente FROM public.tb_Expediente limit 1

SELECT * from public.tb_expediente_preclinicas ep
INNER JOIN public.tb_expediente e
ON ep.id_expediente = e.id_expediente
and ep.id_expediente=8


select * from public.tb_expediente
select * from tb_signosvitales
INSERT INTO public.tb_expediente(Nombre,Id_Responsable,FechaCreacion,UsuarioCreacion) VALUES('EXP-2023-1155',1,NOW(),1)

SELECT * from public.usuarios where medico=true and estado=true
DELETE  from public.tb_Expediente_traslado
update public.tb_signosvitales set estado=1

ALTER TABLE public.tb_Expediente_traslado ADD CONSTRAINT expediente_traslado_fkey FOREIGN KEY (pId_Expediente) REFERENCES public.tb_signosVitales(pId);

-----------------
select * from public.tb_Catalogos tb where tb.ctipo='Estado-Civil' and tb.estado=true



select * from public.tb_signosvitales
select * from public.tb_Expediente_traslado
select * from public.tb_persona
SELECT * FROM public.tb_Catalogos tb where tb.estado=true
select * from public.usuarios where id_usuario=1;

update public.tb_signosVitales set estado=1 where pid=9
delete from public.tb_Expediente_traslado



select sv.pId, tp.pidenticacion,tp.pcodigo,tp.pnombre,tp.papellido,sv.motivo,sv.observacion,sv.fechacreacion from public.tb_persona tp
INNER JOIN public.tb_signosvitales sv
ON tp.pidpersona=CAST (sv.tb_persona AS INTEGER)
order by tp.pfechacreacion DESC
select * from public.tb_signosVitales 
SELECT * from public.usuarios where medico=true and estado=true usuario ='admin' and contrasenia='V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09' and estado=true

SELECT * FROM pg_catalog.pg_tables where schemaname='public'

select * from public.roles_permisos rp where rp.id_rol=1

select * from public.permisos 

select * from public.roles_permisos


select * from public.catalogos
select * from public.delitos

update public.usuarios set contrasenia='V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09' where id_usuario=1