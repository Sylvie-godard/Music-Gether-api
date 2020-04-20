## DATABASE ##
database:
	docker-compose exec php bin/console doctrine:database:create --if-not-exists

database-clean:
	docker-compose exec php bin/console doctrine:database:drop --force

db-diff:
	docker-compose exec php bin/console doctrine:migrations:diff

migration:
	docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction

db-migrate:
	docker-compose exec php bin/console doctrine:migrations:migrate

db-update:
	docker-compose exec php bin/console doctrine:schema:update --force

## VENDORS ##
vendors:
	docker-compose exec php php -n /usr/bin/composer install

bin-console:
	docker-compose exec php bin/console
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

logs:
	docker-compose logs -f
ps:
	docker ps

docker-init: docker-down clean docker-pull docker-build docker-run vendors database migration
docker-init-debug: docker-down clean docker-pull-debug docker-build-debug docker-run-debug vendors database migration


## CLEAN ##
clean:
	rm -rf ./vendor ./var

## Cache
clean-cache:
	rm -r var/cache/*


## Service
service:
	docker-compose exec php bin/console debug:autowiring

## DEBUG

debug-router:
	docker-compose exec php bin/console debug:router


## Tests
test-phpstan:
	docker-compose exec php vendor/bin/phpstan analyse src/*

fixture:
	docker-compose exec php bin/console doctrine:fixtures:load