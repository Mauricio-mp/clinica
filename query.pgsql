
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



select * from public.usuarios where id_usuario=1;


SELECT * from public.usuarios where usuario ='admin' and contrasenia='V1crWVRzbnQxMHgyM3kvdnlIa0NXZz09' and estado=true

SELECT * FROM pg_catalog.pg_tables where schemaname='public'

select * from public.roles_permisos rp where rp.id_rol=1

select * from public.permisos 

select * from public.roles_permisos


