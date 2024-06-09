# Alina's Luxury Outlet
Alina's Luxury Outlet es una aplicación web desarrollada utilizando PHP con el framework Laravel y una base de datos PostgreSQL. Esta aplicación es una plataforma para gestionar una tienda virtual de lujo, ofreciendo una amplia gama de productos exclusivos a los clientes. La aplicación se centra en proporcionar una experiencia de compra fluida y segura, con características como autenticación de usuarios, gestión de inventario, almacenamiento de datos, secciones personalizadas para usuarios y pruebas de funcionalidad.

## Estado del Proyecto

- El proyecto Alina's Luxury Outlet se encuentra actualmente en una fase activa de desarrollo y mejora continua. Aunque la versión inicial ha sido implementada con éxito, sigo trabajando en nuevas características, mejoras de rendimiento y corrección de errores para garantizar una experiencia de usuario óptima.

## Características principales:

- Framework Laravel: Utilizando Laravel, una estructura MVC robusta y elegante, la aplicación ofrece una arquitectura sólida y bien organizada para el desarrollo de la aplicación web.
- Base de datos PostgreSQL: Con PostgreSQL como sistema de gestión de base de datos, se garantiza la integridad de los datos y el rendimiento óptimo para la manipulación de grandes volúmenes de información.
- Controladores y Vistas: Los controladores gestionan las solicitudes HTTP y coordinan la lógica de negocio, mientras que las vistas proporcionan la interfaz de usuario para interactuar con la aplicación.
- Autenticación de Usuarios: La aplicación ofrece funciones de autenticación para permitir que los usuarios se registren, inicien sesión y administren sus cuentas de manera segura.
- Gestión de Inventario: Con características de gestión de inventario, los propietarios de la tienda pueden agregar, editar y eliminar productos, así como realizar un seguimiento del stock disponible.
- Secciones Personalizadas: Se proporcionan secciones personalizadas para los usuarios, como la visualización de órdenes pasadas, la gestión de direcciones de envío y la configuración de preferencias de cuenta.
- Pruebas de Funcionalidad: Se realizan pruebas exhaustivas para garantizar el correcto funcionamiento de todas las características de la aplicación, proporcionando una experiencia de usuario sin errores.


## Requisitos

- PHP 
- Composer
- Laravel 
- Docker

## Instalación

1. Clona este repositorio en tu máquina local:

git clone https://github.com/JoselynO/Alina-s_Outlet-.git

2. Debemos tener descargado Docker en nuestra máquina: 

Si no lo tienes descargado puedes hacerlo desde la página oficial de Docker: [Docker](https://www.docker.com/products/docker-desktop)

3. Instala las dependencias del proyecto usando Composer:

composer install

4. Estamos en nuestro proyecto y ejecutamos el programa:

./vendor/bin/sail up -d

5. Ejecutamos las migraciones de la Base de Datos:

./vendor/bin/sail artisan migrate:fresh

6. Ejecutamos las seeder en la Base de Datos:

./vendor/bin/sail artisan db:seed

7. Ejecutamos el Auth:

npm run dev

8. Visita `http://127.0.0.1/` en tu navegador para ver la aplicación en funcionamiento. o abre el puerto dentro de Docker.

## Uso

- Regístrate como usuario para acceder a todas las funcionalidades.
- Inicia sesión en tu cuenta para comenzar a gestionar los productos de la tienda.
- Agrega nuevos productos, edita la información existente y elimina productos no deseados.

## Estructura de Directorios

- **app/**: Contiene la lógica de la aplicación.
- **bootstrap/**: Archivos de inicio de la aplicación.
- **config/**: Archivos de configuración.
- **database/**: Migraciones y semillas de la base de datos.
- **public/**: Archivos públicos accesibles desde el navegador.
- **resources/**: Vistas, archivos de idioma y recursos adicionales.
- **routes/**: Rutas de la aplicación.
- **storage/**: Archivos generados por la aplicación.
- **tests/**: Pruebas automatizadas para la web y endpoints de nuestra tienda virtual.

## Tabla de funcion básicas del Carrito

| Ruta                                      | Controlador          | Método     | Descripción                                                                   | Middleware           |
|-------------------------------------------|----------------------|------------|-------------------------------------------------------------------------------|----------------------|
| /cart                                     | CartController       | GET        | Muestra el carrito de compras.                                                | auth, admin          |
| /cart                                     | CartController       | PUT        | Actualiza un elemento en el carrito de compras.                               | auth, admin          |
| /cart                                     | CartController       | DELETE     | Elimina un elemento del carrito de compras.                                   | auth, admin          |

## ¿Que hace nuestro carrito?
El carrito de compras es una funcionalidad esencial en cualquier plataforma de comercio electrónico que permite a los usuarios seleccionar y organizar los productos que desean comprar antes de proceder al pago. Nuestro carrito de compras ofrece una experiencia intuitiva y conveniente para los usuarios, permitiéndoles agregar, eliminar y modificar productos fácilmente.

- Una de las características destacadas de nuestro carrito es su capacidad para mostrar de manera clara y concisa los productos seleccionados, junto con su cantidad y precio unitario. Los usuarios pueden visualizar el subtotal de cada producto y el total acumulado de la compra en tiempo real, lo que les proporciona una visión completa de su orden antes de proceder al pago.

- Además de la funcionalidad básica de agregar y eliminar productos, nuestro carrito de compras también permite a los usuarios realizar acciones como actualizar la cantidad de un artículo específico o eliminar productos no deseados con facilidad. Esto proporciona flexibilidad y control total sobre la selección de productos, lo que mejora la experiencia de compra del usuario.

- Otra característica clave es la capacidad de nuestro carrito para gestionar múltiples productos y cantidades, lo que permite a los usuarios realizar compras tanto de artículos individuales como de múltiples unidades de un mismo producto. Esto es especialmente útil para aquellos que desean comprar grandes cantidades de un artículo específico o agregar varios productos a su orden de una sola vez.



## Tabla de Funciones básicas de Productos
| Ruta                                      | Controlador          | Método     | Descripción                                                                   | Middleware           |
|-------------------------------------------|----------------------|------------|-------------------------------------------------------------------------------|----------------------|
| /products                                 | ProductsController   | GET        | Muestra una lista de todos los productos.                                    | auth, admin          |
| /products/create                          | ProductsController   | GET        | Muestra el formulario para crear un nuevo producto.                          | auth, admin          |
| /products                                | ProductsController   | POST       | Guarda un nuevo producto en la base de datos.                                | auth, admin          |
| /products/{product}                      | ProductsController   | GET        | Muestra los detalles de un producto específico.                              |                      |
| /products/{product}/edit                 | ProductsController   | GET        | Muestra el formulario para editar un producto existente.                     | auth, admin          |
| /products/{product}                      | ProductsController   | PUT/PATCH  | Actualiza la información de un producto en la base de datos.                 | auth, admin          |
| /products/{product}                      | ProductsController   | DELETE     | Elimina un producto de la base de datos.                                     | auth, admin          |
| /products/{product}/edit-image           | ProductsController   | GET        | Muestra el formulario para editar la imagen de un producto.                  | auth, admin          |
| /products/{product}/edit-image           | ProductsController   | PATCH      | Actualiza la imagen de un producto en la base de datos.                      | auth, admin          |

## ¿Que hacé nuestro Producto?
Una de las principales funcionalidades de nuestro producto es su capacidad para proporcionar a los usuarios una vista completa y detallada de cada artículo. Desde su nombre y descripción hasta su precio y disponibilidad, nuestro producto ofrece información clara y concisa para ayudar a los clientes a tomar decisiones informadas de compra.

- Además de la visualización de detalles, nuestro producto ofrece opciones de interacción intuitivas que permiten a los usuarios (Admin) realizar acciones como editar, actualizar o eliminar un producto según sus necesidades. Con funciones de edición de fácil acceso, los clientes pueden personalizar sus selecciones de productos de acuerdo con sus preferencias individuales.

- La gestión eficiente de la información del producto es otra característica destacada. Nuestro producto garantiza la integridad y precisión de los datos almacenados, lo que facilita la actualización y mantenimiento de la base de datos de productos. Los usuarios pueden confiar en la exactitud de la información presentada, lo que contribuye a una experiencia de compra sin problemas y sin sorpresas desagradables.

## Tabla de Funciones básicas en Categorias
| Ruta                                      | Controlador          | Método     | Descripción                                                                   | Middleware           |
|-------------------------------------------|----------------------|------------|-------------------------------------------------------------------------------|----------------------|
| /categories                               | CategoriesController | GET        | Muestra una lista de todas las categorías.                                   | auth, admin          |
| /categories/create                        | CategoriesController | GET        | Muestra el formulario para crear una nueva categoría.                        | auth, admin          |
| /categories                               | CategoriesController | POST       | Guarda una nueva categoría en la base de datos.                              | auth, admin          |
| /categories/{category}                    | CategoriesController | GET        | Muestra los detalles de una categoría específica.                            |                      |
| /categories/{category}/edit               | CategoriesController | GET        | Muestra el formulario para editar una categoría existente.                   | auth, admin          |
| /categories/{category}                    | CategoriesController | PUT/PATCH  | Actualiza la información de una categoría en la base de datos.               | auth, admin          |
| /categories/{category}                    | CategoriesController | DELETE     | Elimina una categoría de la base de datos.                                   | auth, admin          |
| /categories/{category}/edit-image         | CategoriesController | GET        | Muestra el formulario para editar la imagen de una categoría.                | auth, admin          |
| /categories/{category}/edit-image         | CategoriesController | PATCH      | Actualiza la imagen de una categoría en la base de datos.                    | auth, admin          |

## ¿Que hacé nuestra Categoría?
Una de las principales funcionalidades de nuestra categoría es su capacidad para mostrar una lista completa y organizada de todas las categorías disponibles. Desde categorías principales hasta subcategorías específicas, nuestra solución proporciona una visión global de la estructura de productos, permitiendo a los usuarios explorar y descubrir fácilmente diferentes opciones.

- Además de la visualización de categorías, nuestra solución ofrece funcionalidades de gestión robustas que permiten a los administradores crear, editar y eliminar categorías según sea necesario. Con formularios intuitivos y opciones de edición accesibles, los administradores pueden personalizar y mantener la estructura de categorías de manera eficiente y sin complicaciones.

- Nuestra categoría también se destaca por su capacidad para mostrar detalles completos y descriptivos de cada categoría, incluyendo su nombre, descripción y opciones de imagen. Esto proporciona a los usuarios una comprensión clara de cada categoría y les ayuda a tomar decisiones informadas sobre qué productos explorar dentro de cada una.

- Además, nuestra solución está diseñada para ser altamente flexible y escalable. Con la capacidad de gestionar un gran volumen de categorías y adaptarse a las necesidades cambiantes del negocio, garantizamos que nuestra plataforma de categorización pueda crecer y evolucionar junto con el crecimiento del catálogo de productos.

## Estado de Pruebas
- Se están realizando pruebas exhaustivas de funcionalidad y rendimiento para detectar y corregir cualquier error o problema potencial.
- La aplicación está siendo sometida a pruebas de usabilidad para garantizar una experiencia de usuario intuitiva y satisfactoria.

## Licencia

- Este proyecto está bajo la Licencia Creative Commons.


## Contribuciones y Retroalimentación

-¡Se anima a la comunidad de desarrolladores y usuarios a contribuir al proyecto! Si tienes ideas, sugerencias o deseas informar sobre problemas, no dudes en abrir un problema o enviar una solicitud de extracción en GitHub.


