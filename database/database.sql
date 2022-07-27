CREATE DATABASE tienda_master;
use tienda_master;

create table usuarios(
id          int(255) auto_increment not null,
nombre      varchar(100) not null,
apellidos   varchar(255),
email       varchar(100) not null,
pass        varchar(255) not null,
rol         varchar(20),    
image       varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(ID),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB;

INSERT INTO usuarios VALUES(null,'admin','admin','admin@admin','pass','admin',null);

CREATE table categorias(
id      INT(255) AUTO_INCREMENT NOT NULL,
nombre  VARCHAR(100) NOT NULL,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)Engine=InnoDB;

INSERT INTO categorias VALUES(null,'Manga Corta');
INSERT INTO categorias VALUES(null,'Manga Larga');
INSERT INTO categorias VALUES(null,'Polerones');

CREATE table productos(
id          INT(255) AUTO_INCREMENT NOT NULL,
categoria_id INT(255) NOT NULL,
nombre      VARCHAR(100) NOT NULL,
descripcion TEXT,
precio      FLOAT(100,2) NOT NULL,
stock       INT(11) NOT NULL,
oferta      VARCHAR(2),
fecha       DATE NOT NULL,
imagen      VARCHAR(255),
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_productos_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)Engine=InnoDb;

CREATE Table pedidos(
id          INT(255) AUTO_INCREMENT NOT NULL,
usuario_id  INT(255) NOT NULL,
provincia   VARCHAR(100) NOT NULL,
direccion   VARCHAR(255) NOT NULL,      
coste       FLOAT(200,2) NOT NULL,
estado      VARCHAR(20) not null,
fecha       DATE,
hora        TIME,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedidos_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)Engine=InnoDB;

CREATE Table detalle_pedido(
id          INT(255) AUTO_INCREMENT NOT NULL,
pedido_id   INT(255) NOT NULL,
producto_id INT(255) NOT NULL,
unidades    INT(10) NOT NULL,
total       FLOAT(200,2) NOT NULL,
CONSTRAINT pk_detalle_pedido PRIMARY KEY(id),
CONSTRAINT fk_detalle_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_detalle_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)Engine=InnoDB;