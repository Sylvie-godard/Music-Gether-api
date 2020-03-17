

## Database
database:
	php bin/console doctrine:database:create

db-diff:
	php bin/console doctrine:migrations:diff

db-migrate:
	bin/console doctrine:migrations:migrate

## Vendors
vendors:
	composer install

## Cache
clean-cache:
	rm -r var/cache/*


## Service
service:
	php bin/console debug:autowiring


## Tests
phpstan:
	vendor/bin/phpstan analyse src/*