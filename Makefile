database:
	docker-compose exec php bin/console doctrine:database:create

migrations:
	docker-compose exec php bin/console make:migration

migrate:
	docker-compose exec php bin/console doctrine:migrations:migrate

vendors:
	docker-compose exec php composer install

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

docker-run:
	docker-compose up -d

docker-run-debug:
	docker-compose up -d

docker-down:
	docker-compose down

docker-logs:
	docker-compose logs -f

clean:
	rm -rf ./vendor ./var

docker-init: docker-down clean docker-pull docker-build docker-run vendors database migrate

