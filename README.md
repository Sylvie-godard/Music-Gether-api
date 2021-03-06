# Music-Gether
### Docker Compose

####Requirement:
- docker (tested with 19.03.8): https://docs.docker.com/install/linux/docker-ce/ubuntu/
- docker-compose (tested with 1.25.4): https://docs.docker.com/compose/install/

####First launch Steps
-       sudo make docker-init
   or
-       sudo make docker-init-debug (if you want to activate xdebug of php)
-   Or follow the following steps

1.    Create .env file on project root folder. (copy .env.dist)
2.    Change DATABASE_URL according to docker-compose.yaml configuration  
    example:  
    -       DATABASE_URL=mysql://root:pass@db:3306/music_gether?serverVersion=5.7&charset=utf8
3.   Docker-compose steps:  
-       docker-compose pull
-       docker-compose build
-   launch docker compose containers on background
-       docker-compose up -d
- vendors are download on docker container, but we need also vendors into local to launch symfony commands:  
-       docker-compose exec php composer install
        or
        make vendors
- [Only if first launch] then launch symfony bin/console init steps  
-       docker-compose exec php bin/console doctrine:database:create
        or
        make database
-       docker-compose exec php bin/console doctrine:database:create
        or
        make migrate
        
#### follow container logs steps
-       docker-compose logs -f
        or
        make docker-logs

#### Shutdown steps
-       docker-compose down
        or
        make docker-down

## Configuration Debugger PhpStorm
https://blog.eleven-labs.com/fr/debug-run-phpunit-tests-using-docker-remote-interpreters-with-phpstorm/

## Lancer le projet sur un server à partir de docker
-       docker-compose exec php php -S 127.0.0.1:8080 -ddisplay_errors=0 -t public public/index.php