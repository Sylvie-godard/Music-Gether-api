database:
	php bin/console doctrine:database:create

db-diff:
	php bin/console doctrine:migrations:diff

db-migrate:
	bin/console doctrine:migrations:migrate

vendors:
	composer install

clean-cache:
	rm -r var/cache/*
