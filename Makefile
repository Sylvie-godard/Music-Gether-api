database:
	docker-compose exec php bin/console doctrine:database:create

database-clean:
	docker-compose exec php bin/console doctrine:database:drop --force

migrations:
	docker-compose exec php bin/console make:migration

migrate:
	docker-compose exec php bin/console doctrine:migrations:migrate

vendors:
	docker-compose exec php composer install

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

clean:
	rm -rf ./vendor ./var

docker-init: docker-down clean docker-pull docker-build docker-run vendors database migrate
docker-init-debug: docker-down clean docker-pull-debug docker-build-debug docker-run-debug vendors database-clean database migrate

