Requerimientos: 
PHP 8.0.25
Laralvel 9
Composer 2.5.3
MySql

Descripción:

Antes de realizar inciar, deberá clonar este repositorio, 
una vez clonado, debe abrir la carpeta en un ide como visual studio code,
adicionalmente, revisar la conexión a la base de datos, 
en este caso, se realizó con una base de datos de mysql,
deberá estar conectado a una base de datos llamada inventario
debe revisar el archivo .end y realizar la siguiente configuración

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario
DB_USERNAME=user
DB_PASSWORD= password

donde user y password son los valores correspondientes a su propio servidor.
deberá también correr el comando 
php artisan migrate para que se creen las tablas correctamente, una vez hecho esto
levante el servidor con el comendo
php artisan serve

y podrá realizar las siguientes pruebas:

Sistema que permite administrar el inventario de activos de una compañía.
Permite crear nuevos empleados, crear activos y asignar los activos a los empleados.

Para crear un nuevo empleado, mediante la url:
http://127.0.0.1:8000/api/addempleoyee 
Y método post, debe enviar los parametros en formato json 
name de tipo String
document_type de tipo String 
document_number de tipo int
position de tipo String
department de tipo String 

Todos los datos son obligatorios.
Puede también consultar los empleados registrados mediante la url:
por método get
http://127.0.0.1:8000/api/getempleoyee

Puede también eliminar los empleados existantes mediante la url:
por método post, enviando el parámetro id de tipo int en formato json 
http://127.0.0.1:8000/api/deleteempleoyee

Por último, puede también actualizar los datos de un empleado en particular
mediante la url y por metodo post
enviando los parametros en formato json 
id de tipo int
name de tipo String
document_type de tipo String 
document_number de tipo int
position de tipo String
department de tipo String 
http://127.0.0.1:8000/api/updateempleoyee

Se puede también administrar la creación, visualización, actualización
y eliminación de los activos mediante las rutas:

http://127.0.0.1:8000/api/getCompanyAssets
mediante metodo get
http://127.0.0.1:8000/api/createCompanyAssets
mediante metodo post con los parametros en formato json 
serial_code de tipo String
trademark de tipo String
reference de tipo String
description de tipo String
http://127.0.0.1:8000/api/deleteCompanyAssets
mediante metodo post con el parametro id de tipo int formato json
http://127.0.0.1:8000/api/updateCompanyAssets
mediante metodo post con los parametros en formato json
id de tipo int
serial_code de tipo String
trademark de tipo String
reference de tipo String
description de tipo String

Por último, se puede administrar la asignación de los activos a los empleados
http://127.0.0.1:8000/api/getAssignment
mediante metodo get
http://127.0.0.1:8000/api/createAssignment
mediante metodo post con los parametros en formato json 
company_assets_id de tipo int
empleoyee_id de tipo int
payload de tipo String
description de tipo String
http://127.0.0.1:8000/api/deleteAssignment
mediante metodo post con el parametro id de tipo int formato json
http://127.0.0.1:8000/api/updateAssignment
mediante metodo post con los parametros en formato json
id de tipo int
company_assets_id de tipo int
empleoyee_id de tipo int


Antes de iniciaar, debe crear al menos los siguientes registros vía consulta
a mysql o utilizando los servicios mencionados anteriormente
Crear empleados
INSERT INTO empleoyee (NAME, document_type, document_number, POSITION, department)
VALUES ("Valentina", "Cédula de ciudadanía", 39384, "Auxiliar Contrable", "Finanzas"),
("Luis", "Cédula de ciudadanía", 1042065, "Desarrollaador", "Tecnologia"),
("Vanesa", "Cédula de ciudadanía", 1036159, "Auxiliar Contrable", "Finanzas"),
("Melissa", "Cédula de ciudadanía", 1017160, "Auxiliar de Nomina", "Gestion Humana"),
("Manuela", "Cédula de ciudadanía", 1014557, "Lider", "Gestion Humana")

crear activos 
INSERT INTO company_assets (serial_code, trademark, REFERENCE, DESCRIPTION)
VALUES ("24680", "ACER", "79140F", "Teclado"),
("12345", "ACER", "39384A", "Portatil"),
("54321", "ACER", "14065B", "Portatil"),
("67890", "AOC", "13619B", "Monitor"),
("09876", "AOC", "11760D", "Monitor"),
("13579", "ACER", "14557E", "Portatil")

La asignación de los activos a los empleados, se deberá hacer necesariamente 
via postman utilizando las rutas y estructuras descritas anteriomente 

Una vez creados los registros, y hechas las asignaciónes, podrá
correr las siguientes consultas las cuales responden a las preguntas
hechas en la prueba.

cantidad de activos asignados a cada empleado
SELECT empleoyee.name, COUNT(DISTINCT(assignment.id)) AS ActivosAsignados FROM assignment 
INNER JOIN empleoyee ON empleoyee.id = assignment.empleoyee_id
GROUP BY empleoyee.id

Área con menos activos asignados
SELECT  empleoyee.department, COUNT(DISTINCT(assignment.id)) AS ActivosAsignados FROM assignment 
INNER JOIN empleoyee ON empleoyee.id = assignment.empleoyee_id
GROUP BY empleoyee.id
LIMIT 1.

