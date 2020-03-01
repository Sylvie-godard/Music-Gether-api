database:
	php bin/console doctrine:database:create

migrations:
	php bin/console make:migration

migrate:
	php bin/console doctrine:migrations:migrate

vendors:
	composer install

clean-cache:
	rm -r var/cache/*
