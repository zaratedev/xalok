.PHONY: setup

setup:
	docker-compose up --build --detach
	docker-compose exec php composer install
	docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction