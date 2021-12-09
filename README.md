# PROYECTO TOLERANTE A FALLAS (DOCKER)
**Integrantes:** 

*Dueñas Becerra Mario Alejandro*

*Hernández Huizar Jhonatan Adrián*

*Vázquez Martínez Edgar Isaías*

**Enlace del video** --> https://drive.google.com/file/d/1QppeVlnV7Sy-9CioHsGGmh9rccl4Hq80/view?usp=sharing

## IMPORTANTE
Antes de comenzar debemos tener descargadas las imagenes de Mariadb y Phpmyadmin, se pueden conseguir directamente desde los siguientes enlaces.

```
Mariadb -----> https://hub.docker.com/_/mariadb
Phpmyadmin --> https://hub.docker.com/r/phpmyadmin/phpmyadmin/
```

1. Descargar los archivos del proyecto.
2. Para agregarlos a docker primero tenemos que crear nuestra imagen del proyecto con un dockerFile, que se verá de la siguiente manera:
```
FROM php:7.4-apache
RUN docker-php-ext-install mysqli
COPY /new /var/www/html 
EXPOSE 80
```

3. Podemos crear la imagen desde visual studio code, con click derecho y *BUILD IMAGE*
![Imagen para *Build Image desde VisualStudioCode*](https://user-images.githubusercontent.com/56968654/145337321-6b8512dd-ba51-4b87-9c44-c12e9deecb80.png)

4. Una vez teniendo la imagen podemos verificar que se haya creado desde terminal usando el comando: docker images / o en la aplicación de docker en el apartado de IMAGES.
![Se muestra que se realizó la imagen del proyecto](https://user-images.githubusercontent.com/56968654/145337441-bedcb941-8792-41b4-9537-793092005107.png)


5. Lo siguente es crear el archivo docker-compose.yml, que contiene las especificaciones de como se ejecutará:
```
version: "3"
services:
  mariadb: 
    image: mariadb
    restart: always 
    environment:
      - MYSQL_ROOT_PASSWORD=root
    ports:
      - 3306:3306
    volumes:
      - ./mariadb_data:/var/lib/mysql
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    environment:
      - PMA_HOST=mariadb
      - PHM_ROOT_PASSWORD=root
    restart: always
    ports:
      - 8080:80
    volumes:
      - /sessions
    links:
      - mariadb
  ss:
    image: ss
    environment:
      - PMA_HOST=mariadb
    restart: always
    ports:
      - 3000:80
    volumes:
        - /new /var/www/html
    links:
      - mariadb
```
6. Una vez con el archivo docker-compose.yml podemos hacer un *compose up* desde las herramientas de visual studio code, con click derecho y seleccionamos la opción deseada.

![](https://user-images.githubusercontent.com/56968654/145337598-78a07506-6b17-41b6-ac8b-51333b042ccb.png)

esto nos creará contenedores de las tres imagenes que necesitamos, Mariadb, Phpmyadmin y SS (nuestra imagen de la app).

7. Ya teniendo las tres imagenes lo siguiente será revisar el contenedor para revisar su dirección IP e ingresarla en nuestra APP para que tengan comunicación entre contenedores.
Esto lo haremos directamente en la terminal, primero revisaremos los contenedores para obtener su ID, con el comando:

```
docker ps -a
```
![](https://user-images.githubusercontent.com/56968654/145339642-956bdd0b-70c6-4761-b779-79789ef7ef9b.png)

8. Buscaremos en que contenedor tenemos nuestro php/myadmin e ingresaremos:
```
docker inspect [id_del_contenedor]
```
nos interesa el siguiente apartado
```
"IPAddress": "xxx.xx.xx.x+1",
```
por que lo usaremos para ingresarlo en nuestra app.

9. Una vez con la dirrección IP de nuestro contenedor debemos cambiar la IP de todos los archivos donde requiera *$hostname* dentro de nuestra app (admin.php, check_in.php, check_out.php, index.php, prestadores.php, reporte_general.php, sesion.php, ultimos_registros.php, validar_admin2.php)

![](https://user-images.githubusercontent.com/56968654/145340046-e007a0e5-f4c6-411b-89f0-e8c4342a36f7.png)
10. Despuês repetimos el paso número 3,4,5 y el sexto pero ahora solo con *compose up - selected services* y en SS para que solo se altere el contenedor deseado.

![](https://user-images.githubusercontent.com/56968654/145341139-40e9a895-61d3-48bf-80f6-541040ea2317.png)
![](https://user-images.githubusercontent.com/56968654/145341290-dabcefdb-d081-45ec-97fe-afcfebf63066.png)

11. Una vez hecho toca configurar nuestra base de datos, ingresamos a:
```
localhost:8080
```
y quitamos la contraseña de inicio (o la podemos dejar pero en los archivos de la app debemos ingresarla también)

12. Creamos una nueva base de datos bajo el nombre de *servicio_social* e importamos la base de datos del archivo *servicio_social.sql*
y al final tendremos algo así:

![](https://user-images.githubusercontent.com/56968654/145341643-797ff08b-09cf-43e2-9752-90d667ca1c79.png)

13. Ahora solo falta ingresar a la página de nuestra app desde:
```
localhost:3000
```
y veremos que los datos de nuestra base de datos se muestran correctamente y todo funciona de manera correcta.

![](https://user-images.githubusercontent.com/56968654/145341926-71d35b79-3957-440d-86cc-f60ccb9f7791.png)
![](https://user-images.githubusercontent.com/56968654/145342438-e25391db-a7f4-4fbf-afc8-1cddf5ca1cdd.png)



