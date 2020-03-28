
## DATABASE ##
database:
	docker-compose exec php bin/console doctrine:database:create --if-not-exists

database-clean:
	docker-compose exec php bin/console doctrine:database:drop --force

db-diff:
	php bin/console doctrine:migrations:diff

migration:
	docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction

db-migrate:
	bin/console doctrine:migrations:migrate

## VENDORS ##
vendors:
	docker-compose exec php composer install

## Docker ##
docker-pull:
	docker-compose -f docker-compose.yaml pull

docker-pull-debug:
	docker-compose -f docker-compose.yaml -f docker-compose.debug.yaml pull

docker-build:
	docker-compose -f docker-compose.yaml build

docker-build-debug:
	docker-compose -f docker-compose.yaml -f docker-compose.debug.yaml build

docker-run:
	docker-compose -f docker-compose.yaml up -d

docker-run-debug:
	docker-compose -f docker-compose.yaml -f docker-compose.debug.yaml up -d

docker-down:
	docker-compose down

docker-logs:
	docker-compose logs -f
ps:
	docker ps

docker-init: docker-down clean docker-pull docker-build docker-run vendors database migration
docker-init-debug: docker-down clean docker-pull-debug docker-build-debug docker-run-debug vendors database migration


## CLEAN ##
clean:
	rm -rf ./vendor ./var

clean-cache:
	rm -r var/cache/*
