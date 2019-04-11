CREATE DATABASE IF NOT EXISTS instagram_laravel;
USE instagram_laravel;

CREATE TABLE IF NOT EXISTS usuarios(
    id int(255) auto_increment not null,
    rol varchar(20),
    name varchar(100),
    surname varchar(200),
    nickname varchar(100),
    email varchar(255),
    password varchar(255), 
    imagen varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),
    CONSTRAINT pk_usuarios PRIMARY KEY(id)
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS imagenes(
    id int(255) auto_increment not null,
    usuario_id int(255) not null,
    imagen_path varchar(255),
    descripcion text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_imagenes PRIMARY KEY(id),
    CONSTRAINT fk_imagenes_usuarios FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=innoDB;


CREATE TABLE IF NOT EXISTS comentarios(
    id int(255) auto_increment not null,
    usuario_id int(255) not null,
    imagen_id int(255) not null,
    contenido text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_comentarios PRIMARY KEY(id),
    CONSTRAINT fk_comentarios_usuarios FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_comentarios_imagenes FOREIGN KEY(imagen_id) REFERENCES imagenes(id)
)ENGINE=innoDB;


CREATE TABLE IF NOT EXISTS megustas(
    id int(255) auto_increment not null,
    usuario_id int(255) not null,
    imagen_id int(255) not null,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_megustas PRIMARY KEY(id),
    CONSTRAINT fk_megustas_usuarios FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_megustas_imagenes FOREIGN KEY(imagen_id) REFERENCES imagenes(id)
)ENGINE=innoDB;