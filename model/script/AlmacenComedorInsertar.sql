
-- 1. Tipo de Usuario
INSERT INTO TipoUsuario VALUE(null, "Administrador");
INSERT INTO TipoUsuario VALUE(null, "Nutricionista");

-- 2. Usuarios
INSERT INTO Usuarios VALUE(null, 1, "gustavo", "d2xlbkNUaTBZOGNYbG1rd2trWU1iUT09", "gustavo@gmail.com", 1);
INSERT INTO Usuarios VALUE(null, 1, "stephanie", "OTN5MXJmbk5PQ1VRK3BXT3JGL0tNZz09", "stephanie@gmail.com", 1);
INSERT INTO Usuarios VALUE(null, 2, "elsy", "Y1VWZnp6YnBCTmNra2J3SGFGOFp0QT09", "elsy@gmail.com", 1);
INSERT INTO Usuarios VALUE(null, 2, "gladiz", "NzlpUlgvRFFxQWl0ZXkyTlpCNkNKUT09", "gladiz@gmail.com", 1);
INSERT INTO Usuarios VALUE(null, 2, "miriam", "ai9XdkY1L1JJWGFmSFpXRkRPMitjUT09", "miriam@gmail.com", 0);
INSERT INTO Usuarios VALUE(null, 1, "vanesa", "RDNLK1JSSHpHdCtJSUczV3ArbmJvdz09", "vanesa@gmail.com", 1);
INSERT INTO Usuarios VALUE(null, 1, "rodrigo", "NFRhZjZmSTlGS25NVjlwKzl1OC9kdz09", "rodrigopoma8@gmail.com", 1);
INSERT INTO Usuarios VALUE(null, 1, "jhonny", "Sk44blFjOXV3MTVlNXF3NWNxMFVYdz09", "jhonny@gmail.com", 1);

-- 3. Unidad Medida
INSERT INTO udiadMedida VALUE(null, "Litros", "lt");
INSERT INTO udiadMedida VALUE(null, "Kilogramos", "kg");
INSERT INTO udiadMedida VALUE(null, "Gramos", "gr");
INSERT INTO udiadMedida VALUE(null, "Amarros", "am");

-- 4. Categoria Producto
INSERT INTO categoriaProducto VALUE(null, "Tuberculos");
INSERT INTO categoriaProducto VALUE(null, "Lacteos");
INSERT INTO categoriaProducto VALUE(null, "Legumbres");
INSERT INTO categoriaProducto VALUE(null, "Cereales");
INSERT INTO categoriaProducto VALUE(null, "Hortalizas");
INSERT INTO categoriaProducto VALUE(null, "Frutas");
INSERT INTO categoriaProducto VALUE(null, "Carnes");
INSERT INTO categoriaProducto VALUE(null, "Aceites y Grasas Comestibles");
INSERT INTO categoriaProducto VALUE(null, "Condimentos");

INSERT INTO producto VALUE(null, "papa", 2, 1);
INSERT INTO producto VALUE(null, "zanahoria", 2, 1);
INSERT INTO producto VALUE(null, "arroz", 2, 4);
INSERT INTO producto VALUE(null, "lechugas", 4, 5);
INSERT INTO producto VALUE(null, "tomate", 2, 6);
INSERT INTO producto VALUE(null, "chuleta", 2, 7);
INSERT INTO producto VALUE(null, "aceite", 1, 8);
INSERT INTO producto VALUE(null, "sal", 3, 9);
INSERT INTO producto VALUE(null, "ajo", 4, 9);

INSERT INTO categoriaPlato VALUE(null, "Plato Fuerte");

INSERT INTO plato VALUE(null, 1, "Chuleta", null);

INSERT INTO receta VALUE(null, 1, 1, 0.50);
INSERT INTO receta VALUE(null, 3, 1, 1.00);
INSERT INTO receta VALUE(null, 4, 1, 1);
INSERT INTO receta VALUE(null, 5, 1, 0.30);
INSERT INTO receta VALUE(null, 6, 1, 1.20);
INSERT INTO receta VALUE(null, 7, 1, 0.50);
INSERT INTO receta VALUE(null, 8, 1, 50);
INSERT INTO receta VALUE(null, 9, 1, 1);

INSERT INTO almacen VALUE(null, 1, 50);
INSERT INTO almacen VALUE(null, 2, 50);
INSERT INTO almacen VALUE(null, 3, 50);
INSERT INTO almacen VALUE(null, 4, 50);
INSERT INTO almacen VALUE(null, 5, 30);
INSERT INTO almacen VALUE(null, 6, 10);
INSERT INTO almacen VALUE(null, 7, 30);
INSERT INTO almacen VALUE(null, 8, 5000);
INSERT INTO almacen VALUE(null, 9, 50);

INSERT INTO detallealmacen VALUE(null, 1, 50, "2018-06-08", 600, now(), 1);
INSERT INTO detallealmacen VALUE(null, 2, 50, "2018-06-08", 400, now(), 1);
INSERT INTO detallealmacen VALUE(null, 3, 50, "2018-06-08", 1200, now(), 1);
INSERT INTO detallealmacen VALUE(null, 4, 50, "2018-06-08", 60, now(), 1);
INSERT INTO detallealmacen VALUE(null, 5, 30, "2018-06-08", 350, now(), 1);
INSERT INTO detallealmacen VALUE(null, 6, 10, "2018-06-08", 500, now(), 1);
INSERT INTO detallealmacen VALUE(null, 7, 30, "2018-06-08", 150, now(), 1);
INSERT INTO detallealmacen VALUE(null, 8, 5000, "2018-06-08", 20, now(), 1);
INSERT INTO detallealmacen VALUE(null, 9, 50, "2018-06-08", 50, now(), 1);

INSERT INTO pedido VALUE(null, 1, 5, 0, now());

INSERT INTO detallePedido VALUE(null, 1, 1, 1.50);
INSERT INTO detallePedido VALUE(null, 2, 1, 3.00);
INSERT INTO detallePedido VALUE(null, 3, 1, 3.00);
INSERT INTO detallePedido VALUE(null, 4, 1, 0.90);
INSERT INTO detallePedido VALUE(null, 5, 1, 3.60);
INSERT INTO detallePedido VALUE(null, 6, 1, 1.50);
INSERT INTO detallePedido VALUE(null, 7, 1, 1.50);
INSERT INTO detallePedido VALUE(null, 8, 1, 3.00);

INSERT INTO pedido VALUE(null, 1, 15, 0, now());

INSERT INTO detallePedido VALUE(null, 1, 2, 3.50);
INSERT INTO detallePedido VALUE(null, 2, 2, 9.00);
INSERT INTO detallePedido VALUE(null, 3, 2, 9.00);
INSERT INTO detallePedido VALUE(null, 4, 2, 2.90);
INSERT INTO detallePedido VALUE(null, 5, 2, 7.60);
INSERT INTO detallePedido VALUE(null, 6, 2, 4.50);
INSERT INTO detallePedido VALUE(null, 7, 2, 4.50);
INSERT INTO detallePedido VALUE(null, 8, 2, 9.00);

INSERT INTO pedido VALUE(null, null, 0, 0, now());

INSERT INTO detallePedido VALUE(null, 1, 3, 3.50);
INSERT INTO detallePedido VALUE(null, 2, 3, 9.00);
INSERT INTO detallePedido VALUE(null, 3, 3, 9.00);
INSERT INTO detallePedido VALUE(null, 4, 3, 2.90);
INSERT INTO detallePedido VALUE(null, 5, 3, 7.60);
INSERT INTO detallePedido VALUE(null, 6, 3, 4.50);
INSERT INTO detallePedido VALUE(null, 7, 3, 4.50);
INSERT INTO detallePedido VALUE(null, 8, 3, 9.00);
