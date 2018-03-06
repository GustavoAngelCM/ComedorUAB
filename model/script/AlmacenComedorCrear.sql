DROP DATABASE IF EXISTS  AlmacenComedor;
CREATE DATABASE AlmacenComedor;
USE AlmacenComedor;


CREATE TABLE TipoUsuario(
    idTipoUsuario int not null auto_increment primary key,
    nombreTipo varchar(40) not null
);

CREATE TABLE Usuarios(
    idUsuario int  not null auto_increment primary key,
    idTipoUsuario int not null,
    usuario varchar(25) unique not null,
    contrasena text not null,
    email varchar(45) not null,
    estado bool not null,
    FOREIGN KEY(idTipoUsuario)REFERENCES TipoUsuario(idTipoUsuario)ON UPDATE CASCADE ON DELETE CASCADE
);

-- 1 unidad de medida
create table udiadMedida (
    idUnidMedida int not null auto_increment primary Key,
    nombre varchar(30)not null,
    abreviatura varchar(30)not null
);

-- 2 categoria producto
create table categoriaProducto (
    idCatProducto int not null auto_increment primary Key,
    nombreCategoria varchar(30)not null
);

-- 3 producto
create table producto (
    idProducto int not null auto_increment primary Key,
    nombreProducto varchar(30)not null,
    idUnidMedida int not null,
    idCatProducto int not null,
    FOREIGN KEY (idCatProducto) REFERENCES categoriaProducto(idCatProducto) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idUnidMedida) REFERENCES udiadMedida(idUnidMedida) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 4 Categoria Plato
CREATE TABLE categoriaPlato (
	idCategoria int not null auto_increment primary key,
	nombre varchar(30) not null
);

-- 5 Plato
CREATE TABLE plato (
	idPlato int not null auto_increment primary key,
	idCategoria int,
	nombre varchar(50) not null,
	imagen text null,
	FOREIGN KEY(idCategoria) REFERENCES categoriaPlato (idCategoria) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 6 receta
create table receta(
    idReceta int not null auto_increment primary Key,
    idProducto int not null,
    idPlato int not null,
    cantidadProducto float(8,2) not null,
    FOREIGN KEY (idPlato) REFERENCES plato(idPlato) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idProducto) REFERENCES producto (idProducto) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 7 Almacen
CREATE TABLE almacen(
    idAlmacen int not null auto_increment primary key,
    idProducto int not null,
    cantidad float(8,2) not null,
    FOREIGN KEY (idProducto) REFERENCES producto (idProducto) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 8 Detalle de Almacen
CREATE TABLE detalleAlmacen(
    idDetalle int not null auto_increment primary key,
    idAlmacen int not null,
    cantidadIngresada float not null,
    fechaVencimiento date null,
    precioTotal float(8,2) not null,
    fechaRegistro timestamp not null,
    idUsuario int not null,
    FOREIGN KEY (idAlmacen) REFERENCES almacen (idAlmacen) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 9  Factura
CREATE TABLE factura(
    idFactura int not null auto_increment primary key,
    idDetalle int not null,
    numFactura varchar(45),
    valorIVA varchar(45),
    FOREIGN KEY (idDetalle) REFERENCES detalleAlmacen (idDetalle) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 10 Despacho
CREATE TABLE despacho (
	idDespacho int not null auto_increment primary key,
	idAlmacen int,
	idPlato int,
	cantidadRetirada float(8,2) not null,
	precioRetiro float(8,2) not null,
	fechaRetiro timestamp not null,
	observaciones varchar(100),
  idUsuario int not null,
	FOREIGN KEY(idAlmacen) REFERENCES almacen (idAlmacen) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(idPlato) REFERENCES plato (idPlato) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE pedido(
    idPedido int not null auto_increment primary key,
    idPlato int null,
    cantidadPlato int null,
    pedidoDespachado bool not null,
    fechaPedido date not null,
    FOREIGN KEY(idPlato) REFERENCES plato (idPlato) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE detallePedido(
    idDetallePedido int not null auto_increment primary key,
    idAlmacen int not null,
    idPedido int not null,
    cantidad float(8,2) not null,
    FOREIGN KEY(idAlmacen) REFERENCES almacen (idAlmacen) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(idPedido) REFERENCES pedido (idPedido) ON UPDATE CASCADE ON DELETE CASCADE
);
