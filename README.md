# pokemon-api-docker

Ejercicio Docker:

1. Crea un archivo index.php que consulte un Pokemon de la PokeAPI.
2. Necesitarás mostrar en tu web la habilidad más significativa de ese Pokemon.
3. Necesitarás crear un formulario con un input para que los jugadores puedan intentar adivinarlo.
4. Muestra por pantalla si han acertado o no.

5. Buildea el contenedor necesario y realiza los comandos necesarios para mostrar esta aplicación mediante un servicio web dentro de un contenedor y servirla a tus compañeros a través de tu ordenador físico.


Construir imagen:   docker-compose up --build

Logeo en Docker Hub: docker login

Buscar nombre de la imagen: docker images  
   REPOSITORY                 TAG       IMAGE ID       CREATED          SIZE
   pokemon-web                latest    f1e413b5a56d   14 minutes ago   702MB

Etiquetar imagen: docker tag pokemon-web lenvigo/pokemon-web

Subir imagen a Docker Hub: docker push lenvigo/pokemon-web



Ejecuta el contenedor localmente: docker run -d -p 8080:80 pokemon-web
Verifica funcionamiento del contenedor: docker ps

