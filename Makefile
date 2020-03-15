database:
	php bin/console doctrine:database:create

diff:
	php bin/console doctrine:migrations:diff

migration:
	bin/console doctrine:migrations:migrate

vendors:
	composer install

clean-cache:
	rm -r var/cache/*
